<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require_once('config/db.php'); // เชื่อมต่อฐานข้อมูล

    if (isset($_POST['register'])) {
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $c_password = $_POST["c_password"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $role = $_POST["role"];

        // // ตรวจสอบว่ามีการอัปโหลดไฟล์หรือไม่
        // if (isset($_FILES['m_img']) && $_FILES['m_img']['error'] === UPLOAD_ERR_OK) {
        //     $type = strrchr($_FILES['m_img']['name'], ".");
        //     $newname = (new DateTime())->format('Ymd_His') . $type; // ใช้ DateTime::format เพื่อสร้างสตริงที่แสดงเวลาและวันที่
        //     $path_copy = "m_img/" . $newname;
        //     move_uploaded_file($_FILES['m_img']['tmp_name'], $path_copy);

        //     // กำหนดชื่อไฟล์ใหม่ในตัวแปร $m_img
        //     $m_img = $newname;
        // } else {
        //     // ถ้าไม่มีการอัปโหลดไฟล์ ให้ $m_img มีค่าเป็นชื่อไฟล์เดิม
        //     $m_img = (isset($_POST['m_img']) ? $_POST['m_img'] : '');
        // }

        // ตรวจสอบข้อมูลที่รับมา
        if (empty($firstname) || empty($lastname) || empty($username) || empty($password) || empty($c_password) || empty($email) || empty($phone)) {
            $_SESSION['error'] = 'กรุณากรอกข้อมูลทุกช่อง';
            header("location: register.php");
            exit;
        }

        if (strlen($password) < 5) {
            $_SESSION['error'] = 'รหัสผ่านต้องมีความยาวอย่างน้อย 5 ตัวอักษร';
            header("location: register.php");
            exit;
        }

        if ($password != $c_password) {
            $_SESSION['error'] = 'รหัสผ่านไม่ตรงกัน';
            header("location: register.php");
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'รูปแบบอีเมล์ไม่ถูกต้อง';
            header("location: register.php");
            exit;
        }

        try {
            // เช็ค username ไม่ให้ซ้ำกัน
            $check_user = $conn->prepare("SELECT username FROM tb_masterlogin WHERE username = :username");
            $check_user->bindParam(":username", $username);
            $check_user->execute();
            $row = $check_user->fetch(PDO::FETCH_ASSOC);

            if ($row['username'] == $username) {
                $_SESSION['warning'] = "มีบัญชีนี้แล้ว <a href='login.php'> คลิ๊กที่นี่ </a> เพื่อเข้าสู่ระบบ";
                header("location: register.php");
            } else if (!isset($_SESSION['error'])) {
                // ทำการเข้ารหัสรหัสผ่าน
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                // สร้าง statement และ bind parameters
                $stmtcus = $conn->prepare("INSERT INTO tb_customer (firstname, lastname, username, password, email, phone, role) VALUES (:firstname, :lastname, :username, :password, :email, :phone, :role)");
                $stmtcus->bindParam(':firstname', $firstname);
                $stmtcus->bindParam(':lastname', $lastname);
                $stmtcus->bindParam(':username', $username);
                $stmtcus->bindParam(":password", $passwordHash);
                $stmtcus->bindParam(':phone', $phone);
                $stmtcus->bindParam(':email', $email);
                $stmtcus->bindParam(':role', $role);
                // ทำการ execute statement
                $stmtcus->execute();

                // ดึงข้อมูล c_id ที่เพิ่มล่าสุด
                $c_id = $conn->lastInsertId();

                // เพิ่มข้อมูลในตาราง tb_masterlogin
                $stmtlogin = $conn->prepare("INSERT INTO tb_masterlogin (username, password, email, role, c_id) VALUES (:username, :password, :email, :role, :c_id)");
                $stmtlogin->bindParam(':username', $username);
                $stmtlogin->bindParam(':password', $passwordHash);
                $stmtlogin->bindParam(':email', $email);
                $stmtlogin->bindParam(':role', $role);
                $stmtlogin->bindParam(':c_id', $c_id);
                $stmtlogin->execute();

                // เพิ่มข้อมูลในตาราง tb_address
                $stmtaddress = $conn->prepare("INSERT INTO tb_address (c_id) VALUES (:c_id)");
                $stmtaddress->bindParam(':c_id', $c_id);
                $stmtaddress->execute();

                // ปิดการเชื่อมต่อกับฐานข้อมูล
                $conn = null;

                $_SESSION['success'] = "สมัครสมาชิกเรียบร้อยแล้ว <a href='login.php' class='alert-link'> คลิ๊กที่นี่ </a> เพื่อเข้าสู่ระบบ";
                header("location: register.php");
                exit;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }
}
