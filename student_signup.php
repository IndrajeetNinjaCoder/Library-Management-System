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
        $st_name = $_POST['name'];
        $st_username = $_POST['username'];
        $st_phone = $_POST['phone'];
        $st_branch = $_POST['branch'];
        $st_semester = $_POST['semester'];
        $st_password = $_POST['password'];
        $st_cpassword = $_POST['cpassword'];
        $st_email = $_POST['email'];

        if (empty($st_name) or empty($st_username) or empty($st_phone) or empty($st_branch) or empty($st_semester) or empty($st_password) or empty($st_cpassword) or empty($st_email)) {
            echo "<script>alert('Any Field may be Empty');</script>";
        } else {
            if (preg_match('/^[0-9]{10}+$/', $st_phone)) {

                if ($st_password == $st_cpassword) {

                    $sql = "INSERT INTO `student_details` VALUES ('$st_name', '$st_username', '$st_password', '$st_branch', '$st_semester', '$st_phone', '$st_email', 'review')";
                    $result = mysqli_query($conn, $sql);

                    if ($result) {
                        echo "<script>alert('Your Account Created and under the Review.');</script>";
                    } else {
                        echo "<script>alert('Please Enter a Unique Username');</script>";
                    }
                } else {
                    echo "<script>alert('Please Enter same password');</script>";
                }
            } else {
                echo "<script>alert('Please Enter a Valid Phone No.');</script>";
            }
        }
    }


    ?>

    <h1>Student Registration</h1>

    <form class="student_signup" action="" method="post">
        <br>
        <input type="text" name="name" placeholder="Enter Name">
        <input type="text" name="username" placeholder="Enter Enrollment No.">
        <input type="text" name="phone" placeholder="Enter Phone No.">
        <input type="text" name="email" placeholder="Enter Email">
        <select name="branch" id="branch">
            <option value="">Select Branch</option>
            <option value="cse">CSE</option>
            <option value="machenical">Machenical Auto</option>
            <option value="machenical">Machenical Prod</option>
            <option value="machenical">Machenical RAC</option>
            <option value="electrical">Electrical</option>
            <option value="electronics">Electronics</option>
            <option value="civil">Civil</option>
            <option value="agricultural ">Agricultural</option>
        </select>

        <select name="semester" id="semester">
            <option value="">Select Semester</option>
            <option value="1">1</option>
            <option value="2">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
        </select>
        <!-- <input type="number" name="semester" placeholder="Enter Semester"> -->
        <input type="password" name="password" placeholder="Enter Password">
        <input type="password" name="cpassword" placeholder="Confirm Password">

        <input type="submit" value="Signup">
    </form>


    <?php
    include "partials/_footer.php";
    ?>
</body>

</html>