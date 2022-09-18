<?php

include "partials/_dbconnect.php";
$main_id_validate = false;
$book_id_validate = false;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add Book</title>
</head>

<body>
    <?php
    include "partials/_header.php";
    ?>

    <h1>Delete Book</h1>
    <form action="" method="post">
        <input type="text" name="main_id" placeholder="Enter Book main id">
        <input type="text" name="book_id" placeholder="Enter Book id">

        <input type="submit" value="Delete Book">
    </form>


    <?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $main_id = $_POST['main_id'];
        $book_id = $_POST['book_id'];

        $check_main_id_sql = "SELECT * FROM `books`";
        $main_id_result = mysqli_query($conn, $check_main_id_sql);
        while ($main_id_row = mysqli_fetch_assoc($main_id_result)) {
            if ($main_id == $main_id_row['book_id']) {
                $main_id_validate = true;
                // $delete_sql = "DELETE FROM `book_details` WHERE `main_id` = '$main_id' and `book_id` = '$book_id'";
                // $delete_result = mysqli_query($conn, $delete_sql);
                // if($delete_result){
                //     echo "<h2>Book Deleted</h3>";
            }
        }


        // Check Book id 
        $check_book_id_sql = "SELECT * FROM `book_details`";
        $book_id_result = mysqli_query($conn, $check_book_id_sql);
        while ($book_id_row = mysqli_fetch_assoc($book_id_result)) {
            if ($book_id == $book_id_row['book_id']) {
                $book_id_validate = true;
                // $delete_sql = "DELETE FROM `book_details` WHERE `main_id` = '$main_id' and `book_id` = '$book_id'";
                // $delete_result = mysqli_query($conn, $delete_sql);
                // if($delete_result){
                //     echo "<h2>Book Deleted</h3>";
            }
        }

        if ($main_id_validate && $book_id_validate) {
            $delete_sql = "DELETE FROM `book_details` WHERE `main_id` = '$main_id' and `book_id` = '$book_id'";
            $delete_result = mysqli_query($conn, $delete_sql);
            if ($delete_result) {
                echo "<script>alert('Book Deleted Successfully');</script>";
            }
        }
        else{
            echo "<script>alert('Book Not Deleted');</script>";
        }
    }
    ?>
</body>

</html>