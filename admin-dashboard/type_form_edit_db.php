<?php
session_start();
echo '<meta charset="utf-8">';
include('config/db.php');

if ($_SESSION['m_level'] != 'admin') {
    header("Location: index.php");
}

$type_id = htmlspecialchars($_POST['type_id']);
$type_name = htmlspecialchars($_POST["type_name"]);

// ใช้ PDO เพื่อป้องกัน SQL Injection
$sql = "UPDATE tb_type SET type_name = :type_name WHERE type_id = :type_id";
$statement = $conn->prepare($sql);
$statement->bindParam(':type_name', $type_name, PDO::PARAM_STR);
$statement->bindParam(':type_id', $type_id, PDO::PARAM_INT);
$result = $statement->execute();

// ปิดการเชื่อมต่อ PDO
$conn = null;

if ($result) {
    echo '<script>';
    echo "window.location='type.php?do=finish';";
    echo '</script>';
} else {
    echo '<script>';
    echo "window.location='type.php?act=add&do=f';";
    echo '</script>';
}
?>
