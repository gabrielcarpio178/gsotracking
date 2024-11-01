<?php
require '../dbCon.php';
if(isset($_GET['employee_id']));
$employee_id = $_GET['employee_id'];
$stmt = $conn->prepare("SELECT r.requester_code, l.`purchase_request_code` ,l.`item_name`, l.`quantity`, l.`price`, l.`specs`, r.`datetime`, r.`status` FROM `purchase_request_list` AS l JOIN `purchase_request` AS r ON l.purchase_request_code = r.purchase_request_code WHERE r.requester_code = ? ORDER BY r.id DESC;");
$stmt->bind_param('s', $employee_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $userData = [];
    while ($row = $result->fetch_assoc()) {
        $row['datetime'] = date('Y-m-d H:i a', strtotime($row['datetime']));
        $userData[] = $row;
    }
    echo json_encode($userData);
} else {
    echo json_encode([]);
}
?>
