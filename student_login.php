<?php
include "partials/_dbconnect.php";
$_SESSION['loggedin'] = false;
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
        $st_username = $_POST['username'];
        $st_password = $_POST['password'];

        $sql = "SELECT * FROM `student_details`";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {

            // echo var_dump($row);
            if ($st_username == $row['student_username'] and $st_password == $row['student_password'] and $row['approval'] == 'accept') {

                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $st_username;
                header("location: bookslist.php");
            }
        }
        if(!isset($_SESSION['loggedin'])){
            echo "<script>alert('Invalid Details');</script>";
        }
    }



    ?>

    <h1>Student Login</h1>
    <form class="student_login" action="" method="post">
        <input type="text" name="username" placeholder="Enter Enrollment">
        <input type="password" name="password" placeholder="Enter Password">

        <input type="submit" value="Login">
    </form>




    <?php
    include "partials/_footer.php";
    ?>

</body>

</html>