<aside id="sidebar">
    <div class="d-flex sidebar-header">
        <button id="toggle-btn" type="button">
            <img src="../img/profil.jpg" alt="avatar" class="avatar">
        </button>
        <div class="sidebar-profile">
            <span class="nim"><?= $data_dosen['nik']; ?></span>
            <span class="name"><?= $data_dosen['nama']; ?></span>
        </div>
    </div>

    <ul class="sidebar-nav expand" style="height : 100vh">
        <li class="sidebar-item">
            <a href="./dashboard.php" class="sidebar-link">
                <i class="bi bi-speedometer"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="./mahasiswa.php" class="sidebar-link">
                <i class="bi bi-card-list"></i>
                <span>Mahasiswa</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="./logout.php" class="sidebar-link">
                <i class="bi bi-box-arrow-left"></i>
                <span>Logout</span>
            </a>
        </li>
    </ul>
    <div class="sidebar-footer">
    </div>
</aside>