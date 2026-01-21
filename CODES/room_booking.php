<?php
session_start();
include 'db.php';

if (!isset($_SESSION['student_id'])) {
    echo "<script>alert('Please log in first.'); window.location.href='studentlogin.html';</script>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_SESSION['student_id'];
    $room_number = $_POST['room_number'];
    $booking_date = $_POST['booking_date'];

    $check = $conn->query("SELECT * FROM bookings WHERE room_number='$room_number'");
    if ($check->num_rows > 0) {
        echo "<script>alert('Room already booked! Choose another.'); window.location.href='roomreserve.html';</script>";
    } else {
        $sql = "INSERT INTO bookings (student_id, room_number, booking_date)
                VALUES ('$student_id', '$room_number', '$booking_date')";
        
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Room reserved successfully!'); window.location.href='booking_history.php';</script>";
        } else {
            echo "<script>alert('Booking failed: " . $conn->error . "'); window.location.href='roomreserve.html';</script>";
        }
    }
}
?>
