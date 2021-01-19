<?php
require 'backend/data.php';

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login/login.php");
}

$items = read("SELECT item FROM itemList");
$users = read("SELECT user FROM userList");

if (isset($_GET["submit"])) {
    $user = $_SESSION["username"];
    $item = $_GET["item"];
    $qty = $_GET["qty"];
    $income = $_GET["income"];
    write("INSERT INTO sales VALUES (now(), '$user', '$item', '$qty', '$income')");
    write("UPDATE itemList SET qty = qty - $qty WHERE item = '$item'");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/main.css">
    <link rel="stylesheet" href="style/sales.css">
    <title>Document</title>
</head>

<body>
    <div class="circle circle1"></div>
    <div class="circle circle2"></div>
    <div class="container">
        <section class="header">
            <a href="index.php" class="back"><img src="img/back-black.png" alt="HOME"></a>
            <a href="login/logout.php">logout</a>
            <a href="expense.php" class="next"><img src="img/front-black.png" alt="EXPENSE"></a>
        </section>
        <section class="main">
            <form action="">
                <div class="input">
                    <label>
                        User:
                        <input type="text" name="user" value="<?= $_SESSION['username'] ?>" readonly>
                    </label>
                    <label>
                        Item:
                        <select type="text" name="item">
                            <?php foreach ($items as $item) : ?>
                                <option value="<?= $item[0] ?>"><?= $item[0] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                    <label>
                        Quantity:
                        <input type="number" name="qty">
                    </label>
                    <label>
                        Income:
                        <input type="number" name="income">
                    </label>
                </div>
                <button type="submit" name="submit">submit</button>
            </form>
        </section>
    </div>
</body>

</html>