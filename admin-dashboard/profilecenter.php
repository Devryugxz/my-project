<?php
session_start();
include('includes/header.php');
include('includes/navbar.php');

require_once('config/db.php');

if (!isset($_SESSION['seller'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ';
    header("location: login.php");
}

// ดึงข้อมูลผู้ใช้จากฐานข้อมูล
if (isset($_SESSION['seller'])) {
    $s_id = $_SESSION['seller'];
    $stmt = $conn->query("SELECT * FROM tb_seller WHERE s_id = $s_id");
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}

// ตรวจสอบว่ามีการส่งข้อมูลฟอร์มมาหรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ดึงข้อมูลที่แก้ไขจากฟอร์ม
    $new_username = isset($_POST['username']) ? htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8') : $user['username'];
    $new_fisrtname = isset($_POST['fisrtname']) ? htmlspecialchars($_POST['fisrtname'], ENT_QUOTES, 'UTF-8') : $user['fisrtname'];
    $new_lastname = isset($_POST['lastname']) ? htmlspecialchars($_POST['lastname'], ENT_QUOTES, 'UTF-8') : $user['lastname'];
    $new_email = isset($_POST['email']) ? htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8') : $user['email'];
    $new_name = isset($_POST['name']) ? htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8') : $user['name'];
    $new_tel = isset($_POST['phone']) ? htmlspecialchars($_POST['phone'], ENT_QUOTES, 'UTF-8') : $user['phone'];
    // $new_address = isset($_POST['address']) ? htmlspecialchars($_POST['address'], ENT_QUOTES, 'UTF-8') : $user['address'];

    // ปรับปรุงข้อมูลในฐานข้อมูล
    $update_stmt = $conn->prepare("UPDATE tb_seller SET username = :username, email = :email, name = :name, phone = :phone, address = :address WHERE s_id = :s_id");
    $update_stmt->bindParam(':username', $new_username);
    $update_stmt->bindParam(':firstname', $new_firstname);
    $update_stmt->bindParam(':lastname', $new_lastname);
    $update_stmt->bindParam(':email', $new_email);
    $update_stmt->bindParam(':name', $new_name);
    $update_stmt->bindParam(':phone', $new_tel);
    // $update_stmt->bindParam(':address', $new_address);
    $update_stmt->bindParam(':s_id', $s_id);

    if ($update_stmt->execute()) {
        echo "ข้อมูลถูกปรับปรุงเรียบร้อยแล้ว";
        // สามารถทำการ redirect หรือแสดงข้อความอื่น ๆ ตามต้องการ
    } else {
        echo "เกิดข้อผิดพลาดในการปรับปรุงข้อมูล";
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

            <!-- Topbar Search -->
            <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                <li class="nav-item dropdown no-arrow d-sm-none">
                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-search fa-fw"></i>
                    </a>
                    <!-- Dropdown - Messages -->
                    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                        <form class="form-inline mr-auto w-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                        <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a href="logout.php" class="dropdown-item">ออกจากระบบ</a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">โปรไฟล์ของฉัน</h1>

            </div>


            <section">
                <div class="pb-5">
                    <div class="row">
                        <div class="col-lg-4">
                            <!-- Profile picture card-->
                            <div class="card mb-4">
                                <div class="card-header">รูปโปรไฟล์</div>
                                <div class="card-body text-center">
                                    <!-- Profile picture image-->
                                    <img src="img/logo.png" class="rounded-circle img-fluid" style="width: 150px;">
                                    <!-- Profile picture help block-->
                                    <div class="small font-italic text-muted mb-4">ขนาดไฟล์สูงสุด : 5.0MB</div>
                                    <div class="small font-italic text-muted mb-4">นามสกุลไฟล์ที่รองรับ : JPG,JPEG,PNG</div>
                                    <!-- Profile picture upload button-->
                                    <button class="btn btn-primary" type="button">อัปโหลดรูปภาพ</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <!-- Account details card-->
                            <div class="card mb-4">
                                <div class="card-header">ข้อมูลทั่วไป</div>
                                <div class="card-body">
                                    <form method="post">
                                        <!-- Form Row-->
                                        <div class="row gx-3 mb-3">
                                            <!-- Form Group (username)-->
                                            <div class="col-md-6 mb-3">
                                                <label class="small mb-1" for="">ชื่อบัญชี</label>
                                                <input class="form-control" id="username" name="username" type="text" value="<?= $user['username'] ?>">
                                            </div>
                                            <!-- Form Group (store name)-->
                                            <div class="col-md-6 mb-3">
                                                <label class="small mb-1" for="">ชื่อร้าน</label>
                                                <input class="form-control" type="text" id="name" name="name" value="<?= $user['name'] ?>">
                                            </div>
                                            <!-- Form Group (first name)-->
                                            <div class="col-md-6 mb-3">
                                                <label class="small mb-1" for="">ชื่อ</label>
                                                <input class="form-control" type="text" id="firstname" name="firstname" value="<?= $user['firstname'] ?>">
                                            </div>
                                            <!-- Form Group (last name)-->
                                            <div class="col-md-6 mb-3">
                                                <label class="small mb-1" for="">นามสกุล</label>
                                                <input class="form-control" type="text" id="lastname" name="lastname" value="<?= $user['lastname'] ?>">
                                            </div>
                                            <!-- Form Group (email address)-->
                                            <div class="col-md-6 mb-3">
                                                <label class="small mb-1" for="inputEmailAddress">อีเมล์</label>
                                                <input class="form-control" type="email" id="email" name="email" value="<?= $user['email'] ?>">
                                            </div>
                                            <!-- Form Group (phone number)-->
                                            <div class="col-md-6 mb-3">
                                                <label class="small mb-1" for="inputPhone">เบอร์โทรศัพท์</label>
                                                <input class="form-control" type="text" id="phone" name="phone" value="<?= $user['phone'] ?>">
                                            </div>
                                            <!-- Form Group (address)-->
                                            <!-- <div class="col-md-6">
                                                <label class="small mb-1" for="">ที่อยู่</label>
                                                <textarea class="form-control" id="address" name="address"><?= $user['address'] ?></textarea>
                                            </div> -->

                                        </div>
                                        <button type="submit" class="btn btn-primary mb-3">บันทึกข้อมูล</button>
                                    </form>
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