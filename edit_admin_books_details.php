<?php

include "partials/_dbconnect.php";
session_start();

if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] != true) {
    header("location: admin_login.php");
    exit;
}

$bookid = $_GET['bookid'];
$sql = "SELECT * FROM `books` WHERE `book_id` = '$bookid'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$book_name = $row['book_name'];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Book</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include "partials/_header.php"; ?>
    <h1>Edit Book</h1>
    <form action="" method="post">
        <input type="text" name="id" value="<?php echo $bookid; ?>" readonly>
        <input type="text" name="name" value="<?php echo $book_name; ?>">
        <input type="submit" value="Save Changes">
    </form>

    <?php

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $update_sql = "UPDATE `books` SET `book_name` = '$name' WHERE `books`.`book_id` = '$id'";
        $update_result = mysqli_query($conn, $update_sql);
        if($update_result){
            header("location: admin_books.php");
        }
        else{
            echo "<script>alert('Book Not updated');</script>";
        }

    }

    ?>
</body>

</html>