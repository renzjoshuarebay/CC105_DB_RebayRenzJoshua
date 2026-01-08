<?php
require_once 'db.php';

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $course = $_POST['course'];
    $year = $_POST['year'];

    $stmt = $conn->prepare("INSERT INTO students (name, course, year) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $course, $year);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add Student</title>
<style>
body{font-family:Arial,sans-serif; background:#2c3e50; color:#ecf0f1;}
.container{max-width:500px;margin:50px auto;background:#34495e;padding:30px;border-radius:10px;}
input, select{width:100%;padding:10px;margin:10px 0;border-radius:5px;border:none;}
button{padding:10px 15px;background:#27ae60;color:white;border:none;border-radius:5px; cursor:pointer;}
button:hover{background:#1e8449;}
a{color:#f1c40f;text-decoration:none;}
</style>
</head>
<body>
<div class="container">
<h2>Add New Student</h2>
<form method="post">
    <input type="text" name="name" placeholder="Student Name" required>
    <input type="text" name="course" value="BSCS" readonly>
    <select name="year" required>
        <option value="">Select Year</option>
        <option value="1st Year">1st Year</option>
        <option value="2nd Year">2nd Year</option>
        <option value="3rd Year">3rd Year</option>
        <option value="4th Year">4th Year</option>
    </select>
    <button type="submit" name="submit">Add Student</button>
</form>
<a href="index.php">← Back to List</a>
</div>
</body>
</html>
