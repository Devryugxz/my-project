<?php
session_start();
require_once('config/db.php');

if (!isset($_SESSION['customer'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ';
    header("location: login.php");
    exit();
}

try {
    // ดึงข้อมูลผู้ใช้จากฐานข้อมูล
    if (isset($_SESSION['customer'])) {
        $c_id = $_SESSION['customer'];
        $stmt = $conn->query("SELECT * FROM tb_customer WHERE c_id = $c_id");
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ตรวจสอบว่ามีการส่งข้อมูลฟอร์มมาหรือไม่
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // ดึงข้อมูลที่แก้ไขจากฟอร์ม
        $new_username = isset($_POST['username']) ? htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8') : $user['username'];
        $new_email = isset($_POST['email']) ? htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8') : $user['email'];
        $new_firstname = isset($_POST['firstname']) ? htmlspecialchars($_POST['firstname'], ENT_QUOTES, 'UTF-8') : $user['firstname'];
        $new_lastname = isset($_POST['lastname']) ? htmlspecialchars($_POST['lastname'], ENT_QUOTES, 'UTF-8') : $user['lastname'];
        $new_phone = isset($_POST['phone']) ? htmlspecialchars($_POST['phone'], ENT_QUOTES, 'UTF-8') : $user['phone'];
        // $new_address = isset($_POST['m_address']) ? htmlspecialchars($_POST['m_address'], ENT_QUOTES, 'UTF-8') : $user['m_address'];

        // ปรับปรุงข้อมูลในฐานข้อมูล
        $update_stmt = $conn->prepare("UPDATE tb_customer SET username = :username, email = :email, firstname = :firstname, lastname = :lastname, phone = :phone WHERE c_id = :c_id");
        $update_stmt->bindParam(':username', $new_username);
        $update_stmt->bindParam(':email', $new_email);
        $update_stmt->bindParam(':firstname', $new_firstname); // แก้เป็น ':firstname'
        $update_stmt->bindParam(':lastname', $new_lastname); // แก้เป็น ':lastname'
        $update_stmt->bindParam(':phone', $new_phone);
        $update_stmt->bindParam(':c_id', $c_id);


        if ($update_stmt->execute()) {
            echo "<script type='text/javascript'>";
            echo "alert('ข้อมูลถูกปรับปรุงเรียบร้อยแล้ว..');";
            echo "window.location = 'profile.php';";
            echo "</script>";
        } else {
            echo "เกิดข้อผิดพลาดในการปรับปรุงข้อมูล";
        }
    }
} catch (PDOException $e) {
    echo "เกิดข้อผิดพลาด: " . $e->getMessage();
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
                                <?php if (isset($user['m_img']) && $user['m_img']) : ?>
                                    <img src="../m_img/<?php echo $user['m_img']; ?>" width="200px">
                                <?php else : ?>
                                    <img src="../Image/no-photo-available.png" width="200px"> <!-- หรือเพิ่มภาพที่คุณต้องการแสดงเมื่อไม่มีภาพโปรไฟล์ -->
                                <?php endif; ?>
                                <h5 class="my-3"><!-- Inside the HTML code where you're accessing $user -->
                                    <?= isset($user['firstname']) ? $user['firstname'] : '' ?>
                                    <?= isset($user['lastname']) ? $user['lastname'] : '' ?>
                                </h5>
                                <!-- <p class="text-muted mb-1">ขนาดไฟล์: สูงสุด 1 MB</p>
                                <p class="text-muted mb-4">ไฟล์ที่รองรับ: .JPEG, .PNG</p> -->
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
                                        <p class="mb-0">ชื่อ</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <input class="form-control mb-3" type="text" id="firstname" name="firstname" value="<?= $user['firstname'] ?>">
                                    </div>
                                    <div class="col-sm-3">
                                        <p class="mb-0">นามสกุล</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" id="lastname" name="lastname" value="<?= $user['lastname'] ?>">
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
                                        <input class="form-control" type="text" id="phone" name="phone" value="<?= $user['phone'] ?>">
                                    </div>
                                </div>
                                <!-- <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">ที่อยู่</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" id="m_address" name="m_address" value="<?= $user['m_address'] ?>">
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mb-3">บันทึกข้อมูล</button>
                        <a href="../member/" class="btn btn-danger mb-3">ยกเลิก</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
</body>

</html>