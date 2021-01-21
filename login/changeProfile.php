<?php
require '../backend/data.php';

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login/login.php");
}

$id = $_SESSION['username'];
$data = read("SELECT * FROM userList WHERE user = '$id'");

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $user = $_SESSION['username'];
    $password = $_POST['password'];
    write("UPDATE userList SET email = '$email', password = '$password' WHERE user = '$user'");
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
    <div class="container">
        <section class="header">
            <a href="../<?= ($_SESSION['role'] == 'admin') ? 'admin.php' : 'index.php' ?>"><img src="../img/back-black.png" alt="HOME"></a>
        </section>
        <section class="main">
            <form action="" method="post">
                <div class="input">
                    <label>
                        username:
                        <input type="text" name="username" value="<?= $data[0][1] ?>" readonly>
                    </label>
                    <label>
                        Email:
                        <input type="text" name="email" value="<?= $data[0][0] ?>">
                    </label>
                    <label>
                        password:
                        <input type="password" name="password" value="<?= $data[0][3] ?>" class="password"><a class="button">view</a>
                    </label>
                </div>
                <button type="submit" name="submit">submit</button>
            </form>
        </section>
    </div>
    <script>
        var view = false;
        button = document.querySelector(".button");
        password = document.querySelector(".password");
        confirmations = document.querySelectorAll(".submit");

        function see(x) {
            if (x == true) {
                password.type = "text";
            } else {
                password.type = "password";
            }
        }

        button.addEventListener("click", () => {
            view = !view;
            see(view);
        })

        confirmations.forEach((confirmation) => {
            confirmation.addEventListener("click", () => {
                let text = (confirmation == confirmations[0]) ? "logout" : "add new expenses";
                confirm(`Are you sure you want to ${text}?`) ? true : event.preventDefault();
            })
        });
    </script>
</body>

</html>