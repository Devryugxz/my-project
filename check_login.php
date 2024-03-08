<?php
session_start();
// print_r($_SESSION);
echo '<pre>';
var_dump($_POST); // หรือ $_GET ตามที่คุณใช้
echo '</pre>';
require_once('config/db.php'); // เชื่อมต่อฐานข้อมูล

if (isset($_POST['login'])) {
    $m_user = $_POST["m_user"];
    $m_pass = $_POST["m_pass"];

    if (empty($m_user)) {
        $_SESSION['error'] = 'กรุณากรอกชื่อบัญชีผู้ใช้';
        header("location: login.php");
    } else if (empty($m_pass)) {
        $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
        header("location: login.php");
    } else if (strlen($_POST['m_pass']) < 5) {
        $_SESSION['error'] = 'รหัสผ่านต้องมีความยาวอย่างน้อย 5 ตัวอักษร';
        header("location: login.php");
    } else {
        try {

            $check_data = $conn->prepare("SELECT * FROM tb_member WHERE m_user = :m_user");
            $check_data->bindParam(':m_user', $m_user);
            $check_data->execute();
            $row = $check_data->fetch(PDO::FETCH_ASSOC);

            if ($check_data->rowCount() > 0) {
                if ($m_user == $row['m_user'] && password_verify($m_pass, $row['m_pass'])) {
                    // ตรวจสอบระดับของผู้ใช้และเปลี่ยนเส้นทางไปยังหน้าที่เหมาะสม
                    switch ($row['m_level']) {
                        case 'store_owner':
                            $_SESSION['store_owner'] = $row['member_id'];
                            header("location: admin-dashboard/index.php");
                            break;
                        case 'member':
                            $_SESSION['member'] = $row['member_id'];
                            header("location: member/index.php");
                            break;
                        default:
                            $_SESSION['error'] = 'ไม่สามารถตรวจสอบระดับของผู้ใช้';
                            header("location: login.php");
                    }                   
                } else {
                    $_SESSION['error'] = 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง';
                    header("location: login.php");
                }
            } else {
                $_SESSION['error'] = 'ไม่มีข้อมูลในระบบ';
                header("location: login.php");
            }
        } catch (PDOException $e) {
            $_SESSION['error'] = 'มีข้อผิดพลาดในการทำงาน: ' . $e->getMessage();
            header("location: login.php");
            exit; // ตรวจสอบข้อผิดพลาดแล้วออกจากสคริปต์
        }
    }
}
?>
