<?php

try {
    $conn = new PDO("mysql:host=localhost;dbname=mango_distribution_db", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (@$_GET['do'] == 'success') {
        echo "<script type='text/javascript'>
            swal('', 'ทำรายการสำเร็จ !!', 'success');
            </script>";
        echo "<meta http-equiv='refresh' content='1;url=type.php' />";
    } else if (@$_GET['do'] == 'finish') {
        echo "<script type='text/javascript'>
            swal('', 'แก้ไขสำเร็จ !!', 'success');
            </script>";
        echo "<meta http-equiv='refresh' content='1;url=type.php' />";
    } else if (@$_GET['do'] == 'wrong') {
        echo "<script type='text/javascript'>
            swal('', 'รหัสผ่านใหม่ไม่ตรงกัน !!', 'warning');
            </script>";
        echo "<meta http-equiv='refresh' content='1;url=type.php' />";
    } else if (@$_GET['do'] == 'error') {
        echo "<script type='text/javascript'>
            swal('', 'ผิดพลาด !!', 'error');
            </script>";
        echo "<meta http-equiv='refresh' content='1;url=type.php' />";
    }

    $query = "SELECT * FROM tb_type ORDER BY type_id DESC";
    $stmt = $conn->query($query);

    echo ' <table id="example1" class="table table-bordered table-striped">';
    echo "<thead>";
    echo "<tr class=''>
      <th width='5%'>ID</th>
      <th>ประเภทสินค้า</th>
      <th width='5%'>-</th>
      <th width='5%'>-</th>
    </tr>";
    echo "</thead>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row["type_id"] .  "</td> ";
        echo "<td>" . $row["type_name"] .  "</td> ";
        echo "<td><a href='type.php?act=edit&ID=$row[type_id]' class='btn btn-warning btn-xs fas fa-times-circle'><span class='glyphicon glyphicon-edit'></span></a>         
    </td> ";
        echo "<td><a href='type_del_db.php?ID=$row[type_id]' onclick=\"return confirm('ยันยันการลบ')\" class='btn btn-danger btn-xs fas fa-trash-alt'><span class='glyphicon glyphicon-trash'></span></a></td> ";
        echo "</tr>";
    }
    echo "</table>";
} catch (PDOException $e) {
    echo "เกิดข้อผิดพลาด: " . $e->getMessage();
}

?>
