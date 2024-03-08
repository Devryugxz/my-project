<?php
session_start();
unset($_SESSION['store_owner']);
header("Location: ../login.php");
exit();
?>