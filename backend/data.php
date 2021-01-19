<?php
// $conn = new mysqli("sql105.epizy.com", "epiz_27719916", "JLlFVEoRB5", "epiz_27719916_shop");
$conn = new mysqli("localhost", "root", "", "shop");

function read($sql)
{
    global $conn;
    $item = $conn->query($sql);
    $database = [];
    while ($data = $item->fetch_row()) {
        $database[] = $data;
    }

    return $database;
}

function write($sql)
{
    global $conn;
    $conn->query($sql);
    return true;
}

function rupiah($angka)
{
    $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}