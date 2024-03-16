<table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
    <!-- <caption>จำนวนสินค้า</caption> -->
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">รูป</th>
            <th scope="col">ชื่อสินค้า</th>
            <th scope="col">รายละเอียดสินค้า</th>
            <th scope="col">ราคาสินค้า</th>
            <th scope="col">จำนวนเข้าชม</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">รูป</th>
            <th scope="col">ชื่อสินค้า</th>
            <th scope="col">รายละเอียดสินค้า</th>
            <th scope="col">ราคาสินค้า</th>
            <th scope="col">จำนวนเข้าชม</th>
        </tr>
    </tfoot>
    <tbody>
        <?php
        $select_stmt = $conn->prepare("SELECT * FROM tb_product as p INNER JOIN tb_type as t ON p.type_id = t.type_id ORDER BY p.p_id DESC");
        $select_stmt->execute();

        $products = $select_stmt->fetchAll();

        if (!$products) {
            echo "<tr><td colspan='9' class='text-center'><h4>ไม่มีข้อมูลสินค้า</h4></td></tr>";
        } else {
            foreach ($products as $product) {
        ?>
                <tr>
                    <td class='hidden-xs'><?= $product["p_id"] ?></td>
                    <td class='hidden-xs'><img src='../p_img/<?= $product['p_img'] ?>' width='100%' height="100px" style="object-fit: cover;"></td>
                    <td> ชื่อ: <?= $product["p_name"] ?><br>ประเภท: <font color='blue'>
                            <?= $product["type_name"] ?></font>
                    </td>
                    <td class='hidden-xs'><?= $product["p_detail"] ?></td>
                    <td> ราคา <?= $product["p_price"] ?> บาท<br>จำนวน
                        <?= $product["p_qty"] ?> <?= $product["p_unit"] ?></td>
                    <td> จำนวนการเข้าชม <?= $product["p_view"] ?> ครั้ง<br>วันที่
                        <?= date('d/m/Y', strtotime($product["datesave"])) ?></td>

                    <td><a href="sellervouchers_form_add.php?add_id=<?php echo $product['p_id']; ?>" class="btn btn-info btn-sm">เพิ่มโปรโมชั่น</a></td>

            <?php }
        } ?>
    </tbody>
</table>