<?php

include "partials/_dbconnect.php";



$main_id_validate = false;
$book_id_validate = false;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Book</title>
</head>

<body>
    <?php
    include "partials/_header.php";
    ?>

    <h1>Edit Book</h1>
    <form action="" method="post">
        <input type="text" name="main_id" placeholder="Enter Book main id">
        <input type="text" name="book_id" placeholder="Enter Book id">
        <!-- <input type="text" name="change_main_id" placeholder="Change Book main id">
        <input type="text" name="change_book_id" placeholder="Change Book id"> -->
        <input type="text" name="change_book_name" placeholder="Change Book Name">
        <input type="text" name="change_book_publisher" placeholder="Change Book Publisher">

        <input type="submit" value="Edit Book">
    </form>


    <?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $main_id = $_POST['main_id'];
        $book_id = $_POST['book_id'];
        $change_book_name = $_POST['change_book_name'];
        $change_book_publisher = $_POST['change_book_publisher'];

        if (empty($main_id) or empty($book_id) or empty($change_book_name) or empty($change_book_publisher)) {
            echo "<script>alert('Any Field may be empty.');</script>";
        } else {
            $check_main_id_sql = "SELECT * FROM `book_details`";
            $main_id_result = mysqli_query($conn, $check_main_id_sql);
            while ($main_id_row = mysqli_fetch_assoc($main_id_result)) {
                if ($main_id == $main_id_row['main_id']) {
                    $main_id_validate = true;
                }
            }

            $check_book_id_sql = "SELECT * FROM `book_details` WHERE `main_id` = '$main_id'";
            $book_id_result = mysqli_query($conn, $check_book_id_sql);
            while ($book_id_row = mysqli_fetch_assoc($book_id_result)) {
                if ($book_id == $book_id_row['book_id']) {
                    $book_id_validate = true;
                }
            }

            if ($main_id_validate and $book_id_validate) {
                $edit_sql = "UPDATE `book_details` SET `book_name` = '$change_book_name', `book_publisher` = '$change_book_publisher' WHERE `book_details`.`book_id` = '$book_id'";
                $edit_result = mysqli_query($conn, $edit_sql);
                if ($edit_sql) {
                    echo "<script>alert('Book Eddited Successfully.');</script>";
                } else {
                    echo "<script>alert('Book Not Eddited');</script>";
                }
            }
        }
    }

    ?>
</body>

</html>