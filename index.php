<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login/login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#6cdbeb">
    <link rel="stylesheet" href="style/main.css?version=1.0.2">
    <link rel="stylesheet" href="style/index.css?version=1.0.2">
    <link rel="manifest" href="manifest.webmanifest.json">
    <link rel="apple-touch-icon" href="img/logo192.png">
    <title>Global Durian</title>
</head>

<body>
    <div class="circle circle1"></div>
    <div class="circle circle2"></div>
    <div class="container">
        <section class="header">
            <?php if ($_SESSION['role'] == 'admin') : ?>
                <?= "<a href='admin.php'><img src='img/back-black.png' alt='ADMIN'></a>" ?>
            <?php endif; ?>
            <?php if ($_SESSION['role'] == 'sales') : ?>
                <?= "<a href='login/changeProfile.php'>Change Profile</a>" ?>
            <?php endif; ?>
            <a href="login/logout.php" class="submit">logout</a>
        </section>
        <section class="main">
            <div class="card">
                <a href="sales.php">Input Sales</a>
            </div>
        </section>
        <section class="footer"></section>
    </div>
    <script src="index.js">
        confirmation = document.querySelectorAll(".submit");

        confirmation.addEventListener("click", () => {
            let text = "logout";
            confirm(`Are you sure you want to ${text}?`) ? true : event.preventDefault();
        });
    </script>
</body>

</html>