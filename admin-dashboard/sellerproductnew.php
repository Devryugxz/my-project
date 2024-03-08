<?php
include('includes/header.php');
include('includes/navbar.php');

require_once('config/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_REQUEST['btn_insert'])) {
        $Product_Name = $_POST["txtName"];
        $Product_Price = $_POST["txtPrice"];
        $Product_Details = $_POST["txtDetails"];
        $Product_qty = $_POST["txtqty"];

        if (empty($Product_Name)) {
            $errorMsg = "กรุณากรอกชื่อสินค้า";
        } else if (empty($Product_Price)) {
            $errorMsg = "กรุณากรอกราคาสินค้า";
        } else if (empty($Product_qty)) {
            $errorMsg = "กรุณากรอกจำนวนสินค้า";
        } else {
            try {
                if (!isset($errorMsg)) {
                    $stmt = $conn->prepare("INSERT INTO tb_product (Product_Name, Product_Price, Product_Details, Product_qty) VALUES (:pName, :pPrice, :pDetails, :pqty)");
                    $stmt->bindParam(':pName', $Product_Name);
                    $stmt->bindParam(':pPrice', $Product_Price);
                    $stmt->bindParam(':pDetails', $Product_Details);
                    $stmt->bindParam(':pqty', $Product_qty);

                    if ($stmt->execute()) {
                        $insertMsg = "บันทึกข้อมูลสำเร็จ";
                        header("refresh:2; sellerlist.php");
                    }
                }
            } catch (PDOException $e) {
                echo "เกิดข้อผิดพลาด: " . $e->getMessage();
            }
        }
    }
}
?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                        <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">ข้อมูลสินค้า</h1>
            </div>

            <!-- Content Row -->
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <?php if (isset($errorMsg)) {
                    ?>
                        <div class="alert alert-danger">
                            <strong>มีบางอย่างผิดพลาด <?php echo $errorMsg; ?></strong>
                        </div>
                    <?php } ?>
                    <?php if (isset($insertMsg)) {
                    ?>
                        <div class="alert alert-success">
                            <strong>บันทึกข้อมูลเรียบร้อยแล้ว <?php echo $insertMsg; ?></strong>
                        </div>
                    <?php } ?>
                    <form method="post" enctype="multipart/form-data">
                        <button type="submit" name="btn_insert" class="btn btn-primary">บันทึกข้อมูล</button>
                        <div class="product">
                            <div class="product-new">
                                <div class="product-edit">
                                    <div class="card my-3" style="padding: 20px;">
                                        <h3>ข้อมูลทั่วไป</h3>
                                        <div class="row" style="padding: 10px;">
                                            <div class="col-3">ภาพสินค้า</div>
                                            <div class="col-9">
                                                <form method="post" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <input type="file" class="form-control" id="imgInput" name="Product_img" accept="image/*">
                                                        <input type="hidden" name="MAX_FILE_SIZE" value="2097152"> <!-- 2 MB -->
                                                        <img width="15%" id="previewImg" alt="">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="row" style="padding: 10px;">
                                            <div class="col-3">ชื่อสินค้า</div>
                                            <div class="col-9">
                                                <div class="form-group">
                                                    <input class="form-control" type="text" name="txtName" placeholder="ใส่คำ" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="padding: 10px;">
                                            <div class="col-3">ราคา</div>
                                            <!--บาท-->
                                            <div class="col-9">
                                                <div class="form-group">
                                                    <input class="form-control" name="txtPrice" type="text" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="padding: 10px;">
                                            <div class="col-3">รายละเอียดสินค้า</div>
                                            <div class="col-9">
                                                <div class="form-group">
                                                    <textarea class="form-control" name="txtDetails" maxlength="5000"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="padding: 10px;">
                                            <div class="col-3">จำนวนสินค้า</div>
                                            <div class="col-9">

                                                <div class="form-group">
                                                    <input class="form-control" name="txtqty" type="text" placeholder="">
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- <div class="card my-3" style="padding: 20px;">
                                        <h3>ข้อมูลการขาย</h3>
                                        <div class="row" style="padding: 10px;">
                                            <div class="col-3">หมวดหมู่</div>
                                            <div class="col-9">
                                                <form>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            มะม่วงสุก
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                                                        <label class="form-check-label" for="flexRadioDefault2">
                                                            มะม่วงดิบ
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3">
                                                        <label class="form-check-label" for="flexRadioDefault3">
                                                            มะม่วงแปรรูป
                                                        </label>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="row" style="padding: 10px;">
                                            <div class="col-3">ราคาโปรโมชั่น</div>
                                            <div class="col-9">
                                                <div class="form-group">
                                                    <input class="form-control" type="text" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="padding: 10px;">
                                            <div class="col-3">วันเริ่มราคาโปรโมชั่น</div>
                                            <div class="col-9">
                                                <div class="input-group date" id="datepicker">
                                                    <input type="date" class="form-control" id="date" />
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row" style="padding: 10px;">
                                            <div class="col-3">วันสิ้นสุดโปรโมชั่น</div>
                                            <div class="col-9">
                                                <div class="input-group date" id="datepicker">
                                                    <input type="date" class="form-control" id="date" />
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="card my-3" style="padding: 20px;">
                                        <h3>ช่องทางการจัดส่ง</h3>
                                        <div class="row" style="padding: 10px;">
                                            <div class="col-3">ช่องทางการจัดส่ง</div>
                                            <div class="col-9 form-check">
                                                <label class="form-check-label" for="">
                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">Kerry
                                                    Express</label>
                                            </div>
                                        </div>
                                        <div class="row" style="padding: 10px;">
                                            <div class="col-3"></div>
                                            <div class="col-9 form-check">
                                                <label class="form-check-label" for="">
                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">J&T
                                                    Express</label>
                                            </div>
                                        </div>
                                        <div class="row" style="padding: 10px;">
                                            <div class="col-3"></div>
                                            <div class="col-9 form-check">
                                                <label class="form-check-label" for="">
                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">Flash
                                                    Express</label>
                                            </div>
                                        </div>
                                        <div class="row" style="padding: 10px;">
                                            <div class="col-3"></div>
                                            <div class="col-9 form-check">
                                                <label class="form-check-label" for="">
                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">ไปรษณีย์ไทย</label>
                                            </div>
                                        </div>
                                        <div class="row" style="padding: 10px;">
                                            <div class="col-3"></div>
                                            <div class="col-9 form-check">
                                                <label class="form-check-label" for="">
                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">อื่นๆ</label>
                                            </div>
                                        </div>

                                    </div> -->
                                </div>
                            </div>

                            <button type="submit" name="btn_insert" class="btn btn-primary mb-3">บันทึกข้อมูล</button>

                        </div>
                </div>

            </div>
            </form>
        </div>

    </div>
    <!-- End of Page Wrapper -->

    <?php
    include('includes/scripts.php');
    include('includes/footer.php');
    ?>