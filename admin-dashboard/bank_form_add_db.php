<?php
session_start();
echo '<meta charset="utf-8">';
include('config/db.php');

if ($_SESSION['m_level'] != 'admin') {
    header("Location: index.php");
    exit();
}

$b_name = $_POST["b_name"];
$b_number = $_POST["b_number"];
$b_owner = $_POST["b_owner"];

$date1 = date("Ymd_His");
$numrand = mt_rand();
$b_logo = (isset($_FILES['b_logo']) ? $_FILES['b_logo'] : '');

if ($b_logo['name'] != '') {
    $path = "../b_logo/";
    $type = strrchr($b_logo['name'], ".");
    $newname = $numrand . $date1 . $type;
    $path_copy = $path . $newname;
    $path_link = "../b_logo/" . $newname;
    move_uploaded_file($b_logo['tmp_name'], $path_copy);
} else {
    $newname = null; // ถ้าไม่มีการอัปโหลดรูปภาพใหม่
}

try {
    $conn = new PDO("mysql:host=localhost;dbname=mango_distribution_db", "root", "");

    $sql = "INSERT INTO tb_bank (b_name, b_number, b_owner, b_logo) 
            VALUES (:b_name, :b_number, :b_owner, :b_logo)";
            
    $stmt = $conn->prepare($sql);
    
    $stmt->bindParam(':b_name', $b_name);
    $stmt->bindParam(':b_number', $b_number);
    $stmt->bindParam(':b_owner', $b_owner);
    $stmt->bindParam(':b_logo', $newname);

    $stmt->execute();

    $conn = null; // ปิดการเชื่อมต่อ

    echo '<script>';
    echo "window.location='bank.php?do=success';";
    echo '</script>';
} catch (PDOException $e) {
    echo '<script>';
    echo "window.location='bank.php?act=add&do=f';";
    echo '</script>';
}
?>
