<?php
require '../backend/data.php';
$id = $_GET['id'];

if (isset($_POST["submit"]) || isset($_POST["delete"])) {
    $qty_c = $_POST["t1"];

    write("UPDATE itemList SET qty = $qty_c WHERE id='$id'");
}
$datas = read("SELECT item, qty FROM itemList WHERE id='$id'");
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
            <a href="view.php?date=<?= ($datas[0][1]) ? $datas[0][1] : '' ?>&dateTo=&user=&search="><img src="../img/back-black.png" alt=""></a>
        </section>
        <section class="main">
            <form action="" method="post">
                <div class="input">
                    <?php foreach ($datas[0] as $key => $data) : ?>
                        <label>
                            <input type="text" name="t<?= $key ?>" value="<?= $data ?>" <?= ($key == 0) ? "readonly" : "" ?>>
                        </label>
                    <?php endforeach; ?>
                </div>
                <button type="submit" name="submit">submit</button>
            </form>
        </section>
    </div>
</body>

</html>