<?php
session_start();

require_once('config/db.php'); // เชื่อมต่อฐานข้อมูล

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

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6" style="width: 400px;">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center mt-2">สมัครสมาชิกลูกค้า</h4>
                    </div>
                    <div class="card-body">
                        <a href="register.php"><img src="image/shopping-cart-flatline.png" class="card-img-top"></a>
                        <!-- <p class="card-text"><a href="">สมัครสมาชิกลูกค้า</a></p> -->
                    </div>
                </div>
            </div>
            <div class="col-md-6" style="width: 400px;">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center mt-2">สมัครสมาชิกผู้ประกอบการ</h4>
                    </div>
                    <div class="card-body">
                        <a href="register_seller.php"><img src="image/online-store-flatline.png" class="card-img-top" style="width: 100%;"></a>
                        <!-- <p class="card-text"><a href="">สมัครสมาชิกลูกค้า</a></p> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>