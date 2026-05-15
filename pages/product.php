<?php
session_start();
include '../config/database.php';

if (!isset($_GET['id'])) {
    header("Location: ../index.php");
    exit;
}

$id = $_GET['id'];

$query = mysqli_query($conn, "SELECT * FROM products WHERE id='$id'");
$product = mysqli_fetch_assoc($query);

if (!$product) {
    header("Location: ../index.php");
    exit;
}

/* ADD TO CART */
if (isset($_POST['add_to_cart'])) {

    $product_id = $product['id'];

    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['qty'] += 1;
    } else {
        $_SESSION['cart'][$product_id] = [
            'id' => $product['id'],
            'nama' => $product['nama_produk'],
            'harga' => $product['harga'],
            'gambar' => $product['gambar'],
            'kategori' => $product['kategori'],
            'qty' => 1
        ];
    }

    header("Location: cart.php");
    exit;
}
?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<section class="section">

    <h2>Product Detail</h2>

    <div class="product-detail">

        <div class="product-image">
            <img src="../assets/images/<?php echo $product['gambar']; ?>" alt="">
        </div>

        <div class="product-info">
            <h1><?php echo $product['nama_produk']; ?></h1>

            <p class="price">
                Rp<?php echo number_format($product['harga'], 0, ',', '.'); ?>
            </p>

            <p class="description">
                Premium underground merchandise from AVANTI MERCH.
                Built for punk rock, hardcore culture, and limited streetwear drops.
            </p>

            <div class="product-actions">
                <form method="POST">
                    <button type="submit" name="add_to_cart" class="btn">
                        Add To Cart
                    </button>
                </form>

                <a href="cart.php" class="btn">View Cart</a>
            </div>

        </div>

    </div>

</section>

<?php include '../includes/footer.php'; ?>