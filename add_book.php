<?php

include "partials/_dbconnect.php";

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

    <h1>Add Book</h1>
    <form action="" method="post">
        <input type="text" name="main_id" placeholder="Enter Book main id">
        <input type="text" name="book_id" placeholder="Enter Book id">
        <input type="text" name="book_name" placeholder="Enter Book Name">
        <input type="text" name="book_publisher" placeholder="Enter Book Publisher">

        <input type="submit" value="Add Book">
    </form>


    <?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $main_id = $_POST['main_id'];
        $book_id = $_POST['book_id'];
        $book_name = $_POST['book_name'];
        $book_publisher = $_POST['book_publisher'];

        if (empty($main_id) or empty($book_id) or empty($book_name) or empty($book_publisher)) {
            echo "<script>alert('Any field may be empty.');</script></h3>";
        } else {
            $check_main_id_sql = "SELECT * FROM `books`";
            $main_id_result = mysqli_query($conn, $check_main_id_sql);
            while ($main_id_row = mysqli_fetch_assoc($main_id_result)) {
                if ($main_id == $main_id_row['book_id']) {
                    $insert_sql = "INSERT INTO `book_details` VALUES ('$main_id', '$book_id', '$book_name', '$book_publisher', 'Available')";
                    $insert_result = mysqli_query($conn, $insert_sql);
                    if ($insert_result) {
                        echo "<script>alert('Book Added Successfully');</script></h3>";
                    }
                }
            }
        }
    }

    
    ?>
</body>

</html>