<?php
session_start();
echo '<meta charset="utf-8">';
include('config/db.php');

if ($_SESSION['role'] != 'seller') {
    header("Location: shipping.php");
}

$ID = htmlspecialchars($_GET["ID"]);

// ใช้ PDO เพื่อป้องกัน SQL Injection
$sql = "DELETE FROM tb_shipping WHERE ship_id = :ship_id";
$statement = $conn->prepare($sql);
$statement->bindParam(':ship_id', $ID, PDO::PARAM_INT);
$result = $statement->execute();

// ปิดการเชื่อมต่อ PDO
$conn = null;

if ($result) {
    echo "<script type='text/javascript'>";
    echo "window.location = '../admin-dashboard/shipping.php'; ";
    echo "</script>";
} else {
    echo "<script type='text/javascript'>";
    echo "window.location = '../admin-dashboard/shipping.php'; ";
    echo "</script>";
}
?>
