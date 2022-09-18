<?php
include "partials/_dbconnect.php";
session_start();

if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] != true) {
    header("location: admin_login.php");
    exit;
}

$main_id = $_GET['bookid'];



?>








<!DOCTYPE html>
<html lang="en">
<title>All Books of <?php echo $main_id; ?></title>
<link rel="stylesheet" href="style.css">
</head>

<body>

    <?php include "partials/_header.php"; ?>

    <div class="book_operation">
        <ul>
            <?php
            echo '<li><a href="add_book.php" target="_blank">Add Book</a></li>';

            echo '<li><a href="delete_book.php" target="_blank">Delete Book</a></li>';

            echo '<li><a href="edit_book.php" target="_blank">Edit Book</a></li>';

            ?>
        </ul>
    </div>
    <h1>Library Management System (main id: <?php echo $main_id; ?>)</h1>


    <!-- <form class="searchbox" action="" method="post">
            <input type="text" name="searchTxt" placeholder="Search Book name">
            <input type="submit" name="search" value="Search">
        </form>
 -->


    <!-- <form action="" method="post">
        <input type="text" name="book_id" placeholder="Enter Book Id">
        <input type="text" name="book_name" placeholder="Enter Book Name">
        <input type="text" name="book_publisher" placeholder="Enter Book Publisher">
        <input type="submit" name="addbook" value="Add Book">
    </form>
 -->

    <div class="table_books">
        <table>
            <tr>
                <th>Sr. No.</th>
                <th>Book id</th>
                <th>Name</th>
                <th>Publisher</th>
                <th>Status</th>
                <!-- <th>Issue</th> -->
                <!-- <th>Edit Book</th> -->
                <!-- <th>Delete Book</th> -->
            </tr>



            <?php



            // if (isset($_POST['search'])) {

            //     $searchTxt = $_POST['searchTxt'];
            //     if ($searchTxt == "") {
            //         $sql = "SELECT * FROM `book_details` WHERE `main_id` = '$book_id'";
            //         $result = mysqli_query($conn, $sql);
            //         display_books($result);
            //     } else {

            //         $sql = "SELECT * FROM `book_details` WHERE `book_name` = '$searchTxt' and `main_id` = '$book_id";
            //         $result = mysqli_query($conn, $sql);
            //         $row_no = mysqli_num_rows($result);
            //         if ($row_no > 0) {
            //             display_books($result);
            //         }
            //     }
            // } else {
            $sql = "SELECT * FROM `book_details`  WHERE `main_id` = '$main_id'";
            $result = mysqli_query($conn, $sql);
            display_books($result);

            // if (isset($_POST['addbook'])) {
            //     $book_id = $_POST['book_id'];
            //     $book_name = $_POST['book_name'];
            //     $book_publisher = $_POST['book_publisher'];

            //     if ($book_id != "" and $book_name != "" and $book_publisher != "") {
            //         $sql = "INSERT INTO `book_details` VALUES ('$main_id', '$book_id', '$book_name', '$book_publisher', 'Available')";
            //         $result = mysqli_query($conn, $sql);
            //         if ($result) {
            //             $sql = "SELECT * FROM `book_details` WHERE `main_id` = $main_id";
            //             $select_result = mysqli_query($conn, $sql);
            //             // echo $main_id;
            //             display_books($select_result);
            //         }
            //         // else{
            //         //     echo "Please enter a Unique Book Id";
            //         // }
            //     }
            // }
            // // }



            function display_books($result)
            {
                $sno = 1;

                global $main_id;
                global $book_id;

                while ($row = mysqli_fetch_assoc($result)) {
                    // $book_id = $row['book_id'];
                    $book_status = $row['book_status'];

                    // $book_sql = "SELECT * FROM `st_data` WHERE `book_id` = $main_id";
                    // $book_result = mysqli_query($conn,$book_sql);
                    // $book_row = mysqli_fetch_assoc($result);
                    // $book_student_name = $book_row['st_name'];


                    echo '<tr>
                    <td>' . $sno. '</td>
                    <td>' . $row['book_id'] . '</td>
                    <td>' . $row['book_name'] . '</td>
                    <td>' . $row['book_publisher'] . '</td>
                    <td>' . $book_status . '</td>';

                    // echo '<td><a href="admin_issue_book.php?table_name=' . $main_id . '">Issue</a></td>';

                    // if ($_SESSION['admin_loggedin'] == true) {
                    //     echo '<td><a href="edit_admin_books_details.php?table_name=' . $main_id . '&book_id=' . $book_id . '">Edit</a></td>';
                    // }
                    // echo '<td><a href="delete_book.php?table_name=' . $book_id . '">Delete</a></td>';

                    echo '</tr>';
                    $sno++;
                }
            }





            ?>



        </table>
    </div>


</body>

</html>