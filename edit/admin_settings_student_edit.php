<?php
include "../partials/_dbconnect.php";
session_start();

if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] != true) {
    header("location: student_login.php");
    exit;
}

$username = $_GET['username'];

$sql = "SELECT * FROM `student_details` WHERE `student_username` = '$username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$name = $row['student_name'];
$password = $row['student_password'];
$branch = $row['student_branch'];
$semester = $row['student_semester'];
$phone = $row['phone_no'];
$email = $row['email'];


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <h1>Teacher Settings</h1>
    <form action="" method="post">
        <label for="name">Name</label>
        <input type="text" name="changed_name" value="<?php echo $name; ?>">

        <label for="name">Enrollment No.</label>
        <input type="text" name="changed_username" value="<?php echo $username; ?>">

        <label for="name">Password</label>
        <input type="text" name="changed_password" value="<?php echo $password; ?>">

        <label for="name">Email</label>
        <input type="text" name="changed_email" value="<?php echo $email; ?>">

        <label for="name">Branch</label>
        <select name="changed_branch" id="branch">
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

        <label for="name">Semester</label>
        <select name="changed_semester" id="semester">
            <option value="">Select Semester</option>
            <option value="1">1</option>
            <option value="2">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
        </select>

        <label for="name">Phone No.</label>
        <input type="text" name="changed_phone" value="<?php echo $phone; ?>">


        <input type="submit" value="Save Changes">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] = 'POST' and isset($_POST['changed_username'])) {
        $changed_name = $_POST['changed_name'];
        $changed_username = $_POST['changed_username'];
        $changed_password = $_POST['changed_password'];
        $changed_branch = $_POST['changed_branch'];
        $changed_semester = $_POST['changed_semester'];
        $changed_phone = $_POST['changed_phone'];
        $changed_email = $_POST['changed_email'];

        if (empty($changed_name) or empty($changed_username) or empty($changed_password) or empty($changed_branch) or empty($changed_semester) or empty($changed_phone) or empty($changed_email)) {
            echo "<script>alert('Any field may be empty');</script>";
        } else {
            $update_sql = "UPDATE `student_details` SET `student_name` = '$changed_name', `student_username` = '$changed_username', `student_password` = '$changed_password', `student_branch` = '$changed_branch', `student_semester` = '$changed_semester',`phone_no` = '$changed_phone', `email` = '$changed_email' WHERE `student_username` = '$username'";
            $result = mysqli_query($conn, $update_sql);
            if ($result) {
                echo "<script>alert('Chages Saved successfully.');</script>";
                header("location: ../admin_settings_student.php");
            } else {
                echo "<script>alert('Changes not saved');</script>";
            }
        }
    }

    ?>
</body>

</html>