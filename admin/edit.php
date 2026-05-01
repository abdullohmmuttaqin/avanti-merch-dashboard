<?php
session_start();

if (!isset($_SESSION['admin_login'])) {
    header("Location: login.php");
    exit;
}

include '../config/database.php';

$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM products WHERE id='$id'");
$row = mysqli_fetch_assoc($data);

if (isset($_POST['update'])) {

    $nama = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $kategori = $_POST['kategori'];

    if ($_FILES['gambar']['name'] != "") {

        $nama_file = $_FILES['gambar']['name'];
        $tmp_file = $_FILES['gambar']['tmp_name'];

        move_uploaded_file($tmp_file, "../assets/images/" . $nama_file);

        mysqli_query($conn, "UPDATE products SET
            nama_produk='$nama',
            harga='$harga',
            kategori='$kategori',
            gambar='$nama_file'
            WHERE id='$id'
        ");
    } else {

        mysqli_query($conn, "UPDATE products SET
            nama_produk='$nama',
            harga='$harga',
            kategori='$kategori'
            WHERE id='$id'
        ");
    }

    header("Location:index.php?status=update");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
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
                <h1>Edit Produk</h1>
                <p>Perbarui data merchandise yang sudah ada.</p>
            </div>

            <div class="panel-box">
                <form method="POST" enctype="multipart/form-data">
                    <div class="admin-form-grid">
                        <input type="text" name="nama_produk" value="<?php echo $row['nama_produk']; ?>" required>
                        <input type="number" name="harga" value="<?php echo $row['harga']; ?>" required>
                        <input type="text" name="kategori" value="<?php echo $row['kategori']; ?>" required>
                        <input type="file" name="gambar" class="full">
                    </div>

                    <button type="submit" name="update" class="save-btn">Update Produk</button>
                </form>
            </div>

        </main>

    </div>

</body>

</html>