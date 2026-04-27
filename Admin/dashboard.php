<?php
include '../db.php';

$result = $conn->query("SELECT r.request_id, u.name, h.category, r.status
                        FROM request r
                        JOIN users u ON r.user_id = u.user_id
                        JOIN hardware h ON r.hardware_id = h.hardware_id");

$current = basename($_SERVER['PHP_SELF']); //Gets the filename of the current page. For example, from http://localhost/hardware/admin/requests.php, it extracts only requests.php.
?>



<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>

<style>
body {
    margin: 0;
    font-family: Arial;
    display: flex;
}

/* SIDEBAR */
.sidebar {
    width: 220px;
    height: 100vh;
    background: #2c3e50;
    color: white;
    padding: 20px;
    border-top-right-radius: 25px;
    border-bottom-right-radius: 25px;
}

.sidebar a {
    display: block;
    color: white;
    padding: 10px;
    text-decoration: none;
    margin: 10px 0;
    border-radius:4px;
}

.sidebar a:hover {
    background: #3498DB;
}

.sidebar a.active{ /*changes color when the link is clicked or selected*/
    background: #3498DB;
    color:white;
    border-radius:4px;
}

/* MAIN */
.main {
    flex: 1;
    padding: 20px;
    background: #ecf0f1;
}

/* TOP BAR */
.top-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/* ADD BUTTON */
.add-btn {
    background: #27ae60;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}

.add-btn:hover {
    transform: scale(1.05);
}

/* TABLE */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background: white;
}

th, td {
    padding: 12px;
}

th {
    background: #3498db;
    color: white;
}

/* ACTION BUTTONS */
.action-btn {
    padding: 5px 10px;
    color: white;
    border-radius: 5px;
    text-decoration: none;
}

.approve { background: #2ecc71; }
.reject { background: #e74c3c; }

/* MODAL */
.modal {
    display: none;
    position: fixed;
    top: 0; left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
}

.modal-content {
    background: white;
    width: 300px;
    margin: 100px auto;
    padding: 20px;
    border-radius: 10px;
}

.modal-content input {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
}

.close {
    float: right;
    cursor: pointer;
    font-size: 20px;
}
</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h2>Admin</h2>
    <a href="#" class="<?= $current == 'dashboard.php' ? 'active' : '' ?>"><i class="fa-solid fa-chart-column"></i> Dashboard</a>
    <a href="itemtracking.php"><i class="fa-solid fa-computer"></i> Track Item</a>
     <a href="requests.php" class="<?= $current == 'requests.php' ? 'active' : '' ?>"><i class="fa-solid fa-clipboard-question"></i> Requests</a>
    <a href="../logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
</div>

<!-- MAIN -->
<div class="main">

    <div class="top-bar">
        <h2>Dashboard</h2>
        
    </div>

    <p>No dashboard yet.</p>

</div>


</script>
<script src="https://kit.fontawesome.com/da92db8247.js" crossorigin="anonymous"></script>  <!--icon library-->

</body>
</html>