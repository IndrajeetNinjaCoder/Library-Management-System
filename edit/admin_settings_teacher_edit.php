<?php
include "../partials/_dbconnect.php";
session_start();

if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] != true) {
    header("location: student_login.php");
    exit;
}

$username = $_GET['username'];

$sql = "SELECT * FROM `teacher_details` WHERE `teacher_username` = '$username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$password = $row['teacher_password'];
$phone = $row['phone_no'];
$email = $row['email'];
// echo $username;

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
        <input type="text" name="changed_username" value="<?php echo $username; ?>">
        <input type="text" name="changed_password" value="<?php echo $password; ?>">
        <input type="text" name="changed_email" value="<?php echo $email; ?>">
        <input type="text" name="changed_phone" value="<?php echo $phone; ?>">
        <input type="submit" value="Save Changes">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] = 'POST' and isset($_POST['changed_username'])) {
        $changed_username = $_POST['changed_username'];
        $changed_password = $_POST['changed_password'];
        $changed_email = $_POST['changed_email'];
        $changed_phone = $_POST['changed_phone'];

        if (empty($changed_username) or empty($changed_password) or empty($changed_email) or empty($changed_phone)) {
            echo "<script>alert('Any Field may be Empty');</script>";
        } else {
            if (preg_match('/^[0-9]{10}+$/', $changed_phone)) {

                $update_sql = "UPDATE `teacher_details` SET `teacher_username` = '$changed_username', `teacher_password` = '$changed_password', `phone_no` = '$changed_phone', `email` = '$changed_email' WHERE `teacher_username` = '$username'";
                $result = mysqli_query($conn, $update_sql);
                if ($result) {
                    echo "<script>alert('Chages Saved successfully.');</script>";
                    header("location: ../admin_settings_teacher.php");
                } else {
                    echo "<script>alert('Changes not saved');</script>";
                }
            } else {
                echo "<script>alert('Please enter a Valid Phone No.');</script>";
            }
        }
    }

    ?>
</body>

</html>