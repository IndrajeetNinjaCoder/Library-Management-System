<?php
include "partials/_dbconnect.php";

$bookid = $_GET['bookid'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['ok'])) {
        // Deleting from books 
        $sql = "DELETE FROM `books` WHERE `books`.`book_id` = '$bookid'";
        $result = mysqli_query($conn, $sql);

        // Deleting from book_details 
        $delete_book_sql = "DELETE FROM `book_details` WHERE `main_id` = '$bookid'";
        $delete_result = mysqli_query($conn, $delete_book_sql);
        header("location: admin_books.php");
    } else {
        header("location: admin_books.php");
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Delete Book</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="confirmBox">
        <h1>Do you Really want to delete "<?php echo $bookid; ?>" book </h1>
        <form action="" class="confirm" method="post">
            <input type="submit" name="ok" value="Ok">
            <input type="submit" name="cancel" value="Cancel">
        </form>
    </div>
</body>

</html>