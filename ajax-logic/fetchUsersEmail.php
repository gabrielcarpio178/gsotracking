<?php
require '../logic/dbCon.php';
session_start();

$text = $_POST['search'];

$stmt = $conn->prepare("SELECT * FROM users WHERE fullname LIKE CONCAT('%',?, '%') OR email LIKE CONCAT('%',?, '%')");
$stmt->bind_param('ss', $text, $text);
$stmt->execute();
$result = $stmt->get_result();
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = [
        'fullname' => $row['fullname'],
        'email' => $row['email'],
        'usercode' => $row['usercode']
    ];
}
echo json_encode($data);
?>