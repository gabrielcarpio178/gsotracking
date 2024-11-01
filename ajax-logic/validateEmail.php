<?php
require '../logic/dbCon.php';

$email = $_POST['email'];
$stmt = $conn->prepare("SELECT email,usercode FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    echo json_encode([
        'email' => 'exists',
        'usercode' => $result->fetch_assoc()['usercode']
    ]);
} else {
    echo json_encode([
        'email' => 'does not exist'
    ]);
}
?>