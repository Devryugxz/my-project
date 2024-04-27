<?php
session_start();
include('config/db.php');
if ($_SESSION['role'] != 'seller') {
    Header("Location: bank.php");
}

$ID = $_GET["ID"];

// Use prepared statement to prevent SQL injection
$sql = "DELETE FROM tb_bank WHERE b_id = :b_id";
$statement = $conn->prepare($sql);
$statement->bindParam(':b_id', $ID);

$result = $statement->execute();

if ($result) {
    echo "<script type='text/javascript'>";
    echo "window.location = 'bank.php'; ";
    echo "</script>";
} else {
    echo "<script type='text/javascript'>";
    echo "window.location = 'bank.php'; ";
    echo "</script>";
}
?>
