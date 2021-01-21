<?php
require '../backend/data.php';
$id = $_GET['id'];

if (isset($_POST["submit"]) || isset($_POST["delete"])) {
    $user_c = $_POST["t2"];
    $item_c = $_POST["t3"];
    $qty_c = $_POST["t4"];
    $income_c = $_POST["t5"];

    (isset($_POST["submit"])) ? write("UPDATE sales SET user='$user_c', item='$item_c', qty='$qty_c', income='$income_c' WHERE id='$id'") : write("DELETE FROM sales WHERE id='$id'");
}

$items = read("SELECT item FROM itemList");
$datas = read("SELECT * FROM sales WHERE id='$id'");

$datas = ($datas) ? $datas : [[[], []]];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/main.css">
    <link rel="stylesheet" href="../style/sales.css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <section class="header">
            <a href="view.php?date=<?= ($datas[0][1]) ? $datas[0][1] : '' ?>&user=&search="><img src="../img/back-black.png" alt=""></a>
        </section>
        <section class="main">
            <form action="" method="post">
                <div class="input">
                    <?php foreach ($datas[0] as $key => $data) : ?>
                        <label>
                            <?php if ($key == 0 || $key == 1) continue; ?>
                            <?php if ($key == 3) : ?>
                                <label>
                                    <select type="text" name="username">
                                        <?php foreach ($items as $item) : ?>
                                            <option value="<?= $item[0] ?>"><?= $item[0] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </label>
                            <?php else : ?>
                                <input type="<?= ($key == 4 || $key == 5) ? 'number' : 'text' ?>" name="t<?= $key ?>" value="<?= $data ?>" <?= ($key == 2) ? 'readonly' : '' ?> <?= ($key == 3) ? "list='itemList'" : ''; ?>>
                            <?php endif; ?>
                        </label>
                    <?php endforeach; ?>
                </div>
                <button type="submit" name="submit">submit</button>
                <button type="submit" name="delete">delete</button>
            </form>
        </section>
    </div>
</body>

</html>