<?php
require '../dbCon.php';
session_start();
// Capture form data
$category = $_POST['category321'];
$equipment_id = $_POST['equipment_id'];
$quantity = $_POST['quantity'];
$notes = $_POST['notes'];
$equipment = $_POST['equipment'];
$datetime = $_POST['datetime'];
$usercode = $_SESSION['usercode'];

// Print received data
// echo "Received datetime: " . $datetime . "<br/>";
// echo $category.'<br/>'.$quantity.'<br/>'.$notes.'<br/>'.$equipment.'<br/>'.$datetime;

$stmt = $conn->prepare("INSERT INTO request_equipment (requester_id, item_requested, equipment_id, category, datetime, notes, quantity) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param('isisssi',$usercode, $equipment, $equipment_id, $category, $datetime, $notes, $quantity);
$stmt->execute();
$stmt->close();
$conn->close();
header("location: ../../pages/client/equipment_list.php");
exit();
?>