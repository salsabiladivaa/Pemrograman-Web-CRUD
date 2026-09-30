<?php
session_start();
require_once "../includes/auth.php";
require_once "../config/database.php";

// Logika Pencarian
$keyword = "";
if (isset($_GET['cari'])) {
    $keyword = mysqli_real_escape_string($conn, $_GET['cari']);
    $query = "SELECT * FROM produk WHERE nama LIKE '%$keyword%' ORDER BY id DESC";
} else {
    $query = "SELECT * FROM produk ORDER BY id DESC";
}
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Armada - Salsabila Rentcar</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f8fafc; color: #0f172a; display: flex; height: 100vh; overflow: hidden; }
        
        /* Sidebar */
        .sidebar { width: 260px; background-color: #0f172a; color: #ffffff; display: flex; flex-direction: column; justify-content: space-between; padding: 25px 20px; flex-shrink: 0; }
        .sidebar-brand h2 { font-size: 1.25rem; color: #38bdf8; margin-bottom: 30px; }
        .sidebar-menu { list-style: none; display: flex; flex-direction: column; gap: 8px; flex-grow: 1; }
        .sidebar-menu a { display: block; padding: 12px 15px; color: #94a3b8; text-decoration: none; border-radius: 8px; font-weight: 500; transition: all 0.2s; }
        .sidebar-menu a:hover, .sidebar-menu a.active { background-color: #1e293b; color: #ffffff; }
        .sidebar-menu a.logout { color: #f87171; }

        /* Main Content */
        .main-content { flex-grow: 1; display: flex; flex-direction: column; overflow-y: auto; background-color: #f8fafc; }
        .top-bar { background: #ffffff; padding: 20px 30px; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center; }
        .top-bar h1 { font-size: 1.5rem; color: #0f172a; }
        
        .content-body { padding: 30px; }
        
        /* Header Aksi & Search */
        .page-header-flex { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; flex-wrap: wrap; gap: 15px; }
        .search-form { display: flex; gap: 10px; }
        .search-form input { padding: 10px 15px; border: 1px solid #cbd5e1; border-radius: 8px; width: 250px; font-size: 0.9rem; }
        .search-form input:focus { outline: none; border-color: #0284c7; box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.15); }
        .btn-search { background: #0f172a; color: #fff; border: none; padding: 10px 20px; border-radius: 8px; font-weight: 600; cursor: pointer; }
        .btn-search:hover { background: #1e293b; }
        
        .btn-add { background: #0284c7; color: #fff; text-decoration: none; padding: 10px 20px; border-radius: 8px; font-weight: 600; font-size: 0.9rem; transition: background 0.2s; display: inline-flex; align-items: center; gap: 6px; }
        .btn-add:hover { background: #0369a1; }

        /* Tabel Styling */
        .table-card { background: #ffffff; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.05); overflow: hidden; }
        table { width: 100%; border-collapse: collapse; text-align: left; }
        th { background: #f1f5f9; color: #334155; padding: 14px 20px; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid #e2e8f0; }
        td { padding: 14px 20px; border-bottom: 1px solid #e2e8f0; color: #334155; font-size: 0.95rem; vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #f8fafc; }

        .img-thumb { width: 60px; height: 45px; object-fit: cover; border-radius: 6px; border: 1px solid #e2e8f0; }
        
        /* Tombol Aksi Tabel */
        .btn-edit { background: #0ea5e9; color: white; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 0.85rem; font-weight: 600; margin-right: 5px; display: inline-block; }
        .btn-edit:hover { background: #0284c7; }
        .btn-delete { background: #ef4444; color: white; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 0.85rem; font-weight: 600; display: inline-block; }
        .btn-delete:hover { background: #dc2626; }
        
        .badge { background: #e0f2fe; color: #0369a1; padding: 4px 10px; border-radius: 20px; font-size: 0.8rem; font-weight: 600; }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2>SALSABILA RENTCAR</h2>
            <ul class="sidebar-menu">
                <li><a href="index.php">Dashboard</a></li>
                <li><a href="produk.php" class="active">Kelola Armada</a></li>
                <li><a href="../index.php" target="_blank">Lihat Website</a></li>
            </ul>
        </div>
        <div>
            <ul class="sidebar-menu" style="margin: 0;">
                <li><a href="logout.php" class="logout">Logout</a></li>
            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="top-bar">
            <h1>Kelola Armada Mobil</h1>
            <div class="user-greeting">
                Halo, <strong><?php echo htmlspecialchars($_SESSION['username'] ?? 'Admin'); ?></strong>
            </div>
        </div>

        <div class="content-body">
            <div class="page-header-flex">
                <form action="" method="GET" class="search-form">
                    <input type="text" name="cari" placeholder="Cari nama mobil..." value="<?php echo htmlspecialchars($keyword); ?>">
                    <button type="submit" class="btn-search">Cari</button>
                </form>
                <a href="tambah.php" class="btn-add">+ Tambah Armada</a>
            </div>

            <div class="table-card">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 5%;">No</th>
                            <th style="width: 10%;">Gambar</th>
                            <th style="width: 25%;">Nama Mobil</th>
                            <th style="width: 15%;">Kategori</th>
                            <th style="width: 20%;">Harga / Hari</th>
                            <th style="width: 10%;">Stok</th>
                            <th style="width: 15%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (mysqli_num_rows($result) > 0): ?>
                            <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td>
                                    <img src="../assets/img/<?php echo htmlspecialchars($row['gambar']); ?>" alt="Foto" class="img-thumb" onerror="this.src='../assets/img/default.jpg'">
                                </td>
                                <td><strong><?php echo htmlspecialchars($row['nama']); ?></strong></td>
                                <td><span class="badge"><?php echo htmlspecialchars($row['kategori']); ?></span></td>
                                <td>Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></td>
                                <td><?php echo htmlspecialchars($row['stok']); ?> Unit</td>
                                <td>
                                    <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn-edit">Edit</a>
                                    <a href="hapus.php?id=<?php echo $row['id']; ?>" class="btn-delete" onclick="return confirm('Yakin ingin menghapus armada ini?')">Hapus</a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" style="text-align: center; padding: 30px; color: #64748b;">Belum ada data armada yang tersedia.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>