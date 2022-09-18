<?php
include "partials/_dbconnect.php";
session_start();

if (!isset($_SESSION['teacher_loggedin']) || $_SESSION['teacher_loggedin'] != true) {
    header("location: teacher_login.php");
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
    <h1>LIBRARY MANAGEMENT SYSTEM</h1>



    <form class="searchbox" action="" method="post">
        <input type="text" name="searchTxt" placeholder="Search Book name">
        <input type="submit" name="search" value="Search">
    </form>










    <div class="table_books">
        <table>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Total Books</th>
                <th>Issued Books</th>
                <th>Status</th>
                <!-- <th>GET BOOK</th> -->
            </tr>

            <?php
            if (isset($_POST['search'])) {

                $searchTxt = $_POST['searchTxt'];
                if ($searchTxt == "") {
                    $sql = "SELECT * FROM `books`";
                    $result = mysqli_query($conn, $sql);
                    display_books($result);
                } else {

                    $sql = "SELECT * FROM `books` WHERE `book_id` = '$searchTxt'";
                    $result = mysqli_query($conn, $sql);
                    $row_no = mysqli_num_rows($result);
                    if ($row_no > 0) {
                        display_books($result);
                    }
                }
            } else {
                // if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                //     $searchTxt = $_POST['searchTxt'];
                //     $sql = "SELECT * FROM `books` WHERE `book_name` = '$searchTxt'";
                //     $result = mysqli_query($conn, $sql);
                //     $row_no = mysqli_num_rows($result);
                //     if ($row_no > 0) {
                //         display_books($result);
                //     }
                // } else {
                $sql = "SELECT * FROM `books`";
                $result = mysqli_query($conn, $sql);
                display_books($result);
                // }
            }
            function display_books($result)
            {
                global $conn;
                while ($row = mysqli_fetch_assoc($result)) {
                    $bookid = $row['book_id'];

                    // Getting Total No. of Books 
                    $total_book_sql = "SELECT * FROM `book_details` WHERE `main_id` = '$bookid'";
                    $total_book_result = mysqli_query($conn, $total_book_sql);
                    $total_books_no = mysqli_num_rows($total_book_result);

                    // Getting Total Available Books 
                    $available_book_sql = "SELECT * FROM `book_details` WHERE `main_id` = '$bookid' and `book_status` = 'Available'";
                    $available_book_result = mysqli_query($conn, $available_book_sql);
                    $available_books_no = mysqli_num_rows($available_book_result);

                    // Total Issued books = Total books - Available Books 
                    $issued_books_no = $total_books_no - $available_books_no;


                    echo '<tr>
                        <td>' . $row['book_id'] . '</td>
                        <td>' . $row['book_name'] . '</td>
                        <td>' . $total_books_no . '</td>
                        <td>' . $issued_books_no . '</td>';

                    if ($total_books_no == $issued_books_no) {
                        echo '<td>Not Available</td>';
                    }
                    else{
                        echo '<td>Available</td>';
                    }

                    // if ($_SESSION['loggedin'] == true) {
                    //     if ($book_status == "available") {
                    //         echo '<td><a href="getbook.php?bookid=' . $bookid . '">GET BOOK</a></td>';
                    //     } else {
                    //         echo '<td><a>Issued</a></td>';
                    //     }
                    // }
                    echo '</tr>';
                }
            }

            ?>





        </table>
    </div>


    <?php
    include "partials/_footer.php";
    ?>
</body>

</html>