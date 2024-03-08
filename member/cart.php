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

      <div class="row mb-5">
        <form class="col-md-12" method="post">
          <div class="site-blocks-table">

            <?php

            $total_quantity = 0;
            $total_price = 0;

            if (isset($_SESSION["cart_item"])) {

            ?>

              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="product-thumbnail">รูปภาพ</th>
                    <th class="product-name">สินค้า</th>
                    <th class="product-price">ราคาต่อหน่วย</th>
                    <th class="product-quantity">จำนวน</th>
                    <th class="product-total">ราคารวม</th>
                    <th class="product-remove">ลบ</th>
                  </tr>

                  <?php

                  foreach ($_SESSION["cart_item"] as $item) {
                    $item_price = $item["quantity"] * $item["Product_Price"];

                  ?>

                </thead>
                <tbody>
                  <tr>
                    <td class="product-thumbnail">
                      <img src="<?php echo $item["Product_img"]; ?>" alt="" class="img-fluid">
                    </td>
                    <td class="product-name">
                      <h2 class="h5 text-black"><?php echo $item["Product_Name"]; ?></h2>
                    </td>
                    <td><?php echo "฿ " . $item["Product_Price"]; ?></td>
                    <td>
                      <div class="input-group mb-3" style="max-width: 120px;">
                        <?php echo $item["quantity"]; ?>
                      </div>
                    </td>
                    <td><?php echo "฿ " . number_format($item["Product_Price"], 2); ?></td>
                    <td><a href="cart.php?action=remove&code=<?php echo $item["Product_ID"]; ?>" class="btn btn-primary btn-sm">X</a></td>
                  </tr>

                <?php

                    $total_quantity += $item["quantity"];
                    $total_price += ($item["Product_Price"] * $item["quantity"]);
                  }

                ?>
                </tbody>
              </table>

            <?php
            } else {
            ?>

              <div class="no-records text-center h3">ไม่พบสินค้า</div>

            <?php

            }

            ?>

          </div>
        </form>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="row mb-5">
            <div class="col-md-6 mb-3 mb-md-0">
              <button class="btn btn-primary btn-sm btn-block">อัพเดทตะกร้า</button>
            </div>
            <div class="col-md-6">
              <button class="btn btn-outline-primary btn-sm btn-block">เลือกสินค้าต่อ</button>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <label class="text-black h4" for="coupon">โค้ดส่วนลด</label>
              <p>ป้อนรหัสคูปองของคุณหากคุณมี</p>
            </div>
            <div class="col-md-8 mb-3 mb-md-0">
              <input type="text" class="form-control py-3" id="coupon" placeholder="รหัสคูปอง">
            </div>
            <div class="col-md-4">
              <button class="btn btn-primary btn-sm">ใช้คูปอง</button>
            </div>
          </div>
        </div>
        <div class="col-md-6 pl-5">
          <div class="row justify-content-end">
            <div class="col-md-7">
              <div class="row">
                <div class="col-md-12 text-right border-bottom mb-5">
                  <h3 class="text-black h4 text-uppercase">รวมการสั่งซื้อ</h3>
                </div>
              </div>
              <div class="row mb-5">
                <div class="col-md-6">
                  <span class="text-black">จำนวน</span>
                </div>
                <div class="col-md-6 text-right">
                  <strong class="text-black"><?php echo $total_quantity; ?></strong>
                </div>
              </div>
              <div class="row mb-5">
                <div class="col-md-6">
                  <span class="text-black">ยอดชำระเงินทั้งหมด</span>
                </div>
                <div class="col-md-6 text-right">
                  <strong class="text-black"><?php echo "฿ " . number_format($total_price, 2); ?></strong>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <button class="btn btn-primary btn-lg py-3 btn-block" onclick="window.location='checkout.php'">ดำเนินการชำระเงิน</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <?php include('footer.php'); ?>
  </div>


</body>

</html>