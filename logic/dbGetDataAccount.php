<?php
require 'dbCon.php';

function getuserpersonalData($id, $conn){
    $stmt = $conn->prepare('SELECT `usercode`,`email`,`phone_number`,`fullname`,`birthdate`,`gender`,`department`,`position` FROM `users` WHERE `usercode` = ?');
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $row['birthday'] = date('Y-m-d H:i a', strtotime($row['birthdate']));
    return $row;
}

function getAllProduct($id, $conn){
    $stmt = $conn->prepare("SELECT prl.item_name, prl.quantity, prl.price, pr.datetime, pr.purchase_request_code FROM users AS u INNER JOIN purchase_request AS pr ON u.usercode = pr.requester_code INNER JOIN purchase_request_list AS prl ON pr.purchase_request_code = prl.purchase_request_code WHERE u.usercode = ? AND pr.status = 'accept';");
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
    $userData = [];
    while ($row = $result->fetch_assoc()) {
        $row['datetime'] = date('Y-m-d H:i a', strtotime($row['datetime']));
        $userData[] = $row;
    }
        return $userData;
    } else {
        return [];
    }
}



if(isset($_POST['id'])){
    $id = $_POST['id'];
    $data_result = ['data'=>getuserpersonalData($id, $conn), 'equipments_list'=>getAllProduct($id, $conn)];
    print_r(json_encode($data_result));
}