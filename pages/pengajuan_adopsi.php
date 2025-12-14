<?php
require_once '../config/koneksi.php';
require_once '../includes/functions.php';

if (!is_logged_in()) {
    header('Location: login.php');
    exit;
}

$id_hewan = (int)($_GET['id'] ?? 0);

$stmt = $pdo->prepare("SELECT * FROM hewan WHERE id_hewan = ?");
$stmt->execute([$id_hewan]);
$hewan = $stmt->fetch();

if (!$hewan) {
    echo "Data tidak ditemukan.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $catatan = trim($_POST['catatan']);
    $id_user = $_SESSION['user']['id_user'];

    $stmt = $pdo->prepare("INSERT INTO adopsi (id_user, id_hewan, catatan) VALUES (?, ?, ?)");
    $stmt->execute([$id_user, $id_hewan, $catatan]);
    echo "<script>alert('Pengajuan adopsi berhasil dikirim!');window.location='../index.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Ajukan Adopsi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
  <?php include '../includes/header.php'; ?>
  <h2>Ajukan Adopsi - <?= e($hewan['nama_hewan']) ?></h2>
  <form method="POST">
    <div class="mb-3">
      <label>Catatan untuk admin (opsional)</label>
      <textarea name="catatan" class="form-control"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Kirim Pengajuan</button>
  </form>
</body>
</html>
