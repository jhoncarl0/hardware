<?php
session_start();
include 'db.php';

$email = $_POST['email'];
$password = $_POST['password'];

$result = $conn->query("SELECT * FROM users WHERE email='$email' AND password='$password'");

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['role'] = $user['role'];
    $_SESSION['name'] = $user['name'];
    $_SESSION['image'] = $row['image'];

    if ($user['role'] == 'admin') {
        header("Location: admin/dashboard.php");
    } else {
        header("Location: user/dashboard.php");
    }
} else {
    echo "Invalid login";
}
?>