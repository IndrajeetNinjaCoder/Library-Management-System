<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
    // $username = $_SESSION['username'];
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Header</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="../img/logo.ico" type="image/x-icon">

</head>

<body>
    <div class="navbar">
        <ul class="menu">
            <?php



            if (isset($_SESSION['loggedin'])) {
                include "_username.php";
            }

            if (isset($_SESSION['teacher_loggedin'])) {
                include "_username.php";
            }

            if (isset($_SESSION['admin_loggedin'])) {
                echo '<li><div class="dropdown">
                        <a class="dropbtn">Settings</a>
                        <div class="dropdown-content">
                        <a href="admin_settings.php">Admin</a>
                        <a href="admin_settings_teacher.php">Teachers</a>
                        <a href="admin_settings_student.php">Students</a>
                        </div>
                    </div>
                    </li>';
            }

            if (!isset($_SESSION['loggedin']) and !isset($_SESSION['admin_loggedin']) and !isset($_SESSION['teacher_loggedin'])) {
                echo '<li><a href="index.php">Home</a></li>';
            }

            if (isset($_SESSION['loggedin'])) {
                echo '<li><a href="bookslist.php">Home</a></li>';
            }

            if (isset($_SESSION['loggedin'])) {
                echo '<li><a href="mybooks.php">My Books</a></li>';
            }

            if (isset($_SESSION['teacher_loggedin'])) {
                echo '<li><a href="teacher_books.php">Home</a></li>';
            }

            if (isset($_SESSION['teacher_loggedin'])) {
                echo '<li><a href="teacher_mybooks.php">My Books</a></li>';
            }

            // if (isset($_SESSION['admin_loggedin'])) {
            //     include "_username.php";
            // }


            if (isset($_SESSION['admin_loggedin'])) {
                echo '<li><a href="admin_books.php">Home</a></li>';
            }

            if (isset($_SESSION['admin_loggedin'])) {
                echo '<li><div class="dropdown">
                        <a class="dropbtn">Users</a>
                        <div class="dropdown-content">
                        <a href="admin_teachers.php" target="_blank">Teachers</a>
                        <a href="admin_loggedin_users.php" target="_blank">Students</a>
                        </div>
                    </div>
                    </li>';
            }

            if (isset($_SESSION['admin_loggedin'])) {
                echo '<li><a href="book_records.php">Return</a></li>';
            }

            if (isset($_SESSION['admin_loggedin'])) {
                echo '<li><a href="admin_issue_form.php" target="_blank">Issue</a></li>';
            }

            // if (isset($_SESSION['admin_loggedin'])) {
            //     echo '<li><a href="admin_returned_book_record.php">Returned Books</a></li>';
            // }

            if (isset($_SESSION['admin_loggedin'])) {
                echo '<li><div class="dropdown">
                        <a class="dropbtn">Messages</a>
                        <div class="dropdown-content">
                        <a href="approval_message.php">Approval</a>
                        <a href="admin_book_remainder.php">Remainder</a>
                        </div>
                    </div>
                    </li>';
            }


            if (!isset($_SESSION['loggedin']) and !isset($_SESSION['admin_loggedin']) and !isset($_SESSION['teacher_loggedin'])) {
                echo '<li><div class="dropdown">
                        <a class="dropbtn">Registration</a>
                        <div class="dropdown-content">
                        <a href="teacher_signup.php">Teacher Registration</a>
                        <a href="student_signup.php">Student Registration</a>
                        </div>
                    </div>
                    </li>';

                // <a href="admin_signup.php">Admin Registration</a>
            }

            if (!isset($_SESSION['loggedin']) and !isset($_SESSION['admin_loggedin']) and !isset($_SESSION['teacher_loggedin'])) {

                echo '<li><div class="dropdown">
                        <a class="dropbtn">Login</a>
                        <div class="dropdown-content">
                        <a href="admin_login.php">Admin Login</a>
                        <a href="teacher_login.php">Teacher Login</a>
                        <a href="student_login.php">Student Login</a>
                        </div>
                    </div>
                    </li>';
            }


            // if (isset($_SESSION['admin_loggedin'])) {
            //     echo '<li><a href="admin_issue_book.php" target="_blank">Issue</a></li>';
            // }

            // if (isset($_SESSION['admin_loggedin'])) {
            //     echo '<li><a href="admin_return_book.php" target="_blank">Return</a></li>';
            // }



            if (isset($_SESSION['loggedin']) or isset($_SESSION['admin_loggedin']) or isset($_SESSION['teacher_loggedin'])) {
                echo '<li><a href="logout.php">Logout</a></li>';
            }

            ?>

        </ul>
    </div>
</body>

</html>