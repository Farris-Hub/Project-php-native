<?php
require_once '../config/koneksi.php';
require_once '../includes/functions.php';

if (!is_admin()) {
    header('Location: ../index.php');
    exit;
}

$jumlah_hewan = $pdo->query("SELECT COUNT(*) FROM hewan")->fetchColumn();
$jumlah_user = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$jumlah_adopsi = $pdo->query("SELECT COUNT(*) FROM adopsi")->fetchColumn();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Dashboard Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
  <?php include '../includes/header.php'; ?>
  <h2>Dashboard Admin</h2>
  <div class="row">
    <div class="col-md-4">
      <div class="card text-center bg-light">
        <div class="card-body">
          <h5>Total Hewan</h5>
          <h2><?= $jumlah_hewan ?></h2>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card text-center bg-light">
        <div class="card-body">
          <h5>Total User</h5>
          <h2><?= $jumlah_user ?></h2>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card text-center bg-light">
        <div class="card-body">
          <h5>Total Pengajuan Adopsi</h5>
          <h2><?= $jumlah_adopsi ?></h2>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
