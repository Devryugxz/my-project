<?php
session_start();
unset($_SESSION['seller']);
header("Location: ../login.php");
exit();
?>