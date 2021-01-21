<?php
require '../backend/data.php';

session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != "admin") {
    header("Location: login/login.php");
}

$true = true;

function check($user, $email)
{
    $data = read("SELECT user, email FROM userList WHERE user='$user' or email='$email'");
    return (count($data) == 0) ? true : false;
}

if (isset($_GET["submit"])) {
    $username = ucwords(strtolower($_GET["username"]));
    $email = strtolower($_GET["email"]);
    $password = $_GET["password"];
    $role = strtolower($_GET["role"]);
    if (check($username, $email)) {
        write("INSERT INTO userList VALUES ('$email', '$username', '$role', '$password')");
    } else {
        $true = false;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/main.css?version=1.0.2">
    <link rel="stylesheet" href="../style/sales.css?version=1.0.2">
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
            <div class="error">
            </div>
            <form action="">
                <div class="input">
                    <label>
                        Username:
                        <input type="text" name="username">
                    </label>
                    <label>
                        email:
                        <input type="text" name="email">
                    </label>
                    <label>
                        password:
                        <input type="password" name="password">
                    </label>
                    <label>
                        role:
                        <input type="text" name="role">
                    </label>
                </div>
                <button type="submit" name="submit" class="submit">submit</button>
            </form>
        </section>
    </div>
    <script>
        var confirmations = document.querySelectorAll(".submit");
        var error = document.querySelector(".error");
        var validation = <?= $true; ?>
        console.log(validation);

        confirmations.forEach((confirmation) => {
            confirmation.addEventListener("click", () => {
                let text = (confirmation == confirmations[0]) ? "logout" : "add new user";
                confirm(`Are you sure you want to ${text}?`) ? true : event.preventDefault();
            })
        });

        if (!validation) {
            error.innerHTML = 'Username or Email has been used by another user';
        }
    </script>
</body>

</html>