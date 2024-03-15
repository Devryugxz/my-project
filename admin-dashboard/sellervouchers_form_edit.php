<?php
include('config/db.php');

$ID = filter_input(INPUT_GET, 'ID', FILTER_SANITIZE_NUMBER_INT);
$sql = "SELECT * FROM tb_bank WHERE b_id = :ID";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':ID', $ID, PDO::PARAM_INT);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<form action="sellervouchers_form_edit_db.php" method="post" class="form-horizontal" enctype="multipart/form-data">

    <div class="row">
        <div class="col-lg-6">
            <!-- Form Row-->
            <div class="row gx-3 mb-3">
                <!-- Form Group (first name)-->
                <div class="col-md-6">
                    <label class="small mb-1" for="">ชื่อสินค้า</label>
                    <input class="form-control" id="" type="text" name="b_name" placeholder="ชื่อหนังสือ" value="<?php echo $row['b_name'] ?>" required>
                </div>
                <!-- Form Group (last name)-->
                <div class="col-md-6">
                    <label class="small mb-1" for="">ชื่อโปรโมชั่น</label>
                    <input class="form-control" id="" type="text" name="b_number" placeholder="ชื่อโปรโมชั่น" value="<?php echo $row['b_number'] ?>" required>
                </div>
            </div>
            <!-- Form Row-->
            <div class="row gx-3 mb-3">
                <!-- Form Group (first name)-->
                <div class="col-md-6">
                    <label class="small mb-1" for="">ส่วนลด</label>
                    <input class="form-control" id="" type="text" name="b_name" placeholder="ส่วนลด" value="<?php echo $row['b_name'] ?>" required>
                </div>
                <!-- Form Group (last name)-->
                <div class="col-md-6">
                    <label class="small mb-1" for="">รายละเอียดโปรโมชั่น</label>
                    <input class="form-control" id="" type="text" name="b_number" placeholder="รายละเอียดโปรโมชั่น" value="<?php echo $row['b_number'] ?>" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="small mb-1" for="">วันที่เริ่มโปรโมชั่น</label>
                <input class="form-control" id="" type="date" name="b_owner" placeholder="ชื่อหนังสือ" value="<?php echo $row['b_owner'] ?>">
            </div>
            <div class="mb-3">
                <label class="small mb-1" for="">วันที่สิ้นสุดโปรโมชั่น</label>
                <input class="form-control" id="" type="date" name="b_owner" placeholder="ชื่อหนังสือ" value="<?php echo $row['b_owner'] ?>">
            </div>

            <input type="hidden" name="b_logo2" value="<?php echo $row['b_logo']; ?>">
            <input type="hidden" name="b_id" value="<?php echo $ID; ?>">

            <!-- Save changes button-->
            <button class="btn btn-primary" type="submit">บันทึกข้อมูล</button>
            <a href="bank.php" class="btn btn-danger">ยกเลิก</a>
        </div>
    </div>
</form>