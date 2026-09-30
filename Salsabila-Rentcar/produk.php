<?php
require_once "config/database.php";

$keyword = $_GET['keyword'] ?? '';
if ($keyword != '') {
    $keyword_safe = mysqli_real_escape_string($conn, $keyword);
    $query = mysqli_query($conn, "SELECT * FROM produk WHERE nama LIKE '%$keyword_safe%' OR kategori LIKE '%$keyword_safe%' ORDER BY id DESC");
} else {
    $query = mysqli_query($conn, "SELECT * FROM produk ORDER BY id DESC");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Katalog Armada - Salsabila Rentcar Jember</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<!-- Navbar -->
<div class="navbar-custom">
    <div class="nav-container">
        <a href="index.php" class="nav-logo">Salsabila Rentcar Jember</a>
        <div class="nav-links">
            <a href="index.php">Beranda</a>
            <a href="produk.php" class="active">Armada</a>
            <a href="tentang.php">Tentang Kami</a>
            <a href="https://wa.me/6285236254494?text=Halo%20Salsabila%20Rentcar,%20saya%20tertarik%20ingin%20melakukan%20pemesanan/booking%20mobil.%20Bisa%20info%20ketersediaan%20unit%20dan%20persyaratannya?" target="_blank" class="btn-cta-nav">Pesan Sekarang</a>
          </div>
        </div>
    </div>

<!-- Header / Hero Ringkas -->
<div class="hero-custom" style="padding: 40px 20px; text-align: center; justify-content: center;">
    <div class="hero-text" style="max-width: 700px; margin: auto;">
        <span style="color: #38bdf8; font-weight: bold; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px;">Katalog Kendaraan</span>
        <h1 style="font-size: 2rem; margin: 10px 0;">Temukan Armada yang Anda Butuhkan</h1>
        <p style="margin: auto; color: #94a3b8;">Jelajahi berbagai pilihan mobil berkualitas tinggi dengan harga sewa terbaik untuk menemani perjalanan Anda.</p>
    </div>
</div>

<!-- Main Content / Daftar Produk -->
<div class="main-content-section">
    <!-- Form Pencarian -->
    <div style="background: #f8fafc; padding: 20px; border-radius: 8px; border: 1px solid #e2e8f0; margin-bottom: 30px;">
        <form method="GET" style="display: flex; gap: 10px; margin: 0;">
            <input type="text" name="keyword" placeholder="Cari nama mobil atau kategori (misal: Avanza, SUV, MPV)..." value="<?= htmlspecialchars($keyword); ?>" style="margin: 0; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; flex: 1;">
            <button type="submit" class="btn" style="padding: 10px 20px;">Cari</button>
        </form>
    </div>

    <div style="border-bottom: 2px solid #f1f5f9; padding-bottom: 10px; margin-bottom: 20px;">
        <h3 style="margin: 0; color: #0f172a;">Daftar Pilihan Armada</h3>
    </div>

    <div class="grid-produk">
        <?php while ($row = mysqli_fetch_assoc($query)): ?>
        <div class="card-produk">
            <?php if (!empty($row['gambar'])): ?>
                <img src="uploads/produk/<?= htmlspecialchars($row['gambar']); ?>" alt="<?= htmlspecialchars($row['nama']); ?>">
            <?php else: ?>
                <div style="height: 160px; background: #e2e8f0; display: flex; align-items: center; justify-content: center; color: #64748b; border-radius: 6px;">No Image</div>
            <?php endif; ?>

            <div style="text-align: left; margin-top: 12px;">
                <span style="font-size: 0.75rem; background: #e0f2fe; color: #0369a1; padding: 2px 8px; border-radius: 4px; font-weight: bold;"><?= htmlspecialchars($row['kategori']); ?></span>
                <h3 style="margin: 8px 0 4px; font-size: 1rem; color: #0f172a;"><?= htmlspecialchars($row['nama']); ?></h3>
                <p style="color: #0284c7; font-weight: bold; margin: 0 0 12px; font-size: 0.95rem;">Rp <?= number_format($row['harga'], 0, ',', '.'); ?> <span style="font-size: 0.75rem; color: #64748b; font-weight: normal;">/ hari</span></p>
                
                <a href="detail.php?id=<?= $row['id']; ?>" class="btn" style="width: 100%; text-align: center; box-sizing: border-box;">Detail & Sewa</a>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>

<!-- Footer CTA -->
<div class="footer-cta">
    <h3 style="margin: 0 0 8px; color: #38bdf8;">Ada kebutuhan sewa mobil?</h3>
    <p style="color: #94a3b8; margin: 0 0 20px; font-size: 0.9rem;">Mari diskusikan perjalanan dan kebutuhan transportasi Anda bersama kami.</p>
    <a href="https://wa.me/6285236254494" target="_blank" class="btn" style="background: #38bdf8; color: #0f172a; font-weight: bold;">Hubungi WhatsApp</a>
</div>

<div class="footer-bottom">
    &copy; 2026 Salsabila Rentcar Jember. All rights reserved.
</div>

</body>
</html>