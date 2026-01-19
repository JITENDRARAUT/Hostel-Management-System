<?php
<?php
session_start();
include 'db.php';

if (!isset($_SESSION['student_id'])) {
    echo json_encode(['error' => 'Not logged in']);
    exit();
}

$student_id = $_SESSION['student_id'];
$sql = "SELECT firstname, lastname, age, gender, dob, country_code, phone, email, room_number, photo FROM students WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$stmt->bind_result($firstname, $lastname, $age, $gender, $dob, $country_code, $phone, $email, $room_number, $photo);
$stmt->fetch();
$stmt->close();

echo json_encode([
    'name' => $firstname . ' ' . $lastname,
    'age' => $age,
    'gender' => $gender,
    'dob' => $dob,
    'country_code' => $country_code,
    'phone' => $phone,
    'email' => $email,
    'room_number' => $room_number,
    'photo' => $photo
]);
?>