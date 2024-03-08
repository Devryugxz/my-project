<?php
session_start();
include('config/db.php');
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit();
if($_SESSION['m_level']!='admin'){
	Header("Location: index.php");
}

$m_level = 'member';
$m_user = $_POST["m_user"];
$m_pass = $_POST["m_pass"];
$m_name = $_POST["m_name"];
$m_tel = $_POST["m_tel"];
$m_email = $_POST["m_email"];
$m_address = $_POST["m_address"];

$date1 = date("Ymd_His");
$numrand = (mt_rand());
$m_img = (isset($_POST['m_img']) ? $_POST['m_img'] : '');
$upload = $_FILES['m_img']['name'];

if ($upload != '') {
	$path = "m_img/";
	$type = strrchr($_FILES['m_img']['name'], ".");
	$newname = $numrand . $date1 . $type;
	$path_copy = $path . $newname;
	$path_link = "m_img/" . $newname;
	move_uploaded_file($_FILES['m_img']['tmp_name'], $path_copy);
}

$sql = "INSERT INTO tb_member
	(m_level, m_user, m_pass, m_name, m_img, m_tel, m_email, m_address) VALUES (:m_level, :m_user, :m_pass, :m_name, :newname, :m_tel, :m_email, :m_address)";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':m_level', $m_level, PDO::PARAM_STR);
$stmt->bindParam(':m_user', $m_user, PDO::PARAM_STR);
$stmt->bindParam(':m_pass', $m_pass, PDO::PARAM_STR);
$stmt->bindParam(':m_name', $m_name, PDO::PARAM_STR);
$stmt->bindParam(':newname', $newname, PDO::PARAM_STR);
$stmt->bindParam(':m_tel', $m_tel, PDO::PARAM_STR);
$stmt->bindParam(':m_email', $m_email, PDO::PARAM_STR);
$stmt->bindParam(':m_address', $m_address, PDO::PARAM_STR);

$result = $stmt->execute();

if ($result) {
	echo '<script type="text/javascript">';
    echo "alert('สมัครเรียบร้อย');";
	echo "window.location='index.php';";
	echo '</script>';
} else {
	echo '<script>';
	echo "window.location='index.php';";
	echo '</script>';
}
?>