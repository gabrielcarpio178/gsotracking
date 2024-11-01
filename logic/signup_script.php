<?php
require 'dbCon.php';
session_start();

$usercode = generateUserCode($conn);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$birthdate = mysqli_real_escape_string($conn, $_POST['birthdate']);
$password = encrypt($password, secretKey());
$phonenumber = mysqli_real_escape_string($conn, $_POST['phonenumber']);
$fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
$gender = mysqli_real_escape_string($conn, $_POST['gender']);
$role = role($conn);
$status = 'active';

$stmt = $conn->prepare('INSERT INTO users (`usercode`, `email`, `password`, `phone_number`, `fullname`,`birthdate`, `gender`, `role`, `status`) VALUES (?,?,?,?,?,?,?,?,?)');
$stmt->bind_param('sssssssss', $usercode, $email, $password, $phonenumber, $fullname, $birthdate, $gender, $role, $status);

if ($stmt->execute()) {
    header('Location:../');
} else {
    echo 'Error: ' . $stmt->error;
}
$stmt->close();
$conn->close();
?>