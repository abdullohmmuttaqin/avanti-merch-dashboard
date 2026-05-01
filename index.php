<?php
include 'config/database.php';

$ambil_produk = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC LIMIT 8");
$latest_produk = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC LIMIT 3");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AVANTI MERCH</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body id="hero">

    <!-- NAVBAR -->
    <nav class="navbar">
        <h1 class="logo">AVANTI MERCH</h1>

        <ul class="nav-links">
            <li><a href="#hero">Home</a></li>
            <li><a href="#latest">Latest Drops</a></li>
            <li><a href="#category">Categories</a></li>
            <li><a href="#shop">Shop</a></li>
            <li><a href="admin/login.php">Admin</a></li>
        </ul>
    </nav>

    <!-- HERO -->
    <header class="hero">
        <div class="hero-overlay"></div>

        <div class="hero-content">
            <h2>Official Merchandise<br>Store</h2>
            <p>Premium apparel, accessories, and exclusive underground drops.</p>
            <a href="#shop" class="shop-btn">Shop Collection</a>
        </div>
    </header>

    <!-- FEATURE -->
    <section class="feature-bar">
        <div class="feature-item">✔ Premium Cotton Quality</div>
        <div class="feature-item">✔ Limited Underground Design</div>
        <div class="feature-item">✔ Worldwide Shipping Ready</div>
        <div class="feature-item">✔ Authentic Music Merchandise</div>
    </section>

    <!-- LATEST -->
    <section class="products" id="latest">
        <h2 class="section-title">Latest Drops</h2>

        <div class="product-container latest-grid">
            <?php while ($latest = mysqli_fetch_assoc($latest_produk)) { ?>
                <div class="product-card">
                    <img src="assets/images/<?php echo $latest['gambar']; ?>">
                    <h3><?php echo $latest['nama_produk']; ?></h3>
                    <div class="price">Rp<?php echo number_format($latest['harga']); ?></div>
                    <div class="category-tag"><?php echo $latest['kategori']; ?></div>
                    <a href="#shop" class="buy-btn">View Product</a>
                </div>
            <?php } ?>
        </div>
    </section>

    <!-- CATEGORY -->
    <section class="category-section" id="category">
        <h2 class="section-title">Shop By Category</h2>

        <div class="category-wrap">
            <div class="cat-box">Punk Rock Collection</div>
            <div class="cat-box">Hardcore Essentials</div>
            <div class="cat-box">Streetwear Limited</div>
            <div class="cat-box">Band Accessories</div>
        </div>
    </section>

    <!-- SHOP -->
    <section class="products" id="shop">
        <h2 class="section-title">All Merchandise</h2>

        <div class="product-container">
            <?php while ($produk = mysqli_fetch_assoc($ambil_produk)) { ?>
                <div class="product-card">
                    <img src="assets/images/<?php echo $produk['gambar']; ?>">
                    <h3><?php echo $produk['nama_produk']; ?></h3>
                    <div class="price">Rp<?php echo number_format($produk['harga']); ?></div>
                    <div class="category-tag"><?php echo $produk['kategori']; ?></div>
                    <a href="#" class="buy-btn">Buy Now</a>
                </div>
            <?php } ?>
        </div>
    </section>

    <!-- ABOUT -->
    <section class="about-strip">
        <h2>Built For Underground Culture</h2>
        <p>
            AVANTI MERCH is an independent merchandise platform focused on authentic
            punk rock, hardcore, and street movement apparel with premium production quality.
        </p>
    </section>

    <!-- FOOTER -->
    <footer class="footer">
        <h3>AVANTI MERCH</h3>
        <p>Premium Underground Merchandise Platform © 2026</p>
    </footer>

</body>

</html>