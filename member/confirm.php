<?php
session_start();
include("config/db.php");

$c_id = $_SESSION['c_id'];

$select_stmt = "SELECT * FROM tb_address WHERE c_id = :c_id";

$query = $conn->prepare($select_stmt);
$query->bindParam(':c_id', $c_id, PDO::PARAM_INT);
$query->execute();
$result = $query->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['btn_update'])) {

    $recipient_name = $_POST['recipient_name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    $update_stmt = "UPDATE tb_address SET recipient_name = :recipient_name, address = :address, phone = :phone WHERE c_id = :c_id";

    $update_query = $conn->prepare($update_stmt);
    $update_query->bindParam(':recipient_name', $recipient_name);
    $update_query->bindParam(':address', $address);
    $update_query->bindParam(':phone', $phone);
    $update_query->bindParam(':c_id', $c_id);

    if ($update_query->execute()) {
        echo "<script type='text/javascript'>";
        echo "alert('บันทึกข้อมูลที่อยู่สำเร็จ..');";
        echo "window.location = 'confirm.php';";
        echo "</script>";
    } else {
        echo "<script type='text/javascript'>";
        echo "alert('error!');";
        echo "window.location = 'show_address.php'; ";
        echo "</script>";
    }
}
?>

<!DOCTYPE html>
<html>


<!DOCTYPE html>
<html>

<head>
    <style>
        .shopping-cart {
            padding-bottom: 50px;
        }

        .shopping-cart.dark {
            background-color: #f6f6f6;
        }

        .shopping-cart .content {
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.075);
            background-color: white;
        }

        .shopping-cart .block-heading {
            padding-top: 50px;
            margin-bottom: 40px;
            text-align: center;
        }

        .shopping-cart .block-heading p {
            text-align: center;
            max-width: 420px;
            margin: auto;
            opacity: 0.7;
        }

        .shopping-cart .dark .block-heading p {
            opacity: 0.8;
        }

        .shopping-cart .block-heading h1,
        .shopping-cart .block-heading h2,
        .shopping-cart .block-heading h3 {
            margin-bottom: 1.2rem;
            color: #3b99e0;
        }

        .shopping-cart .items {
            margin: 1.5rem 1.5rem 0 1.5rem;
        }

        .shopping-cart .items .product {
            margin-bottom: 20px;
            padding-top: 20px;
            padding-bottom: 20px;
        }

        .shopping-cart .items .product .info {
            padding-top: 0px;
            text-align: center;
        }

        .shopping-cart .items .product .info .product-name {
            font-weight: 600;
        }

        .shopping-cart .items .product .info .product-name .product-info {
            font-size: 14px;
            margin-top: 15px;
        }

        .shopping-cart .items .product .info .product-name .product-info .value {
            font-weight: 400;
        }

        .shopping-cart .items .product .info .quantity .quantity-input {
            margin: auto;
            width: 80px;
        }

        .shopping-cart .items .product .info .price {
            margin-top: 15px;
            font-weight: bold;
            font-size: 22px;
        }

        .shopping-cart .summary {
            border-top: 2px solid #5ea4f3;
            background-color: #f7fbff;
            height: 100%;
            padding: 30px;
        }

        .shopping-cart .summary h3 {
            text-align: center;
            font-size: 1.3em;
            font-weight: 600;
            padding-top: 20px;
            padding-bottom: 20px;
        }

        .shopping-cart .summary .summary-item:not(:last-of-type) {
            padding-bottom: 10px;
            padding-top: 10px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .shopping-cart .summary .text {
            font-size: 1em;
            font-weight: 600;
        }

        .shopping-cart .summary .price {
            font-size: 1em;
            float: right;
        }

        .shopping-cart .summary button {
            margin-top: 20px;
        }

        @media (min-width: 768px) {
            .shopping-cart .items .product .info {
                padding-top: 25px;
                text-align: left;
            }

            .shopping-cart .items .product .info .price {
                font-weight: bold;
                font-size: 22px;
                top: 17px;
            }

            .shopping-cart .items .product .info .quantity {
                text-align: center;
            }

            .shopping-cart .items .product .info .quantity .quantity-input {
                padding: 4px 10px;
                text-align: center;
            }
        }
    </style>

    <?php include('header.php'); ?>
</head>

<body>
    <?php include('menutop.php'); ?>

    <section class="shopping-cart dark">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="block-heading" style="text-align:left;">
                        <h2>ทำรายการสั่งซื้อ</h2>
                    </div>
                </div>
                <div class="col">
                    <div class="block-heading" style="text-align:right;">
                        <button class="btn btn-outline-primary btn-sm btn-block" onclick="window.location='../member/index.php'">เลือกสินค้าต่อ</button>
                    </div>
                </div>

            </div>

            <div class="content">
                <div class="row">
                    <div class="col-md-12 col-lg-8">
                        <div class="items">
                            <h4 class="mb-3">ที่อยู่</h4>
                            <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="recipient_name">ชื่อผู้รับ</label>
                                        <input type="text" class="form-control" id="recipient_name" name="recipient_name" placeholder="" value="" required="">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="phone">หมายเลขโทรศัพท์</label>
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="" value="" required="">
                                    </div>
                                </div>

                                <!-- <div class="mb-3">
                                    <label for="email">อีเมล์ <span class="text-muted"></span></label>
                                    <input type="email" class="form-control" id="email" placeholder="">
                                </div> -->

                                <div class="mb-3">
                                    <label for="address">Address</label>
                                    <textarea class="form-control" id="address" name="address" rows="3"></textarea>
                                </div>
                                <!-- <div class="row">
                                    <div class="col-md-5 mb-3">
                                        <label for="country">Country</label>
                                        <select class="form-control custom-select d-block w-100" id="country" required="">
                                            <option value="">Choose...</option>
                                            <option>United States</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="state">State</label>
                                        <select class="form-control custom-select d-block w-100" id="state" required="">
                                            <option value="">Choose...</option>
                                            <option>California</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="zip">Zip</label>
                                        <input type="text" class="form-control" id="zip" placeholder="" required="">
                                    </div>
                                </div> -->
                                <button class="btn btn-primary btn btn-block" name="btn_update" type="submit">บันทึกที่อยู่</button>
                            </form>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-4">
                        <div class="summary">
                            <h3>รวมการสั่งซื้อ</h3>
                            <form id="frmcart" name="frmcart" method="post" action="order_save.php">
                                <?php
                                $total = 0;
                                $total2 = 0;
                                $total3 = 0;
                                $seller = [];
                                $totalShipPrice = 0;
                                $cal_discount = 0;
                                $sum_promo = 0;
                                $promotion1 = 0;
                                $promotion2 = [];
                                $discount_price = 1;
                                $total_promo = 0;
                                $net_price = 0;
                                $sum_net_price = 0;
                                $sum_discount = 0;
                                try {
                                    $stmt = $conn->prepare("SELECT * FROM tb_seller as s
                                        INNER JOIN tb_shipping as sh
                                        on s.s_id = sh.s_id
                                        WHERE sh.s_id  ");
                                    $stmt->execute();
                                    $row4 = $stmt->fetch();
                                } catch (PDOException $e) {
                                    echo "Error: " . $e->getMessage();
                                }

                                foreach ($_SESSION['cart_item'] as $p_id => $p_qty) {
                                    try {
                                        $stmt = $conn->prepare("SELECT * FROM tb_product as p
                                         inner join tb_seller as s
                                         on p.s_id = s.s_id
                                         
                                         WHERE p.id=:p_id
                                         group by s.s_id ");
                                        $stmt->bindParam(':p_id', $p_id);
                                        $stmt->execute();
                                        $row = $stmt->fetch();
                                    } catch (PDOException $e) {
                                        echo "Error: " . $e->getMessage();
                                    }

                                    $s_id = $row['s_id'];

                                    try {
                                        $stmt = $conn->prepare("SELECT * FROM tb_shipping WHERE s_id=:s_id LIMIT 1");
                                        $stmt->bindParam(':s_id', $s_id);
                                        $stmt->execute();
                                        $ship_row = $stmt->fetch();
                                    } catch (PDOException $e) {
                                        echo "Error: " . $e->getMessage();
                                    }

                                    $dupSeller = array_search($s_id, $seller);
                                    if ($dupSeller !== false) {
                                        // echo 'ซ้ำนะไม่บวก';
                                    } else if ($row['ship_cost'] == "กล่อง, ชิ้น, อัน") {
                                        $totalShipPrice == 0;
                                    } else {
                                        // echo 'ไม่เจอบวกเลย';
                                        $totalShipPrice += $ship_row['ship_price'];
                                        array_push($seller, $s_id);
                                    }

                                    try {
                                        $stmt = $conn->prepare("SELECT * FROM tb_promotion as pro
                                                inner join tb_product as p
                                                on pro.pro_id = p.id 
                                                WHERE pro_id=:p_id ");
                                        $stmt->bindParam(':p_id', $p_id);
                                        $stmt->execute();
                                        $pro_row = $stmt->fetch();
                                    } catch (PDOException $e) {
                                        echo "Error: " . $e->getMessage();
                                    }


                                    $sum = $row['p_price'] * $p_qty;
                                    $total += $sum;


                                    if ($discount_price = isset($pro_row['pro_discount']) && $discount_price = $pro_row['pro_discount']) {
                                        $discount_price = $pro_row['pro_discount'];
                                    } else {
                                        $discount_price = 0;
                                    }

                                    $total_promo = (int)$sum * (int)$discount_price / 100; //ราคาต่อหน่วย*ส่วนลด/100 จะได้ส่วนลดเอาไว้ลบกับราคาเต็ม   
                                    $net_price = $sum - $total_promo; //ราคาต่อหน่วยลบส่วนลดที่คำนวณเปอร์เซ็นเเล้ว
                                    // echo $net_price;


                                    if ($discount_price2 = isset($pro_row['pro_discount']) && $discount_price2 = $pro_row['pro_discount']) {
                                        $sum_discount += $total_promo;
                                    } else {
                                        $discount_price2 = 0;
                                        $sum_discount += $discount_price;
                                    }

                                    try {
                                        $stmt = $conn->prepare("SELECT * FROM tb_product as p
                                    inner join tb_seller as s
                                    on p.s_id = s.s_id
                                    INNER JOIN tb_shipping as sh
                                    on s.s_id = sh.s_id
                                    WHERE p.id 
                                    GROUP BY sh.s_id  ");
                                        $stmt->execute();
                                        $row2 = $stmt->fetch();
                                    } catch (PDOException $e) {
                                        echo "Error: " . $e->getMessage();
                                    }

                                    $total3 = ($total + $totalShipPrice) - $sum_discount;


                                ?>
                                    <ul class="list-group mb-3">
                                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                                            <div>
                                                <h6 class="my-0"><?php echo $row["p_name"]; ?></h6>
                                                <small class="text-muted"><?php echo $row["type_name"]; ?></small>
                                            </div>
                                            <span class="text-muted"><?php echo "฿ " . $sum; ?></span>
                                        </li>
                                        <div class="no-records text-center h3">ไม่พบสินค้า</div>
                                    <?php
                                }

                                // echo $sum_discount; 

                                    ?>
                                    <li class="list-group-item d-flex justify-content-between bg-light">
                                        <div class="text-success">
                                            <h6 class="my-0">ส่วนลด</h6>
                                            <small><?php echo $discount_price; ?> %</small>
                                        </div>
                                        <span class="text-success"><?php echo number_format($net_price, 2); ?></span>
                                    </li>
                                    <!-- <li class="list-group-item d-flex justify-content-between">
                                        <span>จำนวนสินค้าทั้งหมด</span>
                                        <strong><?php
                                                $total_quantity = 0;
                                                foreach ($_SESSION['cart_item'] as $item) {
                                                    $total_quantity += $item;
                                                }
                                                echo $total_quantity;
                                                ?></strong>
                                    </li> -->
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>ยอดชำระเงินทั้งหมด</span>
                                        <strong><?php echo "฿ " . number_format($total, 2); ?></strong>
                                    </li>
                                    </ul>
                            </form>
                            <button type="submit" class="btn btn-primary btn-lg btn-block w-100" onclick="window.location='banking.php'">สั่งสินค้า</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include('footer.php'); ?>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>