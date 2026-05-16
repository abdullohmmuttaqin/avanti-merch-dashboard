<?php
session_start();

if (!isset($_SESSION['admin_login'])) {
    header("Location: login.php");
    exit;
}

include '../config/database.php';
/** @var mysqli $conn */

/* TAMBAH PRODUK */
if (isset($_POST['simpan'])) {

    $nama = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $kategori = $_POST['kategori'];

    $nama_file = $_FILES['gambar']['name'];
    $tmp_file = $_FILES['gambar']['tmp_name'];

    move_uploaded_file($tmp_file, "../assets/images/" . $nama_file);

    mysqli_query($conn, "INSERT INTO products(nama_produk,harga,gambar,kategori)
    VALUES('$nama','$harga','$nama_file','$kategori')");

    header("Location:index.php?status=sukses");
    exit;
}

/* HAPUS */
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    mysqli_query($conn, "DELETE FROM products WHERE id='$id'");

    header("Location:index.php?status=hapus");
    exit;
}

if (isset($_GET['status']) && $_GET['status'] == 'sukses') {
    echo "<script>alert('Produk berhasil ditambahkan');</script>";
}

if (isset($_GET['status']) && $_GET['status'] == 'hapus') {
    echo "<script>alert('Produk berhasil dihapus');</script>";
}

if (isset($_GET['status']) && $_GET['status'] == 'update') {
    echo "<script>alert('Produk berhasil diupdate');</script>";
}

$semua_produk = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC");
$jumlah_produk = mysqli_num_rows($semua_produk);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AVANTI Admin Dashboard</title>
    <link rel="stylesheet" href="admin-style.css">
</head>

<body>

    <div class="admin-wrapper">

        <aside class="admin-sidebar">
            <div class="admin-logo">AVANTI</div>

            <a href="index.php">📦 Dashboard Produk</a>
            <a href="../index.php" target="_blank">🌐 Homepage</a>
            <a href="logout.php">🚪 Logout</a>
        </aside>

        <main class="admin-content">

            <div class="admin-header">
                <h1>Dashboard Control Panel</h1>
                <p>Kelola seluruh produk merchandise dari satu tempat.</p>
            </div>

            <div class="quick-stats">
                <div class="stat-mini">
                    <h3>Total Produk</h3>
                    <h1><?php echo $jumlah_produk; ?></h1>
                </div>

                <div class="stat-mini">
                    <h3>Database</h3>
                    <h1>ON</h1>
                </div>

                <div class="stat-mini">
                    <h3>Status Admin</h3>
                    <h1>LIVE</h1>
                </div>
            </div>

            <div class="top-grid">

                <div class="panel-box">
                    <h2>Tambah Produk Baru</h2>

                    <form method="POST" enctype="multipart/form-data">
                        <div class="admin-form-grid">
                            <input type="text" name="nama_produk" placeholder="Nama Produk" required>
                            <input type="number" name="harga" placeholder="Harga Produk" required>
                            <input type="text" name="kategori" placeholder="Kategori Produk" required>
                            <input type="file" name="gambar" required class="full">
                        </div>

                        <button type="submit" name="simpan" class="save-btn">Simpan Produk</button>
                    </form>
                </div>

                <div class="panel-box">
                    <h2>Quick Info</h2>
                    <p style="color:#888; line-height:1.8;">
                        Panel ini digunakan untuk menambah, menghapus, dan mengelola seluruh katalog merchandise AVANTI secara realtime.
                        Setiap gambar yang diupload akan langsung masuk ke folder assets/images dan tersimpan otomatis ke database.
                    </p>
                </div>

            </div>

            <div class="panel-box">
                <h2>Semua Produk</h2>

                <div class="product-grid">

                    <?php while ($row = mysqli_fetch_assoc($semua_produk)) { ?>
                        <div class="product-card">
                            <img src="../assets/images/<?php echo $row['gambar']; ?>">

                            <div class="product-info">
                                <h3><?php echo $row['nama_produk']; ?></h3>
                                <div class="product-price">Rp<?php echo number_format($row['harga']); ?></div>
                                <div class="product-cat"><?php echo $row['kategori']; ?></div><br>

                                <div class="action-wrap">

                                    <a href="edit.php?id=<?php echo $row['id']; ?>" class="edit-product">
                                        Edit Produk
                                    </a>

                                    <a href="index.php?hapus=<?php echo $row['id']; ?>"
                                        onclick="return confirm('Yakin hapus produk ini?')"
                                        class="delete-product">
                                        Hapus Produk
                                    </a>

                                </div>
                            </div>
                        </div>
                    <?php } ?>

                </div>
            </div>

        </main>

    </div>

</body>

</html>