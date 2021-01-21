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
    <meta name="theme-color" content="#6cdbeb">
    <link rel="stylesheet" href="style/main.css">
    <link rel="stylesheet" href="style/index.css">
    <link rel="manifest" href="manifest.webmanifest.json">
    <link rel="apple-touch-icon" href="img/logo192.png">
    <title>Global Durian</title>
</head>

<body>
    <div class="circle circle1"></div>
    <div class="circle circle2"></div>
    <div class="container">
        <section class="header">
            <a href="login/changeProfile.php">Change Profile</a>
            <a href="login/logout.php" class="submit">logout</a>
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
                <a href="sales.php">Input Sales</a>
            </div>
        </section>
        <section class="footer">

        </section>
    </div>
    <script src="index.js">
        confirmation = document.querySelector(".submit");

        confirmation.addEventListener("click", () => {
            console.log("x");
            let text = "logout";
            confirm(`Are you sure you want to ${text}?`) ? true : event.preventDefault();
        });
    </script>
</body>

</html>