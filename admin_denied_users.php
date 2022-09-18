<?php
include "partials/_dbconnect.php";
session_start();

if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] != true) {
    header("location: student_login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Approval</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include "partials/_header.php"; ?>
    <div class="container">

        <h1 class="approval">Teacher Approval</h1>
        <?php
 
        $teacher_sql = "SELECT * FROM `teacher_details` WHERE `approval` = 'deny'";
        $teacher_result = mysqli_query($conn, $teacher_sql);
        $teacher_no = mysqli_num_rows($teacher_result);
        while ($row = mysqli_fetch_assoc($teacher_result)) {
            $username = $row['teacher_username'];
            echo '<div class="message">
                        <p>'. $username . '</p>
                        <div class="buttons">
                            <a id="check" href="admin_loggedin_users.php" >Check</a>
                            <a id="accept" href="approval.php?username=' . $username . '&usertype=teacher&approval=accept" >Accept</a>
                        </div>
                    </div>';
        }
        ?>













        <h1 class="approval">Student Approval</h1>
        <?php

        $student_sql = "SELECT * FROM `student_details` WHERE `approval` = 'deny'";
        $student_result = mysqli_query($conn, $student_sql);
        $student_no = mysqli_num_rows($student_result);
        while ($row = mysqli_fetch_assoc($student_result)) {
            $name = $row['student_name'];
            $username = $row['student_username'];
            echo '<div class="message">
                        <p>' . $name . ' || ' . $username . '</p>
                        <div class="buttons">
                            <a id="check" href="admin_loggedin_users.php" >Check</a>
                            <a id="accept" href="approval.php?username=' . $username . '&usertype=student&approval=accept" >Accept</a>
                        </div>
                    </div>';
        }
        ?>




    </div>
</body>

</html>