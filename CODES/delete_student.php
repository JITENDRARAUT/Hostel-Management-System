<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];

    $conn->query("DELETE FROM bookings WHERE student_id = $id");

    $sql = "DELETE FROM students WHERE id = $id";
    if ($conn->query($sql)) {
        echo "<script>alert('Student deleted successfully'); window.location.href='admindashboard.php';</script>";
    } else {
        echo "<script>alert('Failed to delete student'); window.location.href='admindashboard.php';</script>";
    }
}
?>
