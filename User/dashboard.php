<?php
session_start();
include '../db.php';

// get available items
$result = $conn->query("SELECT * FROM hardware WHERE status='available'");
?>

<!DOCTYPE html>
<html>

<head>
    <title>User Dashboard</title>

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
            text-decoration: none;
            padding: 10px;
            margin: 10px 0;
            border-radius: 6px;
        }

        .sidebar a:hover {
            background: #34495e;
        }

        /* MAIN CONTENT */
        .main {
            flex: 1;
            padding: 20px;
            background: #ecf0f1;
        }

        /* CARDS */
        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .card {
            background: white;
            padding: 15px;
            width: 200px;
            border-radius: 10px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }

        .card h4 {
            margin: 0;
        }

        .card p {
            font-size: 14px;
            color: gray;
        }

        /* BUTTON */
        button {
            width: 100%;
            padding: 8px;
            border: none;
            background: #3498db;
            color: white;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background: #2980b9;
        }
    </style>

</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h2>Hi, <?= $_SESSION['name'] ?></h2>

        <a href="#">Dashboard</a>
        <a href="assigned.php">Assigned Items</a>
        <a href="settings.php">Settings</a>
        <a href="../logout.php">Logout</a>
    </div>

    <!-- MAIN -->
    <div class="main">
        <h2>Available Hardware</h2>

        <div class="card-container">

            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="card">

                    <img src="../images/<?= $row['image'] ?>" style="width:100%; border-radius:8px;">
                    <h4><?= $row['category'] ?></h4>
                    <p>Serial: <?= $row['serial_number'] ?></p>
                    <p>Status: Available</p>

                    <form method="POST" action="request.php">
                        <input type="hidden" name="hardware_id" value="<?= $row['hardware_id'] ?>">
                        <button type="submit">Request</button>
                    </form>
                </div>
            <?php } ?>

        </div>
    </div>

</body>

</html>