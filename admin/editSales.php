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
    <link rel="stylesheet" href="../style/main.css?version=1.0.2">
    <link rel="stylesheet" href="../style/sales.css?version=1.0.2">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <section class="header">
            <a href="view.php?dateFrom=<?= ($datas[0][1]) ? $datas[0][1] : '' ?>&dateTo=&user=&search="><img src="../img/back-black.png" alt=""></a>
        </section>
        <section class="main">
            <form action="" method="post">
                <div class="input">
                    <label>
                        <?php foreach ($datas[0] as $key => $data) : ?>
                            <?php if ($key == 0 || $key == 1) continue; ?>
                            <?php if ($key == 3) : ?>
                                <select type="text" name="t<?= $key ?>">
                                    <?php foreach ($items as $item) : ?>
                                        <option value="<?= $item[0] ?>" <?= ($item[0] == $data) ? ' selected="selected"' : '' ?>><?= $item[0] ?></option>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <input type="<?= ($key == 4 || $key == 5) ? 'number' : 'text' ?>" name="t<?= $key ?>" value="<?= $data ?>" <?= ($key == 2) ? 'readonly' : '' ?>>
                                <?php endif; ?>
                            <?php endforeach; ?>
                    </label>
                </div>
                <button type="submit" name="submit">submit</button>
                <button type="submit" name="delete" class="submit">delete</button>
            </form>
        </section>
    </div>
    <script>
        confirmation = document.querySelector(".submit");

        confirmation.addEventListener("click", () => {
            let text = "delete this item";
            confirm(`Are you sure you want to ${text}?`) ? true : event.preventDefault();
        });
    </script>
</body>

</html>