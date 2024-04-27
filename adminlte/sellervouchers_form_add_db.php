<?php
session_start();
include('config/db.php');

if ($_SESSION['role'] != 'seller') {
    Header("Location: sellervouchers.php");
}

$pro_name = $_POST["pro_name"];
$pro_discount = $_POST["pro_discount"];
$pro_startdate = $_POST["pro_startdate"];
$pro_enddate = $_POST["pro_enddate"];
$pro_details = $_POST["pro_details"];

// Use prepared statements to prevent SQL injection
$sql = "INSERT INTO tb_promotion (pro_name, pro_discount, pro_startdate, pro_enddate, pro_details) VALUES (:pro_name, :pro_discount, :pro_startdate, :pro_enddate, :pro_details)";

$statement = $conn->prepare($sql);
$statement->bindParam(':pro_name', $pro_name);
$statement->bindParam(':pro_discount', $pro_discount);
$statement->bindParam(':pro_startdate', $pro_startdate);
$statement->bindParam(':pro_enddate', $pro_enddate);
$statement->bindParam(':pro_details', $pro_details);

$result = $statement->execute();

if ($result) {
    echo '<script>';
    echo "window.location='sellervouchers.php?do=success';";
    echo '</script>';
} else {
    echo '<script>';
    echo "window.location='sellervouchers.php?act=add&do=f';";
    echo '</script>';
}
