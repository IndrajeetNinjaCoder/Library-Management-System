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
    <title>Student Settings</title>
</head>

<body>
    <?php include "partials/_header.php"; ?>
    <div class="container">
        <h1>Student Settings</h1>
        <div class="table_books">
            <table>
                <tr>
                    <th>Sr. No.</th>
                    <th>Name</th>
                    <th>Enrollment No.</th>
                    <th>Password</th>
                    <th>Branch</th>
                    <th>Semester</th>
                    <th>Phone No.</th>
                    <th>email</th>
                    <th>Edit</th>
                </tr>


                <?php
                $sno = 1;
                $sql = "SELECT * FROM `student_details`";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    $username = $row['student_username'];
                    echo '<tr>
                        <td>' . $sno . '</td>
                        <td>' . $row['student_name'] . '</td>
                        <td>' .  $username . '</td>
                        <td>' . $row['student_password'] . '</td>
                        <td>' . $row['student_branch'] . '</td>
                        <td>' . $row['student_semester'] . '</td>
                        <td>' . $row['phone_no'] . '</td>
                        <td>' . $row['email'] . '</td>
                        <td><a href="edit/admin_settings_student_edit.php?username=' . $username . '">Edit</a></td>
                    </tr>';
                    $sno++;
                }


                ?>
            </table>
        </div>
</body>

</html>