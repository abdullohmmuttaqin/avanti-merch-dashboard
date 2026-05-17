<?php
session_start();

if (!isset($_SESSION['admin_login'])) {
    header("Location: login.php");
    exit;
}

include '../config/database.php';
/** @var mysqli $conn */

$status_filter = isset($_GET['status']) ? $_GET['status'] : 'all';

if ($status_filter == 'all') {
    $query = mysqli_query($conn, "
        SELECT * FROM orders
        ORDER BY id DESC
    ");
} else {
    $query = mysqli_query($conn, "
        SELECT * FROM orders
        WHERE status = '$status_filter'
        ORDER BY id DESC
    ");
}
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
            margin-bottom: 20px;
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

        .status-badge {
            padding: 8px 14px;
            border-radius: 999px;
            font-size: 14px;
            font-weight: 600;
            display: inline-block;
        }

        .status-pending {
            background: #5a3e00;
            color: #ffd166;
        }

        .status-paid {
            background: #003b2f;
            color: #06d6a0;
        }

        .status-shipped {
            background: #002b5a;
            color: #4cc9f0;
        }

        .status-completed {
            background: #1f4d1f;
            color: #90ee90;
        }

        .status-cancelled {
            background: #5a0000;
            color: #ff6b6b;
        }

        select {
            padding: 10px 14px;
            margin-bottom: 20px;
            border-radius: 10px;
        }
    </style>
</head>

<body>

    <h1>Orders Dashboard</h1>

    <form method="GET">
        <select name="status" onchange="this.form.submit()">
            <option value="all" <?php if ($status_filter == 'all') echo 'selected'; ?>>All Orders</option>
            <option value="pending" <?php if ($status_filter == 'pending') echo 'selected'; ?>>Pending</option>
            <option value="paid" <?php if ($status_filter == 'paid') echo 'selected'; ?>>Paid</option>
            <option value="shipped" <?php if ($status_filter == 'shipped') echo 'selected'; ?>>Shipped</option>
            <option value="completed" <?php if ($status_filter == 'completed') echo 'selected'; ?>>Completed</option>
            <option value="cancelled" <?php if ($status_filter == 'cancelled') echo 'selected'; ?>>Cancelled</option>
        </select>
    </form>

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

                    <td>
                        <span class="status-badge status-<?php echo $order['status']; ?>">
                            <?php echo ucfirst($order['status']); ?>
                        </span>
                    </td>

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