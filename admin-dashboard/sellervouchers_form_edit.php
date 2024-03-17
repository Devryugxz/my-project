<?php
include('config/db.php');

$ID = htmlspecialchars($_GET['ID']);
$sql = "SELECT * FROM tb_promotion WHERE pro_id = :ID";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':ID', $ID);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
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
            <div class="row mb-3">
                <!-- Form Group (first name)-->
                <div class="col-md-6">
                    <label class="small mb-1" for="">ชื่อสินค้า</label>
                    <input class="form-control" id="" type="text" name="p_name" placeholder="ชื่อสินค้า" value="<?php echo $row['p_name'] ?>" required>
                </div>
                <!-- Form Group (last name)-->
                <div class="col-md-6">
                    <label class="small mb-1" for="">ชื่อโปรโมชั่น</label>
                    <input class="form-control" id="" type="text" name="pro_name" placeholder="ชื่อโปรโมชั่น" value="<?php echo $row['pro_name'] ?>" required>
                </div>
            </div>
            <!-- Form Row-->
            <div class="row mb-3">
                <!-- Form Group (first name)-->
                <div class="col-md-6">
                    <label class="small mb-1" for="">ส่วนลด</label>
                    <input class="form-control" id="" type="text" name="pro_discount" placeholder="ส่วนลด" value="<?php echo $row['pro_discount'] ?>" required>
                </div>
                <!-- Form Group (last name)-->
                <div class="col-md-6">
                    <label class="small mb-1" for="">รายละเอียดโปรโมชั่น</label>
                    <input class="form-control" id="" type="text" name="pro_details" placeholder="รายละเอียดโปรโมชั่น" value="<?php echo $row['pro_details'] ?>" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="small mb-1" for="">วันที่เริ่มโปรโมชั่น</label>
                <input class="form-control" id="" type="date" name="pro_startdate" placeholder="วันที่เริ่มโปรโมชั่น" value="<?php echo $row['pro_startdate'] ?>">
            </div>
            <div class="mb-3">
                <label class="small mb-1" for="">วันที่สิ้นสุดโปรโมชั่น</label>
                <input class="form-control" id="" type="date" name="pro_enddate" placeholder="วันที่สิ้นสุดโปรโมชั่น" value="<?php echo $row['pro_enddate'] ?>">
            </div>
            <!-- Save changes button-->
            <button class="btn btn-primary" type="submit">บันทึกข้อมูล</button>
            <a href="sellervouchers.php" class="btn btn-danger">ยกเลิก</a>
        </div>
    </div>
</form>