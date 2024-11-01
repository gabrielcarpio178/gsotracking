<?php
require 'dbCon.php';
session_start();

// $sender = $_POST['from'];
$sender = $_SESSION['usercode'];
$receiver = $_POST['usercode'];
$message = $_POST['message'];
$date = date('Y-m-d H:i:s', time());
$status = 'active';

$stmt = $conn->prepare("INSERT INTO messages (sender, receiver, message, status, datetime) VALUES (?,?,?,?,?)");
$stmt->bind_param("sssss", $sender, $receiver, $message, $status, $date);

if ($stmt->execute()) {
    $_SESSION['messages'] = 'send message successfully';
    header("location: ../pages/admin_messages.php");
} else {
    $_SESSION['messages'] = 'error sending message';
    header("location: ../pages/admin_messages.php");
}
?>