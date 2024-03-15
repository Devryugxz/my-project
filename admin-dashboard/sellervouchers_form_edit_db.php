<?php
session_start();
echo '<meta charset="utf-8">';
include('config/db.php');

if($_SESSION['role']!='seller'){
	Header("Location: bank.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $b_id = filter_input(INPUT_POST, 'b_id', FILTER_SANITIZE_NUMBER_INT);
    $b_name = filter_input(INPUT_POST, 'b_name', FILTER_SANITIZE_STRING);
    $b_number = filter_input(INPUT_POST, 'b_number', FILTER_SANITIZE_STRING);
    $b_owner = filter_input(INPUT_POST, 'b_owner', FILTER_SANITIZE_STRING);

    $date1 = date("Ymd_His");
    $numrand = (mt_rand());
    $b_logo = (isset($_POST['b_logo']) ? $_POST['b_logo'] : '');
    
    $upload = $_FILES['b_logo']['name'];
    if($upload !='') { 
        $path="../b_logo/";
        $type = strrchr($_FILES['b_logo']['name'],".");
        $newname = $numrand.$date1.$type;
        $path_copy = $path.$newname;
        $path_link = "../b_logo/".$newname;
        move_uploaded_file($_FILES['b_logo']['tmp_name'], $path_copy);  
    } else {
        $newname = $b_logo2; // Assuming $b_logo2 is defined somewhere
    }

    $sql = "UPDATE tb_bank SET b_name=:b_name, b_number=:b_number, b_owner=:b_owner, b_logo=:newname WHERE b_id=:b_id";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':b_name', $b_name, PDO::PARAM_STR);
    $stmt->bindParam(':b_number', $b_number, PDO::PARAM_STR);
    $stmt->bindParam(':b_owner', $b_owner, PDO::PARAM_STR);
    $stmt->bindParam(':newname', $newname, PDO::PARAM_STR);
    $stmt->bindParam(':b_id', $b_id, PDO::PARAM_INT);

    $result = $stmt->execute();

    if($result) {
        echo '<script>';
        echo "window.location='bank.php?do=finish';";
        echo '</script>';
    } else {
        echo '<script>';
        echo "window.location='bank.php?act=add&do=f';";
        echo '</script>';
    }
}
?>
