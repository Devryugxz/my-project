<?php
$ID = htmlspecialchars($_GET['ID']);

// ใช้ PDO เพื่อป้องกัน SQL Injection
$sql = "SELECT * FROM tb_type WHERE type_id = :type_id";
$statement = $conn->prepare($sql);
$statement->bindParam(':type_id', $ID, PDO::PARAM_INT);
$statement->execute();

$row = $statement->fetch(PDO::FETCH_ASSOC);
?>

<form action="type_form_edit_db.php" method="post" class="form-horizontal">
  <div class="form-group">
    <div class="col-sm-12 control-label">
      ประเภทสินค้า :
    </div>
    <div class="col-sm-12">
      <input type="text" name="type_name" required class="form-control" value="<?php echo htmlspecialchars($row['type_name']); ?>">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
    </div>
    <div class="col-sm-12">
      <input type="hidden" name="type_id" value="<?php echo $ID; ?>" />
      <button type="submit" class="btn btn-success">แก้ไขข้อมูล</button>
      <a href="type.php" class="btn btn-danger">ยกเลิก</a>
    </div>
  </div>
</form>