<?php
include "partials/_dbconnect.php";
session_start();

if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] != true) {
    header("location: student_login.php");
    exit;
}

$book_id = $_GET['bookid'];
$usertype = $_GET['usertype'];

$sql = "SELECT * FROM `st_data` WHERE `book_id` = '$book_id' and `status` = 'Issued'";
$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);
$time = $row['time'];

$updated_time = $time + 15;


$update_sql = "UPDATE `st_data` SET `time` = $updated_time WHERE `book_id` = '$book_id' and `status` = 'Issued'";
$update_result = mysqli_query($conn, $update_sql);

if ($update_result) {
    header("location: admin_loggedin_users.php");
    if ($usertype == 'student') {
        header("location: admin_loggedin_users.php");
    }
    else{
        header("location: admin_teachers.php");
    }
}
