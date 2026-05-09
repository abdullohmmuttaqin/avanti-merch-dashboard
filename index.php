<?php
include 'config/database.php';

$all_produk = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC LIMIT 8");
$latest_produk = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC LIMIT 4");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AVANTI MERCH</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="logo">AVANTI MERCH</div>
        <ul>
            <li><a href="#hero">Home</a></li>
            <li><a href="#latest">Latest</a></li>
            <li><a href="#category">Category</a></li>
            <li><a href="#shop">Shop</a></li>
            <li><a href="admin/login.php">Admin</a></li>
        </ul>
    </nav>

    <!-- HERO -->
    <section class="hero" id="hero">
        <div class="overlay"></div>
        <div class="hero-text">
            <h1>Official Underground Merchandise</h1>
            <p>
                Premium punk rock apparel, hardcore essentials, limited streetwear,
                and authentic band culture accessories.
            </p>
            <a href="#shop">Explore Collection</a>
        </div>
    </section>

    <!-- FEATURE INFO -->
    <section class="feature">
        <div>Premium Fabric Quality</div>
        <div>Limited Underground Design</div>
        <div>Authentic Merchandise Culture</div>
        <div>Worldwide Shipping Ready</div>
    </section>

    <!-- LATEST -->
    <section class="section" id="latest">
        <h2>Latest Drops</h2>
        <div class="product-grid">
            <?php while ($latest = mysqli_fetch_assoc($latest_produk)) { ?>
                <div class="card">
                    <div class="img-box">
                        <img src="assets/images/<?php echo $latest['gambar']; ?>">
                    </div>
                    <div class="card-body">
                        <h3><?php echo $latest['nama_produk']; ?></h3>
                        <span class="price">Rp<?php echo number_format($latest['harga']); ?></span>
                        <span class="tag"><?php echo $latest['kategori']; ?></span>
                        <a href="#shop" class="btn">View Product</a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>

    <!-- CATEGORY -->
    <section class="section" id="category">
        <h2>Shop By Category</h2>
        <div class="category-grid">
            <div class="cat">Punk Rock Collection</div>
            <div class="cat">Hardcore Essentials</div>
            <div class="cat">Streetwear Limited</div>
            <div class="cat">Band Accessories</div>
        </div>
    </section>

    <!-- SHOP -->
    <section class="section" id="shop">
        <h2>All Merchandise</h2>
        <div class="product-grid">
            <?php while ($row = mysqli_fetch_assoc($all_produk)) { ?>
                <div class="card">
                    <div class="img-box">
                        <img src="assets/images/<?php echo $row['gambar']; ?>">
                    </div>
                    <div class="card-body">
                        <h3><?php echo $row['nama_produk']; ?></h3>
                        <span class="price">Rp<?php echo number_format($row['harga']); ?></span>
                        <span class="tag"><?php echo $row['kategori']; ?></span>
                        <a href="#" class="btn">Buy Now</a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>

    <!-- ABOUT -->
    <section class="about">
        <h2>Built For Underground Culture</h2>
        <p>
            AVANTI MERCH is a premium independent merchandise platform focused on authentic
            punk rock movement, hardcore street culture, and limited apparel drops.
        </p>
    </section>

    <!-- FOOTER -->
    <footer>
        <h3>AVANTI MERCH</h3>
        <p>Premium Underground Merchandise Platform © 2026</p>
    </footer>

</body>

</html>