<?php
    include('includes/header.php'); 
    include('includes/navbar.php');
?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">


                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="" id="userDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                        <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
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
                <h1 class="h3 mb-0 text-gray-800">Admin</h1>
            </div>

            <section">
                <div class="pb-5">
                    <div class="row">
                        <div class="col-lg-4">
                            <!-- Profile picture card-->
                            <div class="card mb-4">
                                <div class="card-header">จัดการข้อมูลข่าวสาร</div>
                                <div class="card-body text-center">
                                    <!-- Profile picture image-->
                                    <img src="img/logo.png" class="rounded-circle img-fluid" style="width: 150px;">
                                    <!-- Profile picture help block-->
                                    <div class="small font-italic text-muted mb-4">ขนาดไฟล์สูงสุด : 5.0MB</div>
                                    <div class="small font-italic text-muted mb-4">นามสกุลไฟล์ที่รองรับ : JPG,JPEG,PNG
                                    </div>
                                    <!-- Profile picture upload button-->
                                    <button class="btn btn-primary" type="button">อัปโหลดรูปภาพ</button>
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