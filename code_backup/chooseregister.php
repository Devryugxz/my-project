<?php

session_start();

?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ</title>

    <!--bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>

    <link rel="icon" type="image/x-icon" href="Image/logo.ico">

    <link rel="stylesheet" href="main.css">

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

        .login-right {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding-left: 100px;
            margin-top: 80px;
        }

        .login-left {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 80px;
        }

        .login-left img {
            width: 100%;
            height: 600px;
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

        .login-form {
            width: 400px;
            box-shadow: 1px 5px 15px 2px rgba(0, 0, 0, .2);
            border-radius: 10px;
            padding: 50px;
            background-color: antiquewhite;
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

        /* Responsive */
        @media (max-width:1350px) {
            .login-right {
                padding: 50px !important;
            }

            .login-form {
                width: 100%;
            }

            .login-form-footer {
                flex-direction: column;
                gap: 15px;
            }

        }

        @media (max-width:990px) {
            .login-form {
                width: 100%;
            }

            .login-left {
                display: none;
            }
        }

        @media (max-width:768px) {
            .container {
                grid-template-columns: auto;
            }

            .login-left {
                display: none;
            }
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
    <div class="line"></div>

    <section>
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="Image/4804665.png" alt="login form" class="img-fluid"
                                    style="border-radius: 1rem 0 0 1rem;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">
                                    <!-- Login 12 - Bootstrap Brain Component -->
                                    <section class="py-3 py-md-5 py-xl-8">
                                        <div class="container">
                                            <div class="row justify-content-center">
                                                <div class="col-12 col-lg-10 col-xl-8">
                                                    <div class="row gy-5 justify-content-center">
                                                        <div class="col-md-12">
                                                            <form action="#!">
                                                                <div class="row gy-3 overflow-hidden">
                                                                    <div class="col-12">
                                                                        <div class="d-grid">
                                                                        <button type="submit"><a href="signup.php" style="color: white;">สมัครสมาชิกลูกค้า</a></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="col-12 col-lg-2 d-flex align-items-center justify-content-center gap-3 flex-lg-column">
                                                            <div class="bg-dark h-100 d-none d-lg-block"
                                                                style="width: 1px; --bs-bg-opacity: .1;"></div>
                                                            <div class="bg-dark w-100 d-lg-none"
                                                                style="height: 1px; --bs-bg-opacity: .1;"></div>
                                                            <div>หรือ</div>
                                                            <div class="bg-dark h-100 d-none d-lg-block"
                                                                style="width: 1px; --bs-bg-opacity: .1;"></div>
                                                            <div class="bg-dark w-100 d-lg-none"
                                                                style="height: 1px; --bs-bg-opacity: .1;"></div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <form action="#!">
                                                                <div class="row gy-3 overflow-hidden">
                                                                    <div class="col-12">
                                                                        <div class="d-grid">
                                                                        <button type="submit"><a href="register.php" style="color: white;">สมัครสมาชิกผู้ประกอบการ</a></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <script src="login.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.19/dist/sweetalert2.all.min.js"></script>

</body>

</html>