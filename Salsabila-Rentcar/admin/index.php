<?php
session_start();
require_once "../includes/auth.php";
require_once "../config/database.php";

// Hitung total armada/produk dari tabel 'produk'
$total_produk = 0;
$query_produk = mysqli_query($conn, "SELECT COUNT(*) as total FROM produk");
if ($query_produk) {
    $data_produk = mysqli_fetch_assoc($query_produk);
    $total_produk = $data_produk['total'];
}

// Hitung total kategori unik dari tabel 'produk'
$total_kategori = 0;
$query_kat = mysqli_query($conn, "SELECT COUNT(DISTINCT kategori) as total FROM produk");
if ($query_kat) {
    $data_kat = mysqli_fetch_assoc($query_kat);
    $total_kategori = $data_kat['total'];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Salsabila Rentcar</title>
    <link rel="stylesheet" href="../assets/style.css">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8fafc;
            color: #0f172a;
            display: flex;
            height: 100vh;
            overflow: hidden;
        }
        /* Sidebar Styling */
        .sidebar {
            width: 260px;
            background-color: #0f172a;
            color: #ffffff;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 25px 20px;
            flex-shrink: 0;
        }
        .sidebar-brand h2 {
            font-size: 1.25rem;
            color: #38bdf8;
            letter-spacing: 0.5px;
            margin-bottom: 30px;
        }
        .sidebar-menu {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 8px;
            flex-grow: 1;
        }
        .sidebar-menu a {
            display: block;
            padding: 12px 15px;
            color: #94a3b8;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        .sidebar-menu a:hover, .sidebar-menu a.active {
            background-color: #1e293b;
            color: #ffffff;
        }
        .sidebar-menu a.logout {
            color: #f87171;
        }
        .sidebar-menu a.logout:hover {
            background-color: rgba(248, 113, 113, 0.1);
            color: #ef4444;
        }

        /* Main Content Styling */
        .main-content {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            background-color: #f8fafc;
        }
        .top-bar {
            background: #ffffff;
            padding: 20px 30px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .top-bar h1 {
            font-size: 1.5rem;
            color: #0f172a;
        }
        .user-greeting {
            font-size: 0.95rem;
            color: #475569;
        }
        .user-greeting strong {
            color: #0f172a;
        }

        /* Dashboard Body */
        .dashboard-body {
            padding: 30px;
            max-width: 1200px;
            width: 100%;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .stat-card {
            background: #ffffff;
            padding: 20px 25px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            position: relative;
            overflow: hidden;
        }
        .stat-card::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
        }
        .stat-card.blue::before { background: #38bdf8; }
        .stat-card.purple::before { background: #818cf8; }
        .stat-card.green::before { background: #34d399; }

        .stat-card h3 {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #64748b;
            margin-bottom: 8px;
        }
        .stat-card .number {
            font-size: 1.8rem;
            font-weight: bold;
            color: #0f172a;
            margin-bottom: 4px;
        }
        .stat-card p {
            font-size: 0.85rem;
            color: #94a3b8;
        }

        /* Action Banner */
        .action-banner {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 10px 15px -3px rgba(15, 23, 42, 0.1);
        }
        .action-banner-text h2 {
            font-size: 1.25rem;
            margin-bottom: 6px;
            color: #ffffff;
        }
        .action-banner-text p {
            color: #94a3b8;
            font-size: 0.9rem;
        }
        .btn-action {
            background: #38bdf8;
            color: #0f172a;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: background 0.2s;
            white-space: nowrap;
        }
        .btn-action:hover {
            background: #0ea5e9;
            color: #ffffff;
        }
    </style>
</head>
<body>

    <!-- Sidebar Navigasi -->
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2>SALSABILA RENTCAR</h2>
            <ul class="sidebar-menu">
                <li><a href="index.php" class="active">Dashboard</a></li>
                <li><a href="produk.php">Kelola Armada</a></li>
                <li><a href="../index.php" target="_blank">Lihat Website</a></li>
            </ul>
        </div>
        <div>
            <ul class="sidebar-menu" style="margin: 0;">
                <li><a href="logout.php" class="logout">Logout</a></li>
            </ul>
        </div>
    </div>

    <!-- Konten Utama -->
    <div class="main-content">
        <div class="top-bar">
            <h1>Dashboard Admin</h1>
            <div class="user-greeting">
                Halo, <strong><?php echo htmlspecialchars($_SESSION['username'] ?? 'Admin'); ?></strong>
            </div>
        </div>

        <div class="dashboard-body">
            <!-- Statistik Cards -->
            <div class="stats-grid">
                <div class="stat-card blue">
                    <h3>Total Armada</h3>
                    <div class="number"><?php echo $total_produk; ?></div>
                    <p>Mobil siap disewakan</p>
                </div>
                <div class="stat-card purple">
                    <h3>Kategori / Tipe</h3>
                    <div class="number"><?php echo $total_kategori; ?></div>
                    <p>Jenis kendaraan</p>
                </div>
                <div class="stat-card green">
                    <h3>Status Website</h3>
                    <div class="number" style="font-size: 1.5rem; color: #10b981; padding-top: 5px;">AKTIF</div>
                    <p>Sistem berjalan normal</p>
                </div>
            </div>

            <!-- Banner Navigasi Cepat -->
            <div class="action-banner">
                <div class="action-banner-text">
                    <h2>Kelola Armada Mobil</h2>
                    <p>Tambah, ubah, atau hapus data mobil rental yang ditampilkan ke publik.</p>
                </div>
                <a href="produk.php" class="btn-action">Kelola Armada →</a>
            </div>
        </div>
    </div>

</body>
</html>