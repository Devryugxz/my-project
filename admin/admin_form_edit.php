<?php
include('config/db.php');
try {
    $stmt = $conn->prepare("SELECT * FROM tb_users WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        extract($row);
    } else {
        echo "ไม่พบข้อมูล";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// ปิดการเชื่อมต่อ database
$conn = null;
?>


<form action="admin_form_edit_db.php" method="post" class="form-horizontal" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div class="form-group">
        <div class="col-sm-2 control-label">
            Username :
        </div>
        <div class="col-sm-3">
            <input type="text" name="username" required class="form-control" value="<?php echo $username; ?>">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">
            Role :
        </div>
        <div class="col-sm-3">
            <input type="text" name="role" required class="form-control" value="<?php echo $result['role']; ?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-3">
            <input type="hidden" name="p_img2" value="<?php echo $result['p_img']; ?>">
            <input type="hidden" name="p_id" value="<?php echo $id; ?>" />
            <button type="submit" class="btn btn-success">แก้ไขข้อมูล</button>
            <a href="product.php" class="btn btn-danger">ยกเลิก</a>
        </div>
    </div>
</form>
