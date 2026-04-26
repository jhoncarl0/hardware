<?php
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $category = $_POST['category'];
    $serial = $_POST['serial'];

    // IMAGE HANDLING
    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    // if no image uploaded → use default
    if ($image == "") {
        $image = "default.jpg";
    } else {
        move_uploaded_file($tmp, "../images/" . $image);
    }

    // INSERT INTO DATABASE
    $conn->query("INSERT INTO hardware (category, serial_number, status, image)
                  VALUES ('$category', '$serial', 'available', '$image')");

    // redirect back
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Item</title>

<style>
body {
    font-family: Arial;
    background: #ecf0f1;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.box {
    background: white;
    padding: 30px;
    width: 320px;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}

.box h3 {
    text-align: center;
}

input {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border-radius: 8px;
    border: 1px solid #ccc;
}

button {
    width: 100%;
    padding: 10px;
    background: #27ae60;
    border: none;
    color: white;
    border-radius: 8px;
    cursor: pointer;
}

button:hover {
    background: #219150;
}
</style>
</head>

<body>

<div class="box">
    <h3>Add Hardware Item</h3>

    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="category" placeholder="Item Name" required>
        <input type="text" name="serial" placeholder="Serial Number" required>

        <input type="file" name="image">

        <button type="submit">Add Item</button>
    </form>
</div>

</body>
</html>