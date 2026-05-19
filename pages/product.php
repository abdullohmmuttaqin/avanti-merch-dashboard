<?php
session_start();
include '../config/database.php';
/** @var mysqli $conn */

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
    $qty = $_POST['qty'];

    if (isset($_SESSION['cart'][$product_id])) {

        $_SESSION['cart'][$product_id]['qty'] += $qty;
    } else {

        $_SESSION['cart'][$product_id] = [
            'id' => $product['id'],
            'nama' => $product['nama_produk'],
            'harga' => $product['harga'],
            'gambar' => $product['gambar'],
            'kategori' => $product['kategori'],
            'qty' => $qty
        ];
    }

    header("Location: cart.php");
    exit;
}
?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<section class="section product-page">

    <div class="product-detail">

        <div class="product-image">
            <img src="../assets/images/<?php echo $product['gambar']; ?>" alt="">
        </div>

        <div class="product-info">

            <span class="product-tag">
                <?php echo $product['kategori']; ?>
            </span>

            <h1>
                <?php echo $product['nama_produk']; ?>
            </h1>

            <p class="price">
                Rp<?php echo number_format($product['harga'], 0, ',', '.'); ?>
            </p>
            <p class="stock">Stock Available</p>

            <p class="description">
                Premium underground merchandise from AVANTI MERCH.
                Built for punk rock culture, hardcore scenes,
                and limited streetwear drops with authentic design identity.
            </p>

            <div class="qty-box">
                <label>Quantity</label>
                <input
                    type="number"
                    name="qty"
                    value="1"
                    min="1"
                    class="qty-input">
            </div>

            <div class="product-actions">

                <form method="POST">
                    <button type="submit" name="add_to_cart" class="btn">
                        Add To Cart
                    </button>
                </form>

                <a href="cart.php" class="btn secondary-btn">
                    View Cart
                </a>

            </div>

        </div>

    </div>

</section>

<?php include '../includes/footer.php'; ?>