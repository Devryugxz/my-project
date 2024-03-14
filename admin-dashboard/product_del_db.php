<?php
session_start();
echo '<meta charset="utf-8">';
include('config/db.php');
if ($_SESSION['role'] != 'seller') {
    Header("Location: product.php");
}

$ID = $_GET["ID"];

// Use prepared statement to prevent SQL injection
$sql = "DELETE FROM tb_product WHERE p_id = :p_id";
$statement = $conn->prepare($sql);
$statement->bindParam(':p_id', $ID);

$result = $statement->execute();

if ($result) {
    echo "<script type='text/javascript'>";
    echo "window.location = 'product.php'; ";
    echo "</script>";
} else {
    echo "<script type='text/javascript'>";
    echo "window.location = 'product.php'; ";
    echo "</script>";
}
?>
