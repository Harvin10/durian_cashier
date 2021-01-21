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
$users = read("SELECT user FROM userList");

if (isset($_GET["search"]) && isset($_GET["dateFrom"])) {
    $dateFrom = $_GET["dateFrom"];
    $dateTo = $_GET["dateTo"];
    $user = $_GET["user"];

    $incomes = ($_GET["dateTo"]) ? read("SELECT * FROM sales WHERE date BETWEEN '$dateFrom' AND '$dateTo' ORDER BY date ASC") : read("SELECT * FROM sales WHERE date = '$dateFrom'");

    $expenses = ($_GET["dateTo"]) ? read("SELECT * FROM expense WHERE date BETWEEN '$dateFrom' AND '$dateTo' ORDER BY date ASC") : read("SELECT * FROM expense WHERE date = '$dateFrom'");

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
    <title>Global Durian</title>
</head>

<body>
    <div class="circle circle1"></div>
    <div class="circle circle2"></div>
    <div class="container">
        <section class="header">
            <a href="../admin.php"><img src="../img/back-black.png" alt="HOME"></a>
            <a href="login/logout.php" class="submit">logout</a>
        </section>
        <section class="main">
            <form action="">
                <label>
                    From
                    <input type="date" name="dateFrom">
                </label>
                <label>
                    To
                    <input type="date" name="dateTo">
                </label>
                <label>
                    <input type="text" name="user" list="users">
                    <datalist id="users">
                        <?php foreach ($users as $user) : ?>
                            <option value="<?= $user[0] ?>"></option>
                        <?php endforeach; ?>
                    </datalist>
                </label>
                <button type="search" name="search">search</button>
            </form>

            <section class="tables">
                <table>
                    <tr>
                        <th>Date</th>
                        <th>Sales</th>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Income</th>
                        <th>Edit</th>
                    </tr>
                    <?php foreach ($incomes as $income) : ?>
                        <tr>
                            <?php foreach ($income as $key => $i) : ?>
                                <?php if ($key == 5) {
                                    $total_income += $i;
                                } ?>
                                <?php if ($key == 0) continue; ?>
                                <td><?= ($key == 5) ? rupiah($i) : $i ?></td>
                            <?php endforeach; ?>
                            <td><a href="editSales.php?id=<?= $income[0] ?>">edit</td>
                        </tr>
                    <?php endforeach; ?>
                </table>

                <table>
                    <tr>
                        <th>Date</th>
                        <th>Informations</th>
                        <th>Expense</th>
                        <th>Edit</th>
                    </tr>
                    <?php foreach ($expenses as $expense) : ?>
                        <tr>
                            <?php foreach ($expense as $key => $e) : ?>
                                <?php if ($key == 3) {
                                    $total_expense += $e;
                                } ?>
                                <?php if ($key == 0) continue; ?>
                                <td><?= ($key == 3) ? rupiah($e) : $e ?></td>
                            <?php endforeach; ?>
                            <td><a href="editExpenses.php?id=<?= $expense[0] ?>">edit</td>
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