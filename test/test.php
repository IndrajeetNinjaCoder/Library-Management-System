<!--
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Return</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<?php

// include "partials/_header.php";

?>


<h1>Return Book</h1>
<form action="" method="post">
    <input type="text" name="book_id" value="<?php echo $book_id; ?>" readonly>
    <input type="text" name="username" placeholder="Enter Username">

     <select name="user_type" id="userType">
        <option value="">Select User</option>
        <option value="student">Student</option>
        <option value="teacher">Teacher</option>
    </select>

    <input type="submit" value="Return">
</form>

<?php
/*
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $book_id = $_POST['book_id'];
    $st_username = $_POST['username'];
    $user_type = $_POST['user_type'];



    if ($user_type == "") {
        echo "<script>alert('Please Select User Type');</script>";
    } else {
        // Getting Book Details 
        $book_sql = "SELECT * FROM `book_details`";
        $book_result = mysqli_query($conn, $book_sql);

        while ($book_row = mysqli_fetch_assoc($book_result)) {
            if ($book_id == $book_row['book_id']) {
                $id_validate = true;
            }
        }

        // Checking Book Status Available or not 
        if ($id_validate) {
            $book_status_sql = "SELECT * FROM `book_details` WHERE `book_id` = '$book_id'";
            $book_status_result = mysqli_query($conn, $book_status_sql);
            $book_status_row = mysqli_fetch_assoc($book_status_result);

            if ($book_status_row['book_status'] != "Available") {
                $book_status_validate = true;
            } else {
                echo "<script>alert('Book Already Returned');</script>";
            }
        }
        else{
            echo "<script>alert('Invalid Book Id');</script>";
        }

        if ($user_type == "student") {
            // Getting Student Data 
            $user_sql = "SELECT * FROM `student_details`";
            $user_result = mysqli_query($conn, $user_sql);

            while ($row = mysqli_fetch_assoc($user_result)) {
                if ($st_username == $row['student_username']) {
                    $username_validate = true;
                }
            }
        } else if ($user_type == "teacher") {

            // Getting Teacher Data 
            $user_sql = "SELECT * FROM `teacher_details`";
            $user_result = mysqli_query($conn, $user_sql);

            while ($row = mysqli_fetch_assoc($user_result)) {
                if ($st_username == $row['teacher_username']) {
                    $username_validate = true;
                }
            }
        }            
        if(!$username_validate) {
            echo "<script>alert('Invalid Username!');</script>";
        }


        if ($id_validate and $username_validate and $book_status_validate) {

            $sql = "UPDATE `book_details` SET `book_status` = 'Available' WHERE `book_id` = '$book_id'";
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                echo "<script>alert('Book Issued');</script>";
            }

            $st_data_sql = "UPDATE `st_data` SET `receive_date` = current_timestamp(), `status` = 'Returned' WHERE `st_name` = '$st_username' and `book_id` = '$book_id';";

            $result = mysqli_query($conn, $st_data_sql);
            if ($result) {
                echo '<script>alert("Book Returned by ' . $st_username . '");</script>';
            }
        }
    }
}

*/
?>
</body>

</html>
