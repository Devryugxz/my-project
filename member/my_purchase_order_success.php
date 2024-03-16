<?php
session_start();
require_once('config/db.php');

// ดึงข้อมูลผู้ใช้จากฐานข้อมูล
if (isset($_SESSION['customer'])) {
    $c_id = $_SESSION['customer'];
    $stmt = $conn->query("SELECT * FROM tb_customer WHERE c_id = $c_id");
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>

<head>
    <?php include('header.php'); ?>
</head>

<body>
    <?php include('menutop.php'); ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
        <style>
            ion-icon {
                color: red;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="mb-3 text-black">
                        <h2 class="mb-3 text-black">ได้รับสินค้าแล้ว</h2>
                    </div>
                </div>
                <div class="col">
                    <a href="my_purchase_waitpayment.php" class="btn btn-primary" style="width: 100%;"> รอชำระเงิน </a>
                </div>
                <div class="col">
                    <a href="my_purchase_waitcomfirm_payment.php" class="btn btn-dark" style="width: 100%;"> รอการตรวจสอบการเงินแล้ว </a>
                </div>
                <div class="col">
                    <a href="my_purchase_delivery.php" class="btn btn-warning" style="width: 100%;"> กำลังจัดส่ง </a>
                </div>
                <div class="col">
                    <a href="my_purchase_order_success.php" class="btn btn-success" style="width: 100%;"> ได้รับสินค้าแล้ว </a>
                </div>
                <div class="col">
                    <a href="my_purchase_order_cancel.php" class="btn btn-danger" style="width: 100%;"> ยกเลิกคำสั่งซื้อ </a>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="container my-5">
                        <form action="" method="post">
                            <div class="row gx-4 gx-lg-5 align-items-center">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                            <th scope="col" class="text-center">ราคา</th>
                                            <th scope="col" class="text-center">จำนวน</th>
                                            <th scope="col" class="text-center">รวม(บาท)</th>
                                            <th scope="col" class="text-center">สถานะ</th>
                                            <th scope="col" class="text-center"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="text-align-last: center;"><img src="../Image/no-photo-available.png" width="150px" height="auto"></td>
                                            <td><span class="text-black">หมายเลขคำสั่งซื้อ: </span><br>
                                                <span class="text-black">ชื่อสินค้า: </span>
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td style="text-align-last: center;"><a href="#" class="btn btn-success btn-sm">รายละเอียดสินค้า</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>