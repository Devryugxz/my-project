<?php
$ID = htmlspecialchars($_GET['ID']);
$sql = "SELECT * FROM tb_promotion WHERE p_id = :p_id";
$statement = $conn->prepare($sql);
$statement->bindParam(':p_id', $ID, PDO::PARAM_INT);
$statement->execute();

$result = $statement->fetch(PDO::FETCH_ASSOC);

$sql2 = "SELECT * FROM tb_promotion ORDER BY pro_id DESC";
$stmt2 = $conn->query($sql2);
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
    <div class="form-group">
        <div class="row">
            <div class="col-6">
                <div class="col-sm-12">
                    ชื่อสินค้า :
                </div>
                <div class="col-sm-12">
                    <input type="text" name="p_name" required class="form-control">
                </div>
            </div>
            <div class="col-6">
                <div class="col-sm-12">
                    รูปสินค้า :
                </div>
                <div class="col-sm-12">
                    <img src="../p_img/<?php echo $result['p_img']; ?>" width="150px" height="200px">
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-6">
                <div class="col-sm-12">
                    ชื่อโปรโมชั่น :
                </div>
                <div class="col-sm-12">
                    <input type="text" name="pro_name" required class="form-control">
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-6">
                <div class="col-sm-12">
                    ส่วนลด :
                </div>
                <div class="col-sm-12">
                    <input type="text" name="pro_discount" required class="form-control">
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-6">
                <div class="col-sm-12">
                    รายละเอียดโปรโมชั่น :
                </div>
                <div class="col-sm-12">
                    <textarea class="form-control" name="pro_details"></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-6">
                <div class="col-sm-12">
                    วันที่เริ่มโปรโมชั่น :
                </div>
                <div class="col-sm-12">
                    <input type="date" name="pro_startdate" required class="form-control">
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-6">
                <div class="col-sm-12">
                    วันที่สิ้นสุดโปรโมชั่น :
                </div>
                <div class="col-sm-12">
                    <input type="date" name="pro_enddate" required class="form-control">
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-12">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-success">เพิ่มข้อมูล</button>
                    <a href="sellervouchers.php" class="btn btn-danger">ยกเลิก</a>
                </div>
            </div>
        </div>
    </div>
</form>