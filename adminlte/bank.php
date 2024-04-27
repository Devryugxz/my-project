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
                    <h1 class="h3 mb-0 text-gray-800">บัญชีธนาคาร <a href="bank.php?act=add" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> เพิ่มบัญชีใหม่</a></h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title m-0 font-weight-bold text-primary">บัญชีธนาคาร</h3>
                        </div>
                        <!-- /.card-header -->
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
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>