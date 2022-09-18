<?php
include "partials/_dbconnect.php";
session_start();

if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] != true) {
    header("location: admin_login.php");
    exit;
}


?>







<!DOCTYPE html>
<html lang="en">
<title>Library Management System</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

    <?php include "partials/_header.php"; ?>
    <form class="searchbox" action="" method="post">
        <input type="text" name="searchTxt" placeholder="Book Id or Enrollment No.">
        <input type="submit" name="search" value="Search">
    </form>


    <h1>Books Issue/Return Records.</h1>

    <div class="table_books book_records">
        <table>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Publisher</th>
                <th>Student</th>
                <th>Phone No.</th>
                <th>Issue Date</th>
                <!-- <th>Return Date</th> -->
                <th>Return</th>
            </tr>



            <?php



            if (isset($_POST['search'])) {

                $searchTxt = $_POST['searchTxt'];
                if ($searchTxt == "") {
                    $sql = "SELECT * FROM `st_data`";
                    $result = mysqli_query($conn, $sql);
                    display_books($result);
                } else {

                    $sql = "SELECT * FROM `st_data` WHERE `st_name` = '$searchTxt' or `book_id` = '$searchTxt'";
                    $result = mysqli_query($conn, $sql);
                    $row_no = mysqli_num_rows($result);
                    if ($row_no > 0) {
                        display_books($result);
                    }
                }
            } else {
                $sql = "SELECT * FROM `st_data`";
                $result = mysqli_query($conn, $sql);
                display_books($result);
            }




            function display_books($result)
            {

                while ($row = mysqli_fetch_assoc($result)) {
                    $username = $row['st_name'];
                    $usertype = $row['user_type'];
                    // echo $usertype;
                    // echo $username;
                    // $bookid = $row['book_id'];
                    // $book_status = $row['book_status'];

                    // $book_sql = "SELECT * FROM `st_data` WHERE `book_id` = $bookid";
                    // $book_result = mysqli_query($conn,$book_sql);
                    // $book_row = mysqli_fetch_assoc($result);
                    // $book_student_name = $book_row['st_name'];

                    if ($row['status'] != 'Returned') {
                        echo '<tr>
                    <td>' . $row['book_id'] . '</td>
                    <td>' . $row['book_name'] . '</td>
                    <td>' . $row['book_publisher'] . '</td>
                    <td>' . $row['st_name'] . '</td>
                    <td>' . $row['phone_no'] . '</td>
                    <td>' . $row['issue_date'] . '</td>';

                        // if ($row['receive_date'] == '0000-00-00 00:00:00') {
                        //     echo '<td>Not Received</td>';
                        // } else {
                        //     echo '<td>' . $row['receive_date'] . '</td>';
                        // }

                        if ($row['status'] == 'Issued') {
                            echo '<td><a href="return_book.php?bookid=' . $row['book_id'] . '&username= ' . $username . '&usertype=' . $usertype . '">Return</a></td>';
                        } else {
                            echo '<td>Returned</td>';
                        }
                        echo '</tr>';
                    }
                }
            }



            ?>
        </table>
    </div>


</body>

</html>