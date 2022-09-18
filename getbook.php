<?php
include "partials/_dbconnect.php";

session_start();
$username = $_SESSION['username'];
$id = $_GET['bookid'];


// Book Details 
$sql = "SELECT * FROM `books` WHERE `book_id` = '$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$book_name = $row['book_name'];
$book_publisher = $row['book_publisher'];



// Student Details 
$sql = "SELECT * FROM `student_details` WHERE `student_username` = '$username'";
$result = mysqli_query($conn, $sql);
$stu_row = mysqli_fetch_assoc($result);

$phone_no = $stu_row['phone_no'];
$branch = $stu_row['student_branch'];
$semester = $stu_row['student_semester'];




$sql = "INSERT INTO `st_data` VALUES ('$username', '$phone_no', '$branch', '$semester', '$id', '$book_name', '$book_publisher', current_timestamp(), '0', 'Available')";

$result = mysqli_query($conn, $sql);
if ($result) {
    echo "Book Issued";

    $sql = "UPDATE `books` SET `book_status` = '$username' WHERE `books`.`book_id` = '$id'";
    $result = mysqli_query($conn, $sql);

    header("location: bookslist.php");

} else {
    echo "Book Not Issued";
}


