<?php
require 'dbCon.php';

function updateRequestMaintenance($usercode, $purchase_request_code, $conn){
    $stmt = $conn->prepare("UPDATE `request_maintenance` SET `request_status`= 1 WHERE `usercode` = ? AND `purchase_request_list_id` = ? AND `request_status` = 0");
    $stmt->bind_param('ss', $usercode, $purchase_request_code);
    return $stmt->execute();
}

function updatePurchaseRequest($purchase_request_code, $conn){
    $stmt = $conn->prepare("UPDATE `purchase_request_list` SET `request_maintenance`= NULL WHERE `id` = ?");
    $stmt->bind_param('s', $purchase_request_code);
    return $stmt->execute();
}

if(isset($_POST['usercode'])&&isset($_POST['purchase_request_code'])){
    $usercode = $_POST['usercode'];
    $purchase_request_code = $_POST['purchase_request_code'];
    if(updateRequestMaintenance($usercode, $purchase_request_code, $conn)){
        if(updatePurchaseRequest($purchase_request_code, $conn)){
            echo "success";
        }
    }
}

