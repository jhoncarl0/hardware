<?php
session_start();
include '../db.php';

$user_id = $_SESSION['user_id'];

// get all requests of this user
$result = $conn->query("
    SELECT r.request_id, r.status, h.category, h.serial_number
    FROM request r
    JOIN hardware h ON r.hardware_id = h.hardware_id
    WHERE r.user_id = $user_id
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Request History</title>

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

/* TABLE BOX */
.table-box {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

/* TABLE */
table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 12px;
    text-align: left;
}

th {
    color: gray;
    font-size: 13px;
}

/* STATUS BADGES */
.status {
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: bold;
}

.pending {
    background: #fce5cd;
    color: #d35400;
}

.approved {
    background: #d4edda;
    color: #27ae60;
}

.rejected {
    background: #f8d7da;
    color: #c0392b;
}

.cancelled {
    background: #e0e0e0;
    color: #555;
}

/* BUTTON */
.cancel-btn {
    padding: 5px 10px;
    border: 1px solid red;
    background: none;
    color: red;
    border-radius: 6px;
    cursor: pointer;
}

.cancel-btn:hover {
    background: red;
    color: white;
}
</style>

</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h2>Hi, <?= $_SESSION['name'] ?></h2>

    <a href="dashboard.php">Dashboard</a>
    <a href="assigned.php">Assigned Devices</a>
    <a href="#">Request History</a>
    <a href="settings.php">Settings</a>
    <a href="../logout.php">Logout</a>
</div>

<!-- MAIN -->
<div class="main">

    <h2>Request History</h2>
    <p>Track and manage your hardware requests.</p>

    <div class="table-box">

        <table>
            <tr>
                <th>Item Name</th>
                <th>Serial Number</th>
                <th>Status</th>
                <th>Action</th>
            </tr>

            <?php while($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['category'] ?></td>
                <td><?= $row['serial_number'] ?></td>

                <td>
                    <?php if($row['status'] == 'pending') { ?>
                        <span class="status pending">PENDING</span>
                    <?php } elseif($row['status'] == 'approved') { ?>
                        <span class="status approved">APPROVED</span>
                    <?php } elseif($row['status'] == 'rejected') { ?>
                        <span class="status rejected">REJECTED</span>
                    <?php } else { ?>
                        <span class="status cancelled">CANCELLED</span>
                    <?php } ?>
                </td>

                <td>
                    <?php if($row['status'] == 'pending') { ?>
                        <form method="POST" action="cancel.php">
                            <input type="hidden" name="request_id" value="<?= $row['request_id'] ?>">
                            <button class="cancel-btn">Cancel</button>
                        </form>
                    <?php } else { ?>
                        <span style="color: gray;">No action</span>
                    <?php } ?>
                </td>
            </tr>
            <?php } ?>

        </table>

    </div>

</div>

</body>
</html>