<?php
session_start();
include('config/db.php');

if ($_SESSION['role'] != 'seller') {
    Header("Location: bank.php");
}

$b_id = $_POST['b_id'];
$b_name = $_POST['b_name'];
$b_number = $_POST['b_number'];
$b_owner = $_POST['b_owner'];

$date1 = date("Ymd_His");
$numrand = (mt_rand());
$b_logo = (isset($_POST['b_logo']) ? $_POST['b_logo'] : '');

$upload = $_FILES['b_logo']['name'];
if ($upload != '') {
    $path = "../b_logo/";
    $type = strrchr($_FILES['b_logo']['name'], ".");
    $newname = $numrand . $date1 . $type;
    $path_copy = $path . $newname;
    $path_link = "../b_logo/" . $newname;
    move_uploaded_file($_FILES['b_logo']['tmp_name'], $path_copy);
} else {
    $newname = $b_logo2; // Assuming $b_logo2 is defined somewhere
}

$sql = "UPDATE tb_bank SET b_name=:b_name, b_number=:b_number, b_owner=:b_owner, b_logo=:newname WHERE b_id=:b_id";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':b_name', $b_name);
$stmt->bindParam(':b_number', $b_number);
$stmt->bindParam(':b_owner', $b_owner);
$stmt->bindParam(':newname', $newname);
$stmt->bindParam(':b_id', $b_id);

$result = $stmt->execute();

if ($result) {
    echo '<script>';
    echo "window.location='bank.php?do=finish';";
    echo '</script>';
} else {
    echo '<script>';
    echo "window.location='bank.php?act=add&do=f';";
    echo '</script>';
}
