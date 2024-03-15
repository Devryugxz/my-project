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
          <br>
          <div class="alert mb-3 text-black" role="alert">
          <h2 class="h3 mb-3 text-black">ข้อมูลการสั่งซื้อ</h2>
        
          </div>
        </div>
        <br><br>
        <div class="col-1 col-sm-2">
          <button class="btn btn-secondary" style="width: 100%;" disabled> รอชำระเงิน <br></br></button>
        </div>
        <div class="col-1 col-sm-1" style="margin-top: 15px;">
          
        </div>
        <div class="col-2 col-sm-2">
          <button class="btn btn-secondary" style="width: 100%;" disabled> รอการตรวจสอบการเงินแล้ว</button>
        </div>
        <div class="col-1 col-sm-1" style="margin-top: 15px;">
          
        </div>
        <div class="col-2 col-sm-2">
          <button class="btn btn-secondary" style="width: 100%;" disabled> กำลังจัดส่ง <br></br>  </button>
        </div>
        <div class="col-1 col-sm-1" style="margin-top: 15px;">
        
        </div>
        <div class="col-3 col-sm-2">
          <button class="btn btn-secondary" style="width: 100%;" disabled> ได้รับสินค้าแล้ว <br></br> </button>
        </div>
        <div class="col-1 col-sm-1" style="margin-top: 15px;">
        <div class="col-2 col-sm-2">
          <!-- <button class="btn btn-secondary" style="width: 100%;" disabled> ยกเลิกคำสั่งซื้อ <br></br> </button> -->
        </div>
      </div>
    </div>
    </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
        <div class="container px-4 px-lg-5 my-5">
                <form action="cart.php?act=add&p_id=<?php echo $row['p_id']; ?>" method="post">
                    <div class="row gx-4 gx-lg-5 align-items-center">
                        <div class="col-md-6 item" id='ex1'>
                            <!-- <a class="card-img-top mb-5 mb-md-0"><?php echo "<img src='../p_img/" . $row['p_img'] . "'width='100%'>"; ?></a> -->
                        </div>
          <br><br>
          
          <div class="table-responsive">
          <table class="table table-bordered table-striped table-hover">
            <thead>
              <tr>
                <th scope="col">ราคา</th>
                <th scope="col" class="text-center">จำนวน</th>
                <th scope="col" class="text-center">รวม(บาท)</th>
                <th scope="col" class="text-center">สถานะ</th>
                <th scope="col" class="text-center">รายละเอียดสินค้า</th>
              </tr>
            </thead>
        <div>
                            <img class="card-img-top " src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="...">
                            </div>
                            <div class="col-md-6">
                                <label for="firstname" class="text-black">หมายเลขคำสั่งซื้อ:<span class="text-danger"></span></label>
                               
                            </div>
                            <div class="col-md-6">
                                <label for="firstname" class="text-black">ชื่อสินค้า:<span class="text-danger"></span></label>
                               
                            </div>
                            </div>
    </body>

</html>   