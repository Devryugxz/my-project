<?php
include('includes/header.php');
include('includes/navbar.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">

        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">ข้อมูลผู้ประกอบการ</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                จำนวนลูกค้า</div>
                            <?php
                            $sql = "SELECT COUNT(*) as users FROM tb_seller";
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
                    <h6 class="m-0 font-weight-bold text-primary">ข้อมูลผู้ประกอบการทั้งหมด</h6>
                </div>
                <div class="card-body">
                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <?php
                                include('seller_list.php');
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- /.content-header -->
</div>
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>