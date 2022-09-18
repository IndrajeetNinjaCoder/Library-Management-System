<?php
include "partials/_dbconnect.php";
$_SESSION['admin_loggedin'] = false;
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <title>Student Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include "partials/_header.php"; ?>

    <?php

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $admin_username = $_POST['username'];
        $admin_password = $_POST['password'];

        $sql = "SELECT * FROM `admin`";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {


            // echo var_dump($row);
            if ($admin_username == $row['username'] and $admin_password == $row['password']) {

                session_start();
                $_SESSION['admin_loggedin'] = true;
                $_SESSION['username'] = $admin_username;
                header("location: admin_books.php");
            }
        }
        if(!isset($_SESSION['admin_loggedin'])){
            echo "<script>alert('Invalid Details');</script>";
        }
    }
    ?>



    <h1>Admin Login</h1>

    <form class="admin_login" action="" method="post">
        <br>
        <input type="text" name="username" placeholder="Enter Username">
        <input type="password" name="password" placeholder="Enter Password">

        <input type="submit" value="Login">
    </form>


    <?php
    include "partials/_footer.php";
    ?>


</body>

</html>