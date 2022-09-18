<?php
include "partials/_dbconnect.php";
// session_start();

// echo $_SESSION['loggedin'];
// echo "<br>";
// echo $_SESSION['username']

?>







<!DOCTYPE html>
<html lang="en">
<title>Library Management System</title>
<link rel="stylesheet" href="style.css">
</head>

<body class="index">

    <?php include "partials/_header.php"; ?>
    <div class="index_container">
        <marquee scrollamount="20">
            <h1>M. G. POLYTECHNIC HATHRAS</h1>
        </marquee>

        <!-- <h1 class="index">M. G. POLYTECHNIC LIBRARY</h1> -->
<img class="logo" src="img/mgp_logo.png" alt="logo">
        <!-- <div class="library_fullForm">
            <h2 class="library_slogen">Library यानी</h2>
            <ul class="slogen">
                <li>L – Learn New Things (नई चीज़ें सीखें)</li>
                <li>I – Intelligence Increase (इंटेलिजेंस में वृद्धि)</li>
                <li>B – Behavior Change (व्यवहार परिवर्तन)</li>
                <li>R – Rational (तर्कसंगत)</li>
                <li>A – Ability To Understand (समझने की क्षमता)</li>
                <li>R – Reading Ability (पढ़ने की क्षमता)</li>
                <li>Y – Yield Of Knowledge (ज्ञान की उपज)</li>
            </ul>
        </div> -->

        <?php
        /*
            echo '<div class="table_books">
                <table>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Status</th>
                    </tr>';

            $sql = "SELECT * FROM `books`";
            $result = mysqli_query($conn, $sql);
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
                    <td>' . $row['book_name'] . '</td>';
                    // echo '<td>' . $row['book_publisher'] . '</td>';
                if ($total_books_no == $issued_books_no) {
                    echo '<td>Not Available</td>';
                } else {
                    echo '<td>Available</td>';
                }


                // if ($_SESSION['loggedin'] == true) {
                //     echo '<td><a href="getbook.php?bookid=' . $bookid . '">GET BOOK</a></td>';
                // }
                echo '</tr>';
            }
            */
        ?>





        </table>
    </div>


    </container>
    <?php
    include "partials/_footer.php";
    ?>
</body>

</html>