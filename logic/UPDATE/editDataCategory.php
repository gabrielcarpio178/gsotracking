<?php
require_once '../dbCon.php';

$id = $_POST['id'];
$equipment = $_POST['equipment'];
$quantity = $_POST['quantity'];
$price = $_POST['price'];

$stmt = $conn->prepare("UPDATE equipment SET equipment = ?, quantity = ?, price = ? WHERE id = ?");
$stmt->bind_param("ssss", $equipment, $quantity, $price, $id);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => $conn->error]);
}
?>