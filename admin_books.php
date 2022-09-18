<?php
include "partials/_dbconnect.php";
session_start();

if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] != true) {
    header("location: admin_login.php");
    exit;
}


// Finding Total Books 
$total_books_sql = "SELECT * FROM `book_details`";
$total_books_result = mysqli_query($conn, $total_books_sql);
$total_books = mysqli_num_rows($total_books_result);

// Finding Total Issued Books 
$total_issued_books_sql = "SELECT * FROM `book_details` WHERE `book_status` != 'Available'";
$total_issued_books_result = mysqli_query($conn, $total_issued_books_sql);
$total_issued_books = mysqli_num_rows($total_issued_books_result);


$_SESSION['book_id'] = false;

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
        <input type="text" name="searchTxt" placeholder="Search Book Name">
        <input type="submit" name="search" value="Search">
    </form>



    <form action="" method="post">
        <input type="text" name="book_id" placeholder="Enter Book Id">
        <input type="text" name="book_name" placeholder="Enter Book Name">
        <!-- <input type="text" name="book_publisher" placeholder="Enter Book Publisher"> -->
        <input type="submit" name="addbook" value="Add Book">
    </form>


    <h1>All Books</h1>

    <!-- Total Books -->
    <div class="total_books left_box">
        <h3><?php echo $total_books; ?></h3>
        <h2>Total Books</h2>
    </div>

    <!-- Total Issued Books  -->
    <div class="total_books right_box">
        <h3><?php echo $total_issued_books; ?></h3>
        <h2>Issued Books</h2>
    </div>


    <div class="table_books">
        <table>
            <tr>
                <th>Sr. No.</th>
                <th>Main id</th>
                <th>Name</th>
                <th>Total Books</th>
                <th>Issued Books</th>
                <th>Status</th>
                <th>Edit Book</th>
                <th>Delete Book</th>
            </tr>



            <?php




            // Search Implementation ********************
            
            if (isset($_POST['search'])) {

                $searchTxt = $_POST['searchTxt'];

                if ($searchTxt == "") {
                    $sql = "SELECT * FROM `books`";
                    $result = mysqli_query($conn, $sql);
                    display_books($result);
                } else {

                    // $sql = "SELECT * FROM `books` WHERE `book_id` = '$searchTxt'";
                    $sql = "SELECT * FROM `books` WHERE `book_name` LIKE '%$searchTxt%';";
                    $result = mysqli_query($conn, $sql);
                    $row_no = mysqli_num_rows($result);
                    if ($row_no > 0) {
                        display_books($result);
                    }
                }
            } else {
                $sql = "SELECT * FROM `books`";
                $result = mysqli_query($conn, $sql);
                display_books($result);

                if (isset($_POST['addbook'])) {
                    $book_id = $_POST['book_id'];
                    $book_name = $_POST['book_name'];
                    // $book_publisher = $_POST['book_publisher'];
                    if (empty($book_id) or empty($book_name)) {
                        echo "<script>alert('Book id or Name can't be empty.');</script>";
                    } else {
                        $sql = "INSERT INTO `books` (`book_id`, `book_name`) VALUES ('$book_id', '$book_name')";
                        $result = mysqli_query($conn, $sql);
                        

                        // Creating sub table to store book records
                        // $create_table_sql = 'CREATE TABLE `library`.`' . $book_id . '` ( `main_id` VARCHAR(50) NOT NULL ,  `book_id` VARCHAR(50) NOT NULL ,  `book_name` VARCHAR(255) NOT NULL ,  `book_publisher` VARCHAR(255) NOT NULL ,  `book_status` VARCHAR(50) NOT NULL ,    PRIMARY KEY  (`book_id`))';
                        // $create_table_result = mysqli_query($conn, $create_table_sql);
                        // if ($create_table_result) {
                        //     echo "Table Created";
                        // }

                        if ($result) {
                            $sql = "SELECT * FROM `books` WHERE `book_id` = '$book_id'";
                            $result = mysqli_query($conn, $sql);
                            display_books($result);
                        }
                        // else{
                        //     echo "Please enter a Unique Book Id";
                        // }
                    }
                }
            }



            function display_books($result)
            {
                $sno = 1;
                global $conn;

                while ($row = mysqli_fetch_assoc($result)) {
                    $bookid = $row['book_id'];
                    $_SESSION['book_id'] = $bookid;
                    // echo $_SESSION['book_id'];
                    // $book_sql = "SELECT * FROM `st_data` WHERE `book_id` = $bookid";
                    // $book_result = mysqli_query($conn,$book_sql);
                    // $book_row = mysqli_fetch_assoc($result);
                    // $book_student_name = $book_row['st_name'];

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
                    <td>' . $sno . '</td>
                    <td>' . $row['book_id'] . '</td>
                    <td class="book_details"><a href="admin_book_details.php?bookid=' . $bookid . '">' . $row['book_name'] . '</a></td>
                    <td>' . $total_books_no . '</td>
                    <td>' . $issued_books_no . '</td>';

                    if ($total_books_no == $issued_books_no) {
                        echo '<td>Not Available</td>';
                    } else {
                        echo '<td>Available</td>';
                    }
                    // ?bookid=' . $bookid . '

                    // <td>' . $row['book_publisher'] . '</td>

                    if ($_SESSION['admin_loggedin'] == true) {
                        echo '<td><a href="edit_admin_books_details.php?bookid=' . $bookid . '">Edit</a></td>';
                    }
                    echo '<td><a href="admin_delete_book.php?bookid=' . $bookid . '">Delete</a></td>';

                    echo '</tr>';

                    $sno++;
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