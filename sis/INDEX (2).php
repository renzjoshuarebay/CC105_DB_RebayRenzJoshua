<?php
require_once 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Student Information System</title>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
<style>
body { font-family: 'Roboto', sans-serif; margin:0; padding:0; background:#2c3e50; color:#ecf0f1; }
.container { max-width:1000px; margin:50px auto; background:#34495e; padding:40px; border-radius:15px; box-shadow:0 8px 25px rgba(0,0,0,0.3);}
h1 {text-align:center; color:#f1c40f; margin-bottom:30px; display:flex; align-items:center; justify-content:center; gap:10px;}
.stickman{font-size:40px;}
table {width:100%; border-collapse:collapse; margin-top:20px; background-color:#2c3e50; border-radius:10px; overflow:hidden;}
th, td {padding:15px; text-align:left;}
th {background-color:#1abc9c; color:white;}
tr:nth-child(even){background-color: rgba(255,255,255,0.05);}
tr:hover{background-color: rgba(241,196,15,0.2);}
.action-buttons a {text-decoration:none; padding:6px 12px; margin-right:5px; border-radius:5px; color:white; font-weight:bold; transition:0.3s;}
.edit-btn{background-color:#3498db;} .edit-btn:hover{background-color:#2980b9;}
.delete-btn{background-color:#e74c3c;} .delete-btn:hover{background-color:#c0392b;}
.add-btn {background-color:#27ae60; color:white; padding:10px 15px; border-radius:5px; display:inline-block; margin-bottom:15px;}
.add-btn:hover {background-color:#1e8449;}
.footer{text-align:center; margin-top:30px; color:#bdc3c7; font-size:14px;}
@media(max-width:768px){.container{padding:20px;} th,td{padding:10px;}}
</style>
</head>
<body>

<div class="container">
<h1><span class="stickman">🧍</span> Student Information System</h1>

<a href="add.php" class="add-btn">+ Add New Student</a>

<table>
<tr>
<th>ID</th>
<th>Name</th>
<th>Course</th>
<th>Year</th>
<th>Action</th>
</tr>

<?php
$result = $conn->query("SELECT * FROM students ORDER BY id ASC");
if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()){
        $id = $row['id'];
        $name = $row['name'];
        $course = $row['course'];
        $year = $row['year'];
        echo "<tr>
                <td>$id</td>
                <td>$name</td>
                <td>$course</td>
                <td>$year</td>
                <td class='action-buttons'>
                    <a href='edit.php?id=$id' class='edit-btn'>Edit</a>
                    <a href='delete.php?id=$id' class='delete-btn' onclick=\"return confirm('Are you sure you want to delete this student?');\">Delete</a>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='5' style='text-align:center;'>No students found</td></tr>";
}
?>

</table>
<div class="footer">&copy; <?php echo date("Y"); ?> Student Information System</div>
</div>
</body>
</html>
