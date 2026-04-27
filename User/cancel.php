<?php
session_start();
include '../db.php';

$request_id = $_POST['request_id'];
$user_id = $_SESSION['user_id'];

// only cancel if it's YOUR request and still pending
$conn->query("
    UPDATE request 
    SET status = 'cancelled' 
    WHERE request_id = $request_id 
    AND user_id = $user_id 
    AND status = 'pending'
");

header("Location: history.php");
exit();
?>