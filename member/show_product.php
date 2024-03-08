<section class="py-3 text-center container">
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
</section>

<div class="container">

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <?php
        // ดึงข้อมูลจากฐานข้อมูล
        $stmt = $conn->prepare("SELECT * FROM tb_product as p INNER JOIN tb_type as t ON p.type_id = t.type_id ORDER BY p.p_id ASC");
        $stmt->execute();

        // ตรวจสอบว่ามีข้อมูลหรือไม่
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        ?>
                <div class="col">
                    <div class="card shadow-sm">
                        <a href="productdetails.php?id=<?php echo $row["p_id"]; ?>"><?php echo "<img src='../p_img/" . $row['p_img'] . "'width='100%' height='200px'>"; ?></a>
                        <div class="card-body">
                            <h5 class="fw-bolder">
                                <a href="productdetails.php?id=<?php echo $row["p_id"]; ?>"><?php echo $row["p_name"]; ?></a>
                            </h5>
                            <p class="card-text"><?php echo $row["p_detail"]; ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary"><a href="productdetails.php?id=<?php echo $row["p_id"]; ?>">รายละเอียดสินค้า</a></button>                                   
                                </div>
                                <h5 class="text-body-secondary">ราคา <font color=""> <?php echo $row["p_price"]; ?> </font> บาท</h5>
                                <small class="text-body-secondary">การเข้าชม  <?php echo $row["p_view"];?> ครั้ง</small>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>
</div>