<?php
include('config/db.php');

// รับค่าที่จะแก้ไขจากฟอร์ม
$id = $_REQUEST["id"];
$username = $_REQUEST["username"];
$password = $_REQUEST["password"];
$role = $_REQUEST["role"];

// ทำการปรับปรุงข้อมูลในฐานข้อมูล
$sql = "UPDATE tb_users SET username=:username, password=:password, role=:role WHERE id=:id";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':username', $username, PDO::PARAM_STR);
$stmt->bindParam(':password', $password, PDO::PARAM_STR);
$stmt->bindParam(':role', $role, PDO::PARAM_STR);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);

$result = $stmt->execute();

// ปิดการเชื่อมต่อ database 
$conn = null;

// แสดงผลลัพธ์
if ($result) {
    echo "<script type='text/javascript'>";
    echo "alert('Update');";
    echo "window.location = 'admin.php'; ";
    echo "</script>";
} else {
    echo "<script type='text/javascript'>";
    echo "alert('Error back to Update again');";
    echo "</script>";
}
?>
