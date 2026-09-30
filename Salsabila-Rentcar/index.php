<?php
require_once "config/database.php";

$query = mysqli_query(
    $conn,
    "SELECT * FROM produk ORDER BY id DESC LIMIT 3"
);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Beranda - Salsabila Rentcar Jember</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        /* Gaya Gambar Mobil Bersih, Terang, Tanpa Frame */
        .hero-car-img {
            width: 100%;
            max-width: 520px;
            height: auto;
            object-fit: contain;
            filter: brightness(1.15) contrast(1.05) drop-shadow(0 20px 30px rgba(0, 0, 0, 0.7));
            transition: transform 0.3s ease;
        }
        .hero-car-img:hover {
            transform: scale(1.03);
        }
    </style>
</head>
<body>

<!-- Navbar -->
<div class="navbar-custom">
    <div class="nav-container">
        <a href="index.php" class="nav-logo">Salsabila Rentcar Jember</a>
        <div class="nav-links">
            <a href="index.php" class="active">Beranda</a>
            <a href="produk.php">Armada</a>
            <a href="tentang.php">Tentang Kami</a>
            <a href="https://wa.me/6285236254494?text=Halo%20Salsabila%20Rentcar,%20saya%20tertarik%20ingin%20melakukan%20pemesanan/booking%20mobil.%20Bisa%20info%20ketersediaan%20unit%20dan%20persyaratannya?" target="_blank" class="btn-cta-nav">Pesan Sekarang</a>
        </div>
    </div>
</div>

<!-- Hero Section -->
<div class="hero-custom" style="display: flex; align-items: center; justify-content: space-between; gap: 30px; background: #0f172a; padding: 50px; border-radius: 12px; margin: 30px auto; max-width: 1100px;">
    
    <!-- Teks di Sebelah Kiri -->
    <div class="hero-text" style="flex: 1;">
        <span style="color: #38bdf8; font-weight: bold; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px;">Salsabila Rentcar Jember</span>
        <h1 style="font-size: 2.3rem; margin: 15px 0; color: #ffffff; line-height: 1.2;">
            Sewa Mobil Nyaman, Aman, & Cepat <span style="color: #38bdf8;">di Jember</span>
        </h1>
        <p style="color: #94a3b8; line-height: 1.6; margin-bottom: 25px;">
            Kami menyediakan berbagai pilihan armada mobil terbaik untuk menemani perjalanan liburan, bisnis, maupun acara spesial Anda di Jember dan sekitarnya.
        </p>
        <a href="produk.php" class="btn" style="background: #0284c7; color: white; padding: 12px 25px; border-radius: 6px; font-weight: bold; text-decoration: none; display: inline-block;">Lihat Armada</a>
    </div>

    <!-- Gambar Mobil di Sebelah Kanan (Mengambil dari uploads/produk/) -->
    <div style="flex: 1; text-align: center;">
        <img src="uploads/produk/innova.png" alt="Salsabila Rentcar" class="hero-car-img" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1552519507-da3b142c6e3d?auto=format&fit=crop&w=800&q=80';">
    </div>

</div>

<!-- Main Content / Pilihan Produk -->
<div class="main-content-section" style="max-width: 1100px; margin: 0 auto; padding: 20px 20px 0 20px;">
    
    <!-- Bagian Judul dengan Jarak (Padding) yang Lebih Turun/Proporsional -->
    <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #f1f5f9; padding: 15px 0 15px 0;">
        <h2 style="margin: 0; color: #0f172a; font-size: 1.5rem;">Pilihan Armada Salsabila</h2>
        <a href="produk.php" style="color: #0284c7; text-decoration: none; font-weight: bold; font-size: 0.9rem;">Lihat Semua Armada →</a>
    </div>

    <div class="grid-produk" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px; margin-top: 25px;">
        <?php while ($row = mysqli_fetch_assoc($query)): ?>
        <div class="card-produk" style="background: #fff; border: 1px solid #e2e8f0; border-radius: 8px; padding: 15px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <?php if (!empty($row['gambar'])): ?>
                <!-- Mengambil gambar dari folder uploads/produk/ -->
                <img src="uploads/produk/<?= htmlspecialchars($row['gambar']); ?>" alt="<?= htmlspecialchars($row['nama']); ?>" style="width: 100%; height: 160px; object-fit: cover; border-radius: 6px;">
            <?php else: ?>
                <div style="height: 160px; background: #e2e8f0; display: flex; align-items: center; justify-content: center; color: #64748b; border-radius: 6px;">No Image</div>
            <?php endif; ?>

            <div style="text-align: left; margin-top: 12px;">
                <span style="font-size: 0.75rem; background: #e0f2fe; color: #0369a1; padding: 2px 8px; border-radius: 4px; font-weight: bold;"><?= htmlspecialchars($row['kategori']); ?></span>
                <h3 style="margin: 8px 0 4px; font-size: 1rem; color: #0f172a;"><?= htmlspecialchars($row['nama']); ?></h3>
                <p style="color: #0284c7; font-weight: bold; margin: 0 0 12px; font-size: 0.95rem;">Rp <?= number_format($row['harga'], 0, ',', '.'); ?> <span style="font-size: 0.75rem; color: #64748b; font-weight: normal;">/ hari</span></p>
                
                <a href="detail.php?id=<?= $row['id']; ?>" class="btn" style="width: 100%; text-align: center; box-sizing: border-box; display: block; background: #0f172a; color: white; padding: 10px; border-radius: 6px; text-decoration: none; font-weight: bold;">Detail & Sewa</a>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>

<!-- Footer -->
<div class="footer-cta" style="text-align: center; background: #0f172a; color: white; padding: 40px 20px; margin-top: 50px;">
    <h3 style="margin: 0 0 8px; color: #38bdf8;">Ada kebutuhan sewa mobil?</h3>
    <p style="color: #94a3b8; margin: 0 0 20px; font-size: 0.9rem;">Mari diskusikan perjalanan dan kebutuhan transportasi Anda bersama kami.</p>
    <a href="https://wa.me/6285236254494?text=Halo%20Salsabila%20Rentcar,%20saya%20tertarik%20ingin%20melakukan%20pemesanan/booking%20mobil.%20Bisa%20info%20ketersediaan%20unit%20dan%20persyaratannya?" target="_blank" class="btn" style="background: #38bdf8; color: #0f172a; font-weight: bold; padding: 10px 20px; border-radius: 6px; text-decoration: none; display: inline-block;">Hubungi WhatsApp</a>
</div>

<div class="footer-bottom" style="text-align: center; padding: 20px; background: #090d16; color: #64748b; font-size: 0.85rem;">
    &copy; 2026 Salsabila Rentcar Jember. All rights reserved.
</div>

</body>
</html>