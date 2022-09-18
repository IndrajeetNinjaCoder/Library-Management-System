<?php

include "partials/_dbconnect.php";

$book_id = $_GET['bookid'];
$st_username = $_GET['username'];
$usertype = $_GET['usertype'];

echo $book_id . "<br>";
echo $st_username . "<br>";
echo $usertype . "<br>";

// $book_id = $_GET['bookid'];

$sql = "UPDATE `st_data` SET `receive_date` = current_timestamp(), `status` = 'Returned' WHERE `book_id` = '$book_id'";
$result = mysqli_query($conn, $sql);

$update_sql = "UPDATE `book_details` SET `book_status` = 'Available' WHERE `book_id` = '$book_id'";
$result = mysqli_query($conn, $update_sql);

if ($result) {
    if ($usertype == 'teacher') {
        header("location: admin_teachers.php");
    } else {
        header("location: admin_loggedin_users.php");
    }
}
