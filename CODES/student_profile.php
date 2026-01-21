<?php
session_start();
include 'db.php';

if (!isset($_SESSION['student_id'])) {
    echo "<script>alert('Please log in first.'); window.location.href='studentlogin.html';</script>";
    exit();
}

$student_id = $_SESSION['student_id'];
$sql = "SELECT * FROM students WHERE id='$student_id'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $student = $result->fetch_assoc();
} else {
    echo "<p>Student not found.</p>";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Profile</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        .profile-card {
            width: 400px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 12px;
            box-shadow: 2px 2px 10px rgba(0,0,0,0.1);
        }
        .profile-card img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="profile-card">
    <h2><?php echo htmlspecialchars($student['name']); ?></h2>
    <img src="uploads/<?php echo htmlspecialchars($student['photo']); ?>" alt="Student Photo">
    <p><strong>Gender:</strong> <?php echo $student['gender']; ?></p>
    <p><strong>Email:</strong> <?php echo $student['email']; ?></p>
    <p><strong>Phone:</strong> <?php echo $student['phone']; ?></p>
</div>

</body>
</html>
