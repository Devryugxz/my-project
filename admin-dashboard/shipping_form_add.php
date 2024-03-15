<?php
if (@$_GET['do'] == 'f') {
    echo '<script type="text/javascript">
            swal("", "กรุณาใส่ข้อมูลให้ถูกต้อง !!", "warning");
            </script>';
    echo '<meta http-equiv="refresh" content="2;url=shipping.php?act=add" />';
} elseif (@$_GET['do'] == 'd') {
    echo '<script type="text/javascript">
            swal("", "ข้อมูลซ้ำ กรุณาเปลี่ยน  !!", "error");
            </script>';
    echo '<meta http-equiv="refresh" content="1;url=shipping.php?act=add" />';
}
?>

<form action="shipping_form_add_db.php" method="post" class="form-horizontal">
    <div class="form-group">
        <div class="col-sm-12 control-label">
            ค่าส่ง :
        </div>
        <div class="col-sm-12">
            <input type="text" name="ship_price" class="form-control" minlength="2" required>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-12">
        </div>
        <div class="col-sm-12">
            <button type="submit" class="btn btn-success">เพิ่มข้อมูล</button>
            <a href="shipping.php" class="btn btn-danger">ยกเลิก</a>
        </div>
    </div>
</form>