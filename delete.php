<?php
// Connecting to the database
include 'connection.php';

//Checking for the session status i.e. true or false
include 'checksession.php';

$delsno = $_REQUEST['sno'];
$pdel = $_REQUEST['pdel'];

// Deleting the record from the database
$sql = "DELETE FROM `registration_form`.`sign_in` WHERE `sno` = $delsno";
if (!$con->query($sql)) {
    function_alert("ERROR: $sql <br> $con->error");
}

// Deleting the profile picture stored in the pfp folder
if (file_exists($pdel)) {
    unlink($pdel);
}

// mySQL query to reset the primary key after deleting a record
$sql1 = "ALTER TABLE `registration_form`. `sign_in` AUTO_INCREMENT = $delsno";

if (!$con->query($sql1)) {
    function_alert("ERROR: $sql <br> $con->error");
}

// Redirects to the user page
header("location:user.php");
die();

?>