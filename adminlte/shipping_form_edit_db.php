<?php
session_start();
echo '<meta charset="utf-8">';
include('config/db.php');

if ($_SESSION['role'] != 'seller') {
    header("Location: shipping.php");
}

$ship_id = htmlspecialchars($_POST['ship_id']);
$ship_price = htmlspecialchars($_POST["ship_price"]);

// ใช้ PDO เพื่อป้องกัน SQL Injection
$sql = "UPDATE tb_shipping SET ship_price = :ship_price WHERE ship_id = :ship_id";
$statement = $conn->prepare($sql);
$statement->bindParam(':ship_price', $ship_price, PDO::PARAM_STR);
$statement->bindParam(':ship_id', $ship_id, PDO::PARAM_INT);
$result = $statement->execute();

// ปิดการเชื่อมต่อ PDO
$conn = null;

if ($result) {
    echo '<script>';
    echo "window.location='shipping.php?do=finish';";
    echo '</script>';
} else {
    echo '<script>';
    echo "window.location='shipping.php?act=add&do=f';";
    echo '</script>';
}
?>
