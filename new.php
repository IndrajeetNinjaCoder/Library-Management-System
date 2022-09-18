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
    <h1>Books Issue/Return Records.</h1>

    <div class="table_books">
        <table>
            <tr>
                <th>ID</th>
                <th>NAME</th>
                <th>PUBLISHER</th>
                <th>STATUS</th>
                <th>GET BOOK</th>
                <th>DELETE BOOK</th>
            </tr>



            <?php



            
                $sql = "SELECT * FROM `books`";
                $result = mysqli_query($conn, $sql);
                display_books($result);

                



            function display_books($result)
            {

                while ($row = mysqli_fetch_assoc($result)) {
                    $bookid = $row['book_id'];
                    $book_status = $row['book_status'];

                    // $book_sql = "SELECT * FROM `st_data` WHERE `book_id` = $bookid";
                    // $book_result = mysqli_query($conn,$book_sql);
                    // $book_row = mysqli_fetch_assoc($result);
                    // $book_student_name = $book_row['st_name'];


                    echo '<tr>
                    <td>' . $row['book_id'] . '</td>
                    <td>' . $row['book_name'] . '</td>
                    <td>' . $row['book_publisher'] . '</td>
                    <td>' . $book_status . '</td>';


                    if ($_SESSION['admin_loggedin'] == true) {
                        echo '<td><a href="edit_book.php?bookid=' . $bookid . '">Edit</a></td>';
                    }
                    echo '<td><a href="delete_book.php?bookid=' . $bookid . '">Delete</a></td>';

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

