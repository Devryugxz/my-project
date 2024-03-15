<?php 
try {
    $conn = new PDO("mysql:host=localhost;dbname=mango_distribution_db", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(@$_GET['do']=='success'){
        echo '<script type="text/javascript">
              swal("", "ทำรายการสำเร็จ !!", "success");
              </script>';
        echo '<meta http-equiv="refresh" content="1;url=bank.php" />';
    
      } else if(@$_GET['do']=='finish'){
        echo '<script type="text/javascript">
              swal("", "แก้ไขสำเร็จ !!", "success");
              </script>';
        echo '<meta http-equiv="refresh" content="1;url=bank.php" />';
    
      } else if(@$_GET['do']=='wrong'){
        echo '<script type="text/javascript">
              swal("", "รหัสผ่านใหม่ไม่ตรงกัน !!", "warning");
              </script>';
        echo '<meta http-equiv="refresh" content="1;url=bank.php" />';
    
      } else if(@$_GET['do']=='error'){
        echo '<script type="text/javascript">
              swal("", "ผิดพลาด !!", "error");
              </script>';
        echo '<meta http-equiv="refresh" content="1;url=bank.php" />';
      }

    $query = "SELECT * FROM tb_bank ORDER BY b_id DESC";
    $stmt = $conn->query($query);

    echo '<table id="example1" class="table table-bordered table-striped">';
    echo "<thead>";
    echo "<tr class=''>
      <th width='5%'>ID</th>
      <th width='7%' class='hidden-xs'>รูป</th>
      <th width='15%' class='hidden-xs'>ชื่อธนาคาร</th>
      <th width='15%'>เลขบัญชี </th>
      <th width='15%'>ชื่อ-นามสุกล</th>
      <th width='5%'></th>
      <th width='5%'></th>
    </tr>";
    echo "</thead>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row["b_id"] .  "</td> ";
        echo "<td class='hidden-xs'>" . "<img src='../b_logo/" . $row['b_logo'] . "' width='70%'>" . "</td>";
        echo "<td class='hidden-xs'>" . $row["b_name"] . "</td> ";
        echo "<td class='hidden-xs'>" . $row["b_number"] . "</td> ";
        echo "<td>" . $row["b_owner"] . "</td> ";
        echo "<td><a href='bank.php?act=edit&ID=$row[b_id]' class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-edit'></span></a>   
              <a href='bank_del_db.php?ID=$row[b_id]' onclick=\"return confirm('ยันยันการลบ')\" class='btn btn-danger btn-xs'><span class='glyphicon glyphicon-trash'></span></a>
        </td> ";
    }

    echo "</table>";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// ปิดการเชื่อมต่อ
$conn = null;
?>
