<?php
session_start();

require_once('config/db.php');

if (!isset($_SESSION['member'])) {
    header("location: login.php");
}

//สร้างเงื่อนไขตรวจสอบถ้ามีการค้นหาให้แสดงเฉพาะรายการค้นหา
if (isset($_GET['search']) && $_GET['search'] != '') {

    //ประกาศตัวแปรรับค่าจากฟอร์ม
    $search = "%{$_GET['search']}%";

    //คิวรี่ข้อมูลมาแสดงจากการค้นหา
    $stmt = $conn->prepare("SELECT* FROM tb_product WHERE p_name LIKE ?");
    $stmt->execute([$search]);
    $stmt->execute();
    $result = $stmt->fetchAll();
} else {
    //คิวรี่ข้อมูลมาแสดงตามปกติ *แสดงทั้งหมด
    $stmt = $conn->prepare("SELECT* FROM tb_product");
    $stmt->execute();
    $result = $stmt->fetchAll();
}
?>


<!DOCTYPE html>

<head>
    <?php include('header.php'); ?>
</head>

<body>
    <?php include('menutop.php'); ?>
    <div>
        <div class="nav-wrapper">
            <div class="container">
                <div class="d-flex bd-highlight">
                    <?php

                    if (isset($_SESSION['member'])) {
                        $user_id = $_SESSION['member'];
                        $stmt = $conn->query("SELECT * FROM tb_users WHERE id = $user_id");
                        $stmt->execute();
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    }

                    ?>
                </div>
            </div>
        </div>

        <section class="py-5 bg-light">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row py-lg-3">
                    <div class="col-lg-6 col-md-8 mx-auto">
                        <h1 class="fw-light">สินค้าแนะนำ</h1>
                        <form action="sh_products.php" method="get">
                            <div class="input-group mb-3">
                                <input required type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" name="search" value="<?php if (isset($_GET['search'])) {
                                                                                                                                                                                                echo $_GET['search'];
                                                                                                                                                                                            } ?>" />
                                <button type="submit" class="btn btn-outline-primary" data-mdb-ripple-init>search</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <?php

                    foreach ($result as $row) {

                    ?>
                        <div class="col mb-5">
                            <form action="cart.php?action=add&code=<?php echo $row["p_id"]; ?>" method="post">
                                <div class="card h-100">
                                    <!-- Product image-->
                                    <img class="card-img-top">
                                    <a href="" style="object-fit: cover;">
                                        <?php echo "<img src='../p_img/" . $row['p_img'] . "'width='100%' height='150px'>"; ?></a>
                                    <!-- Product details-->
                                    <div class="card-body p-4">
                                        <div class="text-center">
                                            <!-- Product name-->
                                            <h5 class="fw-bolder"><?php echo $row["p_name"]; ?></h5>
                                            <!-- Product price-->
                                            <?php echo "฿ " . $row["p_price"]; ?>
                                        </div>
                                    </div>
                                    <!-- Product actions-->
                                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                        <div class="text-center">
                                            <input type="text" class="product_qty form-control text-center mb-3" name="quantity" value="1" size="2">
                                            <input type="submit" value="เพิ่มไปยังรถเข็น" class="btnAddAction">
                                        </div>
                                    </div>
                                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="productdetails.php">รายละเอียดสินค้า</a></div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    <?php

                    }
                    ?>
                </div>
            </div>
        </section>

        <?php include('footer.php'); ?>
    </div>
</body>

</html>