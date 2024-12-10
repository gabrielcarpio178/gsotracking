<?php
require 'dbCon.php';
session_start();
sleep(1);

function insertRequest($usercode, $request_code, $conn){
    $stmt = $conn->prepare("INSERT INTO `request_maintenance`( `usercode`, `purchase_request_list_id`) VALUES (?, ?)");
    $stmt->bind_param('ss', $usercode, $request_code);
    return $stmt->execute();
}

function updateRequest($request_code, $conn){
    $stmt = $conn->prepare("UPDATE `purchase_request_list` SET `request_maintenance`= NOW() WHERE `id` = ?");
    $stmt->bind_param('s', $request_code);
    return $stmt->execute();
}


if(isset($_POST['purchase_request_code'])){
    $usercode = $_SESSION['usercode'];
    $request_code = $_POST['purchase_request_code'];

    if(insertRequest($usercode, $request_code, $conn)){
        if(updateRequest($request_code, $conn)){
            echo "success";
        }
    }
    
}