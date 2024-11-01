<?php
include 'dbCon.php';
session_start();

$usercode = $_SESSION['usercode'];
$fullname = $_POST['fullname'];
$phone_number = $_POST['phone_number'];
$email = $_POST['email'];
$password = $_POST['password'];
$password = encrypt($password, secretKey());

$stmt = $conn->prepare("UPDATE users SET fullname =?, email =?, password =?, phone_number = ? WHERE usercode =?");
$stmt->bind_param("sssss", $fullname, $email, $password, $phone_number, $usercode);

if ($stmt->execute()) {
    header("Location: ../pages/settings.php");
} else {
    echo "Error updating user: ". $stmt->error;
}

?>