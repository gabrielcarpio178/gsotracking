<?php
require '../dbCon.php';
sleep(1);
$search = $_POST['code'];
// $search = 202400001;

$stmt = $conn->prepare("SELECT `purchase_request_code` FROM `purchase_request_list` WHERE `purchase_request_code` = ?;");
$stmt->bind_param('s', $search);
$stmt->execute();
$stmt->store_result();

if($stmt->num_rows > 0){
    echo $search;
}else{
    echo 'invalid';
}

?>
