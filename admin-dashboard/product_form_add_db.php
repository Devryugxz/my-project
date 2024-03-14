<?php
session_start();
echo '<meta charset="utf-8">';
include('config/db.php');

if ($_SESSION['role'] != 'seller') {
    Header("Location: product.php");
}

$p_name = $_POST["p_name"];
$type_id = $_POST["type_id"];
$p_detail = $_POST["p_detail"];
$p_price = $_POST["p_price"];
$p_qty = $_POST["p_qty"];
$p_unit = $_POST["p_unit"];

$date1 = date("Ymd_His");
$numrand = (mt_rand());
$p_img = (isset($_POST['p_img']) ? $_POST['p_img'] : '');
$upload = $_FILES['p_img']['name'];
$allowedTypes = array('jpg', 'jpeg', 'png', 'gif');

if ($upload != '' && in_array(strtolower(pathinfo($upload, PATHINFO_EXTENSION)), $allowedTypes)) {
    $path = "../p_img/";
    $type = strrchr($_FILES['p_img']['name'], ".");
    $newname = $numrand . $date1 . $type;
    $path_copy = $path . $newname;
    $path_link = "../p_img/" . $newname;
    move_uploaded_file($_FILES['p_img']['tmp_name'], $path_copy);
} else {
    echo "Invalid file type. Allowed types: jpg, jpeg, png, gif";
    exit; // หยุดการทำงาน
}

// Use prepared statements to prevent SQL injection
$sql = "INSERT INTO tb_product
    (p_name, type_id, p_detail, p_price, p_qty, p_unit, p_img)
    VALUES
    (:p_name, :type_id, :p_detail, :p_price, :p_qty, :p_unit, :newname)";

$statement = $conn->prepare($sql);
$statement->bindParam(':p_name', $p_name);
$statement->bindParam(':type_id', $type_id);
$statement->bindParam(':p_detail', $p_detail);
$statement->bindParam(':p_price', $p_price);
$statement->bindParam(':p_qty', $p_qty);
$statement->bindParam(':p_unit', $p_unit);
$statement->bindParam(':newname', $newname);

$result = $statement->execute();

if ($result) {
    echo '<script>';
    echo "window.location='product.php?do=success';";
    echo '</script>';
} else {
    echo '<script>';
    echo "window.location='product.php?act=add&do=f';";
    echo '</script>';
}
