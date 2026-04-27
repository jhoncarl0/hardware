<?php
session_start();
include '../db.php';

$user_id = $_SESSION['user_id'];

// get assigned items (not yet returned)
$result = $conn->query("
    SELECT a.assignment_id, a.assigned_at, h.*
    FROM assignment a
    JOIN hardware h ON a.hardware_id = h.hardware_id
    WHERE a.user_id = $user_id AND a.returned_at IS NULL
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Assigned Devices</title>

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
    padding: 20px;
    background: #ecf0f1;
}

/* HEADER */
.header h2 {
    margin: 0;
}

.header p {
    color: gray;
    font-size: 14px;
}

/* CARDS */
.card-container {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    margin-top: 20px;
}

.card {
    background: white;
    width: 260px;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    overflow: hidden;
}

.card img {
    width: 100%;
    height: 150px;
    object-fit: cover;
}

.card-content {
    padding: 15px;
}

.card h4 {
    margin: 5px 0;
}

.card small {
    color: gray;
}

.info {
    margin: 10px 0;
    font-size: 13px;
}

/* BUTTON */
button {
    width: 100%;
    padding: 10px;
    border: none;
    background: #3498db;
    color: white;
    border-radius: 8px;
    cursor: pointer;
}

button:hover {
    background: #2980b9;
}

/* EMPTY BOX */
.empty {
    margin-top: 30px;
    padding: 40px;
    text-align: center;
    border: 2px dashed #ccc;
    border-radius: 10px;
    color: gray;
}
</style>

</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h2>Hi, <?= $_SESSION['name'] ?></h2>

    <a href="dashboard.php">Dashboard</a>
    <a href="#">Assigned Devices</a>
    <a href="history.php">Request History</a>
    <a href="settings.php">Settings</a>
    <a href="../logout.php">Logout</a>
</div>

<!-- MAIN -->
<div class="main">

    <div class="header">
        <h2>My Assigned Devices</h2>
        <p>Overview of all equipment assigned to your account.</p>
    </div>

    <div class="card-container">

    <?php if ($result->num_rows > 0) { ?>
        <?php while($row = $result->fetch_assoc()) { ?>
            <div class="card">

                <img src="../images/<?= $row['image'] ?: 'default.jpg' ?>">

                <div class="card-content">
                    <h4><?= $row['category'] ?></h4>

                    <div class="info">
                        Date Assigned: <?= date("M d, Y", strtotime($row['assigned_at'])) ?><br>
                        Serial: <?= $row['serial_number'] ?>
                    </div>

                    <form method="POST" action="return.php">
                        <input type="hidden" name="assignment_id" value="<?= $row['assignment_id'] ?>">
                        <button type="submit">Return</button>
                    </form>
                </div>

            </div>
        <?php } ?>
    <?php } else { ?>

        <div class="empty">
            <h3>No assigned items</h3>
            <p>You currently have no hardware assigned.</p>
        </div>

    <?php } ?>

    </div>

</div>

</body>
</html>