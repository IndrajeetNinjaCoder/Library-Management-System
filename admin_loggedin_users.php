<!-- This file contains student details to issue book -->
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
    <title>All Users</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include "partials/_header.php" ?>

    <form class="searchbox" action="" method="post">
        <input type="text" name="searchTxt" placeholder="Student Name or Enrollment No.">
        <input type="submit" name="search" value="Search">
    </form>




    <!-- <h1>Teachers Details</h1>
    <form class="searchbox teacher" action="" method="post">
        <input type="text" name="searchTxt" placeholder="Enter Teacher Name">
        <input type="submit" name="searchTeacher" value="Search">
    </form>
    <div class="table_books">
        <table>
            <tr>
                <th>Username</th>
                <th>Password</th>
                <th>Phone No.</th>
                <th>Issue</th>
            </tr>
            <?php
            /*
            if (isset($_POST['searchTeacher'])) {

                $searchTxt = $_POST['searchTxt'];
                if ($searchTxt == "") {
                    $sql = "SELECT * FROM `teacher_details`";
                    $result = mysqli_query($conn, $sql);
                    display_teachers($result);
                } else {
                    $sql = "SELECT * FROM `teacher_details` WHERE `teacher_username` = '$searchTxt'";
                    $result = mysqli_query($conn, $sql);
                    $row_no = mysqli_num_rows($result);
                    if ($row_no > 0) {
                        display_teachers($result);
                    }
                }
            } else {
                $teacher_sql = "SELECT * FROM `teacher_details`";
                $teacher_result = mysqli_query($conn, $teacher_sql);
                display_teachers($teacher_result);
            }


            function display_teachers($result)
            {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>
                        <td>' . $row['teacher_username'] . '</td>
                        <td>' . $row['teacher_password'] . '</td>
                        <td>' . $row['phone_no'] . '</td>
                        <td><a href="admin_issue_book.php?username=' . $row['teacher_username'] . '&usertype=teacher">Issue</a></td>
                    </tr>';
                }
            }
            */
            ?>
        </table>
    </div>
 -->


    <h1>Student Details</h1>


    <div class="table_books">
        <table>
            <tr>
                <th>Sr. No.</th>
                <th>Name</th>
                <th>Enrollment No.</th>
                <th>Branch</th>
                <th>Semester</th>
                <th>Phone No.</th>
                <th>Total Issued Books</th>
                <th>Issue</th>
            </tr>
            <?php

            if (isset($_POST['search'])) {

                $searchTxt = $_POST['searchTxt'];
                if ($searchTxt == "") {
                    $sql = "SELECT * FROM `student_details`";
                    $result = mysqli_query($conn, $sql);
                    display_students($result);
                } else {

                    $sql = "SELECT * FROM `student_details` WHERE `student_username` = '$searchTxt' or `student_name` = '$searchTxt'";
                    $result = mysqli_query($conn, $sql);
                    $row_no = mysqli_num_rows($result);
                    if ($row_no > 0) {
                        display_students($result);
                    }
                }
            } else {
                $student_sql = "SELECT * FROM `student_details`";
                $student_result = mysqli_query($conn, $student_sql);
                display_students($student_result);
            }

            function display_students($result)
            {
                $sno = 1;
                global $conn;
                while ($student_row = mysqli_fetch_assoc($result)) {

                    $student_name = $student_row['student_username'];

                    $sql = "SELECT * FROM `st_data` WHERE `st_name` = '$student_name' and `status` = 'Issued'";
                    $book_no_result = mysqli_query($conn, $sql);
                    $book_no = mysqli_num_rows($book_no_result);

                    echo '<tr>
                        <td>' . $sno . '</td>
                        <td>' . $student_row['student_name'] . '</td>
                        <td>' . $student_row['student_username'] . '</td>
                        <td>' . $student_row['student_branch'] . '</td>
                        <td>' . $student_row['student_semester'] . '</td>
                        <td>' . $student_row['phone_no'] . '</td>
                        <td><a href="admin_total_user_books.php?username=' . $student_name . '&usertype=student">' . $book_no . '</a></td>
                        <td><a href="admin_issue_book.php?username=' . $student_row['student_username'] . '&usertype=student">Issue</a></td>
                    </tr>';
                    $sno++;
                }
            }
            ?>
        </table>
    </div>






</body>

</html>