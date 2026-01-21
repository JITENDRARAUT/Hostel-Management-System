<?php
session_start();
include 'db.php';

if (!isset($_SESSION['warden_email'])) {
    echo "<script>alert('Please log in first.'); window.location.href='wardenlogin.html';</script>";
    exit();
}

$students = $conn->query("SELECT * FROM students");

$bookings = $conn->query("SELECT b.id, s.name, b.room_number, b.booking_date 
                          FROM bookings b JOIN students s ON b.student_id = s.id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Warden Dashboard</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 20px;
      background-color: #f9f9f9;
    }

    h1, h2 {
      text-align: center;
    }

    table {
      width: 90%;
      border-collapse: collapse;
      margin: 20px auto;
    }

    th, td {
      border: 1px solid #ccc;
      padding: 8px;
      text-align: center;
    }

    th {
      background-color: #f0f0f0;
    }

    .back-button {
      position: fixed;
      top: 20px;
      left: 20px;
      width: 40px;
      height: 40px;
      text-align: center;
      line-height: 40px;
      font-size: 20px;
      text-decoration: none;
      background-color: #007bff;
      color: #ffffff; /* Explicitly set emoji color to white */
      border-radius: 50%;
      transition: background-color 0.3s;
      z-index: 1000;
    }

    .back-button:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>

<a href="wardenlogin.html" class="back-button">&#x2190;</a>

<h1>Welcome, Warden</h1>

<h2>📋 All Students</h2>
<table>
  <tr>
    <th>ID</th><th>Name</th><th>Gender</th><th>Email</th><th>Phone</th>
  </tr>
  <?php while($s = $students->fetch_assoc()) { ?>
  <tr>
    <td><?= htmlspecialchars($s['id']) ?></td>
    <td><?= htmlspecialchars($s['name']) ?></td>
    <td><?= htmlspecialchars($s['gender']) ?></td>
    <td><?= htmlspecialchars($s['email']) ?></td>
    <td><?= htmlspecialchars($s['phone']) ?></td>
  </tr>
  <?php } ?>
</table>

<h2>🛏️ Room Bookings</h2>
<table>
  <tr>
    <th>Booking ID</th><th>Student</th><th>Room</th><th>Date</th>
  </tr>
  <?php while($b = $bookings->fetch_assoc()) { ?>
  <tr>
    <td><?= htmlspecialchars($b['id']) ?></td>
    <td><?= htmlspecialchars($b['name']) ?></td>
    <td><?= htmlspecialchars($b['room_number']) ?></td>
    <td><?= htmlspecialchars($b['booking_date']) ?></td>
  </tr>
  <?php } ?>
</table>

</body>
</html>