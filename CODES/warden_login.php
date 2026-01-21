<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM warden WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $_SESSION['warden_email'] = $email;
        header("Location: wardendashboard.php");
    } else {
        echo "<script>alert('Invalid credentials'); window.location.href='wardenlogin.html';</script>";
    }
}
?>
