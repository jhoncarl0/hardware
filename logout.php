<?php
session_start();

// unset all session variables
$_SESSION = [];

// destroy session
session_destroy();

// redirect to login page
header("Location: /hardware/index.php");
exit();
?>