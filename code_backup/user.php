<?php

session_start();
require_once 'config/db.php';
if (!isset($_SESSION['user_login'])) {
    header("location: login.php");
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>

    <!--bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

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
                    padding-top: 15px;
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
    <div class="container">
        <?php

        if (isset($_SESSION['user_login'])) {
            $user_id = $_SESSION['user_login'];
            $stmt = $conn->query("SELECT * FROM users WHERE id = $user_id");
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        ?>

        <h3 class="mt-4">Welcome, <?php echo $row['firstname'] . ' ' . $row['lastname'] ?> </h3>

        <a href="logout.php" class="btn btn-danger">ออกจากระบบ</a>
        
        <div>
            <div class="topbar-wrapper disable-xs">
                <div class="container">
                    <div class="d-flex bd-highlight">
                        <div class="p-2 bd-highlight nav-user-support">
                            <ul class="d-flex bd-highlight" style="list-style: none;">
                                <li class="px-2"><a href="#">ศูนย์บริการลูกค้า</a></li>
                                <li class="px-2"><a href="signup.php">สมัครสมาชิก</a></li>
                                <li class="px-2"><a href="login.php">เข้าสู่ระบบ</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="nav-wrapper">
                <div class="container">
                    <div class="d-flex bd-highlight">
                        <div class="logo p-2 bd-highlight"><a href="#"><img src="Image/logo-2.png"></a></div>
                        <div class="mx-auto"></div>
                        <div class="main-nav bd-highlight navbar-expand-lg">
                            <div class="navbar-collapse collapse">
                                <ul class="navbar-nav">
                                    <li class="nav-item active"><a class="nav-link" href="index.php">หน้าแรก</a></li>
                                    <li class="nav-item"><a class="nav-link" href="index.html">เปิดร้านค้า</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">เกี่ยวกับเรา</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">ติดต่อเรา</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators"><button type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button><button
                        type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                        aria-label="Slide 2"></button><button type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide-to="2" aria-label="Slide 3"></button></div>
                <div class="carousel-inner">
                    <div class="carousel-item active"><img src="image/ปก.jpg" class="d-block w-60" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>กลุ่มวิสาหกิจชุมชนอำเภอหนองวัวซอ </h5>
                            <p>ข้อมูลมะม่วงอำเภอหนองวัวซอ พื้นที่ปลูกมะม่วงทั้งหมดในอำเภอหนองวัวซอ 2 ตำบล ตำบลอูบมุงประมาณ 2,207 ไร่ และตำบลกุดหมากไฟ 3,686 ไร่ รวมพื้นที่ปลูก จำนวน 5,893 ไร่ เกษตรกร 455 ครัวเรือน ผลผลิตรวม 6,297 ตัน/ปี เฉลี่ย 1,250 กก./ไร่
                                1)	กลุ่มวิสาหกิจชุมชนผู้ปลูกมะม่วงบ้านห้วยไร่บูรพา หมู่ที่ 10 สมาชิกทั้งหมด 91 ราย นายไพรสูน คำยอง ประธานกลุ่มฯ ที่ทำการกลุ่ม 24 ม.10 บ้านห้วยไร่บูรพา ตำบลอูบมุง  อำเภอหนองวัวซอ จังหวัดอุดรธานี โทร. 090-0283920 พื้นที่ปลูกมะม่วงของกลุ่มที 1,600 ไร่ ปริมาณผลผลิตส่งออกประมาณ 250 ตันต่อปี
                                2)	กลุ่มวิสาหกิจชุมชนผู้ปลูกมะม่วงบ้านห้วยไร่ หมู่ที่ 4 ตำบลอูบมุง สมาชิกทั้งหมด 50 ราย นายสมเกียรติ์ ดอนพล ประธานกลุ่มฯ ที่ทำการกลุ่ม ม.4 บ้านห้วยไร่ ตำบลอูบมุง  อำเภอหนองวัวซอ จังหวัดอุดรธานี 090-5877995 พื้นที่ปลูกมะม่วงของกลุ่ม 607 ไร่ ปริมาณผลผลิตส่งออกประมาณ 150 ตันต่อปี
                                3)	วิสาหกิจชุมชนผู้ปลูกมะม่วงตำบลกุดหมากไฟ  สมาชิกทั้งหมด 170 คน นายบุญช่วย พัฒนชัย ประธานกลุ่มฯ 39 ม.1 ตำบลกุดหมากไฟ อำเภอหนองวัวซอ จังหวัดอุดรธานี โทร. 087-9496454 พื้นที่ปลูกมะม่วง 986 ไร่ ปริมาณผลผลิตส่งออกประมาณ 788 ตัน/ปี
                                4)	วิสาหกิจชุมชนคนรักมะม่วงจังหวัดอุดรธานี สมาชิก 132 ราย นายภูชิต อุ่นเที่ยว ประธานกลุ่ม โทร.088-3089366 ที่ทำการกลุ่ม 44 ม.2 ตำบลกุดหมากไฟ อำเภอหนองวัวซอ จังหวัดอุดรธานีพื้นที่ปลูกมะม่วง 2,100 ไร่ ปริมาณผลผลิตส่งออกประมาณ 2,200 ตัน/ปี
                                </p>
                        </div>
                    </div>
                    <div class="carousel-item"><img src="image/มะม่วง-ฟ้าลั่น.jpg" class="d-block w-60" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>มะม่วงฟ้าลั่น</h5>
                            <p>เป็นทรงพุ่มค่อนข้างทึบ ใบยาวคล้ายใบมะม่วงพันธ์สายฝน ออกผลค่อนข้างดกลักษณะผลจะกลมมากกว่ามะม่วงพันธ์สายฝน แต่มีความยาวพอ ๆ กัน ปลายผลกลมมนเมื่อผลแก่จัดเนื้อจะเปาะบางมากและอาจจะแตกทันทีเมื่อถูกคมมีดซึ่งเป็นลักษณะประจำพันธ์เห็นได้ชัด ลักษณะ เปลือกจะหนา แต่ไม่เหนียว มีต่อมขนาดปลานกลางเห็นได้ชัด และกระจายอยู่ทั่วผล ผิวเปลือกเป็นสีเขียวเข้ม เนื้อขาวนวล ลักษณะผิวหยาบ กรอบ มีเสี้ยนค่อนข้างน้อย รสชาติมันตั้งแต่ผลเล็ก ๆเมื่อแก่จัดรสชาติจะหวานมัน ผลสุก ผิวเขียวปนเหลือง เนื้อเป็นสีเหลืองเนื้อค่อนข้างละเอียด มีเสี้ยนน้อยรสหวานไม่จัดนัก เมล็ด เมื่อเพาะจะมีต้นอ่อนขึ้นหลายต้นจากเมล็ดเดียว รูปร่างของเมล็ดยาว แบนมีเนื้อในเมล็ดไม่เต็ม</p>
                        </div>
                    </div>
                    <div class="carousel-item"><img src="image/มะม่วง-1.jpg" class="d-block w-60" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>มะม่วงน้ำดอกไม้เบอร์ 4</h5>
                            <p>เป็นไม้ยืนต้น สูง 10-15 เมตร แตกกิ่งก้านสาขาเยอะ ใบเป็นใบเดี่ยว ออกเวียนสลับถี่บริเวรดอก ออกเป็นช่อที่ปลายยอด แต่ ละช่อประกอบด้วยดอกย่อยขนาดเล็กสีนวลจำนวนมาก ดอกมีกลิ่นหอม”ผล” รูปกลมรี ยาว ปลายผลย้วยสวยงามมาก เวลาติดผลจะเป็นพวง 3-5 ผล ผลโตเต็มที่น้ำหนักเฉลี่ย 1 ผล ต่อ 1 กิโลกรัม หรืออาจหย่อนเล็กน้อย เมล็ดลีบ ให้เนื้อเยอะ ผลดิบเป็นสีเขียว มีนวล ณ ปลายกิ่ง รูปรีแกมรูปใบหอก ปลายแหลม โคนมน เนื้อใบค่อนข้างหนา สีเขียวเข้มเป็นมัน</p>
                        </div>
                    </div>
                </div><button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span
                        class="visually-hidden">Previous</span></button><button class="carousel-control-next"
                    type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next"><span
                        class="carousel-control-next-icon" aria-hidden="true"></span><span
                        class="visually-hidden">Next</span></button>
            </div>
            <div class="category-list" style="padding: 80px 0;">
                <div class="title-service" style="margin-bottom: 40px;">
                    <div class="container text-center">
                        <h2>หมวดหมู่สินค้า</h2>
                    </div>
                </div>
                <div class="cate-box">
                    <div class="container">
                        <ul class="row h-100" style="list-style: none;">
                            <li class="col-6 col-sm-6 col-md-4 col-lg-4"><a href="#">
                                    <div class="media"><img src="image/มะม่วงสุก.png">
                                        <div class="text-center">
                                            <h4>มะม่วงสุก</h4>
                                        </div>
                                    </div>
                                </a></li>
                            <li class="col-6 col-sm-6 col-md-4 col-lg-4"><a href="#">
                                    <div class="media"><img src="image/มะม่วงดิบ.png">
                                        <div class="text-center">
                                            <h4>มะม่วงดิบ</h4>
                                        </div>
                                    </div>
                                </a></li>
                            <li class="col-6 col-sm-6 col-md-4 col-lg-4"><a href="#">
                                    <div class="media"><img src="image/มะม่วงแปรรูป.png">
                                        <div class="text-center">
                                            <h4>มะม่วงแปรรูป</h4>
                                        </div>
                                    </div>
                                </a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="poppular-list">
                <div class="title-service" style="margin-bottom: 40px;">
                    <div class="container text-center">
                        <h2>สินค้ายอดนิยม</h2>
                    </div>
                </div>
                <div class="product-list">
                    <div class="container">
                        <ul class="row" style="list-style: none;">
                            <li class="col-6 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                                <div class="item-border">
                                    <div class="item-image"><a href="dt.html"><img src="image/logo.ico"></a></div> 
                                    <div class="item-details"><span class="product-name"><a href="dt.html">มะม่วง-1</a></span>
                                        <div class="item-prices">
                                            <div class="item-discount-group"><span class="price-normal"><strong
                                                        class="price-specials">ราคา: 40 บาท/กก.</strong></span></div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="col-6 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                                <div class="item-border">
                                    <div class="item-image"><a href="#"><img src="image/logo.ico"></a></div>
                                    <div class="item-details"><span class="product-name"><a href="#">มะม่วง-2</a></span>
                                        <div class="item-prices">
                                            <div class="item-discount-group"><span class="price-normal"><strong
                                                        class="price-specials">ราคา: 40 บาท/กก.</strong></span></div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="col-6 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                                <div class="item-border">
                                    <div class="item-image"><a href="#"><img src="image/logo.ico"></a></div>
                                    <div class="item-details"><span class="product-name"><a href="#">มะม่วง-3</a></span>
                                        <div class="item-prices">
                                            <div class="item-discount-group"><span class="price-normal"><strong
                                                        class="price-specials">ราคา: 40 บาท/กก.</strong></span></div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="col-6 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                                <div class="item-border">
                                    <div class="item-image"><a href="#"><img src="image/logo.ico"></a></div>
                                    <div class="item-details"><span class="product-name"><a href="#">มะม่วง-4</a></span>
                                        <div class="item-prices">
                                            <div class="item-discount-group"><span class="price-normal"><strong
                                                        class="price-specials">ราคา: 40 บาท/กก.</strong></span></div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="more-products text-center" style="display:block; padding:50px 0;">
                <div class="container">
                    <div class="row">
                        <div class="btn btn-orange"><a href="#">ดูทั้งหมด</a></div>
                    </div>
                </div>
            </div>
            <section>
                <div class="seller-buyer">
                    <h4 class="text-center" style="padding-top: 40px;">ตอบโจทย์ทุกการซื้อ - ขาย</h4>
                    <div class="d-flex justify-content-center" style="padding: 40px;">
                        <div style="background: white; padding: 32px 50px 24px; margin-right: 50px; width: 25%;">
                            <div>
                                <h5 class="text-center">ผู้ประกอบการ</h5>
                                <ul>
                                    <li>
                                        <div><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                                                < !-- ! Font Awesome Free 6.4.2 by @fontawesome -
                                                    https: //fontawesome.com License - https://fontawesome.com/license
                                                    (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                    <path
                                                        d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zM337 209L209 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L303 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z" />
                                            </svg></div><span>ไม่มีขั้นตอนยุ่งยากในการลงขาย</span>
                                    </li>
                                    <li>
                                        <div><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                                                < !-- ! Font Awesome Free 6.4.2 by @fontawesome -
                                                    https: //fontawesome.com License - https://fontawesome.com/license
                                                    (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                    <path
                                                        d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zM337 209L209 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L303 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z" />
                                            </svg></div><span>มีระบบหลังบ้าน
                                            ที่ทำให้คุณจัดการรายการประกาศได้สะดวก</span>
                                    </li>
                                </ul>
                                <div style="text-align: center; margin-top: 30px"><a href="#"
                                        style="padding: 10px 48px; border-radius: 3px; background-color: rgb(13, 28, 99); color: rgb(255, 255, 255); cursor: pointer;">ลงขาย</a>
                                </div>
                            </div>
                        </div>
                        <div style="background: white; padding: 32px 50px 24px; width: 25%;">
                            <div>
                                <h5 class="text-center">ผู้ซื้อ</h5>
                                <ul>
                                    <li>
                                        <div><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                                                < !-- ! Font Awesome Free 6.4.2 by @fontawesome -
                                                    https: //fontawesome.com License - https://fontawesome.com/license
                                                    (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                    <path
                                                        d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zM337 209L209 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L303 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z" />
                                            </svg></div><span>สะดวก มั่นใจในการเลือกซื้อสินค้าที่หลากหลาย</span>
                                    </li>
                                    <li>
                                        <div><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                                                < !-- ! Font Awesome Free 6.4.2 by @fontawesome -
                                                    https: //fontawesome.com License - https://fontawesome.com/license
                                                    (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                    <path
                                                        d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zM337 209L209 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L303 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z" />
                                            </svg></div><span>เรามีสินค้าที่หลากหลายครอบคลุมทุกหมวดหมู่</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
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
                                    <li><a href="#">สมัครสมาชิก</a></li>
                                    <li><a href="#">เช็คสถานะการสั่งซื้อ</a></li>
                                    <li><a href="#">ซื้อสินค้าบนเว็บไซต์</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-4 col-md-4 item">
                                <h3>ขาย (Sell)</h3>
                                <ul>
                                    <li><a href="#">สมัครเป็นผู้ประกอบการ</a></li>
                                    <li><a href="#">เปิดร้านค้าออนไลน์</a></li>
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

        
    </div>
</body>

</html>