<?php
include '../class/function.php';
if (isset($_SESSION['dosen_id'])) {
    $dosen_id = $_SESSION['dosen_id'];
    $data_dosen = $dosen->getDosen($dosen_id);
} else {
    header('Location : index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="../style/dashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Detail Nilai</title>
</head>

<body>
    <?php
    if (isset($_POST['submit'])) {
        $addNilai = $nilai->addNilai(
            $_POST['id_mahasiswa'],
            $_POST['id_mata_kuliah'],
            $_POST['nilai'],
            $_POST['keterangan'],
            $_POST['type'],
        );

        echo '<script>' . $addNilai . '</script>';
    }

    if (isset($_POST['edit'])) {
        $editNilai = $nilai->editNilai(
            $_POST['id_mahasiswa'],
            $_POST['id_mata_kuliah'],
            $_POST['nilai'],
            $_POST['keterangan'],
            $_POST['id_nilai'],
        );

        echo '<script>' . $editNilai . '</script>';
    }

    if (isset($_GET['hapus'])) {
        $deleteNilai = $nilai->deleteNilai(
            $_GET['id_mahasiswa'],
            $_GET['id_mata_kuliah'],
            $_GET['hapus'],
        );

        echo '<script>' . $deleteNilai . '</script>';
    }

    $detail_mahasiswa = $mahasiswa->detailMahasiswa(@$_GET['id_mahasiswa']);
    $detail_mata_kuliah = $mata_kuliah->detailMataKuliah(@$_GET['id_mata_kuliah']);
    $nilai_diskusi = $nilai->getNilaiByType($_GET['id_mahasiswa'], $_GET['id_mata_kuliah'], 'diskusi');
    $nilai_praktikum = $nilai->getNilaiByType($_GET['id_mahasiswa'], $_GET['id_mata_kuliah'], 'praktikum');
    $nilai_responsi = $nilai->getNilaiByType($_GET['id_mahasiswa'], $_GET['id_mata_kuliah'], 'responsi');
    $nilai_uts = $nilai->getNilaiByType($_GET['id_mahasiswa'], $_GET['id_mata_kuliah'], 'uts');
    $nilai_uas = $nilai->getNilaiByType($_GET['id_mahasiswa'], $_GET['id_mata_kuliah'], 'uas');
    ?>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php
        include 'sidebar.php';
        ?>
        <!-- Main -->
        <div class="main">
            <?php
            include 'header.php';
            ?>
            <!-- content -->
            <button type="button" class="btn btn-primary ms-4 my-4" data-bs-toggle="modal"
                data-bs-target="#tambahNilaiModal">
                Tambah Penilaian
            </button>

            <div class="modal fade" id="tambahNilaiModal" tabindex="-1" aria-labelledby="tambahNilaiModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahNilaiModalLabel">Tambah Penilaian</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST"
                                action="detail_nilai.php?id_mahasiswa=<?= $detail_mahasiswa["id"] ?>&id_mata_kuliah=<?= $detail_mata_kuliah["id"] ?>">
                                <input type="hidden" class="form-control" id="id_mahasiswa" name="id_mahasiswa"
                                    value="<?= $detail_mahasiswa["id"] ?>">
                                <input type="hidden" class="form-control" id="id_mata_kuliah" name="id_mata_kuliah"
                                    value="<?= $detail_mata_kuliah["id"] ?>">
                                <div class="mb-3">
                                    <label for="nilai" class="form-label">Nilai</label>
                                    <input type="number" class="form-control" id="nilai" name="nilai">
                                </div>
                                <div class="mb-3">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="type" class="form-label">Type</label>
                                    <select name="type" id="type" class="form-select form-select-sm mb-3"
                                        aria-label=".form-select-sm example">
                                        <option value="diskusi">Diskusi</option>
                                        <option value="praktikum">Praktikum</option>
                                        <option value="responsi">Responsi</option>
                                        <option value="uts">UTS</option>
                                        <option value="uas">UAS</option>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">

                <div class="row">
                    <div class="col-md-12 py-2">

                        <div class="card">
                            <div class="card-header">
                                Detail Nilai Mahasiswa
                            </div>
                            <div class="card-body-sm">
                                <table class="table">
                                    <tr>
                                        <td>Nama</td>
                                        <td>:</td>
                                        <td>
                                            <?= $detail_mahasiswa["nama"] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>NIM</td>
                                        <td>:</td>
                                        <td><?= $detail_mahasiswa["nim"] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Prodi</td>
                                        <td>:</td>
                                        <td><?= $detail_mahasiswa["prodi"] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mata Kuliah</td>
                                        <td>:</td>
                                        <td><?= $detail_mata_kuliah["nama"] ?></td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-md-6 py-2">
                        <div class="card">
                            <div class="card-header">
                                Nilai Diskusi
                            </div>
                            <div class="card-body-sm">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nilai</th>
                                            <th>Keterangan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (count($nilai_diskusi) > 0) {
                                            foreach ($nilai_diskusi as $key): ?>
                                                <tr>
                                                    <td> <?= $key["nilai"] ?> </td>
                                                    <td><?= $key["keterangan"] ?></td>
                                                    <td>
                                                        <a href='#' data-bs-toggle='modal'
                                                            data-bs-target='#editModal<?= $key['id'] ?>'
                                                            data-id='{<?= $key['id'] ?></a>}'
                                                            data-nilai='{<?= $key['nilai'] ?>}'
                                                            data-keterangan='{<?= $key['keterangan'] ?>}'>Edit |</a>
                                                        <a
                                                            href="detail_nilai.php?hapus=<?= $key['id'] ?>&id_mahasiswa=<?= $detail_mahasiswa["id"] ?>&id_mata_kuliah=<?= $detail_mata_kuliah["id"] ?>">Hapus
                                                        </a>
                                                    </td>
                                                    <div class="modal fade" id="editModal<?= $key['id'] ?>" tabindex="-1"
                                                        aria-labelledby="editModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="editModal<?= $key['id'] ?>">Edit
                                                                        Nilai</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form id="editForm" method="POST"
                                                                        action="detail_nilai.php?id_mahasiswa=<?= $detail_mahasiswa["id"] ?>&id_mata_kuliah=<?= $detail_mata_kuliah["id"] ?>">
                                                                        <input type="hidden" id="id_nilai" name="id_nilai"
                                                                            value=<?= $key["id"] ?>>
                                                                        <input type="hidden" class="form-control"
                                                                            id="id_mahasiswa" name="id_mahasiswa"
                                                                            value="<?= $detail_mahasiswa["id"] ?>">
                                                                        <input type="hidden" class="form-control"
                                                                            id="id_mata_kuliah" name="id_mata_kuliah"
                                                                            value="<?= $detail_mata_kuliah["id"] ?>">
                                                                        <div class="mb-3">
                                                                            <label for="editNilai"
                                                                                class="form-label">Nilai</label>
                                                                            <input type="number" class="form-control"
                                                                                id="editNilai" name="nilai"
                                                                                value=<?= $key['nilai'] ?>>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="editKeterangan"
                                                                                class="form-label">Keterangan</label>
                                                                            <input type="text" class="form-control"
                                                                                id="editKeterangan" name="keterangan"
                                                                                value="<?= $key["keterangan"] ?>"></input>
                                                                        </div>
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Tutup</button>
                                                                        <button type="submit" class="btn btn-primary"
                                                                            id="btnSimpanEdit" name="edit">Simpan</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </tr>
                                            <?php endforeach;
                                        } else {
                                            echo '<tr>';
                                            echo '<td>Belum ada nilai</td>';
                                            echo '<td>-</td>';
                                            echo '<td>-</td>';
                                            echo '</tr>';
                                        }
                                        ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 py-2">
                        <div class="card">
                            <div class="card-header">
                                Nilai Praktikum
                            </div>
                            <div class="card-body-sm">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nilai</th>
                                            <th>Keterangan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (count($nilai_praktikum) > 0) {
                                            foreach ($nilai_praktikum as $key): ?>
                                                <tr>
                                                    <td> <?= $key["nilai"] ?> </td>
                                                    <td><?= $key["keterangan"] ?></td>
                                                    <td>
                                                        <a href='#' data-bs-toggle='modal'
                                                            data-bs-target='#editModal<?= $key['id'] ?>'
                                                            data-id='{<?= $key['id'] ?></a>}'
                                                            data-nilai='{<?= $key['nilai'] ?>}'
                                                            data-keterangan='{<?= $key['keterangan'] ?>}'>Edit |</a>
                                                        <a
                                                            href="detail_nilai.php?hapus=<?= $key['id'] ?>&id_mahasiswa=<?= $detail_mahasiswa["id"] ?>&id_mata_kuliah=<?= $detail_mata_kuliah["id"] ?>">Hapus
                                                        </a>
                                                    </td>
                                                    <div class="modal fade" id="editModal<?= $key['id'] ?>" tabindex="-1"
                                                        aria-labelledby="editModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="editModal<?= $key['id'] ?>">Edit
                                                                        Nilai</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form id="editForm" method="POST"
                                                                        action="detail_nilai.php?id_mahasiswa=<?= $detail_mahasiswa["id"] ?>&id_mata_kuliah=<?= $detail_mata_kuliah["id"] ?>">
                                                                        <input type="hidden" id="id_nilai" name="id_nilai"
                                                                            value=<?= $key["id"] ?>>
                                                                        <input type="hidden" class="form-control"
                                                                            id="id_mahasiswa" name="id_mahasiswa"
                                                                            value="<?= $detail_mahasiswa["id"] ?>">
                                                                        <input type="hidden" class="form-control"
                                                                            id="id_mata_kuliah" name="id_mata_kuliah"
                                                                            value="<?= $detail_mata_kuliah["id"] ?>">
                                                                        <div class="mb-3">
                                                                            <label for="editNilai"
                                                                                class="form-label">Nilai</label>
                                                                            <input type="number" class="form-control"
                                                                                id="editNilai" name="nilai"
                                                                                value=<?= $key['nilai'] ?>>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="editKeterangan"
                                                                                class="form-label">Keterangan</label>
                                                                            <input type="text" class="form-control"
                                                                                id="editKeterangan" name="keterangan"
                                                                                value="<?= $key["keterangan"] ?>"></input>
                                                                        </div>
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Tutup</button>
                                                                        <button type="submit" class="btn btn-primary"
                                                                            id="btnSimpanEdit" name="edit">Simpan</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </tr>
                                            <?php endforeach;
                                        } else {
                                            echo '<tr>';
                                            echo '<td>Belum ada nilai</td>';
                                            echo '<td>-</td>';
                                            echo '<td>-</td>';
                                            echo '</tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 py-2">
                        <div class="card">
                            <div class="card-header">
                                Nilai Responsi
                            </div>
                            <div class="card-body-sm">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nilai</th>
                                            <th>Keterangan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (count($nilai_responsi) > 0) {
                                            foreach ($nilai_responsi as $key): ?>
                                                <tr>
                                                    <td> <?= $key["nilai"] ?> </td>
                                                    <td><?= $key["keterangan"] ?></td>
                                                    <td>
                                                        <a href='#' data-bs-toggle='modal'
                                                            data-bs-target='#editModal<?= $key['id'] ?>'
                                                            data-id='{<?= $key['id'] ?></a>}'
                                                            data-nilai='{<?= $key['nilai'] ?>}'
                                                            data-keterangan='{<?= $key['keterangan'] ?>}'>Edit |</a>
                                                        <a
                                                            href="detail_nilai.php?hapus=<?= $key['id'] ?>&id_mahasiswa=<?= $detail_mahasiswa["id"] ?>&id_mata_kuliah=<?= $detail_mata_kuliah["id"] ?>">Hapus
                                                        </a>
                                                    </td>
                                                    <div class="modal fade" id="editModal<?= $key['id'] ?>" tabindex="-1"
                                                        aria-labelledby="editModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="editModal<?= $key['id'] ?>">Edit
                                                                        Nilai</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form id="editForm" method="POST"
                                                                        action="detail_nilai.php?id_mahasiswa=<?= $detail_mahasiswa["id"] ?>&id_mata_kuliah=<?= $detail_mata_kuliah["id"] ?>">
                                                                        <input type="hidden" id="id_nilai" name="id_nilai"
                                                                            value=<?= $key["id"] ?>>
                                                                        <input type="hidden" class="form-control"
                                                                            id="id_mahasiswa" name="id_mahasiswa"
                                                                            value="<?= $detail_mahasiswa["id"] ?>">
                                                                        <input type="hidden" class="form-control"
                                                                            id="id_mata_kuliah" name="id_mata_kuliah"
                                                                            value="<?= $detail_mata_kuliah["id"] ?>">
                                                                        <div class="mb-3">
                                                                            <label for="editNilai"
                                                                                class="form-label">Nilai</label>
                                                                            <input type="number" class="form-control"
                                                                                id="editNilai" name="nilai"
                                                                                value=<?= $key['nilai'] ?>>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="editKeterangan"
                                                                                class="form-label">Keterangan</label>
                                                                            <input type="text" class="form-control"
                                                                                id="editKeterangan" name="keterangan"
                                                                                value="<?= $key["keterangan"] ?>"></input>
                                                                        </div>
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Tutup</button>
                                                                        <button type="submit" class="btn btn-primary"
                                                                            id="btnSimpanEdit" name="edit">Simpan</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </tr>
                                            <?php endforeach;
                                        } else {
                                            echo '<tr>';
                                            echo '<td>Belum ada nilai</td>';
                                            echo '<td>-</td>';
                                            echo '<td>-</td>';
                                            echo '</tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 py-2">
                        <div class="card">
                            <div class="card-header">
                                Nilai UTS
                            </div>
                            <div class="card-body-sm">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nilai</th>
                                            <th>Keterangan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (count($nilai_uts) > 0) {
                                            foreach ($nilai_uts as $key): ?>
                                                <tr>
                                                    <td> <?= $key["nilai"] ?> </td>
                                                    <td><?= $key["keterangan"] ?></td>
                                                    <td>
                                                        <a href='#' data-bs-toggle='modal'
                                                            data-bs-target='#editModal<?= $key['id'] ?>'
                                                            data-id='{<?= $key['id'] ?></a>}'
                                                            data-nilai='{<?= $key['nilai'] ?>}'
                                                            data-keterangan='{<?= $key['keterangan'] ?>}'>Edit |</a>
                                                        <a
                                                            href="detail_nilai.php?hapus=<?= $key['id'] ?>&id_mahasiswa=<?= $detail_mahasiswa["id"] ?>&id_mata_kuliah=<?= $detail_mata_kuliah["id"] ?>">Hapus
                                                        </a>
                                                    </td>
                                                    <div class="modal fade" id="editModal<?= $key['id'] ?>" tabindex="-1"
                                                        aria-labelledby="editModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="editModal<?= $key['id'] ?>">Edit
                                                                        Nilai</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form id="editForm" method="POST"
                                                                        action="detail_nilai.php?id_mahasiswa=<?= $detail_mahasiswa["id"] ?>&id_mata_kuliah=<?= $detail_mata_kuliah["id"] ?>">
                                                                        <input type="hidden" id="id_nilai" name="id_nilai"
                                                                            value=<?= $key["id"] ?>>
                                                                        <input type="hidden" class="form-control"
                                                                            id="id_mahasiswa" name="id_mahasiswa"
                                                                            value="<?= $detail_mahasiswa["id"] ?>">
                                                                        <input type="hidden" class="form-control"
                                                                            id="id_mata_kuliah" name="id_mata_kuliah"
                                                                            value="<?= $detail_mata_kuliah["id"] ?>">
                                                                        <div class="mb-3">
                                                                            <label for="editNilai"
                                                                                class="form-label">Nilai</label>
                                                                            <input type="number" class="form-control"
                                                                                id="editNilai" name="nilai"
                                                                                value=<?= $key['nilai'] ?>>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="editKeterangan"
                                                                                class="form-label">Keterangan</label>
                                                                            <input type="text" class="form-control"
                                                                                id="editKeterangan" name="keterangan"
                                                                                value="<?= $key["keterangan"] ?>"></input>
                                                                        </div>
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Tutup</button>
                                                                        <button type="submit" class="btn btn-primary"
                                                                            id="btnSimpanEdit" name="edit">Simpan</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </tr>
                                            <?php endforeach;
                                        } else {
                                            echo '<tr>';
                                            echo '<td>Belum ada nilai</td>';
                                            echo '<td>-</td>';
                                            echo '<td>-</td>';
                                            echo '</tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 py-2">
                        <div class="card">
                            <div class="card-header">
                                Nilai UAS
                            </div>
                            <div class="card-body-sm">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nilai</th>
                                            <th>Keterangan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (count($nilai_uas) > 0) {
                                            foreach ($nilai_uas as $key): ?>
                                                <tr>
                                                    <td> <?= $key["nilai"] ?> </td>
                                                    <td><?= $key["keterangan"] ?></td>
                                                    <td>
                                                        <a href='#' data-bs-toggle='modal'
                                                            data-bs-target='#editModal<?= $key['id'] ?>'
                                                            data-id='{<?= $key['id'] ?></a>}'
                                                            data-nilai='{<?= $key['nilai'] ?>}'
                                                            data-keterangan='{<?= $key['keterangan'] ?>}'>Edit |</a>
                                                        <a
                                                            href="detail_nilai.php?hapus=<?= $key['id'] ?>&id_mahasiswa=<?= $detail_mahasiswa["id"] ?>&id_mata_kuliah=<?= $detail_mata_kuliah["id"] ?>">Hapus
                                                        </a>
                                                    </td>
                                                    <div class="modal fade" id="editModal<?= $key['id'] ?>" tabindex="-1"
                                                        aria-labelledby="editModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="editModal<?= $key['id'] ?>">Edit
                                                                        Nilai</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form id="editForm" method="POST"
                                                                        action="detail_nilai.php?id_mahasiswa=<?= $detail_mahasiswa["id"] ?>&id_mata_kuliah=<?= $detail_mata_kuliah["id"] ?>">
                                                                        <input type="hidden" id="id_nilai" name="id_nilai"
                                                                            value=<?= $key["id"] ?>>
                                                                        <input type="hidden" class="form-control"
                                                                            id="id_mahasiswa" name="id_mahasiswa"
                                                                            value="<?= $detail_mahasiswa["id"] ?>">
                                                                        <input type="hidden" class="form-control"
                                                                            id="id_mata_kuliah" name="id_mata_kuliah"
                                                                            value="<?= $detail_mata_kuliah["id"] ?>">
                                                                        <div class="mb-3">
                                                                            <label for="editNilai"
                                                                                class="form-label">Nilai</label>
                                                                            <input type="number" class="form-control"
                                                                                id="editNilai" name="nilai"
                                                                                value=<?= $key['nilai'] ?>>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="editKeterangan"
                                                                                class="form-label">Keterangan</label>
                                                                            <input type="text" class="form-control"
                                                                                id="editKeterangan" name="keterangan"
                                                                                value="<?= $key["keterangan"] ?>"></input>
                                                                        </div>
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Tutup</button>
                                                                        <button type="submit" class="btn btn-primary"
                                                                            id="btnSimpanEdit" name="edit">Simpan</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </tr>
                                            <?php endforeach;
                                        } else {
                                            echo '<tr>';
                                            echo '<td>Belum ada nilai</td>';
                                            echo '<td>-</td>';
                                            echo '<td>-</td>';
                                            echo '</tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="../scripts/script.js"></script>
</body>

</html>