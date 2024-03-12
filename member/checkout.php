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

    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-5 mb-md-0">
                    <h2 class="h3 mb-3 text-black">ที่อยู่ในการจัดส่ง</h2>
                    <div class="p-3 p-lg-5 border">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="firstname" class="text-black">ชื่อ<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="firstname" name="firstname" value="<?= $user['firstname'] ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="lastname" class="text-black">นามสกุล<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="lastname" name="lastname" value="<?= $user['lastname'] ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="text-black">เบอร์โทรศัพท์<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="phone" name="phone" value="<?= $user['phone'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="c_address" class="text-black">ที่อยู่<span class="text-danger">*</span></label>
                                <!-- <textarea name="m_address" id="m_address" cols="30" rows="5" class="form-control" placeholder="กรุณากรอกที่อยู่ของคุณ"></textarea> -->
                                <input class="form-control" type="text" id="m_address" name="m_address" value="<?= $user['m_address'] ?>">
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
                                <?php
                                if (isset($_SESSION["cart_item"])) {
                                    $total_quantity = 0;
                                    $total_price = 0;
                                ?>
                                    <table class="table site-block-order-table mb-5">
                                        <thead>
                                            <tr>
                                                <th>สินค้า</th>
                                                <th>ยอดชำระเงินทั้งหมด</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($_SESSION["cart_item"] as $item) {
                                                $item_price = $item["p_qty"] * $item["p_price"];
                                            ?>
                                                <tr>

                                                    <td><?php echo $item["p_name"]; ?><strong class="mx-2">x</strong><?php echo $item["p_qty"]; ?></td>
                                                    <td><?php echo $item["p_qty"] * $item["p_price"]; ?></td>
                                                </tr>
                                            <?php
                                                $total_quantity += $item["p_qty"];
                                                $total_price += $item_price;
                                            }
                                            ?>
                                            <tr>
                                                <td class="text-black font-weight-bold">
                                                    <strong>ยอดชำระเงินทั้งหมด</strong>
                                                </td>
                                                <td class="text-black font-weight-bold"><strong><?php echo "฿ " . number_format($total_price, 2); ?></strong>
                                                </td>
                                            </tr>

                                        </tbody>

                                    </table>
                                <?php
                                } else {
                                ?>

                                    <div class="no-records text-center h3">ไม่พบสินค้า</div>

                                <?php

                                }

                                ?>

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