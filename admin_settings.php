<?php
include "partials/_dbconnect.php";
session_start();

if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] != true) {
    header("location: student_login.php");
    exit;
}

$sql = "SELECT * FROM `admin`";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$admin_name = $row['username'];
$admin_password = $row['password'];
$admin_email = $row['email'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Settings</title>
</head>

<body>
    <?php include "partials/_header.php"; ?>
    <div class="container">
        <h1>Admin Settings</h1>
        <div class="profile">
            <img id="admin_logo" src="img/admin logo.png">
            <?php
            echo '<a href="edit/admin_setting_edit.php?username=' . $admin_name . '&password=', $admin_password . '&email='.$admin_email.'"><img class="edit_pen" src="img/edit.png"></a>';
            ?>
        </div>
        <h1 class="admin">Name: <?php echo $admin_name; ?></h1>
        <h1 class="admin">Email: <?php echo $admin_email; ?></h1>
        <h1 class="admin">Password: <?php echo $admin_password; ?></h1>
    </div>

</body>

</html>