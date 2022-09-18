<?php
include "../partials/_dbconnect.php";
session_start();

if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] != true) {
    header("location: student_login.php");
    exit;
}
$admin_username = $_GET['username'];
$admin_password = $_GET['password'];
$admin_email = $_GET['email'];
// echo $username . "<br>";
// echo $password . "<br>";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <h1>Admin Settings edit</h1>
    <form action="" method="post">
        <input type="text" name="changed_username" value="<?php echo $admin_username; ?>">
        <input type="text" name="changed_email" value="<?php echo $admin_email; ?>">
        <input type="text" name="changed_password" value="<?php echo $admin_password; ?>">
        <input type="submit" value="Save Changes">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] = 'POST' and isset($_POST['changed_username'])) {
        $changed_username = $_POST['changed_username'];
        $changed_password = $_POST['changed_password'];
        $changed_email = $_POST['changed_email'];
        $sql = "UPDATE `admin` SET `username` = '$changed_username', `password` = '$changed_password', `email` = '$changed_email' WHERE `username` = '$admin_username'";
        $result = mysqli_query($conn, $sql);
        if($result){
            echo "<script>alert('Admin username and password changed successfully.');</script>";
            header("location: ../admin_settings.php");
        }else{
            echo "<script>alert('Admin username and password not changed');</script>";

        }
    }

    ?>
</body>

</html>