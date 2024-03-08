<?php
$ID = htmlspecialchars($_GET['ID']);
$sql = "SELECT * FROM tb_product as p 
INNER JOIN tb_type as t ON p.type_id = t.type_id
WHERE p_id=:p_id
ORDER BY p.p_id DESC";

$statement = $conn->prepare($sql);
$statement->bindParam(':p_id', $ID, PDO::PARAM_INT);
$statement->execute();

$result = $statement->fetch(PDO::FETCH_ASSOC);

$sql2 = "SELECT * FROM tb_type ORDER BY type_id DESC";
$stmt2 = $conn->query($sql2);
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

<form action="product_form_edit_db.php" method="post" class="form-horizontal" enctype="multipart/form-data">
    <div class="form-group">
        <div class="col-sm-2 control-label">
            ชื่อสินค้า :
        </div>
        <div class="col-sm-3">
            <input type="text" name="p_name" required class="form-control" value="<?php echo $result['p_name']; ?>">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">
            ประเภทสินค้า :
        </div>
        <div class="col-sm-3">
            <select name="type_id" class="form-control" required>
                <option value="<?php echo $result['type_id']; ?>"><?php echo $result['type_name']; ?></option>
                <option value="">เลือกประเภทสินค้า</option>
                <?php foreach ($stmt2 as $type) { ?>
                    <option value="<?php echo $type["type_id"]; ?>">
                        <?php echo $type["type_name"]; ?>
                    </option>
                <?php } ?>
            </select>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">
            รายละเอียด :
        </div>
        <div class="col-sm-3">
            <textarea name="p_detail" cols="60"><?php echo $result['p_detail']; ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">
            ราคา :
        </div>
        <div class="col-sm-2">
            <input type="number" name="p_price" required class="form-control" value="<?php echo $result['p_price']; ?>">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">
            จำนวน :
        </div>
        <div class="col-sm-1">
            <input type="number" name="p_qty" required class="form-control" value="<?php echo $result['p_qty']; ?>">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">
            หน่วย :
        </div>
        <div class="col-sm-1">
            <select name="p_unit" id="p_unit" required>
                <option value=""><?php echo $result["p_unit"]; ?></option>
                <option value="">กรุณาเลือก</option>
                <option value="ชิ้น">ชิ้น</option>
                <option value="กล่อง">กล่อง</option>
                <option value="อัน">อัน</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">
            รูปภาพสินค้า :
        </div>
        <div class="col-sm-4">
            ภาพเก่า <br>
            <img src="../p_img/<?php echo $result['p_img']; ?>" width="200px">
            <br>
            <input type="file" name="p_img" required class="form-control" accept="image/*" onchange="readURL(this);" />
            <img id="blah" src="#" alt="" width="250" class="img-rounded" style="margin-top: 10px;">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-3">
            <input type="hidden" name="p_img2" value="<?php echo $result['p_img']; ?>">
            <input type="hidden" name="p_id" value="<?php echo $ID; ?>" />
            <button type="submit" class="btn btn-success">แก้ไขข้อมูล</button>
            <a href="product.php" class="btn btn-danger">ยกเลิก</a>
        </div>
    </div>
</form>
