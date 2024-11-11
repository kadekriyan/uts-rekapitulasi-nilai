<?php
include '../class/function.php';
if (isset($_SESSION['dosen_id'])) {
    $dosen_id = $_SESSION['dosen_id'];
    $data_dosen = $dosen->getDosen($dosen_id);
} else {
    header('Location: index.php');
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
    <title>Dashboard</title>
</head>

<body>
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
            <div class="menu-dashboard pt-4">
                <div class="d-flex gap-2">
                    <div class="btn ms-4 bg-primary text-white text-center"> Mahasiswa </div>
                </div>
                <div class="well pt-4">
                    <?php
                    $data_mata_kuliah = $mata_kuliah->getMataKuliah($data_dosen['id']);
                    $data_mahasiswa = $mahasiswa->getMahasiswaByMataKuliah(@$_GET['mata_kuliah_id']);
                    ?>
                    <h5>Filter Mahasiswa</h5>

                    <select class="form-select form-select-sm mb-3" aria-label=".form-select-sm example"
                        name="mata_kuliah_id" id="matakuliah">
                        <option value="">Pilih Mata Kuliah</option>
                        <?php foreach ($data_mata_kuliah as $mk): ?>
                            <option value="<?= $mk["id"] ?>" data-url="mahasiswa.php?mata_kuliah_id=<?= $mk["id"] ?>">
                                <?= $mk['nama'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <br>
                    <table class="table table-responsive-sm">
                        <thead class="text-white text-center table-primary">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">NIM</th>
                                <th scope="col">Prodi</th>
                                <th scope="col">Nilai</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php
                            $nomor = 1;
                            foreach ($data_mahasiswa as $mhs): ?>
                                <tr>
                                    <td><?= $nomor ?></td>
                                    <td><?= $mhs["nama"] ?></td>
                                    <td><?= $mhs["nim"] ?></td>
                                    <td><?= $mhs["prodi"] ?></td>
                                    <td><a
                                            href="detail_nilai.php?id_mahasiswa=<?= $mhs['id'] ?>&id_mata_kuliah=<?= @$_GET['mata_kuliah_id'] ?>">Detail</a>
                                    </td>
                                </tr>
                                <?php $nomor++; endforeach; ?>
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>
    <script>
        document.getElementById('matakuliah').addEventListener('change', function () {
            var selectedOption = this.options[this.selectedIndex];
            var url = selectedOption.getAttribute('data-url');
            if (url) {
                window.location.href = url;
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="../scripts/script.js"></script>
</body>

</html>