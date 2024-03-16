<?php
include('includes/header.php');
include('includes/navbar.php');

session_start();
require_once 'config/db.php';
if (!isset($_SESSION['admin'])) {
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

            if (isset($_SESSION['admin'])) {
                $a_id = $_SESSION['admin'];
                $stmt = $conn->query("SELECT * FROM tb_admin WHERE a_id = $a_id");
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
                <h1 class="h3 mb-0 text-gray-800">Admin</h1>
            </div>

            <!-- Content Row -->
            <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        จำนวนสมาชิก</div>
                                    <?php
                                    $sql = "SELECT COUNT(*) as users FROM tb_masterlogin";
                                    $query = $conn->prepare($sql);
                                    $query->execute();
                                    $fetch = $query->fetch();
                                    ?>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?= $fetch['users'] ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-lg-12">

                    <!-- DataTales Example -->
                    <div class="card mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">ข้อมูลทั้งหมด</h6>
                        </div>
                        <div class="card-body">
                            <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="ID: activate to sort column descending" style="width: 271px;">ID</th>
                                                    <!-- <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="รูป: activate to sort column ascending" style="width: 160px;">รูป</th> -->
                                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Username: activate to sort column ascending" style="width: 130px;">Username</th>
                                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Role: activate to sort column ascending" style="width: 189px;">Role</th>
                                                    <!-- <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="ชื่อผู้ใช้: activate to sort column ascending" style="width: 189px;">ชื่อผู้ใช้</th> -->
                                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="อีเมล: activate to sort column ascending" style="width: 189px;">อีเมล</th>
                                                    <!-- <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="เบอร์โทรศัพท์: activate to sort column ascending" style="width: 189px;">เบอร์โทรศัพท์</th> -->
                                                    <!-- <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="ที่อยู่: activate to sort column ascending" style="width: 189px;">ที่อยู่</th> -->
                                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="วันที่และเวลาที่สมัคร: activate to sort column ascending" style="width: 189px;">วันที่และเวลาที่สมัคร</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th rowspan="1" colspan="1">ID</th>
                                                    <!-- <th rowspan="1" colspan="1">รูป</th> -->
                                                    <th rowspan="1" colspan="1">Username</th>
                                                    <th rowspan="1" colspan="1">Role</th>
                                                    <!-- <th rowspan="1" colspan="1">ชื่อผู้ใช้</th> -->
                                                    <th rowspan="1" colspan="1">อีเมล</th>
                                                    <!-- <th rowspan="1" colspan="1">เบอร์โทรศัพท์</th> -->
                                                    <!-- <th rowspan="1" colspan="1">ที่อยู่</th> -->
                                                    <th rowspan="1" colspan="1">วันที่และเวลาที่สมัคร</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php
                                                $select_stmt = $conn->prepare("SELECT * FROM tb_masterlogin");
                                                $select_stmt->execute();

                                                $users = $select_stmt->fetchAll();

                                                foreach ($users as $user) {
                                                ?>
                                                    <tr>
                                                        <td class="sorting_1"><?php echo $user['master_id']; ?></td>
                                                        <!-- <td><img src="<?php echo $row['m_img']; ?>" class="img-rounded" width="200px"></td> -->
                                                        <td><?php echo $user['username']; ?></td>
                                                        <td><?php echo $user['role']; ?></td>
                                                        <td><?php echo $user['email']; ?></td>
                                                        <!-- <td><?php echo $user['phone']; ?></td> -->
                                                        <!-- <td><?php echo $user['m_address']; ?></td> -->
                                                        <td><?php echo $user['created_at']; ?></td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
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
        <!-- End of Page Wrapper -->

        <?php
        include('includes/scripts.php');
        include('includes/footer.php');
        ?>