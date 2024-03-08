<?php
session_start();
unset($_SESSION['member_login']);
header("Location: ../login.php");
exit();
?>