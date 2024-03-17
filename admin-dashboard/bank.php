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
                $s_id = $_SESSION['seller'];
                $stmt = $conn->query("SELECT * FROM tb_masterlogin WHERE master_id = $s_id");
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
            }

            ?>
            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
                <div class="topbar-divider d-none d-sm-block"></div>
                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $row['username'] ?></span>
                        <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="profilecenter.php">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="logout.php" class="dropdown-item">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>ออกจากระบบ</a>
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
                <h1 class="h3 mb-0 text-gray-800">บัญชีธนาคาร <a href="bank.php?act=add" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> เพิ่มบัญชีใหม่</a></h1>
            </div>


            <section">
                <div class="pb-5">
                    <div class="row">

                        <div class="col-lg-6">
                            <!-- Account details card-->
                            <div class="card mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">บัญชีธนาคาร</h6>
                                </div>
                                <div class="card-body">
                                    <?php
                                    $act = (isset($_GET['act']) ? $_GET['act'] : '');
                                    if ($act == 'add') {
                                        include('bank_form_add.php');
                                    } elseif ($act == 'edit') {
                                        include('bank_form_edit.php');
                                    } else {
                                        include('bank_list.php');
                                    }
                                    ?>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
                </section>

        </div>
    </div>
    <!-- End of Page Wrapper -->

    <?php
    include('includes/scripts.php');
    include('includes/footer.php');
    ?>