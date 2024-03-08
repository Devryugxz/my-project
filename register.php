<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require_once('config/db.php'); // เชื่อมต่อฐานข้อมูล

    if (isset($_POST['register'])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $m_cpass = $_POST["m_cpass"];
        $role = $_POST["role"];
        $m_name = $_POST["m_name"];
        $m_tel = $_POST["m_tel"];
        $email = $_POST["email"];
        $m_address = $_POST["m_address"];

        // ตรวจสอบว่ามีการอัปโหลดไฟล์หรือไม่
        if (isset($_FILES['m_img']) && $_FILES['m_img']['error'] === UPLOAD_ERR_OK) {
            $type = strrchr($_FILES['m_img']['name'], ".");
            $newname = (new DateTime())->format('Ymd_His') . $type; // ใช้ DateTime::format เพื่อสร้างสตริงที่แสดงเวลาและวันที่
            $path_copy = "m_img/" . $newname;
            move_uploaded_file($_FILES['m_img']['tmp_name'], $path_copy);

            // กำหนดชื่อไฟล์ใหม่ในตัวแปร $m_img
            $m_img = $newname;
        } else {
            // ถ้าไม่มีการอัปโหลดไฟล์ ให้ $m_img มีค่าเป็นชื่อไฟล์เดิม
            $m_img = (isset($_POST['m_img']) ? $_POST['m_img'] : '');
        }

        // ตรวจสอบข้อมูลที่รับมา
        if (empty($username) || empty($password) || empty($m_cpass) || empty($m_name) || empty($m_tel) || empty($email) || empty($m_address)) {
            $_SESSION['error'] = 'กรุณากรอกข้อมูลทุกช่อง';
            header("location: register.php");
            exit;
        }

        if (strlen($password) < 5) {
            $_SESSION['error'] = 'รหัสผ่านต้องมีความยาวอย่างน้อย 5 ตัวอักษร';
            header("location: register.php");
            exit;
        }        

        if ($password != $m_cpass) {
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
            $check_user = $conn->prepare("SELECT username FROM tb_users WHERE username = :username");
            $check_user->bindParam(":username", $username);
            $check_user->execute();
            $row = $check_user->fetch(PDO::FETCH_ASSOC);

            if ($row['username'] == $username) {
                $_SESSION['warning'] = "มีบัญชีนี้แล้ว <a href='login.php'> คลิ๊กที่นี่ </a> เพื่อเข้าสู่ระบบ";
                header("location: register.php");
            } else if (!isset($_SESSION['error'])) {
                // ทำการเข้ารหัสรหัสผ่าน
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                if ($passwordHash === false) {
                    $_SESSION['error'] = 'มีปัญหาในการเข้ารหัสรหัสผ่าน';
                    header("location: register.php");
                    exit;
                }
                // สร้าง statement และ bind parameters
                $stmt = $conn->prepare("INSERT INTO tb_users (role, username, password, m_name, m_img, m_tel, email, m_address) VALUES (:role, :username, :password, :m_name, :m_img, :m_tel, :email, :m_address)");
                $stmt->bindParam(':role', $role);
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(":password", $passwordHash);
                $stmt->bindParam(':m_name', $m_name);
                $stmt->bindParam(':m_img', $m_img);
                $stmt->bindParam(':m_tel', $m_tel);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':m_address', $m_address);

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



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        .row-flex {
            display: flex;
            flex-flow: wrap;
        }

        .row-flex-center {
            justify-content: center;
        }

        .set-row {
            width: auto;
            position: inherit;
        }

        .logo {
            height: 80px;
            position: relative;
            z-index: 1;
        }

        .logo img {
            cursor: pointer;
            display: inline-block;
            width: 80px;
            height: 80px;
        }

        .line {
            width: 100%;
            height: 5px;
            position: relative;
            z-index: 9;
            background-color: #fe6d43;
        }

        .background {
            background-color: #fff;
            height: 80px;
            position: relative;
            z-index: 99999;
            width: 100%;
        }

        .container {
            display: flex;
            justify-content: center;
            overflow: hidden;
        }

        .register {
            width: 50%;
            margin-top: 80px;
            border: 1px solid #dedede !important;
            border-radius: 8px;
            padding: 50px;
        }

        .register-header {
            margin-bottom: 20px;
            text-align: center;
        }

        .register-header h1 {
            font-size: 40px;
            margin-bottom: 10px;
        }

        .register-header p {
            opacity: .7;
        }

        .register-form-content {
            display: flex;
            flex-direction: column;
        }

        .register-form-footer {
            display: flex;
            gap: 30px;
            margin-top: 30px;
        }

        .register-form-footer a {
            color: #fe6d43;
        }

        .register-form-footer a:hover {
            text-decoration: underline;
        }

        input[type='text'],
        input[type='password'] {
            border: 1px solid #dedede;
            height: 45px;
            padding: 0 1rem;
            width: 100%;
            outline: none;
            font-size: 14px;
            border-radius: 10px;
        }

        input:hover {
            border: 1px solid #fe6d43;
            box-shadow: 0 0 5px #fe6d43;
        }

        button {
            border: none;
            background-color: #fe6d43;
            color: white;
            border-radius: 10px;
            text-align: center;
            font-size: 18px;
            height: 45px;
            margin-top: 35px;
        }

        button:hover {
            background-color: #ff8360;
        }
    </style>

</head>

<body>
    <header class="background">
        <div class="wrapper">
            <div class="row-flex row-flex-center">
                <div class="set-row">
                    <div class="logo"><a href="index.php"><img src="Image/logo.png" alt="logo"></a></div>
                </div>
            </div>
    </header>

    <section>
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="Image/4804665.png" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">
                                    <?php if (isset($_SESSION['error'])) { ?>
                                        <div class="alert alert-danger" role="alert">
                                            <?php
                                            echo $_SESSION['error'];
                                            unset($_SESSION['error']);
                                            ?>
                                        </div>
                                    <?php } ?>
                                    <?php if (isset($_SESSION['success'])) { ?>
                                        <div class="alert alert-success" role="alert">
                                            <?php
                                            echo $_SESSION['success'];
                                            unset($_SESSION['success']);
                                            ?>
                                        </div>
                                    <?php } ?>
                                    <?php if (isset($_SESSION['warning'])) { ?>
                                        <div class="alert alert-warning" role="alert">
                                            <?php
                                            echo $_SESSION['warning'];
                                            unset($_SESSION['warning']);
                                            ?>
                                        </div>
                                    <?php } ?>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-person-fill-add" style="font-size: 2rem"></i>
                                        <span class="h3 mb-0">สมัครสมาชิก</span>
                                    </div>
                                    <form action="register.php" method="post">
                                        <div class="register-form-content">
                                            <div class="form-item">
                                                <label for="username"></label>
                                                <input type="text" id="username" name="username" placeholder="ชื่อผู้ใช้">
                                            </div>
                                            <div class="form-item">
                                                <label for="password"></label>
                                                <input type="password" id="password" name="password" placeholder="รหัสผ่าน">
                                            </div>
                                            <div class="form-item">
                                                <label for="m_cpass"></label>
                                                <input type="password" id="m_cpass" name="m_cpass" placeholder="ยืนยันรหัสผ่าน">
                                            </div>
                                            <div class="form-item">
                                                <label for="m_name"></label>
                                                <input type="text" id="m_name" name="m_name" placeholder="ชื่อ-สกุล">
                                            </div>
                                            <div class="form-item">
                                                <label for="m_tel"></label>
                                                <input type="text" id="m_tel" name="m_tel" placeholder="เบอร์โทรศัพท์">
                                            </div>
                                            <div class="form-item">
                                                <label for="email"></label>
                                                <input class="form-control" type="email" id="email" name="email" placeholder="อีเมล์">
                                            </div>
                                            <div class="form-item">
                                                <label for="m_address"></label>
                                                <font color="red">** หมายเหตุ: กรุณากรอกที่อยู่จริง ** </font>
                                                <textarea name="m_address" class="form-control" id="m_address" placeholder="ที่อยู่"></textarea>
                                            </div>
                                            <div class="form-item">
                                                <label for="m_img">รูปภาพ :</label>
                                                <input type="file" name="m_img" id="card_img" class="form-control" />
                                            </div>
                                            <div class="form-item">
                                                <label for="role"></label>
                                                <select class="form-select" id="role" name="role">
                                                    <option value="member">สมาชิก</option>
                                                    <option value="store_owner">ผู้ประกอบการ</option>
                                                    <!-- <option value="admin">admin</option> -->
                                                </select>
                                            </div>
                                            <button type="submit" name="register">สมัครสมาชิก</button>
                                        </div>
                                        <div class="register-form-footer">
                                            <div>เป็นสมาชิกอยู่แล้ว ?
                                                <a href="login.php">เข้าสู่ระบบ</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>