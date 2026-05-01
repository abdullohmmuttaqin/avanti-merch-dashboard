<?php
session_start();
include '../config/database.php';

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $cek = mysqli_query($conn, "SELECT * FROM admin_user WHERE username='$username' AND password='$password'");

    if (mysqli_num_rows($cek) > 0) {
        $_SESSION['admin_login'] = true;
        header("Location: index.php");
        exit;
    } else {
        echo "<script>alert('Username atau Password salah!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AVANTI Admin Login</title>
    <link rel="stylesheet" href="admin-style.css">
</head>

<body>

    <div class="login-wrapper">
        <div class="login-card">
            <h1>AVANTI ADMIN</h1>

            <form method="POST">
                <input type="text" name="username" placeholder="Username Admin" required>
                <input type="password" name="password" placeholder="Password Admin" required>
                <button type="submit" name="login">LOGIN SEKARANG</button>
            </form>
        </div>
    </div>

</body>

</html>