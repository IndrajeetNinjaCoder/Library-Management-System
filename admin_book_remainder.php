<?php
include "partials/_dbconnect.php";
session_start();

if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] != true) {
    header("location: student_login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Remainder</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include "partials/_header.php"; ?>

    <div class="container">
        <h1>Book Return Time has been overed</h1>

        <?php

        $sql = "SELECT * FROM `st_data` WHERE `status` = 'issued' and `user_type` = 'student'";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $time = $row['time'];
            $issue_date = $row['issue_date'];
            $current_date = date("Y-m-d H:i:s");
            $return_date = date('Y-m-d H:i:s', strtotime($issue_date . $time . ' days '));


            // echo "issue Date        " . $issue_date;
            // echo "<br>";
            // echo "Return Date       " . $return_date;
            // echo "<br>";
            // echo "Current Date      " . $current_date;
            // echo "<br>";
            // echo $issue_date;

            if ($current_date >= $return_date) {
                // echo "Current Date is Greater of Equal";
                $username = $row['st_name'];
                $phone = $row['phone_no'];
                echo '<div class="message">
                        <p> ' . $username . ' || (Phone No.) ' . $phone . ' </p>
                        <div class="buttons">
                            <a id="check" href="admin_total_user_books.php?username=' . $username . '&usertype=""">Check</a>
                        </div>
                    </div>';
            }
        }

        ?>




    </div>
</body>

</html>