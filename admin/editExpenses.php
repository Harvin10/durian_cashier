<?php
require '../backend/data.php';
$id = $_GET['id'];

if (isset($_POST["submit"]) || isset($_POST["delete"])) {
    $info_c = $_POST["t2"];
    $expense_c = $_POST["t3"];

    (isset($_POST["submit"])) ? write("UPDATE expense SET info='$info_c', expense='$expense_c' WHERE id='$id'") : write("DELETE FROM expense WHERE id='$id'");
}
$x = read("SELECT * FROM sales");
$datas = read("SELECT * FROM expense WHERE id='$id'");

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
            <a href="view.php?date=<?= ($datas[0][1]) ? $datas[0][1] : '' ?>&dateTo=&user=&search="><img src="../img/back-black.png" alt=""></a>
        </section>
        <section class="main">
            <form action="" method="post">
                <div class="input">
                    <?php foreach ($datas[0] as $key => $data) : ?>
                        <label>
                            <?php if ($key == 0 || $key == 1) continue; ?>
                            <input type="text" name="t<?= $key ?>" value="<?= $data ?>">
                        </label>
                    <?php endforeach; ?>
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