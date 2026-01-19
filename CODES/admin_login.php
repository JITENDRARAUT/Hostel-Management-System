<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $_SESSION['admin_email'] = $email;
header("Location: admindashboard.php");

    } else {
        echo "<script>alert('Invalid credentials'); window.location.href='adminlogin.html';</script>";
    }
}
?>
