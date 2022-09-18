<?php
include "partials/_dbconnect.php";
session_start();

if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] != true) {
    header("location: student_login.php");
    exit;
}

$username = $_GET['username'];
$usertype = $_GET['usertype'];
$approval = $_GET['approval'];

if ($approval == 'accept') {
    if ($usertype == 'student') {
        $sql = "UPDATE `student_details` SET `approval` = 'accept' WHERE `student_username` = '$username'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("location: approval_message.php");
        } else {
            echo "<script>alert('Not Accepted');</script>";
        }
    } else if ($usertype == 'teacher') {
        $sql = "UPDATE `teacher_details` SET `approval` = 'accept' WHERE `teacher_username` = '$username'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("location: approval_message.php");
        } else {
            echo "<script>alert('Not Accepted');</script>";
        }
    }
}

if ($approval == 'deny') {
    if ($usertype == 'student') {
        $sql = "UPDATE `student_details` SET `approval` = 'deny' WHERE `student_username` = '$username'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("location: approval_message.php");
        } else {
            echo "<script>alert('Not Denied');</script>";
        }
    } else if ($usertype == 'teacher') {
        $sql = "UPDATE `teacher_details` SET `approval` = 'deny' WHERE `teacher_username` = '$username'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("location: approval_message.php");
        } else {
            echo "<script>alert('Not Denied');</script>";
        }
    }
}
