<?php
require 'backend/data.php';

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login/login.php");
}

if (isset($_GET["submit"])) {
    $info = $_GET["info"];
    $expense = $_GET["expense"];
    write("INSERT INTO expense VALUES (now(), '$info', '$expense')");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/main.css">
    <link rel="stylesheet" href="style/sales.css">
    <title>Global Durian</title>
</head>

<body>
    <div class="circle circle1"></div>
    <div class="circle circle2"></div>
    <div class="container">
        <section class="header">
            <a href="sales.php"><img src="img/back-black.png" alt="SALE"></a>
            <a href="login/logout.php">logout</a>
            <a href="<?= ($_SESSION['role'] == 'admin') ? 'admin.php' : 'index.php' ?>"><img src="img/front-black.png" alt="HOME"></a>
        </section>
        <section class="main">
            <form action="">
                <div class="input">
                    <label>
                        Information
                        <input type="text" name="info">
                    </label>
                    <label>
                        Expense
                        <input type="number" name="expense">
                    </label>
                </div>
                <button type="submit" name="submit">submit</button>
            </form>
        </section>
    </div>
</body>

</html>