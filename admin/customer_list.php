<table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
    <thead>
        <tr role="row">
            <!-- <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="ID: activate to sort column descending" style="width: 271px;">ID</th> -->
            <!-- <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="รูป: activate to sort column ascending" style="width: 160px;">รูป</th> -->
            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Username: activate to sort column ascending" style="width: 130px;">Username</th>
            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="ชื่อ: activate to sort column ascending" style="width: 130px;">ชื่อ</th>
            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="นามสกุล: activate to sort column ascending" style="width: 130px;">นามสกุล</th>
            <!-- <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Role: activate to sort column ascending" style="width: 189px;">Role</th> -->
            <!-- <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="ชื่อผู้ใช้: activate to sort column ascending" style="width: 189px;">ชื่อผู้ใช้</th> -->
            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="อีเมล: activate to sort column ascending" style="width: 189px;">อีเมล</th>
            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="เบอร์โทรศัพท์: activate to sort column ascending" style="width: 189px;">เบอร์โทรศัพท์</th>
            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="สถานะ: activate to sort column ascending" style="width: 189px;">สถานะ</th>
            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="วันที่และเวลาที่สมัคร: activate to sort column ascending" style="width: 189px;">วันที่และเวลาที่สมัคร</th>
            <!-- <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="แก้ไข: activate to sort column ascending" style="width: 171px;">แก้ไข</th> -->
            <!-- <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="ลบ: activate to sort column ascending" style="width: 171px;">ลบ</th> -->
        </tr>
    </thead>
    <tfoot>
        <tr>
            <!-- <th rowspan="1" colspan="1">ID</th> -->
            <!-- <th rowspan="1" colspan="1">รูป</th> -->
            <th rowspan="1" colspan="1">Username</th>
            <!-- <th rowspan="1" colspan="1">Role</th> -->
            <!-- <th rowspan="1" colspan="1">ชื่อผู้ใช้</th> -->
            <th rowspan="1" colspan="1">ชื่อ</th>
            <th rowspan="1" colspan="1">นามสกุล</th>
            <th rowspan="1" colspan="1">อีเมล</th>
            <th rowspan="1" colspan="1">เบอร์โทรศัพท์</th>
            <th rowspan="1" colspan="1">สถานะ</th>
            <th rowspan="1" colspan="1">วันที่และเวลาที่สมัคร</th>
            <!-- <th rowspan="1" colspan="1">แก้ไข</th> -->
            <!-- <th rowspan="1" colspan="1">ลบ</th> -->
        </tr>
    </tfoot>
    <tbody>
        <?php
        $select_stmt = $conn->prepare("SELECT * FROM tb_customer");
        $select_stmt->execute();

        $users = $select_stmt->fetchAll();

        foreach ($users as $user) {
        ?>
            <tr>
                <td><?php echo $user['username']; ?></td>
                <td><?php echo $user['firstname']; ?></td>
                <td><?php echo $user['lastname']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['phone']; ?></td>
                <td><?php echo $user['role']; ?></td>
                <td><?php echo $user['created_at']; ?></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>