<?php
require_once '../dbCon.php';

$category = $_POST['category'];
$equipment = $_POST['equipment'];
$quantity = $_POST['quantity'];
$price = $_POST['price'];
$date_acquired = date('Y-m-d'); // Only the date, not time

// First, check if an item with the same name, price, and date exists
$stmt = $conn->prepare("SELECT id, quantity FROM equipment WHERE category = ? AND equipment = ? AND price = ? AND DATE(date_stored) = ?");
$stmt->bind_param("ssds", $category, $equipment, $price, $date_acquired);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Item exists, update the quantity
    $row = $result->fetch_assoc();
    $new_quantity = $row['quantity'] + $quantity;
    $update_stmt = $conn->prepare("UPDATE equipment SET quantity = ? WHERE id = ?");
    $update_stmt->bind_param("ii", $new_quantity, $row['id']);
    
    if ($update_stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Quantity updated successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error updating quantity: ' . $conn->error]);
    }
} else {
    // Item doesn't exist, insert new record
    $insert_stmt = $conn->prepare("INSERT INTO equipment (category, equipment, quantity, price, date_stored) VALUES (?, ?, ?, ?, ?)");
    $insert_stmt->bind_param("ssids", $category, $equipment, $quantity, $price, $date_acquired);
    
    if ($insert_stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'New item added successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error adding new item: ' . $conn->error]);
    }
}
?>