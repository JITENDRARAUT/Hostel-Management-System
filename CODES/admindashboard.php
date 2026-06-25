<?php
session_start();
include 'db.php';

if (!isset($_SESSION['admin_email'])) {
    echo "<script>alert('Please log in first.'); window.location.href='adminlogin.html';</script>";
    exit();
}

$students = $conn->query("SELECT * FROM students");

$bookings = $conn->query("SELECT b.id, s.name, b.room_number, b.booking_date 
                          FROM bookings b JOIN students s ON b.student_id = s.id");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        table { width: 90%; margin: 20px auto; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
        th { background-color: #f0f0f0; }
        h2 { text-align: center; }
        .btn-del {
            background-color: red; color: white; border: none;
            padding: 5px 10px; cursor: pointer; border-radius: 4px;
        }
        .btn-del:hover { background-color: darkred; }
        header { text-align: center; margin-bottom: 20px; }
        header a { text-decoration: none; color: #333; }
        header a:hover { color: #007BFF; }
        h1 { text-align: center; color: #333; }
        h2 { color: #555; } 
        table tr:nth-child(even) { background-color: #f9f9f9; }
        table tr:hover { background-color: #f1f1f1; }

    </style>
</head>
<body>
    

<h1>Welcome, Admin</h1>

<h2> Manage Students</h2>
<table>
    <tr>
        <th>ID</th><th>Name</th><th>Gender</th><th>Email</th><th>Phone</th><th>Action</th>
    </tr>
    <?php while($s = $students->fetch_assoc()) { ?>
    <tr>
        <td><?= $s['id'] ?></td>
        <td><?= $s['name'] ?></td>
        <td><?= $s['gender'] ?></td>
        <td><?= $s['email'] ?></td>
        <td><?= $s['phone'] ?></td>
        <td>
            <form action="delete_student.php" method="POST" onsubmit="return confirm('Delete this student?');">
                <input type="hidden" name="id" value="<?= $s['id'] ?>">
                <button type="submit" class="btn-del">Delete</button>
            </form>
        </td>
    </tr>
    <?php } ?>
</table>

<h2>🛏️ Manage Bookings</h2>
<table>
    <tr>
        <th>Booking ID</th><th>Student</th><th>Room</th><th>Date</th><th>Action</th>
    </tr>
    <?php while($b = $bookings->fetch_assoc()) { ?>
    <tr>
        <td><?= $b['id'] ?></td>
        <td><?= $b['name'] ?></td>
        <td><?= $b['room_number'] ?></td>
        <td><?= $b['booking_date'] ?></td>
        <td>
            <form action="delete_Bookings.php" method="POST" onsubmit="return confirm('Delete this booking?');">
                <input type="hidden" name="id" value="<?= $b['id'] ?>">
                <button type="submit" class="btn-del">Delete</button>
            </form>
        </td>
    </tr>
    <?php } ?>
</table>

</body>
</html>
