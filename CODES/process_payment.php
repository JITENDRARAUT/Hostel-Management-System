<?php
session_start();
include 'db.php';

if (!isset($_SESSION['student_id'])) {
    echo "<script>
        alert('You must be logged in to make a payment.');
        window.location.href='studentlogin.php';
    </script>";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_SESSION['student_id'];  
    $amount = isset($_POST['amount']) ? (float) $_POST['amount'] : 0;
    $payment_method = isset($_POST['payment_method']) ? trim($_POST['payment_method']) : '';
    $payment_date = isset($_POST['payment_date']) ? trim($_POST['payment_date']) : '';

    if ($amount <= 0 || empty($payment_method) || empty($payment_date)) {
        echo "<script>
            alert('Please fill in all required fields.');
            window.history.back();
        </script>";
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO payments (student_id, amount, payment_method, payment_date)
                            VALUES (?, ?, ?, ?)");
    $stmt->bind_param("idss", $student_id, $amount, $payment_method, $payment_date);

    if ($stmt->execute()) {
        $stmt->close();
        echo "<script>
            alert('Payment submitted successfully.');
            window.location.href='studentdashboard.php';
        </script>";
    } else {
        echo "<script>
            alert('Payment failed. Please try again.');
            window.location.href='studentdashboard.php';
        </script>";
    }
}
?>
