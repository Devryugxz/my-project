<?php
session_start();

require_once('config/db.php'); // เชื่อมต่อฐานข้อมูล

if (isset($_POST['login'])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (empty($username)) {
        $_SESSION['error'] = 'กรุณากรอกชื่อบัญชีผู้ใช้';
        header("location: login.php");
    } else if (empty($password)) {
        $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
        header("location: login.php");
    } else if (strlen($_POST['password']) < 5) {
        $_SESSION['error'] = 'รหัสผ่านต้องมีความยาวอย่างน้อย 5 ตัวอักษร';
        header("location: login.php");
    } else {
        try {

            $check_data = $conn->prepare("SELECT * FROM tb_users WHERE username = :username");
            $check_data->bindParam(':username', $username);
            $check_data->execute();
            $row = $check_data->fetch(PDO::FETCH_ASSOC);

            if ($check_data->rowCount() > 0) {
                if ($username == $row['username'] && password_verify($password, $row['password'])) {
                    // ตรวจสอบระดับของผู้ใช้และเปลี่ยนเส้นทางไปยังหน้าที่เหมาะสม
                    if ($row['role'] == 'admin') {
                        $_SESSION['admin'] = $row['id'];
                        header("location: admin/index.php");
                    } else if ($row['role'] == 'store_owner') {
                        $_SESSION['store_owner'] = $row['id'];
                        header("location: admin-dashboard/index.php");
                    } else {
                        $_SESSION['member'] = $row['id'];
                        header("location: member/index.php");
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


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

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

        .login {
            width: 50%;
            margin-top: 80px;
            border: 1px solid #dedede !important;
            border-radius: 8px;
            padding: 50px;
        }

        .login-header {
            margin-bottom: 20px;
            text-align: center;
        }

        .login-header h1 {
            font-size: 40px;
            margin-bottom: 10px;
        }

        .login-header p {
            opacity: .7;
        }

        .login-form-content {
            display: flex;
            flex-direction: column;
        }

        .login-form-footer {
            display: flex;
            gap: 30px;
            margin-top: 30px;
        }

        .login-form-footer a {
            color: #fe6d43;
        }

        .login-form-footer a:hover {
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
                                    <div class="d-flex align-items-center">
                                        <span class="h3 mb-0">เข้าสู่ระบบ</span>
                                    </div>
                                    <form action="login.php" method="post">
                                        <div class="login-form-content">
                                            <div class="form-item">
                                                <label for="username"></label>
                                                <input type="text" id="username" name="username" placeholder="ชื่อผู้ใช้">
                                            </div>
                                            <div class="form-item">
                                                <label for="password"></label>
                                                <input type="password" id="password" name="password" placeholder="รหัสผ่าน">
                                            </div>
                                            <button type="submit" name="login">เข้าสู่ระบบ</button>
                                        </div>
                                    </form>
                                    <div class="login-form-footer">
                                        <div>ยังไม่ได้เป็นสมาชิก?
                                            <a href="register.php">สมัครสมาชิก</a>
                                        </div>
                                    </div>
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