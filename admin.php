<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != "admin") {
    header("Location: login/login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=7, initial-scale=1.0">
    <link rel="stylesheet" href="style/main.css">
    <link rel="stylesheet" href="style/index.css">
    <title>Document</title>
</head>

<body>
    <div class="circle circle1"></div>
    <div class="circle circle2"></div>
    <div class="container">
        <section class="header">
            <a href="login/logout.php">logout</a>
        </section>
        <section class="main">
            <div class="card">
                <a href="admin/newUser.php">Input new User</a>
            </div>
            <div class="card">
                <a href="admin/newItem.php">Input New Item</a>
            </div>
            <div class="card">
                <a href="admin/view.php">Read data</a>
            </div>
            <div class="card">
                <a href="index.php">Home</a>
            </div>
        </section>
        <section class="footer">

        </section>
    </div>
</body>

</html>