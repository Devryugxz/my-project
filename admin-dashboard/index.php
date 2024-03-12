<?php
include('includes/header.php');
include('includes/navbar.php');

session_start();
require_once 'config/db.php';

if (!isset($_SESSION['seller'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ';
    header("location: ../login.php");
}
?>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <?php

            if (isset($_SESSION['seller'])) {
                $admin_dashboard_id = $_SESSION['seller'];
                $stmt = $conn->query("SELECT * FROM tb_users WHERE id = $admin_dashboard_id");
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
            }

            ?>
            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
                <div class="topbar-divider d-none d-sm-block"></div>
                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $row['username'] ?></span>
                        <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <a href="logout.php" class="dropdown-item">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>ออกจากระบบ</a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">รายการสินค้า</h1>
            </div>

            <div class="row">
                <div class="col-md-12 col-lg-12">

                    <!-- DataTales Example -->
                    <div class="card mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">รายการสินค้าทั้งหมด</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-bordered dataTable" id="dataTable" width="100%"
                                                cellspacing="0" role="grid" aria-describedby="dataTable_info"
                                                style="width: 100%;">
                                                <!-- <caption>จำนวนสินค้า</caption> -->
                                                <thead>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">รูป</th>
                                                        <th scope="col">ชื่อสินค้า</th>
                                                        <th scope="col">รายละเอียดสินค้า</th>
                                                        <th scope="col">ราคาสินค้า</th>
                                                        <th scope="col">จำนวนเข้าชม</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">รูป</th>
                                                        <th scope="col">ชื่อสินค้า</th>
                                                        <th scope="col">รายละเอียดสินค้า</th>
                                                        <th scope="col">ราคาสินค้า</th>
                                                        <th scope="col">จำนวนเข้าชม</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                    <?php
                                                    $select_stmt = $conn->prepare("SELECT * FROM tb_product as p
                                                    INNER JOIN tb_type as t ON p.type_id = t.type_id ORDER BY p.p_id DESC");
                                                    $select_stmt->execute();

                                                    $products = $select_stmt->fetchAll();

                                                    if (!$products) {
                                                        echo "<tr><td colspan='9' class='text-center'><h4>ไม่มีข้อมูลสินค้า</h4></td></tr>";
                                                    } else {
                                                        foreach ($products as $product) {
                                                    ?>
                                                    <tr>
                                                        <td class='hidden-xs'><?= $product["p_id"] ?></td>
                                                        <td class='hidden-xs'><img src='../p_img/<?= $product['p_img'] ?>'width='100%' height="100px" style="object-fit: cover;"></td>
                                                        <td> ชื่อ: <?= $product["p_name"] ?><br>ประเภท: <font color='blue'>
                                                                <?= $product["type_name"] ?></font>
                                                        </td>
                                                        <td class='hidden-xs'><?= $product["p_detail"] ?></td>
                                                        <td> ราคา <?= $product["p_price"] ?> บาท<br>จำนวน
                                                            <?= $product["p_qty"] ?> <?= $product["p_unit"] ?></td>
                                                        <td> จำนวนการเข้าชม <?= $product["p_view"] ?> ครั้ง<br>วันที่
                                                            <?= date('d/m/Y', strtotime($product["datesave"])) ?></td>
                                                    </tr>
                                                    <?php }
                                                    } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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