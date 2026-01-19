<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM bookings WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Booking deleted successfully'); window.location.href='admindashboard.php';</script>";
    } else {
        echo "<script>alert('Failed to delete booking'); window.location.href='admindashboard.php';</script>";
    }
    $stmt->close();
}
?>
