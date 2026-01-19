<?php
session_start();
include 'db.php';

if (!isset($_SESSION['student_id'])) {
    echo "<script>alert('Please log in first.'); window.location.href='studentlogin.html';</script>";
    exit();
}

$student_id = $_SESSION['student_id'];
$sql = "SELECT * FROM bookings WHERE student_id = $student_id ORDER BY booking_date DESC";
$result = $conn->query($sql);
if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Booking History</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        table { width: 80%; border-collapse: collapse; margin: 20px auto; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>

<h2 style="text-align:center;">My Room Booking History</h2>

<table>
    <tr>
        <th>Booking ID</th>
        <th>Room Number</th>
        <th>Booking Date</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['room_number']}</td>
                    <td>{$row['booking_date']}</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No bookings found.</td></tr>";
    }
    ?>
</table>

</body>
</html>