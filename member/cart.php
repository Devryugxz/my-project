<?php
session_start();
require_once('config/db.php');

if (!empty($_GET['action'])) {
  switch ($_GET['action']) {
    case "add":
      if (!empty($_POST["p_qty"])) {
        $stmt = $conn->prepare("SELECT * FROM tb_product WHERE p_id = :p_id");
        $stmt->bindParam(':p_id', $_GET["p_id"]);
        $stmt->execute();
        $p_array = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($p_array)) {
          $itemArray = array($p_array[0]["p_id"] => array(
            'p_name' => $p_array[0]["p_name"],
            'p_qty' => $_POST["p_qty"],
            'p_price' => $p_array[0]["p_price"],
            'p_img' => $p_array[0]["p_img"]
          ));
        }
        if (!empty($_SESSION["cart_item"])) {
          if (array_key_exists($p_array[0]["p_id"], $_SESSION["cart_item"])) {
            $_SESSION["cart_item"][$p_array[0]["p_id"]]["p_qty"] += $_POST["p_qty"];
          } else {
            $_SESSION["cart_item"] += $itemArray;
          }
        } else {
          $_SESSION["cart_item"] = $itemArray;
        }
      }
      break;
    case "remove":
      if (!empty($_SESSION["cart_item"]) && !empty($_GET["p_id"])) {
        unset($_SESSION["cart_item"][$_GET["p_id"]]);
        if (empty($_SESSION["cart_item"])) {
          unset($_SESSION["cart_item"]);
        }
      }
      break;
      case "empty":
        unset($_SESSION["cart_item"]);
        break;
  }
}

if (isset($_POST['update_cart'])) {
  foreach ($_POST['quantity'] as $key => $value) {
    if (!empty($value) && is_numeric($value)) {
      $_SESSION["cart_item"][$key]["p_qty"] = $value;
    }
  }
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

      <div class="row mb-5">
        <form class="col-md-12" method="post">
          <div class="site-blocks-table">
            <?php
            if (isset($_SESSION["cart_item"])) {
              $total_quantity = 0;
              $total_price = 0;
            ?>
            <div style="text-align: end;">
              <a href=" cart.php?action=empty" id="btnEmpty">ลบทั้งหมด</a>
            </div>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="product-thumbnail">รูปภาพ</th>
                    <th class="product-name">สินค้า</th>
                    <th class="product-price">ราคาต่อหน่วย</th>
                    <th class="product-quantity">จำนวน</th>
                    <th class="product-total">ราคารวม</th>
                    <th class="product-remove" style="text-align: center;">ลบ</th>
                  </tr>

                </thead>

                <tbody>
                  <?php
                  foreach ($_SESSION["cart_item"] as $item) {
                    $item_price = $item["p_qty"] * $item["p_price"];
                  ?>
                    <tr>
                      <td class="product-thumbnail">
                        <img src="<?php echo $item["p_img"]; ?>" class="img-fluid">
                      </td>
                      <td class="product-name">
                        <h2 class="h5 text-black"><?php echo $item["p_name"]; ?></h2>
                      </td>
                      <td class="product-price"><?php echo "฿ " . $item["p_price"]; ?></td>
                      <td class="product-quantity">
                        <div class="input-group mb-3" style="max-width: 120px;">
                          <?php echo $item["p_qty"]; ?>
                        </div>
                      </td>
                      <td class="product-total"><?php echo "฿ " . $item_price; ?></td>
                      <td class="product-remove" style="text-align: center;">
                        <a href="cart.php?action=remove&p_id=<?= $item["p_id"] ?? ''; ?>" class="btn btn-danger btn-sm">ลบ</a>
                      </td>
                    </tr>
                  <?php
                    $total_quantity += $item["p_qty"];
                    $total_price += $item_price;
                  }
                  ?>


                </tbody>
              </table>

            

          </div>
        </form>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="row mb-5">
            <div class="col-md-6 mb-3 mb-md-0">
              <button class="btn btn-primary btn-sm btn-block" type="submit" name="update_cart">อัพเดทตะกร้า</button>
            </div>
            <div class="col-md-6">
              <button class="btn btn-outline-primary btn-sm btn-block" onclick="window.location='../member/index.php'">เลือกสินค้าต่อ</button>
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
        <?php
            } else {
            ?>

              <div class="no-records text-center h3">ไม่พบสินค้า</div>

            <?php

            }

            ?>
      </div>
    </div>
  </div>


  <?php include('footer.php'); ?>
  </div>


</body>

</html>