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
    <title>All Teachers</title>
</head>

<body>
    <?php include "partials/_header.php"; ?>

    <h1>Teachers Details</h1>
    <form class="searchbox" action="" method="post">
        <input type="text" name="searchTxt" placeholder="Enter Teacher Name">
        <input type="submit" name="searchTeacher" value="Search">
    </form>
    <div class="table_books">
        <table>
            <tr>
                <th>Sr. No.</th>
                <th>Username</th>
                <!-- <th>Password</th>
                <th>Phone No.</th> -->
                <th>Total Issued Books</th>
                <th>Issue</th>
            </tr>
            <?php
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
                $sno = 1;
                global $conn;


                while ($row = mysqli_fetch_assoc($result)) {
                    $teacher_name = $row['teacher_username'];
                    $sql = "SELECT * FROM `st_data` WHERE `st_name` = '$teacher_name' and `status` = 'Issued'";
                    $book_no_result = mysqli_query($conn, $sql);
                    $book_no = mysqli_num_rows($book_no_result);


                    echo '<tr>
                        <td>' . $sno . '</td>
                        <td>' . $row['teacher_username'] . '</td>
                        <td><a href="admin_total_user_books.php?username=' . $teacher_name . '&usertype=teacher">' . $book_no . '</a></td>
                        <td><a href="admin_issue_book.php?username=' . $row['teacher_username'] . '&usertype=teacher">Issue</a></td>
                    </tr>';
                    $sno++;
                }
            }
            ?>
        </table>
    </div>



</body>

</html>