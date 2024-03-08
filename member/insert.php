<?php
session_start();
require_once 'config/db.php';

if (isset($_REQUEST['btnInsert'])) {
    $firstname = $_REQUEST['firstname'];
    $lastname = $_REQUEST['lastname'];
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    $r_password = $_REQUEST['r_password'];
    $urole = 'user';

    if (empty($firstname)) {
        $errorMsg = "กรุณากรอกชื่อ";
    } else if (empty($lastname)) {
        $errorMsg = "กรุณากรอกนามสกุล";
    } else if (empty($email)) { 
        $errorMsg = "กรุณากรอกอีเมล";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMsg = "รูปแบบอีเมลไม่ถูกต้อง";
    } else if (empty($password)) {
        $errorMsg = "กรุณากรอกรหัสผ่าน";
    } else if (strlen($_REQUEST['password']) > 20 || strlen($_REQUEST['password']) < 5) {
        $errorMsg = "รหัสผ่านต้องมีความยาวระหว่าง 5 ถึง 20 ตัวอักษร";
    } else if (empty($r_password)) {
        $errorMsg = "กรุณายืนยันรหัสผ่าน";
    } else if ($password != $r_password) {
        $errorMsg = "รหัสผ่านไม่ตรงกัน";
    } else {
        try {

            if (!isset($errorMsg)) {
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                $insert_stmt = $conn->prepare("INSERT INTO users(firstname, lastname, email, password, urole) VALUE (:firstname, :lastname, :email, :password, :urole)");
                $insert_stmt->bindParam(":firstname", $firstname);
                $insert_stmt->bindParam(":lastname", $lastname);
                $insert_stmt->bindParam(":email", $email);
                $insert_stmt->bindParam(":password", $passwordHash);
                $insert_stmt->bindParam(":urole", $urole);

                if ($insert_stmt->execute()) {
                    $insertMsg = "เพิ่มข้อมูลสำเร็จ";
                    header("refresh:2;admin.php");
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert</title>

    <!--bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <link rel="icon" type="image/x-icon" href="Image/logo.ico">

    <link rel="stylesheet" href="main.css">
</head>

<body>

    <div class="container">
        <div class="display-3 text-center">Add Users</div>

        <?php
        if (isset($errorMsg)) {
        ?>
            <div class="alert alert-warning">
                <strong>Wrong! <?= $errorMsg; ?></strong>
            </div>
        <?php } ?>

        <?php
        if (isset($insertMsg)) {
        ?>
            <div class="alert alert-success">
                <strong>Success! <?= $insertMsg; ?></strong>
            </div>
        <?php } ?>

        <form method="post" class="form-horizontal mt-5">
            <div class="form-group text-end">
                <div class="row">
                    <label for="firstname" class="col-sm-3 control-label">ชื่อ</label>
                    <div class="col-sm-9">
                        <input type="text" name="firstname" class="form-control" placeholder="ชื่อ">
                    </div>
                </div>
            </div>
            <div class="form-group text-end">
                <div class="row mt-3">
                    <label for="lastname" class="col-sm-3 control-label">นามสกุล</label>
                    <div class="col-sm-9">
                        <input type="text" name="lastname" class="form-control" placeholder="นามสกุล">
                    </div>
                </div>
            </div>
            <div class="form-group text-end">
                <div class="row mt-3">
                    <label for="email" class="col-sm-3 control-label">อีเมล</label>
                    <div class="col-sm-9">
                        <input type="text" name="email" class="form-control" placeholder="อีเมล">
                    </div>
                </div>
            </div>
            <div class="form-group text-end">
                <div class="row mt-3">
                    <label for="password" class="col-sm-3 control-label">รหัสผ่าน</label>
                    <div class="col-sm-9">
                        <input type="password" name="password" class="form-control" placeholder="รหัสผ่าน">
                    </div>
                </div>
            </div>
            <div class="form-group text-end">
                <div class="row mt-3">
                    <label for="r_password" class="col-sm-3 control-label">ยืนยันรหัสผ่าน</label>
                    <div class="col-sm-9">
                        <input type="password" name="r_password" class="form-control" placeholder="ยืนยันรหัสผ่าน">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="col-md-12 mt-3">
                    <input type="submit" name="btnInsert" class="btn btn-success" value=เพิ่มข้อมูล>
                    <a href="admin.php" class="btn btn-danger">ยกเลิก</a>
                </div>
            </div>
        </form>
    </div>

</body>

</html>