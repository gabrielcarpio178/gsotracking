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
    $stmt = $conn->prepare("SELECT u.usercode, pr.purchase_request_code, prl.id, prl.item_name, prl.quantity, pr.datetime FROM purchase_request_list AS prl JOIN users AS u ON prl.requester_code = u.usercode JOIN purchase_request AS pr ON prl.purchase_request_code = pr.purchase_request_code WHERE u.usercode = ? AND pr.status = 'accept';");
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