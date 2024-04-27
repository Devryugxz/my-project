<?php
$ID = htmlspecialchars($_GET['ID']);

// ใช้ PDO เพื่อป้องกัน SQL Injection
$sql = "SELECT * FROM tb_shipping WHERE ship_id = :ship_id";
$statement = $conn->prepare($sql);
$statement->bindParam(':ship_id', $ID, PDO::PARAM_INT);
$statement->execute();

$row = $statement->fetch(PDO::FETCH_ASSOC);
?>

<form action="shipping_form_edit_db.php" method="post" class="form-horizontal">
    <div class="form-group">
        <div class="col-sm-12 control-label">
            ค่าส่ง :
        </div>
        <div class="col-sm-12">
            <input type="text" name="ship_price" required class="form-control" value="<?php echo htmlspecialchars($row['ship_price']); ?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-12">
        </div>
        <div class="col-sm-12">
            <input type="hidden" name="ship_id" value="<?php echo $ID; ?>" />
            <button type="submit" class="btn btn-success">แก้ไขข้อมูล</button>
            <a href="shipping.php" class="btn btn-danger">ยกเลิก</a>
        </div>
    </div>
</form>