<?php
session_start();
include '../config/database.php';

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit;
}

$shipping = 25000;
$total = 0;

foreach ($_SESSION['cart'] as $item) {
    $total += $item['harga'] * $item['qty'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $payment = $_POST['payment'];

    $grand_total = $total + $shipping;

    mysqli_query($conn, "INSERT INTO orders (
        nama_customer,
        email,
        phone,
        address,
        notes,
        subtotal,
        shipping,
        total
    ) VALUES (
        '$nama',
        '$email',
        '$phone',
        '$address',
        '$payment',
        '$total',
        '$shipping',
        '$grand_total'
    )");

    $order_id = mysqli_insert_id($conn);

    foreach ($_SESSION['cart'] as $item) {
        $subtotal = $item['harga'] * $item['qty'];

        mysqli_query($conn, "INSERT INTO order_items (
            order_id,
            product_id,
            nama_produk,
            harga,
            qty,
            subtotal
        ) VALUES (
            '$order_id',
            '{$item['id']}',
            '{$item['nama']}',
            '{$item['harga']}',
            '{$item['qty']}',
            '$subtotal'
        )");
    }

    unset($_SESSION['cart']);

    header("Location: success.php");
    exit;
}
?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<section class="section">
    <h2>Checkout</h2>

    <div class="checkout-container">

        <div class="checkout-form">
            <h3>Customer Information</h3>

            <form method="POST">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="nama" required placeholder="Enter your full name">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" required placeholder="Enter your email">
                </div>

                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" name="phone" required placeholder="Enter your phone number">
                </div>

                <div class="form-group">
                    <label>Shipping Address</label>
                    <textarea name="address" required placeholder="Enter shipping address"></textarea>
                </div>

                <div class="form-group">
                    <label>Payment Method</label>
                    <select name="payment">
                        <option>Bank Transfer</option>
                        <option>QRIS</option>
                        <option>COD</option>
                    </select>
                </div>

                <button type="submit" class="btn place-order-btn">
                    Place Order
                </button>
            </form>
        </div>

        <div class="checkout-summary">
            <h3>Order Summary</h3>

            <?php foreach ($_SESSION['cart'] as $item) : ?>
                <div class="summary-row">
                    <span>
                        <?php echo $item['nama']; ?> x<?php echo $item['qty']; ?>
                    </span>
                    <span>
                        Rp<?php echo number_format($item['harga'] * $item['qty'], 0, ',', '.'); ?>
                    </span>
                </div>
            <?php endforeach; ?>

            <div class="summary-row">
                <span>Shipping</span>
                <span>Rp<?php echo number_format($shipping, 0, ',', '.'); ?></span>
            </div>

            <div class="summary-row total">
                <span>Total</span>
                <span>
                    Rp<?php echo number_format($total + $shipping, 0, ',', '.'); ?>
                </span>
            </div>
        </div>

    </div>
</section>

<?php include '../includes/footer.php'; ?>