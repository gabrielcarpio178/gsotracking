<?php
require_once '../logic/dbCon.php';

$id = $_POST['id'];

$stmt = $conn->prepare("DELETE FROM dashboard WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => $conn->error]);
}

?>