<?php
// memanggil file koneksi database
include 'config/database.php';

// query ambil semua data produk dari tabel products
$ambil_produk = mysqli_query($conn, "SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AVANTI MERCH</title>

    <!-- Main CSS file -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <!-- ===== BAGIAN HERO / BANNER UTAMA ===== -->
    <header class="hero">

        <!-- Menu navigasi utama -->
        <nav class="navbar">
            <h1 class="logo">AVANTI MERCH</h1>

            <!-- Main Menu -->
            <ul class="nav-links">
                <li><a href="#">Home</a></li>
                <li><a href="#">Shop</a></li>
                <li><a href="#">Categories</a></li>
                <li><a href="#">Cart</a></li>
                <li><a href="#">Admin</a></li>
            </ul>
        </nav>

        <!-- Hero Text Content -->
        <div class="hero-content">
            <h2>Official Merchandise Store</h2>
            <p>Premium apparel, accessories, and exclusive drops.</p>
            <a href="#" class="shop-btn">Shop Now</a>
        </div>
    </header>

    <!-- ========= PRODUCT SECTION ========= -->
    <section class="products">

        <!-- Section Title -->
        <h2 class="section-title">Produk Unggulan</h2>

        <!-- Product Card Container -->
        <div class="product-container">
            <?php
            // melakukan perulangan untuk setiap data produk dari database
            while ($produk = mysqli_fetch_assoc($ambil_produk)) {
            ?>
                <div class="product-card">
                    <img src="assets/images/<?php echo $produk['gambar']; ?>" alt="<?php echo $produk['nama_produk']; ?>">
                    <h3><?php echo $produk['nama_produk']; ?></h3>
                    <p>Rp<?php echo number_format($produk['harga']); ?></p>
                    <a href="#" class="buy-btn">Beli Sekarang</a>
                </div>
            <?php
            }
            ?>
        </div>

    </section>

</body>

</html>