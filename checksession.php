<?php

// Checks for the session status
if (!isset($_SESSION['IS_LOGIN'])) {
    header("location:login.php");
    die();
}
?>