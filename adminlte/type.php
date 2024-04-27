<?php
include('includes/header.php');
include('includes/navbar.php');

require_once 'config/db.php';

if (!isset($_SESSION['seller'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ';
    header("location: ../login.php");
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="h3 mb-0 text-gray-800">ข้อมูลรายการประเภทสินค้า <a href="type.php?act=add" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> เพิ่มประเภทสินค้า</a></h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- /.row -->
            <!-- Main row -->
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title m-0 font-weight-bold text-primary">ประเภทสินค้า</h6>
                </div>
                <!-- /.card-header -->
                <div class="card-body">                   
                    <?php
                    $act = (isset($_GET['act']) ? $_GET['act'] : '');
                    if ($act == 'add') {
                        include('type_form_add.php');
                    } elseif ($act == 'edit') {
                        include('type_form_edit.php');
                    } else {
                        include('type_list.php');
                    }
                    ?>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>