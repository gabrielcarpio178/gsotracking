<?php
require '../dbCon.php';
session_start();

// Capture form data
$quantity = $_POST['quantity'];
$equipmentId = $_POST['equipmentId'];
$requester = $_POST['requester'];

if (!isset($quantity, $equipmentId, $requester)) {
    // Handle missing data
    echo "Invalid request";
    // exit();
}

// Fetch current equipment quantity
$stmt = $conn->prepare("SELECT quantity FROM equipment WHERE eq_unicode = ?");
$stmt->bind_param('s', $equipmentId);
$stmt->execute();
$stmt->bind_result($currentQuantity);
$stmt->fetch();
$stmt->close();

// Check if there is enough quantity
if ($currentQuantity < $quantity) {
    // Not enough quantity
    echo "Not enough quantity available";
    $conn->close();
    // header("Location: ../../pages/client/equipment_list.php");
    exit();
}

// Update equipment quantity
$newQuantity = $currentQuantity - $quantity;
$stmt = $conn->prepare("UPDATE equipment SET quantity = ? WHERE eq_unicode = ?");
$stmt->bind_param('ss', $newQuantity, $equipmentId);
$stmt->execute();
$stmt->close();

// Optionally, update the user request
$status = 'success';
$stmt = $conn->prepare("UPDATE borrowed_equipment SET status2 = ? WHERE borrower_id = ? AND equipment_id = ?");
$stmt->bind_param('sss', $status, $requester, $equipmentId);
$stmt->execute();
$stmt->close();

// Set success message in session
echo "Request successfully processed";

// Close connection and redirect
$conn->close();
// header("Location: ../../pages/client/request_list.php");
// exit();
?>
