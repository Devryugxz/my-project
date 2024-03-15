<?php
include('includes/header.php');
include('includes/navbar.php');

session_start();
require_once 'config/db.php';
if (!isset($_SESSION['seller'])) {
    header("location: login.php");
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
                $s_id = $_SESSION['seller'];
                $stmt = $conn->query("SELECT * FROM tb_seller WHERE s_id = $s_id");
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
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            ออกจากระบบ</a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">ข้อมูลรายการประเภทสินค้า <a href="type.php?act=add"
                        class="btn btn-primary btn-sm">เพิ่มประเภทสินค้า</a></h1>
            </div>

            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <!-- DataTales Example -->
                    <div class="card mb-4">
                    <div class="card-body">
                                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <?php
                                                $act = (isset($_GET['act']) ? $_GET['act'] : '');
                                                if($act == 'add'){
                                                    include('type_form_add.php');
                                                }elseif ($act == 'edit') {
                                                    include('type_form_edit.php');
                                                }else {
                                                    include('type_list.php');
                                                }
                                            ?>
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