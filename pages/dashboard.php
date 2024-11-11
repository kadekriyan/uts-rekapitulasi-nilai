<?php
include '../class/function.php';
if (isset($_SESSION['dosen_id'])) {
    $dosen_id = $_SESSION['dosen_id'];
    $data_dosen = $dosen->getDosen($dosen_id);
} else {
    echo "<script> window.location.href = 'index.php'</script>";
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
                <h5>Mata Kuliah</h5>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    <?php
                    // Loop untuk menampilkan data dalam card
                    $data_mata_kuliah = $mata_kuliah->getMataKuliah($data_dosen['id']);
                    foreach ($data_mata_kuliah as $item) {
                        echo '<div class="col">';
                        echo '  <div class="card">';
                        echo '    <div class="card-body">';
                        echo '      <h5 class="card-title">' . $item["nama"] . '</h5>';
                        echo '      <p class="card-text">Jumlah Mahasiswa: ' . $item["jumlah_mahasiswa"] . '</p>';
                        echo '     <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#' . $item["id"] . '">Komponen Penilaian</button>';
                        echo '    </div>';
                        echo '  </div>';
                        echo '</div>';

                        // Modal untuk setiap mata kuliah
                        echo '  <div class="modal fade" id="' . $item["id"] . '" tabindex="-1" aria-labelledby="' . $item["id"] . 'Label" aria-hidden="true">';
                        echo '    <div class="modal-dialog">';
                        echo '      <div class="modal-content">';
                        echo '        <div class="modal-header">';
                        echo '          <h5 class="modal-title" id="' . $item["id"] . 'Label">Komponen Penilaian - ' . $item["nama"] . '</h5>';
                        echo '          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                        echo '        </div>';
                        echo '        <div class="modal-body">';
                        echo '          <ul>';
                        echo '           <li>Diskusi: ' . $item["jml_diskusi"] . ' x ' . $item["persentase_diskusi"] . '% </li>';
                        echo '           <li>Praktikum: ' . $item["jml_praktikum"] . ' x ' . $item["persentase_praktikum"] . '%</li>';
                        echo '           <li>Responsi: ' . $item["jml_responsi"] . ' x ' . $item["persentase_responsi"] . '%</li>';
                        echo '           <li>UTS : ' . $item["jml_uts"] . ' x ' . $item["persentase_uts"] . '%</li>';
                        echo '           <li>UAS : ' . $item["jml_uas"] . ' x ' . $item["persentase_uas"] . '%</li>';
                        echo '          </ul>';
                        echo '        </div>';
                        echo '        <div class="modal-footer">';
                        echo '          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>';
                        echo '        </div>';
                        echo '      </div>';
                        echo '    </div>';
                        echo '  </div>';
                    }
                    ?>
                </div>
            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="../scripts/script.js"></script>
</body>

</html>