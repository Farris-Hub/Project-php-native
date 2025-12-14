<?php
require_once 'config/koneksi.php';
require_once 'includes/functions.php';

$kategori = $_GET['kategori'] ?? 'semua';

try {
    if ($kategori === 'semua') {
        $stmt = $pdo->prepare(
            "SELECT * FROM hewan WHERE status = 'Tersedia'"
        );
    } else {
        // LOWER() supaya tidak peduli kapital / kecil
        $stmt = $pdo->prepare(
            "SELECT * FROM hewan 
             WHERE LOWER(jenis) = LOWER(?) 
             AND status = 'Tersedia'"
        );
        $stmt->bindParam(1, $kategori, PDO::PARAM_STR);
    }

    $stmt->execute();
    $hewan = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Terjadi kesalahan: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Adopsi Hewan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/styles/style.css?v=<?= time(); ?>">
</head>
<body>

<?php include 'includes/header.php'; ?>

<div class="container mt-4">
    <h1 class="mb-4">Daftar Hewan yang Tersedia</h1>

    <div class="row">
        <?php if (count($hewan) > 0): ?>
            <?php foreach ($hewan as $h): ?>
                <div class="col-md-4 mb-3">
                    <div class="card h-100 shadow-sm">
                        <img 
                            src="assets/img/<?= e($h['foto'] ?: 'kitten1.jpg'); ?>" 
                            class="card-img-top"
                            alt="<?= e($h['nama_hewan']); ?>"
                        >

                        <div class="card-body">
                            <h5 class="card-title"><?= e($h['nama_hewan']); ?></h5>
                            <p class="card-text"><?= e($h['deskripsi']); ?></p>
                        </div>

                        <div class="card-footer bg-white border-0">
                            <a 
                                href="pages/detail_hewan.php?id=<?= $h['id_hewan']; ?>" 
                                class="btn btn-primary w-100"
                            >
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    Belum ada hewan untuk kategori <b><?= e($kategori); ?></b>.
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
