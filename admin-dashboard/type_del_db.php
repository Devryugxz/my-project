<?php
session_start();
echo '<meta charset="utf-8">';
include('config/db.php');

if ($_SESSION['role'] != 'seller') {
    header("Location: type.php");
}

$ID = htmlspecialchars($_GET["ID"]);

// ใช้ PDO เพื่อป้องกัน SQL Injection
$sql = "DELETE FROM tb_type WHERE type_id = :type_id";
$statement = $conn->prepare($sql);
$statement->bindParam(':type_id', $ID, PDO::PARAM_INT);
$result = $statement->execute();

// ปิดการเชื่อมต่อ PDO
$conn = null;

if ($result) {
    echo "<script type='text/javascript'>";
    echo "window.location = 'type.php'; ";
    echo "</script>";
} else {
    echo "<script type='text/javascript'>";
    echo "window.location = 'type.php'; ";
    echo "</script>";
}
?>
