<?php
// print_r($_POST);
session_start();
require_once('config/db.php'); // เชื่อมต่อฐานข้อมูล

if (isset($_POST['m_user'])) {
    // รับค่า user & mem_password
    $m_user = $_POST['m_user'];
    $m_pass = $_POST['m_pass'];

    try {
        // ใช้ Prepared Statements เพื่อป้องกัน SQL Injection
        $stmt = $conn->prepare("SELECT * FROM tb_member WHERE m_user = :m_user AND m_pass = :m_pass");
        $stmt->bindParam(':m_user', $m_user);
        $stmt->bindParam(':m_pass', $m_pass);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            switch ($row['m_level']) {
                case "admin":
                    header("Location: admin/index.php");
                    break;
                case "store_owner":
                    header("location: admin-dashboard/index.php");
                    break;
                default:
                    header("Location: index.php");
            }
        } else {
            echo "<script>";
            echo "alert(\" user หรือ password ไม่ถูกต้อง\");";
            echo "window.history.back()";
            echo "</script>";
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} else {
    header("Location: index.php"); // user & mem_password incorrect back to login again
}
?>
