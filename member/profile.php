<?php
session_start();
require_once('config/db.php');

if (!isset($_SESSION['customer'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ';
    header("location: login.php");
}

// ดึงข้อมูลผู้ใช้จากฐานข้อมูล
if (isset($_SESSION['customer'])) {
    $m_id = $_SESSION['customer'];
    $stmt = $conn->query("SELECT * FROM tb_users WHERE id = $m_id");
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}

// ตรวจสอบว่ามีการส่งข้อมูลฟอร์มมาหรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ดึงข้อมูลที่แก้ไขจากฟอร์ม
    $new_username = isset($_POST['username']) ? htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8') : $user['username'];
    $new_email = isset($_POST['email']) ? htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8') : $user['email'];
    $new_name = isset($_POST['m_name']) ? htmlspecialchars($_POST['m_name'], ENT_QUOTES, 'UTF-8') : $user['m_name'];
    $new_tel = isset($_POST['m_tel']) ? htmlspecialchars($_POST['m_tel'], ENT_QUOTES, 'UTF-8') : $user['m_tel'];
    $new_address = isset($_POST['m_address']) ? htmlspecialchars($_POST['m_address'], ENT_QUOTES, 'UTF-8') : $user['m_address'];

    // ปรับปรุงข้อมูลในฐานข้อมูล
    $update_stmt = $conn->prepare("UPDATE tb_users SET username = :username, email = :email, m_name = :m_name, m_tel = :m_tel, m_address = :m_address WHERE id = :id");
    $update_stmt->bindParam(':username', $new_username);
    $update_stmt->bindParam(':email', $new_email);
    $update_stmt->bindParam(':m_name', $new_name);
    $update_stmt->bindParam(':m_tel', $new_tel);
    $update_stmt->bindParam(':m_address', $new_address);
    $update_stmt->bindParam(':id', $m_id);

    if ($update_stmt->execute()) {
        echo "ข้อมูลถูกปรับปรุงเรียบร้อยแล้ว";
        // สามารถทำการ redirect หรือแสดงข้อความอื่น ๆ ตามต้องการ
    } else {
        echo "เกิดข้อผิดพลาดในการปรับปรุงข้อมูล";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>

    <!--bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</head>

<body>
    <section style="background-color: #eee;">
        <div class="container py-5">
            <form method="post">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card mb-4">
                            <div class="card-body text-center">
                                <img src="../m_img/<?php echo $user['m_img']; ?>" width="200px">
                                <h5 class="my-3"><?= $user['m_name'] ?></h5>
                                <p class="text-muted mb-1">ขนาดไฟล์: สูงสุด 1 MB</p>
                                <p class="text-muted mb-4">ไฟล์ที่รองรับ: .JPEG, .PNG</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">ชื่อผู้ใช้</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" id="username" name="username" value="<?= $user['username'] ?>">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">ชื่อ-นามสกุล</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" id="m_name" name="m_name" value="<?= $user['m_name'] ?>">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">อีเมล์</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="email" id="email" name="email" value="<?= $user['email'] ?>">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">เบอร์โทรศัพท์</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" id="m_tel" name="m_tel" value="<?= $user['m_tel'] ?>">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">ที่อยู่</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" id="m_address" name="m_address" value="<?= $user['m_address'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mb-3">บันทึกข้อมูล</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</body>

</html>