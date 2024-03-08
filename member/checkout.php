<?php
session_start();
require_once('config/db.php');
?>

<!DOCTYPE html>

<head>
    <?php include('header.php'); ?>
</head>

<body>
    <?php include('menutop.php'); ?>

    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-5 mb-md-0">
                    <h2 class="h3 mb-3 text-black">ที่อยู่ในการจัดส่ง</h2>
                    <div class="p-3 p-lg-5 border">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="c_fname" class="text-black">ชื่อ<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="c_fname" name="c_fname">
                            </div>
                            <div class="col-md-6">
                                <label for="c_lname" class="text-black">นามสกุล<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="c_lname" name="c_lname">
                            </div>
                        </div>
                        <div class="form-group row">

                            <div class="col-md-6">
                                <label for="c_phone" class="text-black">เบอร์โทรศัพท์<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="c_phone" name="c_phone" placeholder="เบอร์โทรศัพท์">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="c_address" class="text-black">ที่อยู่<span class="text-danger">*</span></label>
                                <textarea name="c_order_notes" id="c_order_notes" cols="30" rows="5" class="form-control" placeholder="กรุณากรอกที่อยู่ของคุณ"></textarea>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-4 mb-5 mb-md-0">
                    <h2 class="h3 mb-3 text-black">ข้อมูลการชำระเงิน</h2>
                    <div class="p-3 p-lg-5 border">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="c_fname" class="text-black">ชื่อ<span class="text-danger">*</span></label>
                                <input class="form-control" id="" type="text" placeholder="ชื่อนามสกุลตามที่ปรากฎในบัญชีธนาคาร" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="c_fname" class="text-black">ชื่อธนาคาร<span class="text-danger">*</span></label>
                                <input class="form-control" id="" type="text" placeholder="ชื่อธนาคาร" value="">
                            </div>
                            <div class="col-md-6">
                                <label for="c_lname" class="text-black">เลขที่บัญชี<span class="text-danger">*</span></label>
                                <input class="form-control" id="" type="text" placeholder="เลขที่บัญชี" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="c_phone" class="text-black">QR Code<span class="text-danger">*</span></label>
                                <div class="card-body text-center">
                                    <!-- Profile picture image-->
                                    <img src="img\logo.png" class="rounded-circle img-fluid" style="width: 150px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row mb-5">
                        <div class="col-md-12">
                            <h2 class="h3 mb-3 text-black">คำสั่งซื้อของคุณ</h2>
                            <div class="p-3 p-lg-5 border">
                                <div class="form-group">
                                    <label for="exampleFormControlFile1">หลักฐานการชำระเงิน</label>
                                    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="Product_img" accept="image/png, image/jpg">
                                </div>
                                <table class="table site-block-order-table mb-5">
                                    <thead>
                                        <tr>
                                            <th>สินค้า</th>
                                            <th>ยอดชำระเงินทั้งหมด</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>ชื่อสินค้า<strong class="mx-2">x</strong> 1</td>
                                            <td>฿250.00</td>
                                        </tr>
                                        <tr>
                                            <td>ชื่อสินค้า<strong class="mx-2">x</strong> 1</td>
                                            <td>฿100.00</td>
                                        </tr>
                                        <tr>
                                            <td class="text-black font-weight-bold">
                                                <strong>ยอดชำระเงินทั้งหมด</strong>
                                            </td>
                                            <td class="text-black font-weight-bold"><strong>฿350.00</strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="form-group">
                                    <button class="btn btn-primary btn-lg py-3 btn-block" onclick="window.location='thankyou.php'">Place Order</button>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <!-- </form> -->
        </div>
    </div>
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


</body>

</html>