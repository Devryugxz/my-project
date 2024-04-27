<?php
session_start();
include('config/db.php');

if ($_SESSION['role'] != 'seller') {
    Header("Location: sellervouchers.php");
}

$s_id = $_SESSION['s_id'];

$select_stmt = $conn->prepare("SELECT * FROM tb_promotion WHERE s_id = :s_id"); 
$select_stmt->bindParam(':s_id', $s_id);
$select_stmt->execute();

$pro_id = $_POST['pro_id'];
$pro_name = $_POST['pro_name'];
$pro_discount = $_POST['pro_discount'];
$pro_startdate = $_POST['pro_startdate'];
$pro_enddate = $_POST['pro_enddate'];
$pro_details = $_POST['pro_details'];


$sql = "UPDATE tb_promotion SET pro_name=:pro_name, pro_discount=:pro_discount, pro_startdate=:pro_startdate, pro_enddate=:pro_enddate, pro_details=:pro_details, WHERE pro_id=:pro_id";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':pro_name', $pro_name);
$stmt->bindParam(':pro_discount', $pro_discount);
$stmt->bindParam(':pro_startdate', $pro_startdate);
$stmt->bindParam(':pro_enddate', $pro_enddate);
$stmt->bindParam(':pro_details', $pro_details);
$stmt->bindParam(':pro_id', $pro_id);

$result = $stmt->execute();

if ($result) {
    echo '<script>';
    echo "window.location='sellervouchers.php?do=finish';";
    echo '</script>';
} else {
    echo '<script>';
    echo "window.location='sellervouchers.php?act=add&do=f';";
    echo '</script>';
}
