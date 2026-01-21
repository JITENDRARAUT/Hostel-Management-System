<?php
session_start();
include 'db.php';

if (!isset($_SESSION['student_id'])) {
    echo "<script>alert('Please log in first.'); window.location.href='studentlogin.html';</script>";
    exit();
}

$student_id = $_SESSION['student_id'];
$sql = "SELECT name, gender, phone, email, photo, country_code, address FROM students WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$stmt->bind_result($name, $gender, $phone, $email, $photo, $country_code, $address);
$stmt->fetch();
$stmt->close();

$photo_url = !empty($photo) ? 'uploads/' . $photo : "https://via.placeholder.com/100";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Student Dashboard - Hostel Management</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: #f2f2f2;
    }
    header {
      background-color: #004080;
      color: white;
      padding: 20px;
      text-align: center;
    }
    .dashboard {
      display: flex;
      flex-wrap: wrap;
      padding: 20px;
    }
    .sidebar {
      flex: 1 1 200px;
      background-color: #0066cc;
      color: white;
      padding: 20px;
      min-height: 100vh;
    }
    .sidebar h2 {
      margin-top: 0;
    }
    .sidebar a {
      display: block;
      padding: 10px;
      margin: 10px 0;
      background-color: #005bb5;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      transition: background 0.3s;
    }
    .sidebar a:hover {
      background-color: #004080;
    }
    .content {
      flex: 3 1 600px;
      padding: 20px;
      background-color: white;
      border-radius: 10px;
      margin-left: 20px;
    }
    .profile-card {
      background-color: #e6f0ff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .profile-card img {
      width: 100px;
      border-radius: 50%;
      border: 3px solid #004080;
    }
    .profile-details {
      margin-top: 10px;
    }
    .profile-details p {
      margin: 5px 0;
    }
    footer {
      text-align: center;
      padding: 15px;
      background-color: #004080;
      color: white;
      margin-top: 40px;
    }
    @media (max-width: 768px) {
      .dashboard {
        flex-direction: column;
      }
      .content {
        margin-left: 0;
        margin-top: 20px;
      }
    }
  </style>
</head>
<body>

  <header>
    <h1>Welcome to Ambition Hostel - Student Dashboard</h1>
  </header>

  <div class="dashboard">
    <div class="sidebar">
      <h2>Menu</h2>
      <h2>Welcome, <?php echo htmlspecialchars($name); ?></h2>
      <div class="profile-card">
        <h2><?php echo htmlspecialchars($name); ?></h2>
        <img src="<?php echo htmlspecialchars($photo_url); ?>" alt="Student Photo">
        <p><strong>Gender:</strong> <?php echo htmlspecialchars($gender); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
        <p><strong>Phone:</strong> <?php echo htmlspecialchars($phone); ?></p>
      </div>
      <a href="studentdashboard.php">Dashboard</a>
      <a href="student_profile.php">Profile</a>
      <a href="Room.html">Room Details</a>
      <a href="payment.html">Renew Payment</a>
      <a href="student_profile.php">View My Profile</a>
      <a href="booking_history.php">View My Booking History</a>
      <a href="logout.php">Logout</a>
    </div>

    <div class="content" id="student-profile">
      <h2>Student Profile</h2>
      <div class="profile-card">
        <img src="<?php echo htmlspecialchars($photo_url); ?>" alt="Student Photo">
        <div class="profile-details">
          <p><strong>Name:</strong> <?php echo htmlspecialchars($name); ?></p>
          <p><strong>Gender:</strong> <?php echo htmlspecialchars($gender); ?></p>
          <p><strong>Phone:</strong> <?php echo htmlspecialchars($country_code . '-' . $phone); ?></p>
          <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
          <p><strong>Address:</strong> <?php echo htmlspecialchars($address); ?></p>
        </div>
      </div>
    </div>
  </div>

  <footer>
    &copy; 2025 Ambition Hostel | ambitionhostel123@gmail.com
  </footer>
</body>
</html>