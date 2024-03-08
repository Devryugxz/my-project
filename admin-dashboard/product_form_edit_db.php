<?php
session_start();
echo '<meta charset="utf-8">';
include('config/db.php');
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit();
if ($_SESSION['m_level'] != 'admin') {
    Header("Location: index.php");
}

$p_id = $_POST["p_id"];
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
if ($upload != '') {

    $path = "../p_img/";
    $type = strrchr($_FILES['p_img']['name'], ".");
    $newname = $numrand . $date1 . $type;
    $path_copy = $path . $newname;
    $path_link = "../p_img/" . $newname;
    move_uploaded_file($_FILES['p_img']['tmp_name'], $path_copy);
} else {
    $newname = $p_img2; // Assuming $p_img2 is a variable from somewhere in your code
}

// Use prepared statements to prevent SQL injection
$sql = "UPDATE tb_product SET 
	p_name=:p_name,
	type_id=:type_id,
	p_detail=:p_detail,
	p_price=:p_price,
	p_qty=:p_qty,
	p_unit=:p_unit,
	p_img=:newname
	WHERE p_id=:p_id";

$statement = $conn->prepare($sql);
$statement->bindParam(':p_name', $p_name);
$statement->bindParam(':type_id', $type_id);
$statement->bindParam(':p_detail', $p_detail);
$statement->bindParam(':p_price', $p_price);
$statement->bindParam(':p_qty', $p_qty);
$statement->bindParam(':p_unit', $p_unit);
$statement->bindParam(':newname', $newname);
$statement->bindParam(':p_id', $p_id);

$result = $statement->execute();

if ($result) {
    echo '<script>';
    echo "window.location='product.php?do=finish';";
    echo '</script>';
} else {
    echo '<script>';
    echo "window.location='product.php?act=add&do=f';";
    echo '</script>';
}
?>
