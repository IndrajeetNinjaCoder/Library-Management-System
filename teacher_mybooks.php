<?php
include "partials/_dbconnect.php";
session_start();

if (!isset($_SESSION['teacher_loggedin']) || $_SESSION['teacher_loggedin'] != true) {
    header("location: teacher_loggedin.php");
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>My Books</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    include "partials/_header.php";

    ?>

    <h1>These books are Issued/Return by you.</h1>


    <?php

    $username = $_SESSION['username'];
    $sql = "SELECT * FROM `st_data` WHERE `st_name` = '$username'";
    $result = mysqli_query($conn, $sql);
    display_allotted_books($result);

    function display_allotted_books($result)
    {

        $row_no = mysqli_num_rows($result);
        if ($row_no > 0) {

            echo '<div class="table_books mybooks">
                    <table>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Publisher</th>
                            <th>Issue Date</th>
                            <th>Return till</th>
                            <th>Status</th>
                        </tr>';


            while ($row = mysqli_fetch_assoc($result)) {
                $bookid = $row['book_id'];
                $issue_date = $row['issue_date'];

                // receive_date = issue_date + 15 days
                $receive_date = date('Y-m-d H:i:s', strtotime($issue_date . ' +15 day'));


                echo '<tr>
                    <td>' . $row['book_id'] . '</td>
                    <td>' . $row['book_name'] . '</td>
                    <td>' . $row['book_publisher'] . '</td>
                    <td>' . $issue_date . '</td>
                    <td>' . $receive_date . '</td>
                    <td>' . $row['status'] . '</td>';


                // if ($_SESSION['loggedin'] == true) {
                //     echo '<td><a href="return_book.php?bookid=' . $bookid . '">Return Book</a></td>';
                // }
                echo '</tr>';
            }
            echo '</table>
            </div>';
        }
    }



    ?>



</body>

</html>