<?php
session_start();
require_once 'config/db.php';

if (isset($_REQUEST['update_id'])) {
    try {
        $id = $_REQUEST['update_id'];
        $select_stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
        $select_stmt->bindParam(':id', $id);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
        extract($row);
    } catch (PDOException $e) {
        $e->getMessage();
    }
}

if (isset($_REQUEST['btnUpdate'])) {
    $firstname_up = $_REQUEST['firstname'];
    $lastname_up = $_REQUEST['lastname'];
    $email_up = $_REQUEST['email'];

    if (empty($firstname_up)) {
        $errorMsg = "กรุณากรอกชื่อ";
    } else if (empty($lastname_up)) {
        $errorMsg = "กรุณากรอกนามสกุล";
    } else if (empty($email_up)) {
        $errorMsg = "กรุณากรอกอีเมล";
    } else if (!filter_var($email_up, FILTER_VALIDATE_EMAIL)) {
        $errorMsg = "รูปแบบอีเมลไม่ถูกต้อง";
    } else {
        try {
            if (!isset($errorMsg)) {
                $update_stmt = $conn->prepare("UPDATE users SET firstname = :fname_up, lastname = :lname_up, email = :email_up WHERE id = :id");
                $update_stmt->bindParam(':fname_up', $firstname_up);
                $update_stmt->bindParam(':lname_up', $lastname_up);
                $update_stmt->bindParam(':email_up', $email_up);
                $update_stmt->bindParam(':id', $id);

                if ($update_stmt->execute()) {
                    $updateMsg = "อัพเดทข้อมูลสำเร็จ";
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
        <div class="display-3 text-center">Edit Users</div>

        <?php
        if (isset($errorMsg)) {
        ?>
            <div class="alert alert-warning">
                <strong>Wrong! <?= $errorMsg; ?></strong>
            </div>
        <?php } ?>

        <?php
        if (isset($updateMsg)) {
        ?>
            <div class="alert alert-success">
                <strong>Success! <?= $updateMsg; ?></strong>
            </div>
        <?php } ?>

        <form method="post" class="form-horizontal mt-5">
            <div class="form-group text-end">
                <div class="row">
                    <label for="firstname" class="col-sm-3 control-label">ชื่อ</label>
                    <div class="col-sm-9">
                        <input type="text" name="firstname" class="form-control" value="<?= $firstname; ?>">
                    </div>
                </div>
            </div>
            <div class="form-group text-end">
                <div class="row mt-3">
                    <label for="lastname" class="col-sm-3 control-label">นามสกุล</label>
                    <div class="col-sm-9">
                        <input type="text" name="lastname" class="form-control" value="<?= $lastname; ?>">
                    </div>
                </div>
            </div>
            <div class="form-group text-end">
                <div class="row mt-3">
                    <label for="email" class="col-sm-3 control-label">อีเมล</label>
                    <div class="col-sm-9">
                        <input type="text" name="email" class="form-control" value="<?= $email; ?>">
                    </div>
                </div>
            </div>
            <div class="form-group text-end">
                <div class="row mt-3">
                    <label for="urole" class="col-sm-3 control-label">สถานะ</label>
                    <div class="col-sm-9">
                        <input type="text" name="urole" class="form-control" disabled value="<?= $urole; ?>">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="col-md-12 mt-3">
                    <input type="submit" name="btnUpdate" class="btn btn-success" value="แก้ไขข้อมูล">
                    <a href="admin.php" class="btn btn-danger">ยกเลิก</a>
                </div>
            </div>
        </form>
    </div>

</body>

</html>