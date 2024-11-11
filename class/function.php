<?php
session_start();
include './../config/config.php';

class Dosen
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    private function alertdanger($action, $url)
    {
        $alert = "
        Swal.fire(
            'Failed',
            'Gagal " . $action . "',
            'error'
        ).then(function() {
            window.location.href = '" . $url . "';
        });
        ";
        return $alert;
    }
    public function login($nik, $password)
    {
        $nik = $this->conn->real_escape_string($nik);
        $sql = "SELECT * FROM dosen WHERE nik = '$nik'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (md5($password) == $row["password"]) {
                $_SESSION['dosen_id'] = $row['id'];
                return "window.location.href = 'dashboard.php'";
            } else {
                $message = $this->alertdanger("Login", 'index.php');
            }
        } else {
            $message = $this->alertdanger("Login", 'index.php');
        }
        return $message;
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        return true;
    }

    public function getDosen($id)
    {
        $id = $this->conn->real_escape_string($id);
        $qry = $this->conn->query("SELECT * FROM dosen WHERE id ='$id'");
        $data = $qry->fetch_assoc();
        return $data;
    }

}


class MataKuliah
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function getMataKuliah($dosen_id)
    {
        $data = array();
        $qry = $this->conn->query("SELECT mk.*, COUNT(mmk.mahasiswa_id) AS jumlah_mahasiswa FROM mata_kuliah mk INNER JOIN mata_kuliah_mahasiswa mmk ON mk.id = mmk.mata_kuliah_id WHERE mk.dosen_id = $dosen_id GROUP BY mk.nama;");
        while ($pecah = $qry->fetch_assoc()) {
            $data[] = $pecah;
        }
        return $data;
    }

    public function detailMataKuliah($mata_kuliah_id)
    {
        $qry = $this->conn->query("SELECT * FROM mata_kuliah WHERE id=$mata_kuliah_id");
        return $qry->fetch_assoc();
    }

}

class Mahasiswa
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getMahasiswaByMataKuliah($mata_kuliah_id)
    {
        $data = array();
        if (!$mata_kuliah_id) {
            return $data;
        }
        $qry = $this->conn->query("SELECT mahasiswa.*, mata_kuliah.nama AS nama_mata_kuliah
        FROM mata_kuliah_mahasiswa 
        JOIN mahasiswa ON mata_kuliah_mahasiswa.mahasiswa_id = mahasiswa.id
        JOIN mata_kuliah ON mata_kuliah_mahasiswa.mata_kuliah_id = mata_kuliah.id
        WHERE mata_kuliah_mahasiswa.mata_kuliah_id = $mata_kuliah_id
        ORDER BY mahasiswa.nama ASC;");
        while ($pecah = $qry->fetch_assoc()) {
            $data[] = $pecah;
        }
        return $data;
    }

    public function detailMahasiswa($mahasiswa_id)
    {
        $qry = $this->conn->query("SELECT * FROM mahasiswa WHERE id=$mahasiswa_id");
        return $qry->fetch_assoc();
    }
}

class Nilai
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    private function alertsuccess($action, $url)
    {
        $alert = "
       Swal.fire(
            'Sukses',
            'Data Berhasil " . $action . "',
            'success'
        ).then(function() {
            window.location.href = '" . $url . "';
        });
        ";
        return $alert;
    }

    // Alert ketika data gagal di tambahkan/dihapus/diedit
    private function alertdanger($action, $url)
    {
        $alert = "
        Swal.fire(
            'Failed',
            'Data Gagal " . $action . "',
            'error'
        ).then(function() {
            window.location.href = '" . $url . "';
        });
        ";
        return $alert;
    }
    public function getNilaiByType($mahasiswa_id, $mata_kuliah_id, $type)
    {
        $data = array();
        $qry = $this->conn->query("SELECT
        m.nama,
        mk.nama AS mata_kuliah,
        n.nilai,
        n.type,
        n.keterangan,
        n.id
        FROM
            nilai_mata_kuliah_mahasiswa n
        INNER JOIN mahasiswa m ON n.id_mahasiswa = m.id
        INNER JOIN mata_kuliah mk ON n.id_mata_kuliah = mk.id
        WHERE
        m.id = $mahasiswa_id
        AND mk.id = $mata_kuliah_id
        AND n.type = '$type';");
        while ($pecah = $qry->fetch_assoc()) {
            $data[] = $pecah;
        }
        return $data;
    }

    public function addNilai($mahasiswa_id, $mata_kuliah_id, $nilai, $keterangan, $type)
    {
        $qry = $this->conn->query("INSERT INTO `nilai_mata_kuliah_mahasiswa` (`id`, `id_mahasiswa`, `id_mata_kuliah`, `nilai`, `keterangan`, `type`) VALUES (NULL, '$mahasiswa_id', '$mata_kuliah_id', '$nilai', '$keterangan', '$type');");
        if ($qry) {
            return $this->alertsuccess('Ditambahkan', 'detail_nilai.php?id_mahasiswa=' . $mahasiswa_id . '&id_mata_kuliah=' . $mata_kuliah_id);
        } else {
            return $this->alertdanger('Ditambahkan', 'detail_nilai.php?id_mahasiswa=' . $mahasiswa_id . '&id_mata_kuliah=' . $mata_kuliah_id);
        }
    }

    public function editNilai($mahasiswa_id, $mata_kuliah_id, $nilai, $keterangan, $nilai_id)
    {
        $qry = $this->conn->query("UPDATE nilai_mata_kuliah_mahasiswa SET nilai=$nilai, keterangan='$keterangan' WHERE nilai_mata_kuliah_mahasiswa.id=$nilai_id;");
        if ($qry) {
            return $this->alertsuccess("Diubah", 'detail_nilai.php?id_mahasiswa=' . $mahasiswa_id . '&id_mata_kuliah=' . $mata_kuliah_id);
        } else {
            return $this->alertdanger("Diubah", 'detail_nilai.php?id_mahasiswa=' . $mahasiswa_id . '&id_mata_kuliah=' . $mata_kuliah_id);
        }
    }

    public function deleteNilai($mahasiswa_id, $mata_kuliah_id, $nilai_id)
    {
        $qry = $this->conn->query("DELETE FROM nilai_mata_kuliah_mahasiswa WHERE nilai_mata_kuliah_mahasiswa.id = '$nilai_id'");
        if ($qry) {
            return $this->alertsuccess("Dihapus", 'detail_nilai.php?id_mahasiswa=' . $mahasiswa_id . '&id_mata_kuliah=' . $mata_kuliah_id);
        } else {
            return $this->alertdanger("Dihapus", 'detail_nilai.php?id_mahasiswa=' . $mahasiswa_id . '&id_mata_kuliah=' . $mata_kuliah_id);
        }
    }
}

$conn = $db->connection();
$dosen = new Dosen($conn);
$mata_kuliah = new MataKuliah($conn);
$mahasiswa = new Mahasiswa($conn);
$nilai = new Nilai($conn);