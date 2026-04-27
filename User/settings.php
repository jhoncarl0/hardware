<?php
session_start();
include '../db.php';

$user_id = $_SESSION['user_id'];

// GET USER DATA
$user = $conn->query("SELECT * FROM users WHERE user_id=$user_id")->fetch_assoc();

// UPDATE
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['name'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    // IMAGE UPLOAD
    if (!empty($_FILES['image']['name'])) {

        $imageName = time() . "_" . $_FILES['image']['name'];
        $target = "../images/" . $imageName;

        move_uploaded_file($_FILES['image']['tmp_name'], $target);

        $conn->query("UPDATE users SET image='$imageName' WHERE user_id=$user_id");
    }

    // UPDATE NAME
    $conn->query("UPDATE users SET name='$name' WHERE user_id=$user_id");
    $_SESSION['name'] = $name;

    // UPDATE PASSWORD
    if (!empty($password)) {

        if ($password === $confirm) {

            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $conn->query("UPDATE users SET password='$hashed' WHERE user_id=$user_id");

        } else {
            echo "<script>alert('Passwords do not match');</script>";
        }
    }

    header("Location: settings.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Settings</title>

<style>
body {
    margin: 0;
    font-family: Arial;
    display: flex;
}

/* SIDEBAR */
.sidebar {
    width: 200px;
    height: 100vh;
    background: #2c3e50;
    color: white;
    padding: 20px;
    border-top-right-radius: 20px;
    border-bottom-right-radius: 20px;
}

.sidebar h2 {
    text-align: center;
    font-size: 20px;
}

.sidebar a {
    display: block;
    color: white;
    padding: 10px;
    text-decoration: none;
    margin: 10px 0;
    border-radius: 6px;
}

.sidebar a:hover {
    background: #34495e;
}

/* MAIN */
.main {
    flex: 1;
    padding: 30px;
    background: #ecf0f1;
}

/* CONTAINER */
.container {
    display: flex;
    gap: 30px;
}

/* PROFILE BOX */
.profile-box {
    background: white;
    padding: 25px;
    width: 260px;
    border-radius: 12px;
    text-align: center;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

/* IMAGE WRAPPER */
.image-wrapper {
    position: relative;
    display: inline-block;
}

.image-wrapper img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
}

/* EDIT ICON */
.edit-icon {
    position: absolute;
    bottom: 5px;
    right: 5px;
    background: #3498db;
    color: white;
    border-radius: 50%;
    padding: 8px;
    cursor: pointer;
    font-size: 14px;
}

/* TEXT */
.profile-box h4 {
    color: #3498db;
    margin: 10px 0 5px;
}

.photo-text {
    font-size: 12px;
    color: gray;
}

/* FORM */
.form-box {
    background: white;
    padding: 20px;
    flex: 1;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

input {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border-radius: 8px;
    border: 1px solid #ccc;
}

/* BUTTON */
button {
    padding: 10px 20px;
    background: #3498db;
    border: none;
    color: white;
    border-radius: 8px;
    cursor: pointer;
}

button:hover {
    background: #2980b9;
}

/* LABEL */
label {
    font-size: 13px;
    color: gray;
}
</style>

</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h2>Hi, <?= $_SESSION['name'] ?></h2>

    <a href="dashboard.php">Dashboard</a>
    <a href="assigned.php">Assigned Devices</a>
    <a href="history.php">Request History</a>
    <a href="#">Settings</a>
    <a href="../logout.php">Logout</a>
</div>

<!-- MAIN -->
<div class="main">

    <h2>Profile Settings</h2>
    <p>Manage your personal information.</p>

    <div class="container">

        <!-- PROFILE -->
        <div class="profile-box">

            <div class="image-wrapper">
                <img src="../images/<?= $user['image'] ?: 'defaultprofile.png' ?>">

                <label for="imageUpload" class="edit-icon">✎</label>
            </div>

            <input type="file" id="imageUpload" name="image" form="settingsForm" hidden>

            <h4>Change Photo</h4>
            <p class="photo-text">JPG, GIF or PNG. Max size of 2MB.</p>

            <p><?= $user['name'] ?></p>

        </div>

        <!-- FORM -->
        <div class="form-box">

            <form id="settingsForm" method="POST" enctype="multipart/form-data">

                <label>Full Name</label>
                <input type="text" name="name" value="<?= $user['name'] ?>" required>

                <label>Email (Managed by organization)</label>
                <input type="email" value="<?= $user['email'] ?>" readonly>

                <label>New Password</label>
                <input type="password" name="password" placeholder="Enter new password">

                <label>Confirm Password</label>
                <input type="password" name="confirm_password" placeholder="Confirm password">

                <br><br>

                <button type="submit">Save Changes</button>

            </form>

        </div>

    </div>

</div>

</body>
</html>