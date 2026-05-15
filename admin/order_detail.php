<?php
include '../config/database.php';
/** @var mysqli $conn */

if (!isset($_GET['id'])) {
    die("Order ID not found");
}

$order_id = $_GET['id'];

$order_query = mysqli_query($conn, "SELECT * FROM orders WHERE id = '$order_id'");
$order = mysqli_fetch_assoc($order_query);

$items_query = mysqli_query($conn, "SELECT * FROM order_items WHERE order_id = '$order_id'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Detail</title>

    <style>
        body {
            background: #000;
            color: white;
            font-family: Arial, sans-serif;
            padding: 40px;
        }

        h1,
        h2 {
            color: #ff4d4d;
        }

        .box {
            background: #0a0a0a;
            padding: 30px;
            border-radius: 20px;
            margin-bottom: 30px;
        }

        .info p {
            margin: 10px 0;
            font-size: 18px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #0a0a0a;
            border-radius: 16px;
            overflow: hidden;
        }

        th,
        td {
            padding: 16px;
            border-bottom: 1px solid #1a1a1a;
            text-align: left;
        }

        th {
            background: #111;
            color: #ff4d4d;
        }

        .total-box {
            background: #111;
            padding: 20px;
            border-radius: 16px;
            margin-top: 20px;
        }

        .total-box p {
            font-size: 20px;
            margin: 10px 0;
        }

        .back-btn {
            display: inline-block;
            margin-top: 20px;
            background: #ff4d4d;
            color: white;
            padding: 12px 20px;
            border-radius: 10px;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <h1>Order Detail #<?php echo $order['id']; ?></h1>

    <div class="box info">
        <h2>Customer Information</h2>

        <p><strong>Name:</strong> <?php echo $order['nama_customer']; ?></p>
        <p><strong>Email:</strong> <?php echo $order['email']; ?></p>
        <p><strong>Phone:</strong> <?php echo $order['phone']; ?></p>
        <p><strong>Address:</strong> <?php echo $order['address']; ?></p>
        <p><strong>Payment:</strong> <?php echo $order['notes']; ?></p>
        <p><strong>Date:</strong> <?php echo $order['created_at']; ?></p>
    </div>

    <h2>Ordered Items</h2>

    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Subtotal</th>
            </tr>
        </thead>

        <tbody>
            <?php while ($item = mysqli_fetch_assoc($items_query)) : ?>
                <tr>
                    <td><?php echo $item['nama_produk']; ?></td>
                    <td>Rp<?php echo number_format($item['harga'], 0, ',', '.'); ?></td>
                    <td><?php echo $item['qty']; ?></td>
                    <td>Rp<?php echo number_format($item['subtotal'], 0, ',', '.'); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <div class="total-box">
        <p>Subtotal: Rp<?php echo number_format($order['subtotal'], 0, ',', '.'); ?></p>
        <p>Shipping: Rp<?php echo number_format($order['shipping'], 0, ',', '.'); ?></p>
        <p><strong>Total: Rp<?php echo number_format($order['total'], 0, ',', '.'); ?></strong></p>
    </div>

    <a href="orders.php" class="back-btn">Back To Orders</a>

</body>

</html>