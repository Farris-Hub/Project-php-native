<?php
session_start();
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
  <a class="navbar-brand d-flex align-items-center" href="index.php">
    <img src="assets/img/paw.png" alt="Logo" width="28" class="me-2">
    <span>Adopsi Hewan</span>
  </a>

  <!-- Tombol toggle (untuk tampilan HP) -->
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Bagian menu -->
  <div class="collapse navbar-collapse" id="navbarNav">
    <!-- Dropdown kategori di kiri -->
    <ul class="navbar-nav me-auto ms-4">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="kategoriDropdown" role="button" data-bs-toggle="dropdown">
          Kategori
        </a>
        <ul class="dropdown-menu" aria-labelledby="kategoriDropdown">
          <li><a class="dropdown-item" href="index.php?kategori=semua">Semua Hewan</a></li>
          <li><a class="dropdown-item" href="index.php?kategori=kucing">Kucing</a></li>
          <li><a class="dropdown-item" href="index.php?kategori=anjing">Anjing</a></li>
          <li><a class="dropdown-item" href="index.php?kategori=kelinci">Kelinci</a></li>
          <li><a class="dropdown-item" href="index.php?kategori=burung">Burung</a></li>
        </ul>
      </li>
    </ul>

    <!-- Bagian kanan (akun & logout) -->
    <ul class="navbar-nav ms-auto">
      <li class="nav-item">
        <span class="nav-link">Halo, <?= htmlspecialchars($_SESSION['nama']); ?></span>
      </li>
      <li class="nav-item">
        <a href="logout.php" class="btn btn-outline-light btn-sm ms-2">Logout</a>
      </li>
    </ul>
  </div>
</nav>
