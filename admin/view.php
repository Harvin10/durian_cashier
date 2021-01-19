<?php
require '../backend/data.php';

session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != "admin") {
    header("Location: ../login/login.php");
}

$incomes = [];
$expenses = [];
$stocks = [];
$total_income = 0;
$total_expense = 0;

if (isset($_GET["search"]) && $_GET["date"] != "") {
    $date = $_GET["date"];

    $part = [];
    $date_array = explode("-", $date);
    $year = $date_array[0];
    $month = $date_array[1];
    $day = $date_array[2];
    $incomes = read("SELECT * FROM sales WHERE date = '$year-$month-$day'");

    $expenses = read("SELECT * FROM expense WHERE date = '$year-$month-$day'");

    $stocks = read("SELECT item, qty FROM itemList");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/main.css">
    <link rel="stylesheet" href="../style/view.css">
    <title>Document</title>
</head>

<body>
    <div class="circle circle1"></div>
    <div class="circle circle2"></div>
    <div class="container">
        <section class="header">
            <a href="../admin.php"><img src="../img/back-black.png" alt="HOME"></a>
            <a href="login/logout.php">logout</a>
        </section>
        <section class="main">
            <form action="">
                <label>
                    <input type="date" name="date">
                </label>
                <button type="search" name="search">search</button>
            </form>

            <section class="tables">
                <table>
                    <tr>
                        <th>Date</th>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Income</th>
                    </tr>
                    <?php foreach ($incomes as $income) : ?>
                        <tr>
                            <?php foreach ($income as $i) : ?>
                                <?php if ($i == $income[3]) {
                                    $total_income += $i;
                                } ?>
                                <td><?= ($i == $income[3]) ? rupiah($i) : $i ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </table>

                <table>
                    <tr>
                        <th>Date</th>
                        <th>Informations</th>
                        <th>Expense</th>
                    </tr>
                    <?php foreach ($expenses as $expense) : ?>
                        <tr>
                            <?php foreach ($expense as $e) : ?>
                                <?php if ($e == $expense[2]) {
                                    $total_expense += $e;
                                } ?>
                                <td><?= ($e == $expense[2]) ? rupiah($e) : $e ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </table>

                <table>
                    <tr>
                        <th>Item</th>
                        <th>Remaining stock</th>
                    </tr>
                    <?php foreach ($stocks as $stock) : ?>
                        <tr>
                            <?php foreach ($stock as $s) : ?>
                                <td><?= $s ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </section>

            <div class="total">
                <h1>Total Revenue</h1>
                <h2><?= rupiah($total_income - $total_expense) ?></h2>
            </div>
        </section>
    </div>

</body>

</html>