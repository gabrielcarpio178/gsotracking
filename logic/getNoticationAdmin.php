<?php
require 'dbCon.php';
function getNotificationPurchaseRequestData($conn){
    $return_data = [];
    $stmt_count = $conn->prepare("SELECT u.fullname ,l.requester_code, n.id, p.purchase_request_code, p.status, p.datetime, n.admin, n.request_type FROM purchase_request_list AS l JOIN purchase_request AS p ON l.purchase_request_code = p.purchase_request_code JOIN users AS u ON l.requester_code = u.usercode JOIN notification AS n ON n.id = p.notification_id WHERE n.request_type = 'purchase_request' GROUP BY n.id;");
    $stmt_count->execute();
    $result_count = $stmt_count->get_result();
    
    while($row_count = $result_count->fetch_assoc()){
        $return_data[] = $row_count;
    }
    return $return_data;
}
function getNotificationRequestMaintenanceData($conn){
    $return_data = [];
    $stmt_count = $conn->prepare('SELECT u.fullname, p.item_name, n.admin, n.request_type, n.id, r.request_datetime AS datetime, r.request_status FROM notification AS n JOIN request_maintenance AS r ON n.id = r.notification_id JOIN purchase_request_list AS p ON r.purchase_request_list_id = p.id JOIN users AS u ON u.usercode = r.usercode GROUP BY n.id ORDER BY r.request_datetime DESC');
    $stmt_count->execute();
    $result_count = $stmt_count->get_result();
    
    while($row_count = $result_count->fetch_assoc()){
        $return_data[] = $row_count;
    }
    return $return_data;
}

if(isset($_GET['admin'])){
    $purchase_request = getNotificationPurchaseRequestData($conn);
    $request_maintenance = getNotificationRequestMaintenanceData($conn);
    print_r(json_encode(array_merge($purchase_request, $request_maintenance)));
}