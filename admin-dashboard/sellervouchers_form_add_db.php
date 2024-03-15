<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
        require_once('config/db.php');

        $s_id = $_SESSION['s_id'];
    
        $p_id = $_GET['add_id'];

        if (isset($_GET['add_id'])) {
            try {
                $p_id = $_GET['p_id'];
                $s_id = $_SESSION['s_id'];
    
                $select_stmt = $conn->prepare("SELECT * FROM tb_product as p
                INNER JOIN tb_type AS t 
                ON p.type_id = t.type_id
                INNER JOIN tb_seller AS s 
                ON p.s_id = s.s_id
                where p.p_id = $p_id and p.s_id = $s_id
                ORDER BY p.p_id  "); 
                
                $select_stmt->execute();
                $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
                extract($row);
            } catch(PDOException $e) {
                $e->getMessage();
            }
        }   
    
    
    
    
    if (isset($_REQUEST['btn_insert'])) {
        try {
            
            $pro_name = $_REQUEST['pro_name'];
            $pro_discount = $_REQUEST['pro_discount'];
            $pro_details = $_REQUEST['pro_details'];
            $pro_start = $_REQUEST['pro_start'];
            $pro_end = $_REQUEST['pro_end'];
            $s_id = $_SESSION['s_id'];
            $p_id = $_GET['p_id'];
            

            if (empty($pro_name)) {                         
                $errorMsg = "กรุณากรอกชื่อโปรโมชั่น";
            }else if (empty($pro_details)) {
                $errorMsg = "กรูณากรอกส่วนลด";
            }else if (empty($pro_details)) {
                $errorMsg = "กรุณากรอกรายละเอียดโปรโมชั่น ";
            }else if (empty($pro_start)) {
                $errorMsg = "กรุณากรอกวันที่เริ่มต้นโปรโมชั่น ";
            }else if (empty($pro_end)) {
                $errorMsg = "กรุณากรอกวันที่สิ้นสุดโแรโมชั่น ";
            }

            
            
        

            if (!isset($errorMsg)) {
                $insert_stmt = $conn->prepare("INSERT INTO tb_promotion(pro_name, pro_discount, pro_details, pro_startdate, pro_enddate, p_id, s_id)                    
                    VALUES ( :fpro_name, :fpro_discount, :fpro_details, :fpro_startdate, :fpro_enddate,:fp_id,:fs_id )");
                    
                $insert_stmt->bindParam(':fpro_name', $pro_name);
                $insert_stmt->bindParam(':fpro_discount', $pro_discount);
                $insert_stmt->bindParam(':fpro_details', $pro_details);
                $insert_stmt->bindParam(':fpro_startdate', $pro_start);
                $insert_stmt->bindParam(':fpro_enddate', $pro_end);
                $insert_stmt->bindParam(':fs_id', $s_id);
                $insert_stmt->bindParam(':fp_id', $p_id);
        
                if ($insert_stmt->execute()) {

                    $select_stmt2 = $conn->prepare("SELECT * FROM tb_promotion where pro_id order by pro_id desc"); 
                    $select_stmt2->execute();
                    $row2 = $select_stmt2->fetch(PDO::FETCH_ASSOC);
                    extract($row2);
                     
                    $pro_name = $row2["pro_name"];
  
                    $insert_stmt2 = $conn->prepare("UPDATE tb_product SET pro_name  = :pro_name where p_id = :p_id");
                    $insert_stmt2->bindParam(':pro_name', $pro_name);
                    $insert_stmt2->bindParam(':p_id', $p_id);
    
                    if ($insert_stmt2->execute()) {
                    $insertMsg = "เพิ่มโปรโมชั่นสำเร็จ...";
                    header('refresh:2;sellervouchers.php');
                    }
                }
            
            }

        } catch(PDOException $e) {
            $e->getMessage();
        }
    }

    
    


?>