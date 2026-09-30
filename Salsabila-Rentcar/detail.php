<?php
require_once "config/database.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$query = mysqli_query($conn, "SELECT * FROM produk WHERE id = $id");
$produk = mysqli_fetch_assoc($query);

if (!$produk) {
    die("Armada tidak ditemukan.");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($produk['nama']); ?> - Salsabila Rentcar</title>
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
        </div>
    </div>
</div>

<!-- Main Content Detail -->
<div class="main-content-section" style="max-width: 900px;">
    <div style="display: flex; gap: 30px; flex-wrap: wrap; align-items: flex-start;">
        
        <!-- Gambar Mobil -->
        <div style="flex: 1; min-width: 300px;">
            <?php if (!empty($produk['gambar'])): ?>
                <img src="uploads/produk/<?= htmlspecialchars($produk['gambar']); ?>" alt="<?= htmlspecialchars($produk['nama']); ?>" style="width: 100%; height: 300px; object-fit: cover; border-radius: 8px; border: 1px solid #e2e8f0;">
            <?php else: ?>
                <div style="width: 100%; height: 300px; background: #e2e8f0; display: flex; align-items: center; justify-content: center; color: #64748b; border-radius: 8px;">No Image</div>
            <?php endif; ?>
        </div>

        <!-- Informasi Detail -->
        <div style="flex: 1; min-width: 300px;">
            <span style="font-size: 0.8rem; background: #e0f2fe; color: #0369a1; padding: 4px 10px; border-radius: 4px; font-weight: bold;"><?= htmlspecialchars($produk['kategori']); ?></span>
            <h1 style="margin: 10px 0 5px; color: #0f172a; font-size: 1.8rem;"><?= htmlspecialchars($produk['nama']); ?></h1>
            <h2 style="color: #0284c7; margin: 10px 0 20px;">Rp <?= number_format($produk['harga'], 0, ',', '.'); ?> <span style="font-size: 0.85rem; color: #64748b; font-weight: normal;">/ hari</span></h2>
            
            <div style="background: #f8fafc; padding: 15px; border-radius: 6px; border: 1px solid #e2e8f0; margin-bottom: 20px;">
                <p style="margin: 0 0 8px; color: #475569; font-size: 0.9rem;">Unit Tersedia: <strong><?= $produk['stok']; ?> unit</strong></p>
                <p style="margin: 0; color: #475569; font-size: 0.9rem;">Status: <strong style="color: #16a34a;">Siap Disewa</strong></p>
            </div>

            <p style="line-height: 1.6; color: #475569; margin-bottom: 25px;"><?= nl2br(htmlspecialchars($produk['deskripsi'])); ?></p>

            <div style="display: flex; gap: 10px;">
                <a href="https://wa.me/6285236254494?text=Halo%20Salsabila%20Rentcar,%20saya%20tertarik%20ingin%20menyewa%20mobil%20<?= urlencode($produk['nama']); ?>.%20Apakah%20unitnya%20ready?" target="_blank" class="btn" style="background: #16a34a; text-align: center; flex: 1;">Pesan via WhatsApp</a>
                <a href="produk.php" class="btn" style="background: #64748b; text-align: center;">Kembali</a>
            </div>
        </div>

    </div>
</div>

<!-- Footer CTA -->
<div class="footer-cta">
    <h3 style="margin: 0 0 8px; color: #38bdf8;">Ada kebutuhan sewa mobil?</h3>
    <p style="color: #94a3b8; margin: 0 0 20px; font-size: 0.9rem;">Mari diskusikan perjalanan dan kebutuhan transportasi Anda bersama kami.</p>
    <a href="https://wa.me/6285236254494?text=Halo%20Salsabila%20Rentcar,%20saya%20tertarik%20ingin%20melakukan%20pemesanan/booking%20mobil.%20Bisa%20info%20ketersediaan%20unit%20dan%20persyaratannya?" target="_blank" class="btn" style="background: #38bdf8; color: #0f172a; font-weight: bold;">Hubungi WhatsApp</a>
</div>

<div class="footer-bottom">
    &copy; 2026 Salsabila Rentcar Jember. All rights reserved.
</div>

</body>
</html>