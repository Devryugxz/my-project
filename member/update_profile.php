<?php
require_once('config/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_username = $_POST['username'];
    $new_email = $_POST['email'];

    $update_stmt = $conn->prepare("UPDATE tb_users SET username = :username, email = :email WHERE id = :id");
    $update_stmt->bindParam(':username', $new_username);
    $update_stmt->bindParam(':email', $new_email);
    $update_stmt->bindParam(':id', $user_id);
    
    if ($update_stmt->execute()) {
        echo "ข้อมูลถูกปรับปรุงเรียบร้อยแล้ว";
    } else {
        echo "เกิดข้อผิดพลาดในการปรับปรุงข้อมูล";
    }
}
?>