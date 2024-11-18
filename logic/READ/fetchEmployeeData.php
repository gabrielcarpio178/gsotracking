<?php
require '../dbCon.php';
sleep(1);
$search = $_POST['code'];
// $search = 2952017637;

$stmt = $conn->prepare("SELECT l.`maintance` ,l.`id`, l.`purchase_request_code`, l.`item_name`, l.`quantity`, l.`specs`, l.`status`, p.`datetime`, u.`fullname` FROM `users` AS u JOIN `purchase_request` AS p ON u.`usercode` = p.`requester_code` JOIN `purchase_request_list` AS l ON l.`purchase_request_code` = p.`purchase_request_code` WHERE l.`status` = ?;");
$stmt->bind_param('s', $search);
$stmt->execute();
$result = $stmt->get_result();
$return_data = [];
while($row = $result->fetch_assoc()){
    $row['maintance'] = timeAgo($row['maintance']);
    $row['datetime'] = date('Y-m-d H:i a', strtotime($row['datetime']));
    $return_data[] = $row;
}

print_r(json_encode($return_data));

?>
