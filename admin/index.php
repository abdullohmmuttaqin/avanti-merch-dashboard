<?php
// ===============================
// MEMULAI SESSION LOGIN
// ===============================
session_start();

// kalau admin belum login, lempar ke login page
if (!isset($_SESSION['admin_login'])) {
    header("Location: login.php");
    exit;
}

// memanggil koneksi database
include '../config/database.php';


// ===============================
// SIMPAN PRODUK BARU
// ===============================
if (isset($_POST['simpan'])) {

    $nama = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $kategori = $_POST['kategori'];
    $gambar = $_POST['gambar'];

    mysqli_query($conn, "INSERT INTO products VALUES (
        NULL,
        '$nama',
        '$harga',
        '$gambar',
        '$kategori'
    )");

    header("Location: index.php?status=sukses");
    exit;
}


// ===============================
// HAPUS PRODUK
// ===============================
if (isset($_GET['hapus'])) {

    $id_hapus = $_GET['hapus'];

    mysqli_query($conn, "DELETE FROM products WHERE id='$id_hapus'");

    header("Location: index.php?status=hapus");
    exit;
}


// ===============================
// ALERT STATUS
// ===============================
if (isset($_GET['status']) && $_GET['status'] == 'sukses') {
    echo "<script>alert('Produk berhasil ditambahkan!');</script>";
}

if (isset($_GET['status']) && $_GET['status'] == 'hapus') {
    echo "<script>alert('Produk berhasil dihapus!');</script>";
}


// ===============================
// AMBIL SEMUA DATA PRODUK
// ===============================
$semua_produk = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - AVANTI MERCH</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

    <div class="dashboard-layout">

        <!-- SIDEBAR MENU KIRI -->
        <div class="sidebar-admin">
            <h2>AVANTI PANEL</h2>

            <a href="index.php">📦 Dashboard Produk</a>
            <a href="../index.php" target="_blank">🌐 Lihat Homepage</a>
            <a href="logout.php">🚪 Logout</a>
        </div>

        <!-- AREA KONTEN KANAN -->
        <div class="main-admin-content">

            <?php $jumlah_produk = mysqli_num_rows($semua_produk); ?>

            <h2 class="admin-title">AVANTI ADMIN DASHBOARD</h2>

            <div class="stats-box">
                <div class="stat-card">
                    <h3>Total Produk</h3>
                    <h1><?php echo $jumlah_produk; ?></h1>
                </div>

                <div class="stat-card">
                    <h3>Status Database</h3>
                    <h1>ON</h1>
                </div>
            </div>

            <div class="admin-box">
                <h2 style="margin-bottom:20px;">Tambah Produk Baru</h2>

                <form method="POST" class="admin-form">
                    <input type="text" name="nama_produk" placeholder="Nama Produk" required>
                    <input type="number" name="harga" placeholder="Harga Produk" required>
                    <input type="text" name="gambar" placeholder="Nama File Gambar (contoh: sid1.jpg)" required>
                    <input type="text" name="kategori" placeholder="Kategori Produk" required>

                    <button type="submit" name="simpan" class="admin-btn">Simpan Produk</button>
                </form>
            </div>

            <div class="admin-box">
                <h2 style="margin-bottom:20px;">Daftar Semua Produk</h2>

                <table class="admin-table">
                    <tr>
                        <th>ID</th>
                        <th>Gambar</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>

                    <?php while ($row = mysqli_fetch_assoc($semua_produk)) { ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><img src="../assets/images/<?php echo $row['gambar']; ?>" width="70"></td>
                            <td><?php echo $row['nama_produk']; ?></td>
                            <td>Rp<?php echo number_format($row['harga']); ?></td>
                            <td><?php echo $row['kategori']; ?></td>
                            <td>
                                <a class="delete-btn"
                                    href="index.php?hapus=<?php echo $row['id']; ?>"
                                    onclick="return confirm('Yakin hapus produk ini?')">
                                    Hapus
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>

        </div>
    </div>

</body>

</html>