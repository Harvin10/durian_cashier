<?php
require '../backend/data.php';
// variable pendefinisian kredensial
$users = read("SELECT * FROM userList");

// memulai session
session_start();

// mengambil isian dari form login
$username = $_POST['username'];
$password = $_POST['password'];

// pengecekan kredensial login
foreach ($users as $user) {
    if (($username == $user[1] || $username == $user[0]) && $password == $user[3]) {
        session_start();
        $_SESSION['username'] = $user[1];
        $_SESSION['role'] = $user[2];
        if ($user[2] == "sales") {
            header("Location: ../index.php");
            exit();
        } else if ($user[2] == "admin") {
            header("Location: ../admin.php");
            exit();
        }
    }
}
header("Location: login.php");
