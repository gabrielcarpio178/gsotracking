<?php
require 'dbCon.php';
include 'generateQrHistory.php';
sleep(1);
function updateMain($id, $conn){
    try {
        mysqli_query($conn, "UPDATE `purchase_request_list` SET `doingMaintenance`= NOW() WHERE id = '$id'");
        return "success";
    } catch (\Throwable $th) {
        return $th;
    }
}

function insertMaintenance($purchase_request_code, $conn){
    try {
        mysqli_query($conn, "INSERT INTO `maintenance`(`purchase_request_list_id`) VALUES ('$purchase_request_code')");
        return "success";
    } catch (\Throwable $th) {
        return $th;
    }
}
print_r($_POST);
if(isset($_POST['id'])&&isset($_POST['usercode'])&&isset($_POST['isDisabled'])){
    $id = $_POST['id'];
    $usercode = $_POST['usercode'];
    $isDisabled = $_POST['isDisabled'];
    if(updateMain($id, $conn)=="success"){
        insertEquipmentHistory($conn, $usercode, $id, $isDisabled, "Maintenance");
        echo insertMaintenance($id, $conn);
    }
}    
