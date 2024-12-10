<?php
require 'dbCon.php';

function updateEquipment($conn, $to, $equipment_id){

    $stmt = $conn->prepare("UPDATE `purchase_request` SET `requester_code` = ? WHERE `purchase_request_code` = ?");
    $stmt->bind_param('ss', $to, $equipment_id);
    return $stmt->execute();
    

}

function transfersEquipment($conn, $to, $selected_equipments){
    $result = false;
    foreach ($selected_equipments as $equipment) {
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

if(isset($_POST['from'])&&isset($_POST['to'])&&isset($_POST['selected_equiments'])){
    $from = $_POST['from'];
    $to = $_POST['to'];
    $selected_equiments = $_POST['selected_equiments'];
    userData($conn, $to, $selected_equiments);
}
