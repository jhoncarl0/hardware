<?php
session_start();
include '../db.php';

// get available items
$result = $conn->query("SELECT * FROM hardware WHERE status='available'");

// total available items
$available = $conn->query("SELECT COUNT(*) as total FROM hardware WHERE status='available'");
$availableCount = $available->fetch_assoc()['total'];

// pending requests of this user
$user_id = $_SESSION['user_id'];
$pending = $conn->query("SELECT COUNT(*) as total FROM request 
                         WHERE user_id=$user_id AND status='pending'");
$pendingCount = $pending->fetch_assoc()['total'];
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

/* STATS */
.stats {
    display: flex;
    gap: 20px;
    margin-bottom: 20px;
}

.stat-card {
    background: white;
    padding: 20px;
    width: 200px;
    border-radius: 10px;
    box-shadow: 0 5px 10px rgba(0,0,0,0.1);
    text-align: center;
}

.stat-card h3 {
    margin: 0;
    font-size: 28px;
    color: #3498db;
}

.stat-card p {
    margin: 5px 0 0;
    color: gray;
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
    <a href="assigned.php">Assigned Devices</a>
    <a href="history.php">Request History</a>
    <a href="settings.php">Settings</a>
    <a href="../logout.php">Logout</a>
</div>

    <!-- MAIN -->
    <div class="main">

     <!-- HEADER -->
    <div class="header">
            <h2>Available Devices</h2>

        <div class="stats">
            <div class="stat-card">
                <h3><?= $availableCount ?></h3>
                <p>📦 Available</p>
            </div>

            <div class="stat-card">
                <h3><?= $pendingCount ?></h3>
                <p>⏳ Pending</p>
            </div>
        </div>
    </div>

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