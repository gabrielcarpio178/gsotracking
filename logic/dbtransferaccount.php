<?php
require 'dbCon.php';
include 'generateQrHistory.php';

function updateEquipment($conn, $to, $equipment_id){

    $stmt = $conn->prepare("UPDATE `purchase_request_list` SET `requester_code` = ? WHERE `id` = ?");
    $stmt->bind_param('ss', $to, $equipment_id);
    return $stmt->execute();
    
}

function transfersEquipment($conn, $to, $selected_equipments){
    $result = false;
    foreach ($selected_equipments as $equipment) {
        insertEquipmentHistory($conn, $to, $equipment, 'Transfer Equipment');
        if(!updateEquipment($conn, $to, $equipment)){
            $result = true; 
        }
        
    }
    return $result;
}


function userData($conn, $to, $selected_equiments){
    if(!transfersEquipment($conn, $to, $selected_equiments)){
        echo "success";
    }else{
        echo "error occur";
    }
}


function insertNotification($conn){
    $stmt = $conn->prepare("INSERT INTO `notification`(`request_type`) VALUES ('transfer_account')");
    if ($stmt->execute()) {
        return "success";
    }
}

if(isset($_POST['from'])&&isset($_POST['to'])&&isset($_POST['selected_equiments'])){
    $from = $_POST['from'];
    $to = $_POST['to'];
    $selected_equiments = $_POST['selected_equiments'];
    if(insertNotification($conn)=="success"){
        echo userData($conn, $to, $selected_equiments);
    }
}
