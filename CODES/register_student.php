<?php

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $name = $firstname . ' ' . $lastname;
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $country_code = $_POST['country_code'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];

    $photo = $_FILES['photo']['name'];
    $target = "uploads/" . basename($photo);

    $stmt = $conn->prepare("SELECT id FROM students WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        echo "<script>alert('Email already registered'); window.location.href='registration.html';</script>";
        exit();
    }
    $stmt->close();

    if (move_uploaded_file($_FILES['photo']['tmp_name'], $target)) {
        $stmt = $conn->prepare("INSERT INTO students (name, gender, phone, country_code, email, password, address, photo)
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $name, $gender, $phone, $country_code, $email, $password, $address, $photo);

        if ($stmt->execute()) {
            echo "<script>alert('Registration successful'); window.location.href='studentlogin.html';</script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "'); window.location.href='registration.html';</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Photo upload failed'); window.location.href='registration.html';</script>";
    }
}
?>