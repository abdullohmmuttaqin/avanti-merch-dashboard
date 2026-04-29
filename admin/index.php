<?php
include '../config/database.php';

global $conn;

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

    echo "<script>alert('Produk berhasil ditambahkan!');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - AVANTI MERCH</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

    <section class="products">
        <h2 class="section-title">Admin Tambah Produk</h2>

        <div style="max-width:600px; margin:auto; background:#1b1b1b; padding:30px; border-radius:12px;">

            <form method="POST">
                <input type="text" name="nama_produk" placeholder="Nama Produk" required style="width:100%; padding:12px; margin-bottom:15px;">

                <input type="number" name="harga" placeholder="Harga Produk" required style="width:100%; padding:12px; margin-bottom:15px;">

                <input type="text" name="gambar" placeholder="Nama File Gambar (contoh: sid1.jpg)" required style="width:100%; padding:12px; margin-bottom:15px;">

                <input type="text" name="kategori" placeholder="Kategori Produk" required style="width:100%; padding:12px; margin-bottom:20px;">

                <button type="submit" name="simpan" class="buy-btn" style="border:none; cursor:pointer;">Simpan Produk</button>
            </form>

        </div>
    </section>

</body>

</html>