<?php
include '../db.php';

// get available items
/*
$result = $conn->query("SELECT * FROM assignment a
                        JOIN hardware h ON a.hardware_id = h.hardware_id
                        JOIN users u ON a.user_id = u.user_id");
*/
$isAssignmentDataEmpty = true;
$result = $conn->query("SELECT assignment_id FROM assignment LIMIT 1");

if ($result->num_rows > 0) {
    $isAssignmentDataEmpty = false;
}

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
    <a href="dashboard.php">Dashboard</a>
    <a href="#">Track Item</a>
    <a href="#" onclick="openModal()">Add Item</a>
    <a href="../logout.php">Logout</a>
</div>

<!-- MAIN -->
<div class="main">
    <h2>Available Hardware</h2>
    <?php if ($isAssignmentDataEmpty) { ?>
        <p>No items have been assigned yet.</p>
    <?php } else { ?> 
        <p>There are items waiting to be displayed.</p>
    <?php } ?>

    </div>
</div>
<!-- MODAL -->
<div id="modal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal()">&times;</span>

    <h3>Add Item</h3>

    <form method="POST" action="add_item.php" enctype="multipart/form-data">
        <input type="text" name="category" placeholder="Item Name" required>
        <input type="text" name="serial" placeholder="Serial Number" required>
        <input type="file" name="image" required>

        <button type="submit">Add</button>
    </form>
  </div>
</div>

<!-- SCRIPT -->
<script>
function openModal() {
    document.getElementById("modal").style.display = "block";
}

function closeModal() {
    document.getElementById("modal").style.display = "none";
}
</script>

</body>
</html>