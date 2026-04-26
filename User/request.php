<?php
session_start();
include '../db.php';

$user_id = $_SESSION['user_id'];
$hardware_id = $_POST['hardware_id'];

$conn->query("INSERT INTO request (user_id, hardware_id) 
              VALUES ($user_id, $hardware_id)");

header("Location: dashboard.php");
?>