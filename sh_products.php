<?php 
    session_start();
    
    require_once('config/db.php');
    
    //สร้างเงื่อนไขตรวจสอบถ้ามีการค้นหาให้แสดงเฉพาะรายการค้นหา
    if (isset($_GET['search']) && $_GET['search']!='') {
 
        //ประกาศตัวแปรรับค่าจากฟอร์ม
        $search = "%{$_GET['search']}%";

        //คิวรี่ข้อมูลมาแสดงจากการค้นหา
        $stmt = $conn->prepare("SELECT* FROM tb_product WHERE p_name LIKE ?");
        $stmt->execute([$search]);
        $stmt->execute();
        $result = $stmt->fetchAll();
      } else {
         //คิวรี่ข้อมูลมาแสดงตามปกติ *แสดงทั้งหมด
        $stmt = $conn->prepare("SELECT* FROM tb_product");
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จำหน่ายมะม่วงออนไลน์</title>
    <!--bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
        integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous">
    </script>

    <link rel="icon" type="image/x-icon" href="Image/logo.ico">
    <link rel="stylesheet" href="main.css">


    <style>
        .topbar-wrapper {
            background: #eeeeee;
            width: auto;
            height: 40px
        }

        .topbar-wrapper .nav-user-support li a {
            font-size: 14px;
            font-weight: 400;
        }

        .logo img {
            width: 100%;
            max-width: 300px;
            display: block;
        }

        .nav-wrapper .main-nav {
            text-align: right;
            padding-top: 10px;
        }

        .nav-wrapper .main-nav .nav-item.active a {
            color: #0066b2;
        }

        .nav-wrapper .main-nav li a {
            font-weight: 400;
        }

        .nav-wrapper .main-nav li {
            padding: 5px 10px;
        }

        .carousel-inner .carousel-item img {
            width: 100%;
            height: 500px;
            object-fit: cover;
        }

        .cate-box img {
            width: 100%;
            height: 100px;
            object-fit: contain;
        }

        .product-list img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .item-border {
            border: solid 1px;
        }

        .item-details {
            padding: 10px;
        }

        .btn-orange a {
            padding: 10px 50px;
            background: #f24a0b;
            color: #ffffff;
            border-radius: 3px;
        }

        .seller-buyer {
            background: rgb(235, 239, 245);
            box-sizing: border-box;
        }

        .seller-buyer ul {
            list-style: none;
            padding: 0px;
        }

        .seller-buyer ul li {
            margin-bottom: 8px;
            display: grid;
            grid-template-columns: 2rem 1fr;
        }

        .footer-clean {
            padding: 50px 0;
            background-color: #fff;
            color: #4b4c4d;
        }

        .footer-clean h3 {
            margin-top: 0;
            margin-bottom: 12px;
            font-weight: bold;
            font-size: 16px;
        }

        .footer-clean ul {
            padding: 0;
            list-style: none;
            line-height: 1.6;
            font-size: 14px;
            margin-bottom: 0;
        }

        .footer-clean ul a {
            color: inherit;
            text-decoration: none;
            opacity: 0.8;
        }

        .footer-clean ul a:hover {
            opacity: 1;
        }

        .footer-clean .item.social {
            text-align: right;
        }

        @media (max-width:767px) {
            .footer-clean .item {
                text-align: center;
                padding-bottom: 20px;
            }
        }

        @media (max-width: 768px) {
            .footer-clean .item.social {
                text-align: center;
            }
        }

        .footer-clean .item.social>a {
            font-size: 24px;
            width: 40px;
            height: 40px;
            line-height: 40px;
            display: inline-block;
            text-align: center;
            border-radius: 50%;
            border: 1px solid #ccc;
            margin-left: 10px;
            margin-top: 22px;
            color: inherit;
            opacity: 0.75;
        }

        .footer-clean .item.social>a:hover {
            opacity: 0.9;
        }

        @media (max-width:991px) {
            .footer-clean .item.social>a {
                margin-top: 40px;
            }
        }

        @media (max-width:767px) {
            .footer-clean .item.social>a {
                margin-top: 10px;
            }
        }

        .footer-clean .copyright {
            margin-top: 14px;
            margin-bottom: 0;
            font-size: 13px;
            opacity: 0.6;
        }
    </style>

</head>

<body>
    <div>
        <div class="topbar-wrapper disable-xs">
            <div class="container">
                <div class="d-flex bd-highlight">
                    <div class="p-2 bd-highlight nav-user-support">
                        <ul class="d-flex bd-highlight" style="list-style: none;">
                            <li class="px-2"><a href="signup.php" target="_blank">สมัครสมาชิก</a></li>
                            <li class="px-2"><a href="login.php" target="_blank">เข้าสู่ระบบ</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="nav-wrapper">
            <div class="container">
                <div class="d-flex bd-highlight">
                    <div class="logo p-2 bd-highlight"><a href="index.php"><img src="Image/logo-2.png"></a></div>
                    <div class="mx-auto"></div>
                    <div class="main-nav bd-highlight navbar-expand-lg">
                        <div class="navbar-collapse collapse">
                            <ul class="navbar-nav">
                                <li class="nav-item active"><a class="nav-link" href="index.php">หน้าแรก</a></li>
                                <li class="nav-item"><a class="nav-link" href="register.php"
                                        target="_blank">เปิดร้านค้า</a></li>
                                <li class="nav-item"><button class="btn btn-outline-dark" type="submit">
                                        <form class="d-flex">
                                            <a class="nav-link" href="cart.php">
                                                <i class="bi-cart-fill me-1"></i>
                                                ตะกร้าสินค้า
                                                <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                                            </a>
                                        </form>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <?php

                    if (isset($_SESSION['member_login'])) {
                        $user_id = $_SESSION['member_login'];
                        $stmt = $conn->query("SELECT * FROM tb_users WHERE id = $user_id");
                        $stmt->execute();
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    }

                    ?>

                    <div class="d-flex bd-highlight mx-4" style="align-items: center;">
                        <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser2"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="" alt="" width="32" height="32" class="rounded-circle">
                            <?php echo $row['username']?>
                        </a>
                        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                            <li><a class="dropdown-item" href="#">โปรไฟล์</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a href="logout.php" class="dropdown-item">ออกจากระบบ</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>

        <section class="py-5 bg-light">
            <div class="container px-4 px-lg-5 mt-5">
                <h2 class="fw-bolder mb-4">สินค้าแนะนำ</h2>

                <form action="sh_products.php" method="get">
                    <div class="input-group mb-3">
                        <input required type="search" class="form-control rounded" placeholder="Search"
                            aria-label="Search" aria-describedby="search-addon" name="search"
                            value="<?php if (isset($_GET['search'])) { echo $_GET['search'];}?>" />
                        <button type="submit" class="btn btn-outline-primary" data-mdb-ripple-init>search</button>
                    </div>
                </form>

                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <?php 

                    foreach($result as $row) {

                    ?>
                    <div class="col mb-5">
                        <form action="cart.php?action=add&code=<?php echo $row["p_id"]; ?>"
                            method="post">
                            <div class="card h-100">
                                <!-- Product image-->
                                <img class="card-img-top">
                                <a href="" style="object-fit: cover;">
                        <?php echo "<img src='p_img/" . $row['p_img'] . "'width='100%' height='150px'>"; ?></a>
                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder"><?php echo $row["p_name"]; ?></h5>
                                        <!-- Product price-->
                                        <?php echo "฿ ". $row["p_price"]; ?>
                                    </div>
                                </div>
                                <!-- Product actions-->
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center">
                                        <input type="text" class="product_qty form-control text-center mb-3"
                                            name="quantity" value="1" size="2">
                                        <input type="submit" value="เพิ่มไปยังรถเข็น" class="btnAddAction">
                                    </div>
                                </div>
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto"
                                            href="productdetails.php">รายละเอียดสินค้า</a></div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <?php 
                            
                        }
                    ?>
                </div>
            </div>
        </section>

        <footer class="mainfooter" style="margin-top: 50px; border-top: solid 1px #e0e0e0;">
            <div class="container">
                <div class="footer-clean">
                    <div class="row justify-content-start" style="padding: 0 20px;">
                        <div class="col-sm-4 col-md-4 item">
                            <h3>เกี่ยวกับขายมะม่วงออนไลน์</h3>
                            <ul>
                                <li><a href="#">เกี่ยวกับเรา</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-4 col-md-4 item" style="margin-bottom: 20px;">
                            <h3>ซื้อ (Buy)</h3>
                            <ul>
                                <li><a href="signup.php">สมัครสมาชิก</a></li>
                                <li><a href="#">เช็คสถานะการสั่งซื้อ</a></li>
                                <li><a href="index.php">ซื้อสินค้าบนเว็บไซต์</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-4 col-md-4 item">
                            <h3>ขาย (Sell)</h3>
                            <ul>
                                <li><a href="register.php">สมัครเป็นผู้ประกอบการ</a></li>
                                <li><a href="register.php">เปิดร้านค้าออนไลน์</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-4 col-md-4 item">
                            <h3>ติดต่อเรา</h3>
                            <ul>
                                <p class="copyright">Website selling mangoes online © 2023</p>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>