<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

/* UPDATE QTY */
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = $_GET['id'];

    if (isset($_SESSION['cart'][$id])) {

        if ($_GET['action'] == 'plus') {
            $_SESSION['cart'][$id]['qty'] += 1;
        }

        if ($_GET['action'] == 'minus') {
            $_SESSION['cart'][$id]['qty'] -= 1;

            if ($_SESSION['cart'][$id]['qty'] <= 0) {
                unset($_SESSION['cart'][$id]);
            }
        }

        if ($_GET['action'] == 'remove') {
            unset($_SESSION['cart'][$id]);
        }
    }

    header("Location: cart.php");
    exit;
}

$total = 0;
$shipping = 25000;
?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<section class="section">
    <h2>Your Cart</h2>

    <div class="cart-container">

        <div class="cart-items">

            <?php if (empty($_SESSION['cart'])) : ?>
                <div class="empty-cart">
                    <h3>Cart is empty</h3>
                    <p>Add some merch first 🤘</p>
                    <a href="../index.php#shop" class="btn">Back To Shop</a>
                </div>

            <?php else : ?>

                <?php foreach ($_SESSION['cart'] as $item) : ?>
                    <?php
                    $subtotal = $item['harga'] * $item['qty'];
                    $total += $subtotal;
                    ?>

                    <div class="cart-card">

                        <div class="cart-image">
                            <img src="../assets/images/<?php echo $item['gambar']; ?>" alt="">
                        </div>

                        <div class="cart-info">
                            <h3><?php echo $item['nama']; ?></h3>
                            <p><?php echo $item['kategori']; ?></p>

                            <p class="price">
                                Rp<?php echo number_format($item['harga'], 0, ',', '.'); ?>
                            </p>
                        </div>

                        <div class="cart-controls">
                            <a href="?action=minus&id=<?php echo $item['id']; ?>" class="qty-btn">-</a>

                            <span><?php echo $item['qty']; ?></span>

                            <a href="?action=plus&id=<?php echo $item['id']; ?>" class="qty-btn">+</a>

                            <a href="?action=remove&id=<?php echo $item['id']; ?>" class="remove-btn">
                                Remove
                            </a>
                        </div>

                    </div>
                <?php endforeach; ?>

            <?php endif; ?>

        </div>

        <?php if (!empty($_SESSION['cart'])) : ?>
            <div class="cart-summary">
                <h3>Order Summary</h3>

                <div class="summary-row">
                    <span>Subtotal</span>
                    <span>Rp<?php echo number_format($total, 0, ',', '.'); ?></span>
                </div>

                <div class="summary-row">
                    <span>Shipping</span>
                    <span>Rp<?php echo number_format($shipping, 0, ',', '.'); ?></span>
                </div>

                <hr>

                <div class="summary-row total">
                    <span>Total</span>
                    <span>
                        Rp<?php echo number_format($total + $shipping, 0, ',', '.'); ?>
                    </span>
                </div>

                <a href="checkout.php" class="btn checkout-btn">
                    Proceed to Checkout
                </a>
            </div>
        <?php endif; ?>

    </div>
</section>

<?php include '../includes/footer.php'; ?>