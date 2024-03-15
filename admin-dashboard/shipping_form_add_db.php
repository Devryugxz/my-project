<?php
session_start();
include('config/db.php');

if ($_SESSION['role'] != 'seller') {
    header("Location: shipping.php");
}

$ship_price = htmlspecialchars($_POST["ship_price"]);

// ใช้ PDO เพื่อป้องกัน SQL Injection
$check_query = "SELECT ship_price FROM tb_shipping WHERE ship_price = :ship_price";
$check_statement = $conn->prepare($check_query);
$check_statement->bindParam(':ship_price', $ship_price, PDO::PARAM_STR);
$check_statement->execute();
$num = $check_statement->rowCount();

if ($num > 0) {
    echo '<script>';
    echo "window.location='shipping.php?act=add&do=d';";
    echo '</script>';
} else {
    // ใช้ PDO เพื่อป้องกัน SQL Injection
    $insert_query = "INSERT INTO tb_shipping (ship_price) VALUES (:ship_price)";
    $insert_statement = $conn->prepare($insert_query);
    $insert_statement->bindParam(':ship_price', $ship_price, PDO::PARAM_STR);
    $result = $insert_statement->execute();
}

// ปิดการเชื่อมต่อ PDO
$conn = null;

if ($result) {
    echo '<script>';
    echo "window.location='shipping.php?do=success';";
    echo '</script>';
} else {
    echo '<script>';
    echo "window.location='shipping.php?act=add&do=f';";
    echo '</script>';
}
?>
