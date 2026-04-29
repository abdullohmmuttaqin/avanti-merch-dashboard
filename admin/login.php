<?php
// ===============================
// MEMULAI SESSION
// ===============================
session_start();

// memanggil koneksi database
include '../config/database.php';


// ===============================
// PROSES LOGIN ADMIN
// ===============================
if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    // cek ke tabel admin_user
    $cek = mysqli_query($conn, "SELECT * FROM admin_user 
                                WHERE username='$username' 
                                AND password='$password'");

    // jika data ketemu
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
    <title>Login Admin - AVANTI MERCH</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

    <section class="products">
        <h2 class="section-title">ADMIN LOGIN</h2>

        <div class="admin-box" style="max-width:500px; margin:auto;">

            <form method="POST" class="admin-form">
                <input type="text" name="username" placeholder="Username Admin" required>
                <input type="password" name="password" placeholder="Password Admin" required>

                <button type="submit" name="login" class="admin-btn">Login Sekarang</button>
            </form>

        </div>
    </section>

</body>

</html>