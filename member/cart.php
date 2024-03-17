<?php
session_start();
require_once('config/db.php');


if (!isset($_SESSION['cart_item'])) {
  $_SESSION['cart_item'] = array(); // หรือค่าเริ่มต้นที่คุณต้องการ
}

$p_id = isset($_GET['p_id']) ? $_GET['p_id'] : "";
$act = isset($_GET['act']) ? $_GET['act'] : "";

if ($act == 'add' && !empty($p_id)) {
  if (isset($_SESSION['cart_item'][$p_id])) {
    $_SESSION['cart_item'][$p_id]++;
  } else {
    $_SESSION['cart_item'][$p_id] = 1;
  }

  echo "<script type='text/javascript'>";
  echo "alert('เพิ่มสินค้าลงตะกร้าแล้ว');";
  echo "window.location = 'productdetails.php?id=$p_id'";
  echo "</script>";
}

if ($act == 'remove' && !empty($p_id)) {
  unset($_SESSION['cart_item'][$p_id]);
}


if ($act == 'update') {
  if (isset($_POST['amount'])) {
    $amount_array = $_POST['amount'];
    foreach ($amount_array as $p_id => $amount) {
      $_SESSION['cart_item'][$p_id] = $amount;
    }
  }
}

if ($act == 'emtpy') {
  unset($_SESSION['cart_item']);
}
?>
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
      margin: 1.5rem 0 0 1.5rem;
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
      /* margin-top: 15px; */
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
            <h2>ตะกร้าสินค้า</h2>
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
          <div class="col-md-12 col-lg-8" style="align-self: center;">
            <div class="items">
              <form id="frmcart" name="frmcart" method="post" action="?p_id=<?php echo $p_id; ?>&act=update">
                <div class="row">
                  <div class="col-3">
                    <div class="col-md-12 mt-4" style="text-align: center;">
                      <button class="btn btn-primary btn-sm btn-block" type="submit" name="update">อัพเดทตะกร้า</button>
                    </div>
                  </div>
                  <div class="col-9">
                    <div class="row">
                      <div class="col-md-5 mt-4" style="text-align: center;">
                        <!-- <button class="btn btn-primary btn-sm btn-block" type="submit" name="update">อัพเดทตะกร้า</button> -->
                      </div>
                      <div class="col-md-2 mt-4" style="text-align: center;">
                        <p>ราคา</p>
                      </div>
                      <div class="col-md-2 mt-4" style="text-align: center;">
                        <p>จำนวน</p>
                      </div>
                      <div class="col-md-2 mt-4" style="text-align: center;">
                        <p>ราคารวม</p>
                      </div>
                    </div>

                  </div>
                </div>

                <?php
                $total = 0;
                if (!empty($_SESSION["cart_item"])) {
                  foreach ($_SESSION['cart_item'] as $p_id => $p_qty) {
                    $sql = "SELECT * FROM tb_product WHERE p_id=:p_id";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':p_id', $p_id, PDO::PARAM_INT);
                    $stmt->execute();
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    $sum = $row['p_price'] * $p_qty;
                    $total += $sum;
                ?>
                    <div class="product">
                      <div class="row">
                        <div class="col-md-3" style="text-align-last: center;">
                          <img src="../p_img/<?php echo $row["p_img"]; ?>" width="150px" height="200px" class="img-fluid">
                        </div>
                        <div class="col-md-9">
                          <div class="info">
                            <div class="row">
                              <div class="col-md-5 product-name">
                                <div class="product-name">
                                  <h2 class="h5 text-black"><?php echo $row["p_name"]; ?></h2>
                                  <div class="product-info">
                                    <div>ประเภทสินค้า: <span class="value"><?php echo $row["type_name"]; ?></span></div>
                                    <div>รายละเอียดสินค้า: <span class="value"><?php echo $row["p_detail"]; ?></span></div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-2 price text-center">
                                <span><?php echo "฿ " . $row["p_price"]; ?></span>
                              </div>
                              <div class="col-md-2 quantity">
                                <!-- <label for="quantity">Quantity:</label> -->
                                <!-- <input id="quantity" type="number" value="1" class="form-control quantity-input"> -->
                                <?php
                                echo "<input type='text' name='amount[$p_id]' value='$p_qty' size='2'/>";
                                ?>
                              </div>
                              <div class="col-md-2 price text-center">
                                <span><?php echo "฿ " . $sum; ?></span>
                              </div>
                              <div class="col-md-1 price">
                                <span><a href="cart.php?act=remove&p_id=<?php echo $row["p_id"]; ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a></span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php
                  }
                } else {
                  ?>
                  <div class="no-records text-center h3">ไม่พบสินค้า</div>
                <?php
                }
                ?>
              </form>
            </div>
          </div>
          <div class="col-md-12 col-lg-4">
            <div class="summary">
              <h3>รวมการสั่งซื้อ</h3>
              <div class="summary-item"><span class="text">จำนวนสินค้าทั้งหมด</span><span class="price">
                  <?php
                  $total_quantity = 0;
                  foreach ($_SESSION['cart_item'] as $item) {
                    $total_quantity += $item;
                  }
                  echo $total_quantity;
                  ?></span></div>
              <!-- <div class="summary-item"><span class="text">Discount</span><span class="price">$0</span></div> -->
              <div class="summary-item mt-3"><span class="text">ยอดชำระเงินทั้งหมด</span><span class="price"><?php echo "฿ " . number_format($total, 2); ?></span></div>
              <button type="submit" class="btn btn-primary btn-lg btn-block w-100" onclick="window.location='confirm.php'">ดำเนินการชำระเงิน</button>
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