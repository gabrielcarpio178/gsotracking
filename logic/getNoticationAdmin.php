<?php
require 'dbCon.php';
function getNotificationPurchaseRequestData($conn){
    $stmt = $conn->prepare("SELECT u.fullname, p.purchase_request_code, p.status, p.datetime FROM `users` AS u JOIN `purchase_request` AS p ON u.`usercode` = p.`requester_code`");
    $stmt->execute();
    $result = $stmt->get_result();
    $data_return = [];
    while($row = $result->fetch_assoc()){
        $row['type_noti'] = 'purchase_request';
        $data_return[] = $row;
    }
    return $data_return;
}
function getNotificationRequestMaintenanceData($conn){
    $stmt = $conn->prepare("SELECT u.fullname, rm.purchase_request_list_id, rm.request_datetime AS datetime, rm.request_status, p.item_name FROM request_maintenance AS rm JOIN purchase_request_list AS p ON rm.purchase_request_list_id = p.id JOIN users AS u ON rm.usercode = u.usercode");
    $stmt->execute();
    $result = $stmt->get_result();
    $data_return = [];
    while($row = $result->fetch_assoc()){
        $row['type_noti'] = 'request_maintenance';
        $data_return[] = $row;
    }
    return $data_return;
}

if(isset($_GET['admin'])){
    $purchase_request = getNotificationPurchaseRequestData($conn);
    $request_maintenance = getNotificationRequestMaintenanceData($conn);
    print_r(json_encode(array_merge($purchase_request, $request_maintenance)));
}