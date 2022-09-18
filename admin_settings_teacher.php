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
    <title>Teacher Settings</title>
</head>

<body>
    <?php include "partials/_header.php"; ?>
    <div class="container">
        <h1>Teacher Settings</h1>
        <div class="table_books">
            <table>
                <tr>
                    <th>Sr. No.</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Phone No.</th>
                    <th>Email</th>
                    <th>Edit</th>
                </tr>


                <?php

                $sno = 1;
                $sql = "SELECT * FROM `teacher_details`";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    $teacher_name = $row['teacher_username'];
                    echo '<tr>
                        <td>' . $sno . '</td>
                        <td>' . $row['teacher_username'] . '</td>
                        <td>' . $row['teacher_password'] . '</td>
                        <td>' . $row['phone_no'] . '</td>
                        <td>' . $row['email'] . '</td>
                        <td><a href="edit/admin_settings_teacher_edit.php?username=' . $teacher_name . '">Edit</a></td>
                    </tr>';
                    $sno++;
                }


                ?>
            </table>
        </div>
</body>

</html>