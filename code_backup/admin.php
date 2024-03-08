<?php
session_start();
require_once 'config/db.php';
if (!isset($_SESSION['admin_login'])) {
    header("location: login.php");
}

if (isset($_REQUEST['delete_id'])) {
    $id = $_REQUEST['delete_id'];

    $select_stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
    $select_stmt->bindParam(':id', $id);
    $select_stmt->execute();
    $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

    // Del record
    $del_stmt = $conn->prepare("DELETE FROM users WHERE id = :id");
    $del_stmt->bindParam(':id', $id);
    $del_stmt->execute();

    header('location: admin.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

    <!--bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="main.css">

</head>

<body>

    <!-- Modal 
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Add User</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="insert.php" method="post">
                <div class="md-3">
                    <label for="firstname"></label>
                    <input class="form-control" type="text" id="firstname" name="firstname" placeholder="ชื่อ" require>
                </div>
                <div class="md-3">
                    <label for="lastname"></label>
                    <input class="form-control" type="text" id="lastname" name="lastname" placeholder="นามสกุล" require>
                </div>
                <div class="md-3">
                    <label for="email"></label>
                    <input class="form-control" type="text" id="email" name="email" placeholder="อีเมล" require>
                </div>
                <div class="md-3">
                    <label for="password"></label>
                    <input class="form-control" type="password" id="password" name="password" placeholder="รหัสผ่าน" require>
                </div>
                <div class="md-3">
                    <label for="repeatpassword"></label>
                    <input class="form-control" type="password" id="r_password" name="r_password" placeholder="ยืนยันรหัสผ่าน" require>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="btnInsert" class="btn btn-success">เพิ่มข้อมูล</button>
        </div>
        </div>
    </div>
    </div>-->

    <div class="container">
        <?php

        if (isset($_SESSION['admin_login'])) {
            $admin_id = $_SESSION['admin_login'];
            $stmt = $conn->query("SELECT * FROM users WHERE id = $admin_id");
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        ?>

        <h3 class="mt-4">Welcome, Admin <?= $row['firstname'] . ' ' . $row['lastname'] ?> </h3>

        <a href="logout.php" class="btn btn-danger">ออกจากระบบ</a>
        <div class="row mt-5">
            <div class="col-md-6">
                <h3>ข้อมูล</h3>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <a href="insert.php" class="btn btn-success">เพิ่มข้อมูล</a>
                <!--<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal">Add Users</button>-->
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <!--<th scope="col">#</th>-->
                    <th scope="col">Firstname</th>
                    <th scope="col">Lastname</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $conn->query("SELECT * FROM users");
                $stmt->execute();

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                ?>
                    <tr>
                        <!--<th scope="row"><?= $row['id'] ?></th>-->
                        <td><?= $row['firstname'] ?></td>
                        <td><?= $row['lastname'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td><?= $row['urole'] ?></td>
                        <td>
                            <a href="edit.php?update_id=<?= $row['id']; ?>" class="btn btn-warning">แก้ไข</a>
                            <a href="?delete_id=<?= $row['id']; ?>" class="btn btn-danger" onclick="return confirm('กรุณายืนยันการลบข้อมูล');">ลบ</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>
</body>

</html>