<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require_once('config/db.php'); // เชื่อมต่อฐานข้อมูล

    if (isset($_POST['register_seller'])) {
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $c_password = $_POST["c_password"];
        $name = $_POST['name'];
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
        if (empty($firstname) || empty($lastname) || empty($username) || empty($password) || empty($c_password) || empty($name) || empty($email) || empty($phone)) {
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
                $stmt = $conn->prepare("INSERT INTO tb_seller (firstname, lastname, username, password, name, email, phone, role) VALUES (:firstname, :lastname, :username, :password, :name, :email, :phone, :role)");
                $stmt->bindParam(':firstname', $firstname);
                $stmt->bindParam(':lastname', $lastname);
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(":password", $passwordHash);
                $stmt->bindParam(":name", $name);
                $stmt->bindParam(':phone', $phone);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':role', $role);

                // ทำการ execute statement
                $stmt->execute();

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
?>