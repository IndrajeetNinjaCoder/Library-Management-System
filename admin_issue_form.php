<?php

include "partials/_dbconnect.php";

// $enrollment = $_GET['username'];
// $usertype = $_GET['usertype'];
// echo $enrollment . "<br>";
// echo $usertype . "<br>";


$id_validate = false;
$username_validate = false;
$book_status_validate = false;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Issue</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php

    include "partials/_header.php";

    ?>


    <h1>Issue Book</h1>
    <form action="" method="post">
        <input type="text" name="book_id" placeholder="Enter Book Id">
        <input type="text" name="username" placeholder="Enter Username">

        <select name="user_type" id="userType">
            <option value="">Select User</option>
            <option value="student">Student</option>
            <option value="teacher">Teacher</option>
        </select>
        <input type="submit" value="Issue">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $book_id = $_POST['book_id'];
        $username = $_POST['username'];
        $usertype = $_POST['user_type'];


        if (empty($book_id) or empty($username) or empty($usertype)) {
            echo "<script>alert('Any field may be empty');</script>";
        } else {

            // Getting Book Details 
            $book_sql = "SELECT * FROM `book_details`";
            $book_result = mysqli_query($conn, $book_sql);

            while ($book_row = mysqli_fetch_assoc($book_result)) {
                if ($book_id == $book_row['book_id']) {

                    $book_name = $book_row['book_name'];
                    $book_publisher = $book_row['book_publisher'];
                    $book_status = $book_row['book_status'];


                    $id_validate = true;
                }
            }

            if ($id_validate) {
                // Checking Book Status Available or not 
                $book_status_sql = "SELECT * FROM `book_details` WHERE `book_id` = '$book_id'";
                $book_status_result = mysqli_query($conn, $book_status_sql);
                $book_status_row = mysqli_fetch_assoc($book_status_result);

                if ($book_status_row['book_status'] == "Available") {
                    $book_status_validate = true;
                } else {
                    echo "<script>alert('Book Already Issued');</script>";
                }
            } else {
                echo "<script>alert('Invalid Book Id');</script>";
            }

            if ($usertype == "student") {
                // Getting Student Data 
                $st_sql = "SELECT * FROM `student_details`";
                $user_result = mysqli_query($conn, $st_sql);


                while ($row = mysqli_fetch_assoc($user_result)) {
                    if ($username == $row['student_username']) {

                        // $user_sql = "SELECT * FROM `st_data`";
                        // $user_result = mysqli_query($conn, $user_sql);


                        $user_branch = $row['student_branch'];
                        $user_semester = $row['student_semester'];
                        $user_phone = $row['phone_no'];
                        $user_email = $row['email'];

                        $username_validate = true;
                    }
                }
            } else if ($usertype == "teacher") {
                // Getting Student Data 
                $st_sql = "SELECT * FROM `teacher_details`";
                $user_result = mysqli_query($conn, $st_sql);


                while ($row = mysqli_fetch_assoc($user_result)) {
                    if ($username == $row['teacher_username']) {

                        // $user_sql = "SELECT * FROM `st_data`";
                        // $user_result = mysqli_query($conn, $user_sql);


                        $user_branch = "None";
                        $user_semester = "None";
                        $user_phone = $row['phone_no'];
                        $user_email = $row['email'];

                        $username_validate = true;
                    }
                }
            }

            if ($username_validate and $id_validate and $book_status_validate) {

                // $d = date("Y-m-d H:i:s");
                // $to_be_return_date = date("Y-m-d H:i:s", strtotime($d . ' +15 days'));

                $sql = "UPDATE `book_details` SET `book_status` = '$username' WHERE `book_id` = '$book_id'";
                $result = mysqli_query($conn, $sql);
                if (!$result) {
                    echo "<script>alert('Book Not Issued');</script>";
                }


                $st_data_sql = "INSERT INTO `st_data` VALUES ('$username', '$user_phone', '$user_branch', '$user_email', '$user_semester', '$book_id', '$book_name', '$book_publisher', current_timestamp(), 15, 0, 'Issued', '$usertype')";

                $result = mysqli_query($conn, $st_data_sql);
                if ($result) {

                    echo '<script>alert("Book Issued to ' . $username . '");</script>';
                }
                else{
                    echo '<script>alert("Book Not Issued");</script>';
                }
            }
        }
    }
    ?>
</body>

</html>