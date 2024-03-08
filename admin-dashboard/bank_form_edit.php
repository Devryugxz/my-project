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

            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<form action="bank_form_edit_db.php" method="post" class="form-horizontal" enctype="multipart/form-data">
    <section>
        <div class="pb-5">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Form Group (username)-->
                    <div class="mb-3">
                        <label class="small mb-1" for="">ชื่อนามสกุลตามที่ปรากฎในบัญชีธนาคาร</label>
                        <input class="form-control" id="" type="text" name="b_owner" placeholder="ชื่อนามสกุลตามที่ปรากฎในบัญชีธนาคาร" value="<?php echo $row['b_owner'] ?>" required>
                    </div>
                    <!-- Form Row-->
                    <div class="row gx-3 mb-3">
                        <!-- Form Group (first name)-->
                        <div class="col-md-6">
                            <label class="small mb-1" for="">ชื่อธนาคาร</label>
                            <input class="form-control" id="" type="text" name="b_name" placeholder="ชื่อธนาคาร" value="<?php echo $row['b_name'] ?>" required>
                        </div>
                        <!-- Form Group (last name)-->
                        <div class="col-md-6 mb-3">
                            <label class="small mb-1" for="">เลขที่บัญชี</label>
                            <input class="form-control" id="" type="text" name="b_number" placeholder="เลขที่บัญชี" value="<?php echo $row['b_number'] ?>" required>
                        </div>

                    </div>
                    <div class="card-header text-center">QR Code</div>
                    <div class="card-body text-center">
                        <!-- Profile picture image-->
                        <img src="../b_logo/<?php echo $row['b_logo']; ?>" class="img-rounded" style="margin-top: 10px;" width="200px">
                        <img id="blah" src="#" alt="" width="200" class="img-rounded" style="margin-top: 10px;">
                        <input type="file" required name="b_logo" class="form-control" accept="image/*"
                            onchange="readURL(this);" />
                    </div>

                    <input type="hidden" name="b_logo2" value="<?php echo $row['b_logo']; ?>">
                    <input type="hidden" name="b_id" value="<?php echo $ID; ?>">

                    <!-- Save changes button-->
                    <button class="btn btn-primary" type="submit">บันทึกข้อมูล</button>
                    <a href="bank.php" class="btn btn-danger">ยกเลิก</a>
                </div>
            </div>
        </div>
    </section>
</form>