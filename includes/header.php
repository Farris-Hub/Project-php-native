<?php 
// Memastikan sesi dimulai
if (session_status() === PHP_SESSION_NONE) {
    session_start(); 
}
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <div class="container">
        <a class="navbar-brand" href="index.php">🐾 Adopsi Hewan</a>

        <div class="dropdown ms-3">
      <button class="btn btn-outline-light dropdown-toggle btn-sm" type="button" id="dropdownKategori" data-bs-toggle="dropdown" aria-expanded="false">
        Kategori
      </button>
      <ul class="dropdown-menu" aria-labelledby="dropdownKategori">
                <li><a class="dropdown-item" href="index.php?kategori=semua">Semua</a></li>
        <li><hr class="dropdown-divider"></li>
        
                <li><a class="dropdown-item" href="index.php?kategori=Kucing">Kucing</a></li>
        <li><a class="dropdown-item" href="index.php?kategori=Anjing">Anjing</a></li>
        <li><a class="dropdown-item" href="index.php?kategori=Kelinci">Kelinci</a></li>
      </ul>
    </div>

        <div class="ms-auto">
      <?php if (isset($_SESSION['user'])): ?>
        <span class="text-light me-3">Halo, <?= e($_SESSION['user']['nama']) ?></span>
        <a href="logout.php" class="btn btn-outline-light btn-sm">Logout</a>
      <?php else: ?>
        <a href="pages/login.php" class="btn btn-outline-light btn-sm">Login</a>
        <a href="pages/register.php" class="btn btn-outline-light btn-sm ms-2">Register</a>
      <?php endif; ?>
    </div>
  </div>
</nav>