<?php
require '../backend/data.php';

session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != "admin") {
    header("Location: login/login.php");
}

$items = read("SELECT item FROM itemList");

if (isset($_GET['submit'])) {
    $newItem = $_GET['newItem'];
    $qty = $_GET['qty'];
    $new = true;
    foreach ($items as $item) {
        if ($item[0] == $newItem) {
            $new = false;
            break;
        }
    }
    ($new == false) ? write("UPDATE itemList SET qty = qty + '$qty' WHERE item = '$newItem'") : write("INSERT INTO itemList VALUES ('', '$newItem', '$qty')");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/main.css">
    <link rel="stylesheet" href="../style/sales.css">
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
            <form action="" method="GET">
                <div class="input">
                    <label>
                        New Item
                        <input type="text" name="newItem" list="itemList">
                        <datalist id="itemList">
                            <?php foreach ($items as $item) : ?>
                                <option value="<?= $item[0] ?>"><?= $item[0] ?></option>
                            <?php endforeach; ?>
                        </datalist>
                    </label>
                    <label>
                        Quantity
                        <input type="number" name="qty">
                    </label>
                </div>
                <button type="submit" name="submit" class="submit">submit</button>
            </form>
        </section>
    </div>
    <script>
        confirmations = document.querySelectorAll(".submit");

        confirmations.forEach((confirmation) => {
            confirmation.addEventListener("click", () => {
                let text = (confirmation == confirmations[0]) ? "logout" : "add new item";
                confirm(`Are you sure you want to ${text}?`) ? true : event.preventDefault();
            })
        });
    </script>
</body>

</html>