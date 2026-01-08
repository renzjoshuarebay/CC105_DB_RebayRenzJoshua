<?php
require_once 'db.php';

// Get the student ID from URL
$id = $_GET['id'] ?? null;

// If no ID, redirect to index
if(!$id){
    header("Location: index.php");
    exit;
}

// Fetch the student data
$stmt = $conn->prepare("SELECT * FROM students WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();
$stmt->close();

// If student not found, redirect
if(!$student){
    header("Location: index.php");
    exit;
}

// Handle form submission
if(isset($_POST['submit'])){
    $name = trim($_POST['name']);
    $course = trim($_POST['course']);
    $year = trim($_POST['year']);

    // Validate inputs
    if($name != "" && $course != "" && $year != ""){
        $stmt = $conn->prepare("UPDATE students SET name=?, course=?, year=? WHERE id=?");
        $stmt->bind_param("sssi", $name, $course, $year, $id);
        $stmt->execute();
        $stmt->close();

        // Redirect to index after update
        header("Location: index.php");
        exit;
    } else {
        $error = "All fields are required!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Student</title>
<style>
body{font-family:Arial,sans-serif; background:#2c3e50; color:#ecf0f1;}
.container{max-width:500px;margin:50px auto;background:#34495e;padding:30px;border-radius:10px; box-shadow:0 4px 15px rgba(0,0,0,0.3);}
input, select{width:100%;padding:10px;margin:10px 0;border-radius:5px;border:none;}
button{padding:10px 15px;background:#3498db;color:white;border:none;border-radius:5px; cursor:pointer; font-weight:bold;}
button:hover{background:#2980b9;}
a{color:#f1c40f;text-decoration:none; display:inline-block; margin-top:10px;}
.error{color:#e74c3c; margin-bottom:10px; font-weight:bold;}
</style>
</head>
<body>
<div class="container">
<h2>Edit Student</h2>

<?php if(isset($error)) echo "<div class='error'>$error</div>"; ?>

<form method="post">
    <label>Name:</label>
    <input type="text" name="name" value="<?php echo htmlspecialchars($student['name']); ?>" required>

    <label>Course:</label>
    <input type="text" name="course" value="<?php echo htmlspecialchars($student['course']); ?>" readonly>

    <label>Year:</label>
    <select name="year" required>
        <option value="1st Year" <?php if($student['year']=="1st Year") echo "selected"; ?>>1st Year</option>
        <option value="2nd Year" <?php if($student['year']=="2nd Year") echo "selected"; ?>>2nd Year</option>
        <option value="3rd Year" <?php if($student['year']=="3rd Year") echo "selected"; ?>>3rd Year</option>
        <option value="4th Year" <?php if($student['year']=="4th Year") echo "selected"; ?>>4th Year</option>
    </select>

    <button type="submit" name="submit">Update Student</button>
</form>

<a href="index.php">← Back to List</a>
</div>
</body>
</html>
