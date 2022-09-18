<?php
include "partials/_dbconnect.php";
session_start();

if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] != true) {
    header("location: admin_login.php");
    exit;
}



// Finding Total Books 
$total_books_sql = "SELECT * FROM `st_data` WHERE `status` = 'Returned'";
$total_books_result = mysqli_query($conn, $total_books_sql);
$total_books = mysqli_num_rows($total_books_result);

?>







<!DOCTYPE html>
<html lang="en">
<title>Returned Books Record</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

    <?php include "partials/_header.php"; ?>
    <form class="searchbox" action="" method="post">
        <input type="text" name="searchTxt" placeholder="Book Id or Enrollment No.">
        <input type="submit" name="search" value="Search">
    </form>


    <h1>Returned Books Records.</h1>

    <!-- Total Returned Books  -->
    <div class="total_books left_box">
        <h3><?php echo $total_books; ?></h3>
        <h2>Total Returned Books</h2>
    </div>

    <div class="table_books book_records">
        <table>
            <tr>
                <th>Sr. No.</th>
                <th>Id</th>
                <th>Name</th>
                <th>Publisher</th>
                <th>Student</th>
                <th>Phone No.</th>
                <th>Issue Date</th>
                <th>Return Date</th>
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
                $sql = "SELECT * FROM `st_data` WHERE `status` = 'Returned'";
                $result = mysqli_query($conn, $sql);
                display_books($result);
            }




            function display_books($result)
            {
                $sno = 1;

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


                    echo '<tr>
                    <td>' . $sno . '</td>
                    <td>' . $row['book_id'] . '</td>
                    <td>' . $row['book_name'] . '</td>
                    <td>' . $row['book_publisher'] . '</td>
                    <td>' . $row['st_name'] . '</td>
                    <td>' . $row['phone_no'] . '</td>
                    <td>' . $row['issue_date'] . '</td>
                    <td>' . $row['receive_date'] . '</td>';

                    /*
                    if ($row['receive_date'] == '0000-00-00 00:00:00') {
                        echo '<td>Not Received</td>';
                    } else {
                        echo '<td>' . $row['receive_date'] . '</td>';
                    }

                    if ($row['status'] == 'Issued') {
                        echo '<td><a href="return_book.php?bookid=' . $row['book_id'] . '&username= ' . $username . '&usertype='.$usertype.'">Return</a></td>';
                    } else {
                        echo '<td>Returned</td>';
                    }
                    */

                    echo '</tr>';
                    $sno++;
                }
            }




            ?>
        </table>
    </div>


</body>

</html>