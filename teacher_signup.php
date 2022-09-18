<?php
include "partials/_dbconnect.php";
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <title>Teacher Signup</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include "partials/_header.php"; ?>


    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $teacher_username = $_POST['username'];
        $teacher_phone = $_POST['phone'];
        $teacher_email = $_POST['email'];
        $teacher_password = $_POST['password'];
        $teacher_cpassword = $_POST['cpassword'];

        if (empty($teacher_username) or empty($teacher_password) or empty($teacher_phone) or empty($teacher_email) or empty($teacher_cpassword)) {
            echo "<script>alert('Any field may be Empty');</script>";
        } else {

            if (preg_match('/^[0-9]{10}+$/', $teacher_phone)) {

                if ($teacher_password == $teacher_cpassword) {
                    $sql = "INSERT INTO `teacher_details` VALUES ('$teacher_username', '$teacher_password', '$teacher_phone', '$teacher_email', 'review')";
                    $result = mysqli_query($conn, $sql);

                    if ($result) {
                        echo "<script>alert('Your Account Created and under Review.')</script>";
                    } else {
                        echo "<script>alert('Please Enter a Unique Username');</script>";
                    }
                } else {
                    echo "<script>alert('Please Enter same password')</sc;ript>";
                }
            }
            else {
                echo "<script>alert('Please Enter a Valid Phone No.')</script>;";
            }
        }
    }

    ?>

    <h1>Teacher Registration</h1>

    <form class="student_signup" action="" method="post">
        <br>
        <input type="text" name="username" placeholder="Enter Username">
        <input type="text" name="phone" placeholder="Enter Phone No.">
        <input type="text" name="email" placeholder="Enter Email">

        <input type="password" name="password" placeholder="Enter Password">
        <input type="password" name="cpassword" placeholder="Confirm Password">

        <input type="submit" value="Signup">
    </form>


    <?php
    include "partials/_footer.php";
    ?>
</body>

</html>