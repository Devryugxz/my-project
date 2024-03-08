<?php
    include('includes/header.php'); 
    include('includes/navbar.php');

    require_once 'config/db.php';

    if(isset($_REQUEST['delete_id'])){
        $id = $_REQUEST['delete_id'];

        $select_stmt = $conn->prepare("SELECT * FROM tb_product WHERE Product_ID = :id");
        $select_stmt->bindParam(':id', $id);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

        // ลบข้อมูลในตารางสินค้า
        $delete_stmt = $conn->prepare("DELETE FROM tb_product WHERE Product_ID = :id");
        $delete_stmt->bindParam(':id', $id);
        $delete_stmt->execute();

        header('locataion: sellerlist.php');
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
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                        <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="profilecenter.php">
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
                <h1 class="h3 mb-0 text-gray-800">จัดการข้อมูล</h1>
            </div>

            <?php if(isset($_SESSION['success'])){ ?>
                <div class="alert alert-success">
                    <?php 
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                    ?>
                </div>
            <?php } ?>
            <?php if(isset($_SESSION['error'])){ ?>
                <div class="alert alert-danger">
                    <?php 
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    ?>
                </div>
            <?php } ?>

            <!-- Content Row -->
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="card" style="padding: 30px;">
                        <form action="">
                            <div style="padding-bottom: 20px;">
                                <label for="">ชื่อสินค้า</label>
                                <input class="form-control" type="text" placeholder="ชื่อสินค้า"></input>
                            </div>
                            <label for="">หมวดหมู่</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                    id="flexRadioDefault1" checked>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    มะม่วงสุก
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                    id="flexRadioDefault2">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    มะม่วงดิบ
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                    id="flexRadioDefault3">
                                <label class="form-check-label" for="flexRadioDefault3">
                                    มะม่วงแปรรูป
                                </label>
                            </div>
                            <button type="button" class="btn btn-primary mt-3">ค้นหา</button>
                            <button type="button" class="btn btn-primary mt-3">รีเซ็ต</button>
                        </form>
                    </div>
                    <div class="card my-3" style="padding: 30px;">
                        <form action="">
                            <a href="sellerproductnew.php" rel="noopener noreferrer"><button type="button"
                                    class="btn btn-primary mb-3">เพิ่มสินค้าใหม่</button></a>
                            <table class="table">
                                <!-- <caption>จำนวนสินค้า</caption> -->
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">รูปปก</th>
                                        <th scope="col">ชื่อสินค้า</th>
                                        <th scope="col">ราคาต่อหน่วย</th>
                                        <th scope="col">จำนวนสินค้า</th>
                                        <!-- <th scope="col">หมวดหมู่สินค้า</th> -->
                                        <th scope="col">วันที่เพิ่มสินค้า</th>
                                        <th scope="col">แก้ไข</th>
                                        <th scope="col">ลบ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $select_stmt = $conn->prepare("SELECT * FROM tb_product");
                                        $select_stmt->execute();

                                        $products = $select_stmt->fetchAll();

                                        if(!$products){
                                            echo "<tr><td colspan='9' class='text-center'><h4>ไม่มีข้อมูลสินค้า</h4></td></tr>";
                                        } else {
                                            foreach ($products as $product){                                                 
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $product['Product_ID']; ?></th>
                                        <td width="150px"><img width="100%" src="upload_img/<?php echo $product['Product_img']; ?>" class="rounded" ></td>
                                        <td><?php echo $product['Product_Name']; ?>
                                            <small class="text-muted"><?php echo $product['Product_Details']; ?></small>
                                        </td>
                                        <td><?php echo $product['Product_Price']; ?></td>
                                        <td><?php echo $product['Product_qty']; ?></td>
                                        <!-- <td><?php echo $product['Category_ID']; ?></td> -->
                                        <td><?php echo $product['created_at']; ?></td>
                                        <td><a class="btn btn-warning" href="Product_edit.php?update_id=<?php echo $product['Product_ID']; ?>">แก้ไข</a></td>
                                        <td><a class="btn btn-danger" href="?delete_id=<?php echo $product['Product_ID']; ?>" onclick="return confirm('คุณต้องการลบข้อมูลใช่หรือไม่');">ลบ</a></td>
                                    </tr>  
                                    <?php }} ?>                                                         
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!-- End of Page Wrapper -->

    <?php
    include('includes/scripts.php'); 
    include('includes/footer.php'); 
?>