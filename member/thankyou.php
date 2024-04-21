<?php
session_start();
require_once('config/db.php');
?>

<head>
    <?php include('header.php'); ?>
</head>

<body>
    <?php include('menutop.php'); ?>

    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <span class="icon-check_circle display-3 text-success"></span>
                    <h2 class="display-3 text-black">ขอบคุณ!</h2>
                    <p class="lead mb-5">คำสั่งซื้อของคุณเสร็จสมบูรณ์แล้ว</p>
                    <p><a href="../member/index.php" class="btn btn-sm btn-primary">เลือกสินค้าต่อ</a></p>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>
    </div>


</body>

</html>