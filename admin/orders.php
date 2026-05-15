<?php
include '../config/database.php';

$query = mysqli_query($conn, "SELECT * FROM orders ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders Dashboard</title>

    <style>
        body {
            background: #000;
            color: white;
            font-family: Arial, sans-serif;
            padding: 40px;
        }

        h1 {
            margin-bottom: 30px;
            color: #ff4d4d;
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

        tr:hover {
            background: #111;
        }

        .btn {
            background: #ff4d4d;
            color: white;
            padding: 10px 16px;
            border-radius: 10px;
            text-decoration: none;
            display: inline-block;
        }
    </style>
</head>

<body>

    <h1>Orders Dashboard</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Payment</th>
                <th>Status</th>
                <th>Total</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php while ($order = mysqli_fetch_assoc($query)) : ?>
                <tr>
                    <td><?php echo $order['id']; ?></td>
                    <td><?php echo $order['nama_customer']; ?></td>
                    <td><?php echo $order['email']; ?></td>
                    <td><?php echo $order['phone']; ?></td>
                    <td><?php echo $order['notes']; ?></td>
                    <td><?php echo ucfirst($order['status']); ?></td>
                    <td>Rp<?php echo number_format($order['total'], 0, ',', '.'); ?></td>
                    <td><?php echo $order['created_at']; ?></td>
                    <td>
                        <a href="order_detail.php?id=<?php echo $order['id']; ?>" class="btn">
                            Detail
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</body>

</html>