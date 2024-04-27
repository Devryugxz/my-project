<?php
session_start();
include('config/db.php');

if ($_SESSION['role'] != 'seller') {
    header("Location: type.php");
}

$type_name = htmlspecialchars($_POST["type_name"]);

// ใช้ PDO เพื่อป้องกัน SQL Injection
$check_query = "SELECT type_name FROM tb_type WHERE type_name = :type_name";
$check_statement = $conn->prepare($check_query);
$check_statement->bindParam(':type_name', $type_name, PDO::PARAM_STR);
$check_statement->execute();
$num = $check_statement->rowCount();

if ($num > 0) {
    echo '<script>';
    echo "window.location='type.php?act=add&do=d';";
    echo '</script>';
} else {
    // ใช้ PDO เพื่อป้องกัน SQL Injection
    $insert_query = "INSERT INTO tb_type (type_name) VALUES (:type_name)";
    $insert_statement = $conn->prepare($insert_query);
    $insert_statement->bindParam(':type_name', $type_name, PDO::PARAM_STR);
    $result = $insert_statement->execute();
}

// ปิดการเชื่อมต่อ PDO
$conn = null;

if ($result) {
    echo '<script>';
    echo "window.location='type.php?do=success';";
    echo '</script>';
} else {
    echo '<script>';
    echo "window.location='type.php?act=add&do=f';";
    echo '</script>';
}
?>
