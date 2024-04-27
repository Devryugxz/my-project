<style>
    th.center {
        text-align: center;
    }
    td.center {
        text-align: center;
    }
</style>

<?php

try {
    $conn = new PDO("mysql:host=localhost;dbname=mango_distribution_db", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (@$_GET['do'] == 'success') {
        echo "<script type='text/javascript'>
            swal('', 'ทำรายการสำเร็จ !!', 'success');
            </script>";
        echo "<meta http-equiv='refresh' content='1;url=shipping.php' />";
    } else if (@$_GET['do'] == 'finish') {
        echo "<script type='text/javascript'>
            swal('', 'แก้ไขสำเร็จ !!', 'success');
            </script>";
        echo "<meta http-equiv='refresh' content='1;url=shipping.php' />";
    } else if (@$_GET['do'] == 'wrong') {
        echo "<script type='text/javascript'>
            swal('', 'รหัสผ่านใหม่ไม่ตรงกัน !!', 'warning');
            </script>";
        echo "<meta http-equiv='refresh' content='1;url=shipping.php' />";
    } else if (@$_GET['do'] == 'error') {
        echo "<script type='text/javascript'>
            swal('', 'ผิดพลาด !!', 'error');
            </script>";
        echo "<meta http-equiv='refresh' content='1;url=shipping.php' />";
    }

    $query = "SELECT * FROM tb_shipping ORDER BY ship_id DESC";
    $stmt = $conn->query($query);

    echo ' <table id="example1" class="table table-bordered table-striped">';
    echo "<thead>";
    echo "<tr class=''>
      <th width='5%'>ID</th>
      <th>ราคาค่าส่ง</th>
      <th class='center' width='5%'>-</th>
      <th class='center' width='5%'>-</th>
    </tr>";
    echo "</thead>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row["ship_id"] .  "</td> ";
        echo "<td>" . $row["ship_price"] .  "</td> ";
        echo "<td class='center'><a href='shipping.php?act=edit&ID=$row[ship_id]' class='btn btn-warning btn-sm'><span class='fa fa-edit'></span></a>         
    </td> ";
        echo "<td class='center'><a href='shipping_del_db.php?ID=$row[ship_id]' onclick=\"return confirm('ยันยันการลบ')\" class='btn btn-danger btn-sm'><span class='fas fa-trash-alt'></span></a></td> ";
        echo "</tr>";
    }
    echo "</table>";
} catch (PDOException $e) {
    echo "เกิดข้อผิดพลาด: " . $e->getMessage();
}

?>
