<?php
require_once '../config/koneksi.php';
require_once '../includes/functions.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Validasi sederhana
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Format email tidak valid!";
    } elseif (strlen($password) < 6) {
        $message = "Password minimal 6 karakter.";
    } else {
        // Cek apakah email sudah digunakan
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $message = "Email sudah terdaftar!";
        } else {
            // Simpan user baru
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (nama, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$nama, $email, $hash]);
            header('Location: login.php?success=1');
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Register</title>
  <link rel="stylesheet" href="../assets/styles/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
  <h2>Daftar Akun Baru</h2>
  <?php if ($message): ?><div class="alert alert-danger"><?= e($message) ?></div><?php endif; ?>
  <form method="POST">
    <div class="mb-3">
      <label>Nama Lengkap</label>
      <input type="text" name="nama" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Email</label>
      <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Password</label>
      <input type="password" name="password" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Daftar</button>
    <p class="mt-3">Sudah punya akun? <a href="login.php">Login di sini</a></p>
  </form>
</body>
</html>
