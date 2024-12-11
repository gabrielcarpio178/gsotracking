<?php
require 'dbCon.php';
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
if(isset($_POST['id'])){
    $id = $_POST['id'];
    $purchase_request_code = $_POST['purchase_request_code'];
    if(updateMain($id, $conn)=="success"){
        echo insertMaintenance($id, $conn);
    }
}    
