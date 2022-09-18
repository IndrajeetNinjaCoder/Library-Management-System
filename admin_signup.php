<?php
include "partials/_dbconnect.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Student Signup</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include "partials/_header.php"; ?>


    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $admin_username = $_POST['username'];
        $admin_password = $_POST['password'];
        $admin_cpassword = $_POST['cpassword'];

        if (strlen($admin_username) > 0) {

            if ($admin_password == $admin_cpassword) {
                $sql = "INSERT INTO `admin` (`username`, `password`) VALUES ('$admin_username', '$admin_cpassword');";
                $result = mysqli_query($conn, $sql);

                if ($result) {
                    echo "<h2>Your Account Created Successfully and you can Login</h2>";
                } else {
                    echo "<h3>Please Enter a Unique Username</h3>";
                }
            } else {
                echo "<h3>Please Enter same password</h3>";
            }
        } else {
            echo "<h3>Please Enter username</h3>";
        }
    }



    ?>



    <h1>Admin Registration</h1>
    <form class="admin_signup" action="" method="post">
        <br>
        <input type="text" name="username" placeholder="Enter Username">
        <input type="password" name="password" placeholder="Enter Password">
        <input type="password" name="cpassword" placeholder="Confirm Password">

        <input type="submit" value="Signup">
    </form>


    <?php
    include "partials/_footer.php";
    ?>
</body>

</html>