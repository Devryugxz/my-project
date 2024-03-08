<?php 
    session_start();
    require_once('config/db.php');
?>

<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>จำหน่ายมะม่วงออนไลน์</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
    integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

  <!--bootstrap-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
  </script>
  <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
    integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous">
  </script>
  <link rel="icon" type="image/x-icon" href="Image/logo.ico">
  <link rel="stylesheet" href="main.css">
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

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
    <div>
      <div class="topbar-wrapper disable-xs">
        <div class="container">
          <div class="d-flex bd-highlight">
            <div class="p-2 bd-highlight nav-user-support">
              <ul class="d-flex bd-highlight" style="list-style: none;">
                <li class="px-2"><a href="#">สมัครสมาชิก</a></li>
                <li class="px-2"><a href="#">เข้าสู่ระบบ</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="nav-wrapper">
        <div class="container">
          <div class="d-flex bd-highlight">
            <div class="logo p-2 bd-highlight"><a href="#"><img src="Image/"></a></div>
            <div class="mx-auto"></div>
            <div class="main-nav bd-highlight navbar-expand-lg">
              <div class="navbar-collapse collapse">
                <ul class="navbar-nav">
                  <li class="nav-item active"><a class="nav-link" href="index.php">หน้าแรก</a></li>
                  <li class="nav-item"><a class="nav-link" href="#">เปิดร้านค้า</a></li>
                  <li class="nav-item">
                    <button class="btn btn-outline-dark" type="submit">
                      <form class="d-flex">
                        <a class="nav-link" href="cart.php">
                          <i class="bi-cart-fill me-1"></i>
                          ตะกร้าสินค้า
                          <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                        </a>
                      </form>
                    </button>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="site-section">
        <div class="container">

          <div class="row mb-5">
            <form class="col-md-12" method="post">
              <div class="site-blocks-table">

              <?php 

                    $total_quantity = 0;
                    $total_price = 0;

                    if(isset($_SESSION["cart_item"])){
                    
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

                      foreach($_SESSION["cart_item"] as $item){
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
                      <td><a href="cart.php?action=remove&code=<?php echo $item["Product_ID"]; ?>"
                          class="btn btn-primary btn-sm">X</a></td>
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
                      <button class="btn btn-primary btn-lg py-3 btn-block"
                        onclick="window.location='checkout.php'">ดำเนินการชำระเงิน</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
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