<?php
require_once "config/database.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tentang Kami - Salsabila Rentcar Jember</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        .about-hero {
            background: #0f172a;
            color: #ffffff;
            padding: 60px 20px;
            text-align: center;
            border-radius: 12px;
            margin: 30px auto;
            max-width: 1100px;
        }
        .about-container {
            max-width: 1100px;
            margin: 0 auto 50px auto;
            padding: 0 20px;
        }
        .about-card {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            padding: 40px;
            margin-bottom: 30px;
        }
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }
        .feature-item {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-top: 4px solid #0284c7;
            padding: 25px;
            border-radius: 8px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .feature-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
            border-color: #cbd5e1;
            border-top-color: #0284c7;
        }
        .contact-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 30px;
            margin-top: 35px;
        }
        
        /* Desain Elemen Informasi Kontak Modern Tanpa Emoji */
        .info-cards-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-top: 20px;
        }
        @media(max-width: 768px) {
            .info-cards-grid {
                grid-template-columns: 1fr;
            }
        }
        .info-box-item {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-left: 4px solid #0284c7;
            border-radius: 6px;
            padding: 20px;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<div class="navbar-custom">
    <div class="nav-container">
        <a href="index.php" class="nav-logo">Salsabila Rentcar Jember</a>
        <div class="nav-links">
            <a href="index.php">Beranda</a>
            <a href="produk.php">Armada</a>
            <a href="tentang.php" class="active">Tentang Kami</a>
            <a href="https://wa.me/6285236254494?text=Halo%20Salsabila%20Rentcar,%20saya%20tertarik%20ingin%20melakukan%20pemesanan/booking%20mobil.%20Bisa%20info%20ketersediaan%20unit%20dan%20persyaratannya?" target="_blank" class="btn-cta-nav">Pesan Sekarang</a>
        </div>
    </div>
</div>

<!-- Hero Section Tentang Kami -->
<div class="about-hero">
    <span style="color: #38bdf8; font-weight: bold; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px;">Profil Perusahaan</span>
    <h1 style="font-size: 2.5rem; margin: 15px 0; color: #ffffff;">Lebih Dekat dengan Salsabila Rentcar</h1>
    <p style="color: #94a3b8; font-size: 1.05rem; max-width: 650px; margin: 0 auto; line-height: 1.6;">
        Penyedia layanan transportasi profesional, aman, dan terpercaya di wilayah Jember dan sekitarnya.
    </p>
</div>

<!-- Konten Utama -->
<div class="about-container">
    <div class="about-card">
        <h2 style="color: #0f172a; margin-top: 0; font-size: 1.8rem;">Tentang Salsabila Rentcar Jember</h2>
        <p style="color: #475569; line-height: 1.8; font-size: 1.05rem;">
            <strong>Salsabila Rentcar Jember</strong> adalah penyedia jasa layanan transportasi terkemuka yang berpusat di Jember. Kami berdedikasi untuk menyediakan armada kendaraan berkualitas tinggi, bersih, terawat, serta siap menemani perjalanan bisnis, liburan keluarga, maupun acara spesial Anda.
        </p>
        <p style="color: #475569; line-height: 1.8; font-size: 1.05rem;">
            Dengan proses pemesanan yang cepat, transparan, dan pelayanan supir yang profesional, kami siap memberikan pengalaman berkendara yang aman, nyaman, dan memuaskan bagi seluruh pelanggan.
        </p>

        <!-- Keunggulan / Fitur -->
        <div class="features-grid">
            <div class="feature-item">
                <h4 style="margin: 5px 0 8px; color: #0f172a; font-size: 1.1rem;">Armada Terawat</h4>
                <p style="margin: 0; color: #64748b; font-size: 0.92rem; line-height: 1.5;">Seluruh unit mobil selalu melalui pengecekan berkala demi keamanan dan kenyamanan perjalanan Anda.</p>
            </div>
            <div class="feature-item">
                <h4 style="margin: 5px 0 8px; color: #0f172a; font-size: 1.1rem;">Proses Cepat</h4>
                <p style="margin: 0; color: #64748b; font-size: 0.92rem; line-height: 1.5;">Pemesanan mudah dan cepat langsung melalui WhatsApp tanpa prosedur yang berbelit-belit.</p>
            </div>
            <div class="feature-item">
                <h4 style="margin: 5px 0 8px; color: #0f172a; font-size: 1.1rem;">Harga Kompetitif</h4>
                <p style="margin: 0; color: #64748b; font-size: 0.92rem; line-height: 1.5;">Menawarkan harga sewa terbaik di Jember dengan pilihan paket lepas kunci maupun dengan pengemudi.</p>
            </div>
        </div>

        <!-- Layanan & Kontak (Grid Layout Bersih Tanpa Emoji) -->
        <div class="contact-box">
            <h3 style="margin-top: 0; color: #0f172a; font-size: 1.2rem;">Layanan & Kontak Resmi</h3>
            <p style="color: #64748b; font-size: 0.92rem; margin-bottom: 20px;">Silakan hubungi atau kunjungi lokasi *pool* armada kami melalui informasi di bawah ini:</p>

            <div class="info-cards-grid">
                <!-- Kotak WhatsApp -->
                <div class="info-box-item">
                    <span style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: #0284c7; font-weight: bold; display: block; margin-bottom: 4px;">Layanan Booking</span>
                    <h4 style="margin: 0 0 8px; color: #0f172a; font-size: 1rem;">WhatsApp Fast Response</h4>
                    <a href="https://wa.me/6285236254494" target="_blank" style="color: #0284c7; text-decoration: none; font-weight: bold; font-size: 1.05rem;">0852-3625-4494</a>
                </div>

                <!-- Kotak Jam Operasional -->
                <div class="info-box-item">
                    <span style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: #0284c7; font-weight: bold; display: block; margin-bottom: 4px;">Waktu Layanan</span>
                    <h4 style="margin: 0 0 8px; color: #0f172a; font-size: 1rem;">Jam Operasional</h4>
                    <p style="margin: 0; color: #334155; font-size: 0.95rem; font-weight: 500;">Buka Setiap Hari (07.00 - 21.00 WIB)</p>
                </div>
            </div>

            <!-- Kotak Alamat Utama Full Lebar -->
            <div style="background: #ffffff; border: 1px solid #e2e8f0; border-left: 4px solid #0f172a; border-radius: 6px; padding: 20px; margin-top: 20px;">
                <span style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b; font-weight: bold; display: block; margin-bottom: 4px;">Lokasi / Pool Armada</span>
                <h4 style="margin: 0 0 6px; color: #0f172a; font-size: 1rem;">Alamat Kantor</h4>
                <p style="margin: 0; color: #334155; font-size: 0.95rem; line-height: 1.5; font-weight: 500;">
                    Perum Villa Ajung Bumi Asri Blok H 8, Ajung, Jember
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Footer Call to Action -->
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