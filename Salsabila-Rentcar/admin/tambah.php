<?php
session_start();
require_once "../includes/auth.php";
require_once "../config/database.php";

// Proses simpan data jika tombol submit diklik
if (isset($_POST['submit'])) {
    $nama      = mysqli_real_escape_string($conn, $_POST['nama']);
    $kategori  = mysqli_real_escape_string($conn, $_POST['kategori']);
    $harga     = mysqli_real_escape_string($conn, $_POST['harga']);
    $stok      = mysqli_real_escape_string($conn, $_POST['stok']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);

    // Handle upload gambar ke folder uploads/produk/
    $gambar = "default.jpg";
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === 0) {
        $nama_file = $_FILES['gambar']['name'];
        $tmp_file  = $_FILES['gambar']['tmp_name'];
        $ekstensi  = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));
        $ekstensi_valid = ['jpg', 'jpeg', 'png', 'webp'];

        if (in_array($ekstensi, $ekstensi_valid)) {
            $gambar_baru = uniqid() . '.' . $ekstensi;
            
            // Pastikan folder uploads/produk/ ada di luar folder admin
            $folder_tujuan = '../uploads/produk/';
            if (!is_dir($folder_tujuan)) {
                mkdir($folder_tujuan, 0777, true);
            }
            
            // Pindahkan file ke folder tujuan
            if (move_uploaded_file($tmp_file, $folder_tujuan . $gambar_baru)) {
                $gambar = $gambar_baru;
            }
        }
    }

    $query = "INSERT INTO produk (nama, kategori, harga, stok, deskripsi, gambar) VALUES ('$nama', '$kategori', '$harga', '$stok', '$deskripsi', '$gambar')";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data armada berhasil ditambahkan!'); window.location.href='produk.php';</script>";
        exit;
    } else {
        $error = "Gagal menyimpan data ke database.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Armada - Salsabila Rentcar</title>
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
        
        .form-container { padding: 30px; max-width: 800px; width: 100%; }
        .card-form { background: #ffffff; padding: 30px; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
        
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-weight: 600; margin-bottom: 8px; color: #334155; font-size: 0.9rem; }
        .form-group input, .form-group select, .form-group textarea { width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.95rem; background: #fff; color: #0f172a; }
        .form-group input:focus, .form-group select:focus, .form-group textarea:focus { outline: none; border-color: #0284c7; box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.15); }
        
        .btn-submit { background: #0f172a; color: #ffffff; border: none; padding: 12px 20px; border-radius: 8px; font-weight: bold; font-size: 1rem; cursor: pointer; transition: background 0.2s; }
        .btn-submit:hover { background: #1e293b; }
        .btn-back { background: #e2e8f0; color: #334155; text-decoration: none; padding: 12px 20px; border-radius: 8px; font-weight: bold; display: inline-block; margin-left: 10px; }
        .btn-back:hover { background: #cbd5e1; }
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
            <h1>Tambah Armada Baru</h1>
            <div class="user-greeting">
                Halo, <strong><?php echo htmlspecialchars($_SESSION['username'] ?? 'Admin'); ?></strong>
            </div>
        </div>

        <div class="form-container">
            <div class="card-form">
                <?php if (isset($error)): ?>
                    <div style="background: #fee2e2; border: 1px solid #f87171; color: #991b1b; padding: 12px; border-radius: 8px; margin-bottom: 20px; font-size: 0.9rem;">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Nama Mobil / Armada</label>
                        <input type="text" name="nama" placeholder="Masukkan nama dan tipe kendaraan" required autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label>Kategori / Tipe Kendaraan</label>
                        <select name="kategori" required>
                            <option value="">Pilih Kategori Kendaraan</option>
                            <option value="SUV">SUV</option>
                            <option value="Sedan">Sedan</option>
                            <option value="MPV">MPV</option>
                            <option value="Luxury">Luxury</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Harga Sewa per Hari (Rp)</label>
                        <input type="number" name="harga" placeholder="Masukkan tarif sewa harian" required>
                    </div>

                    <div class="form-group">
                        <label>Stok Unit</label>
                        <input type="number" name="stok" placeholder="Masukkan jumlah unit yang tersedia" required>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi / Spesifikasi</label>
                        <textarea name="deskripsi" rows="4" placeholder="Masukkan spesifikasi kendaraan, kapasitas penumpang, dan fasilitas pendukung..."></textarea>
                    </div>

                    <div class="form-group">
                        <label>Foto Mobil</label>
                        <input type="file" name="gambar" accept="image/*">
                        <small style="color: #64748b; display: block; margin-top: 5px;">Format yang didukung: JPG, JPEG, PNG, WEBP.</small>
                    </div>

                    <div style="margin-top: 30px;">
                        <button type="submit" name="submit" class="btn-submit">Simpan Armada</button>
                        <a href="produk.php" class="btn-back">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>