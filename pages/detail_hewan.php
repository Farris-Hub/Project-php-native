<?php
require_once '../config/koneksi.php';
require_once '../includes/functions.php';

if (!isset($_GET['id'])) {
    header('Location: ../index.php');
    exit;
}

$id = (int)$_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM hewan WHERE id_hewan = ?");
$stmt->execute([$id]);
$hewan = $stmt->fetch();

if (!$hewan) {
    echo "Data tidak ditemukan.";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Detail Hewan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
  <?php include '../includes/header.php'; ?>
  <div class="card mb-4">
    <img src="assets/img/<?= e($h['foto'] ?: 'kitten1.jpg') ?>" class="card-img-top" alt="">
    <div class="card-body">
      <h3><?= e($hewan['nama_hewan']) ?></h3>
      <p><strong>Jenis:</strong> <?= e($hewan['jenis']) ?></p>
      <p><strong>Umur:</strong> <?= e($hewan['umur']) ?></p>
      <p><?= e($hewan['deskripsi']) ?></p>
      <?php if (is_logged_in()): ?>
        <a href="pengajuan_adopsi.php?id=<?= $hewan['id_hewan'] ?>" class="btn btn-primary">Ajukan Adopsi</a>
      <?php else: ?>
        <a href="login.php" class="btn btn-secondary">Login untuk Adopsi</a>
      <?php endif; ?>
    </div>
  </div>
</body>
</html>
