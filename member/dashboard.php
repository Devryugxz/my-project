<?php
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: login.php"); // ถ้าไม่ได้ล็อกอินให้ redirect ไปยังหน้า login
    exit();
}

    $user = $_SESSION["user"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h2>Welcome, <?php echo $user["username"]; ?>!</h2>
    <p>Your Role: <?php echo $user["role"]; ?></p>
    <a href="logout.php">Logout</a>
</body>
</html>
