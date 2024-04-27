  <?php
  session_start();
  require_once 'config/db.php';

  if (!isset($_SESSION['seller'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ';
    header("location: ../login.php");
  }
  ?>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">หน้าหลัก</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">
          <i class="fas fa-sign-out-alt"></i>
          ออกจากระบบ
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="img/logo.png" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">ขายมะม่วงออนไลน์</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <?php

      if (isset($_SESSION['seller'])) {
        $s_id = $_SESSION['seller'];
        $stmt = $conn->query("SELECT * FROM tb_masterlogin WHERE master_id = $s_id");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
      }

      ?>
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $row['username'] ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="index.php" class="nav-link active">
              <i class="fas fa-home"></i>
              <p> หน้าหลัก</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="orderlist.php" class="nav-link">
              <i class="nav-icon fas fa-clipboard-list"></i>
              <p>
                รายการที่สั่งซื้อ
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="product.php" class="nav-link">
              <i class="nav-icon fas fa-clipboard-list"></i>
              <p>
                จัดการสินค้า
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="type.php" class="nav-link">
              <i class="nav-icon fas fa-clipboard-list"></i>
              <p>
                จัดการประเภทสินค้า
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="bank.php" class="nav-link">
              <i class="nav-icon fas fa-clipboard-list"></i>
              <p>
                บัญชีของฉัน
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="sellervouchers.php" class="nav-link">
              <i class="nav-icon fas fa-clipboard-list"></i>
              <p>
                โปรโมชัน
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="shipping.php" class="nav-link">
              <i class="nav-icon fas fa-clipboard-list"></i>
              <p>
                ค่าส่ง
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="previewcenter.php" class="nav-link">
              <i class="nav-icon fas fa-clipboard-list"></i>
              <p>
                หน้าร้านค้า
              </p>
            </a>
          </li>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>