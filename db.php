<?php
$conn = new mysqli("localhost", "root", "", "hardware");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>