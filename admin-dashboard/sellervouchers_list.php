<?php
if (@$_GET['do'] == 'success') {
    echo '<script type="text/javascript">
          swal("", "ทำรายการสำเร็จ !!", "success");
          </script>';
    echo '<meta http-equiv="refresh" content="1;url=product.php" />';
} else if (@$_GET['do'] == 'finish') {
    echo '<script type="text/javascript">
          swal("", "แก้ไขสำเร็จ !!", "success");
          </script>';
    echo '<meta http-equiv="refresh" content="1;url=product.php" />';
}

$query = "SELECT * FROM tb_product as p
INNER JOIN tb_type as t ON p.type_id = t.type_id
ORDER BY p.p_id DESC";

$stmt = $conn->query($query);
echo ' <table id="example1" class="table table-bordered table-striped">';
echo "<thead>";
echo "<tr class=''>
       <th width='10%' class='hidden-xs'>รูป</th>
       <th width='15%'>ชื่อสินค้า</th>
       <th width='15%'>ชื่อโปรโมชัน</th>
       <th width='5%'>ส่วนลด</th>
       <th width='30%' class='hidden-xs'>รายละเอียดโปรโมชัน</th>
       <th>วันที่เริ่มโปรโมชั่น</th>
       <th>วันที่สิ้นสุดโปรโมชั่น</th>
       <th width='3%'>-</th>
       <th width='3%'>-</th>
    </tr>";
echo "</thead>";
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>";
    // echo "<td  class='hidden-xs'>" . $row["p_id"] .  "</td> ";
    echo "<td class='hidden-xs'>" . "<img src='../p_img/" . $row['p_img'] . "' width='100%'>" . "</td>";
    echo "<td> ชื่อ: " . $row["p_name"] .
        "<br>ประเภท: <font color='blue'>" . $row["type_name"] . "</font>" .
        "</td class='hidden-xs'> ";
    echo "<td class='hidden-xs'>" . $row["pro_name"] . "</td> ";
    echo "<td class='hidden-xs'>" . $row["pro_discount"] . "</td> ";
    echo "<td class='hidden-xs'>" . $row["pro_details"] . "</td> ";
    echo "<td class='hidden-xs'>" . $row["pro_startdate"] . "</td> ";
    echo "<td class='hidden-xs'>" . $row["pro_enddate"] . "</td> ";
    echo "<td><a href='sellervouchers.php?act=edit&ID=$row[p_id]' class='btn btn-warning btn-sm'><span class='fas fa-edit'></span></a></td> ";
    echo "<td><a href='sellervouchers_del_db.php?ID=$row[p_id]' onclick=\"return confirm('ยันยันการลบ')\" class='btn btn-danger btn-sm'><span class='fas fa-trash-alt'></span></a></td> ";
    echo "</tr>";
}
echo "</table>";
