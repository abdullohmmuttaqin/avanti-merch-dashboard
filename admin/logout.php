<?php
session_start();

// hapus semua session login
session_destroy();

// lempar balik ke login
header("Location: login.php");
exit;
