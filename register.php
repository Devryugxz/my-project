<?php
session_start();
require_once('config/db.php'); // เชื่อมต่อฐานข้อมูล
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

    <!-- <section>
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
                                    xxx
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <header class="card-header">
                        <h4 class="card-title mt-2">สมัครสมาชิกลูกค้า</h4>
                    </header>
                    <div class="card-body">
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
                        <form action="register_db.php" method="post">
                            <div class="form-group row">
                                <div class="col">
                                    <label for="firstname"></label>
                                    <input class="form-control" type="text" id="firstname" name="firstname" placeholder="ชื่อ">
                                </div>
                                <div class="col">
                                    <label for="lastname"></label>
                                    <input class="form-control" type="text" id="lastname" name="lastname" placeholder="นามสกุล">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label for="phone"></label>
                                    <input class="form-control" type="text" id="phone" name="phone" placeholder="เบอร์โทรศัพท์">
                                </div>
                                <div class="col">
                                    <label for="email"></label>
                                    <input class="form-control" type="email" id="email" name="email" placeholder="อีเมล์">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="username"></label>
                                <input class="form-control" type="text" id="username" name="username" placeholder="ชื่อผู้ใช้">
                            </div>
                            <!-- <div class="form-group mb-2">
                                <label for="m_name"></label>
                                <input class="form-control" type="text" id="m_name" name="m_name" placeholder="ชื่อ-สกุล">
                            </div> -->
                            <div class="form-group">
                                <label for="password"></label>
                                <input class="form-control" type="password" id="password" name="password" placeholder="รหัสผ่าน">
                            </div>
                            <div class="form-group">
                                <label for="c_password"></label>
                                <input class="form-control" type="password" id="c_password" name="c_password" placeholder="ยืนยันรหัสผ่าน">
                            </div>
                            <!-- <div class="form-group mb-2">
                                <label for="m_address"></label>
                                <font color="red">** หมายเหตุ: กรุณากรอกที่อยู่จริง ** </font>
                                <textarea name="m_address" class="form-control" id="m_address" placeholder="ที่อยู่"></textarea>
                            </div> -->
                            <!-- <div class="form-group mb-2">
                                <label for="m_img">รูปภาพ :</label>
                                <input type="file" name="m_img" id="card_img" class="form-control" />
                            </div> -->
                            <!-- <div class="form-group">
                                <label for="role"></label>
                                <select class="form-select" id="role" name="role">
                                    <option value="customer">สมาชิก</option>
                                    <option value="seller">ผู้ประกอบการ</option>
                                    <option value="admin">admin</option>
                                </select>
                            </div> -->
                            <input type="hidden" name="role"  value="customer">
                            <button class="btn btn-primary btn-block mt-4" type="submit" name="register" style="width: 100%;">สมัครสมาชิก</button>

                        </form>
                    </div>
                    <div class="border-top card-body text-center">เป็นสมาชิกอยู่แล้ว ?
                        <a href="login.php">เข้าสู่ระบบ</a>
                    </div>
                </div>
            </div>

        </div>


    </div>
</body>

</html>