<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มโปรโมชั่นและส่วนลด</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
    
            
    <div class="container text-center">
        <p></p> <br>
        <h1>เพิ่มโปรโมชั่นและส่วนลด</h1>
        <p></p>
        <?php if(isset($_SESSION['error'])) : ?>
                        <div class="alert alert-danger">
                            <h3>
                                <?php 
                                    echo $_SESSION['error'];
                                    unset($_SESSION['error']);
                                ?>
                            </h3>
                        </div>
            <?php endif ?>

        <?php 
            if(isset($insertMsg)) {
        ?>
            <div class="alert alert-success">
                <strong><?php echo $insertMsg; ?></strong>
            </div>
        <?php } ?>

        <form action="sellervouchers_form_add_db.php" method="post" class="form-horizontal" enctype="multipart/form-data">
        <div class="form-group">
        <div class="row">
            <label for="name" class="col-sm-3 control-label">รูปสินค้า</label>
            <div class="col-sm-9">
                <p>
                <img src="../p_img/<?php echo $row['p_img']; ?>" width="150px" height="200px" alt="">
                </p>
      
            </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
            <label for="name" class="col-sm-3 control-label">ชื่อสินค้า</label>
            <div class="col-sm-9">
                <input type="text" name="p_name" class="form-control" value="<?php echo $row['p_name']; ?>" placeholder="กรอกชื่อหนังสือ">
            </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
            <label for="name" class="col-sm-3 control-label">ชื่อโปรโมชั่น</label>
            <div class="col-sm-9">
                <input type="text" name="pro_name" class="form-control" placeholder="ชื่อโปรโมชั่น">
            </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
            <label for="name" class="col-sm-3 control-label">ส่วนลด</label>
            <div class="col-sm-9">
                <input type="text" name="pro_discount" class="form-control" placeholder="กรอกส่วนลด %">
            </div>
            </div>
        </div>

        
        <div class="form-group">
            <div class="row">
            <label for="name" class="col-sm-3 control-label">รายละเอียดโปรโมชั่น</label>
            <div class="col-sm-9">
                <input type="text" name="pro_details" class="form-control" placeholder="กรอกรายละเอียดโปรโมชั่น">
            </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
            <label for="name" class="col-sm-3 control-label">วันที่เริ่ม </label>
            <div class="col-sm-9">
                <input type="date" name="pro_start" class="form-control" placeholder="กรอกวันที่เริ่มโปรโมชั่น">
            </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
            <label for="name" class="col-sm-3 control-label">วันที่สิ้นสุด </label>
            <div class="col-sm-9">
                <input type="date" name="pro_end" class="form-control" placeholder="กรอกวันที่สิ้นสุดโปรโมชั่น">
            </div>
            </div>
        </div>
 
        <br>

        <div class="form-group">
            <div class="col-sm-12">
                <input type="submit" name="btn_insert" class="btn btn-success" value="เพิ่ม">
                <a href="sellervouchers.php" class="btn btn-danger">ยกเลิก</a>
            </div>
        </div>
    </form> 
    

    

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>