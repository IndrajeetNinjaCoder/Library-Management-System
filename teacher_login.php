<?php
include "partials/_dbconnect.php";


$_SESSION['teacher_loggedin'] = false;
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <title>Teacher Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include "partials/_header.php"; ?>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $teacher_username = $_POST['username'];
        $teacher_password = $_POST['password'];

        $sql = "SELECT * FROM `teacher_details`";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {

            // echo var_dump($row);
            if ($teacher_username == $row['teacher_username'] and $teacher_password == $row['teacher_password'] and $row['approval'] == 'accept') {

                session_start();
                $_SESSION['teacher_loggedin'] = true;
                $_SESSION['username'] = $teacher_username;
                header("location: teacher_books.php");
                // echo "You are loggedin";
            }
        }
        if (!isset($_SESSION['teacher_loggedin'])) {
            echo "<script>alert('Invalid Details');</script>";
        }
    }



    ?>

    <h1>Teacher Login</h1>
    <form class="student_login" action="" method="post">
        <input type="text" name="username" placeholder="Enter Username">
        <input type="password" name="password" placeholder="Enter Password">

        <input type="submit" value="Login">
    </form>




    <?php
    include "partials/_footer.php";
    ?>

</body>

</html>