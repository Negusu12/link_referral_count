<?php
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "referral";
$con = new mysqli($servername, $username, $password, $db_name);
if ($con->connect_error) {
    die("Connection failed" . $con->connect_error);
}
echo "";
