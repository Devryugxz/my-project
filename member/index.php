<?php
session_start();

require_once('config/db.php');

if (!isset($_SESSION['member'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ';
    header("location: login.php");
}

//สร้างเงื่อนไขตรวจสอบถ้ามีการค้นหาให้แสดงเฉพาะรายการค้นหา
if (isset($_GET['search']) && $_GET['search'] != '') {

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

<head>
    <?php include('header.php'); ?>
</head>

<body>
    <?php include('menutop.php'); ?>
    <?php include('banner.php'); ?>
    <?php include('show_product.php'); ?>


    <section>
        <div class="seller-buyer">
            <h4 class="text-center" style="padding-top: 40px;">ตอบโจทย์ทุกการซื้อ - ขาย</h4>
            <div class="d-flex justify-content-center" style="padding: 40px;">
                <div style="background: white; padding: 32px 50px 24px; margin-right: 50px; width: 25%;">
                    <div>
                        <h5 class="text-center">ผู้ประกอบการ</h5>
                        <ul>
                            <li>
                                <div></div><span>ไม่มีขั้นตอนยุ่งยากในการลงขาย</span>
                            </li>
                            <li>
                                <div></div><span>มีระบบหลังบ้าน
                                    ที่ทำให้คุณจัดการรายการประกาศได้สะดวก</span>
                            </li>
                        </ul>
                        <div style="text-align: center; margin-top: 30px"><a href="../register.php" style="padding: 10px 48px; border-radius: 3px; background-color: rgb(13, 28, 99); color: rgb(255, 255, 255); cursor: pointer;">เปิดร้าน</a>
                        </div>
                    </div>
                </div>
                <div style="background: white; padding: 32px 50px 24px; width: 25%;">
                    <div>
                        <h5 class="text-center">ผู้ซื้อ</h5>
                        <ul>
                            <li>
                                <div></div><span>สะดวก มั่นใจในการเลือกซื้อสินค้าที่หลากหลาย</span>
                            </li>
                            <li>
                                <div></div><span>เรามีสินค้าที่หลากหลายครอบคลุมทุกหมวดหมู่</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include('footer.php'); ?>
    </div>
</body>

</html>