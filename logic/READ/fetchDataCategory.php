<?php
require_once '../dbCon.php';

$category = $_POST['category'];

$stmt = $conn->prepare("SELECT * FROM equipment WHERE category = ? ORDER BY id DESC");
$stmt->bind_param("s", $category);
$stmt->execute();
$result = $stmt->get_result();

$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
?>