<?php
include "partials/_dbconnect.php";

$username = $_SESSION['username'];
echo '<li class="username_logo"><a href="#">' . $username . '</a></li>';
