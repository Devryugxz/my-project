<?php
require_once 'config\db.php';
?>

<div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
    <div class="row">
        <div class="col-sm-12">
            <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                <thead>
                    <tr role="row">
                        <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="ID: activate to sort column descending" style="width: 271px;">ID</th>
                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="รูป: activate to sort column ascending" style="width: 160px;">รูป</th>
                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Username: activate to sort column ascending" style="width: 130px;">Username</th>
                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Role: activate to sort column ascending" style="width: 189px;">Role</th>
                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="ชื่อผู้ใช้: activate to sort column ascending" style="width: 189px;">ชื่อผู้ใช้</th>
                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="อีเมล: activate to sort column ascending" style="width: 189px;">อีเมล</th>
                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="เบอร์โทรศัพท์: activate to sort column ascending" style="width: 189px;">เบอร์โทรศัพท์</th>
                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="ที่อยู่: activate to sort column ascending" style="width: 189px;">ที่อยู่</th>
                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="วันที่และเวลาที่สมัคร: activate to sort column ascending" style="width: 189px;">วันที่และเวลาที่สมัคร</th>
                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="แก้ไข: activate to sort column ascending" style="width: 171px;">แก้ไข</th>
                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="ลบ: activate to sort column ascending" style="width: 171px;">ลบ</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th rowspan="1" colspan="1">ID</th>
                        <th rowspan="1" colspan="1">รูป</th>
                        <th rowspan="1" colspan="1">Username</th>
                        <th rowspan="1" colspan="1">Role</th>
                        <th rowspan="1" colspan="1">ชื่อผู้ใช้</th>
                        <th rowspan="1" colspan="1">อีเมล</th>
                        <th rowspan="1" colspan="1">เบอร์โทรศัพท์</th>
                        <th rowspan="1" colspan="1">ที่อยู่</th>
                        <th rowspan="1" colspan="1">วันที่และเวลาที่สมัคร</th>
                        <th rowspan="1" colspan="1">แก้ไข</th>
                        <th rowspan="1" colspan="1">ลบ</th>
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
                            <td>
                                <!-- <img src="<?php echo $row['m_img']; ?>" class="img-rounded" width="200px"> -->
                            </td>
                            <td><?php echo $user['username']; ?></td>
                            <td><?php echo $user['role']; ?></td>
                            <td><?php echo $user['m_name']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td><?php echo $user['m_tel']; ?></td>
                            <td><?php echo $user['m_address']; ?></td>
                            <td><?php echo $user['created_at']; ?></td>
                            <td><a href="admin_form_edit.php?update_id=<?php echo $user['master_id']; ?>" class="btn btn-warning"><i class="fas fa-times"></i></a></td>
                            <td><a href="?delete_id=<?php echo $user['master_id']; ?>" class="btn btn-danger" onclick="return confirm('กรุณายืนยันการลบข้อมูล');"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>


    <?php
    include('includes/scripts.php');
    include('includes/footer.php');
    ?>