<?php

// To Start a session
session_start();

// To Connect to the database
$server = "localhost";
$username = "root";
$password = "";

function function_alert($message)
{
    echo "<script>alert('$message');</script>";
}

$con = mysqli_connect($server, $username, $password);
if (!$con) {
    die("Connection failure due to" . mysqli_connect_error());
}
?>