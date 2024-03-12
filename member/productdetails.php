<?php
session_start();
require_once('config/db.php');

$p_id = $_GET["id"];
?>

<!DOCTYPE html>

<head>
    <?php include('header.php'); ?>
    <style>
        .item {
            position: relative;
            margin: 2%;
            overflow: hidden;
            width: 540px;
        }

        .item img {
            max-width: 100%;

            -moz-transition: all 0.3s;
            -webkit-transition: all 0.3s;
            transition: all 0.3s;
        }

        .item:hover img {
            -moz-transform: scale(1.1);
            -webkit-transform: scale(1.1);
            transform: scale(1.3);
        }
    </style>

</head>

<body>
    <?php include('menutop.php'); ?>
    <?php

    $stmt = $conn->prepare("SELECT * FROM tb_product as p INNER JOIN tb_type as t ON p.type_id = t.type_id WHERE p.p_id = :p_id");
    $stmt->bindParam(':p_id', $p_id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $sql_last_view = "SELECT p_view FROM tb_product WHERE p_id = :p_id";
    $stmt_last_view = $conn->prepare($sql_last_view);
    $stmt_last_view->bindParam(':p_id', $p_id, PDO::PARAM_STR);
    $stmt_last_view->execute();
    $row_last_view = $stmt_last_view->fetch(PDO::FETCH_ASSOC);

    $last_view = $row_last_view['p_view'] + 1;
    $update_view = "UPDATE tb_product SET p_view = :last_view WHERE p_id = :p_id";
    $stmt_update_view = $conn->prepare($update_view);
    $stmt_update_view->bindParam(':last_view', $last_view, PDO::PARAM_INT);
    $stmt_update_view->bindParam(':p_id', $p_id, PDO::PARAM_STR);
    $stmt_update_view->execute();

    if (!$row) {
        die('ไม่พบข้อมูลสินค้าที่ค้นหา');
    }
    ?>
    <div class="container">
        <!-- Product section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 my-5">
                <form action="cart.php?action=add&p_id=<?php echo $row['p_id']; ?>" method="post">
                    <div class="row gx-4 gx-lg-5 align-items-center">
                        <div class="col-md-6 item" id='ex1'>
                            <a class="card-img-top mb-5 mb-md-0"><?php echo "<img src='../p_img/" . $row['p_img'] . "'width='100%'>"; ?></a>
                        </div>
                        <div class="col-md-6">
                            <div class="fs-5 mb-5">
                                <span><?php echo $row["p_name"]; ?></span>
                                <h3><?php echo $row["p_price"]; ?>บาท</h3>
                                <span>จำนวนการเข้าชม <?php echo $row["p_view"]; ?> ครั้ง</span>
                            </div>

                            <h3 class="fw-bolder">รายละเอียดสินค้า</h3>
                            <p class="lead"><?php echo $row["p_detail"]; ?></p>
                            <p><?php echo $row["type_name"]; ?></p>

                            <div class="d-flex">
                                <input class="form-control text-center me-3" id="inputQuantity" name="p_qty" type="text" value="1" style="max-width: 3rem" />
                                คงเหลือ <font color=""> <?php echo $row["p_qty"]; ?> <?php echo $row["p_unit"]; ?> </font>
                            </div>
                            <input class="btn btn-warning" type="submit" value="เพิ่มลงตะกร้า" class="btnAddAction">
                        </div>
                    </div>
                </form>
            </div>
        </section>

        <!-- Related items section-->
        <section class="py-5 bg-light">
            <div class="container px-4 px-lg-5 mt-5">
                <h2 class="fw-bolder mb-4">สินค้าแนะนำ</h2>
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="...">
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">ชื่อสินค้า</h5>
                                    <!-- Product price-->
                                    ราคาต่อหน่วย
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="productdetails.php">รายละเอียดสินค้า</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Sale badge-->
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">
                                Sale</div>
                            <!-- Product image-->
                            <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="...">
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">ชื่อสินค้า</h5>
                                    <!-- Product reviews-->
                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                    </div>
                                    <!-- Product price-->
                                    <span class="text-muted text-decoration-line-through"></span>
                                    ราคาต่อหน่วย
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="productdetails.php">รายละเอียดสินค้า</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Sale badge-->
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">
                                Sale</div>
                            <!-- Product image-->
                            <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="...">
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">ชื่อสินค้า</h5>
                                    <!-- Product price-->
                                    <span class="text-muted text-decoration-line-through"></span>
                                    ราคาต่อหน่วย
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="productdetails.php">รายละเอียดสินค้า</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="...">
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">ชื่อสินค้า</h5>
                                    <!-- Product reviews-->
                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                    </div>
                                    <!-- Product price-->
                                    ราคาต่อหน่วย
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="productdetails.php">รายละเอียดสินค้า</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <?php include('footer.php'); ?>
</body>

</html>