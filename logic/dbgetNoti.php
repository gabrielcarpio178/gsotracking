<?php
require 'dbCon.php';

function getPurchaseNoti($id, $conn){
    $return_data = [];
    $stmt_count = $conn->prepare('SELECT p.requester_code, p.notification_id, p.purchase_request_code, p.status, p.datetime, n.id, n.client, n.request_type FROM purchase_request AS p JOIN notification AS n ON p.notification_id = n.id WHERE p.requester_code = ? ORDER BY p.datetime DESC');
    $stmt_count->bind_param('s', $id);
    $stmt_count->execute();
    $result_count = $stmt_count->get_result();
    
    while($row_count = $result_count->fetch_assoc()){
        $return_data[] = $row_count;
    }
    return $return_data;
}


function getRequestNoti($id, $conn){
    $return_data = [];
    $stmt_count = $conn->prepare('SELECT p.item_name, n.client, n.request_type, n.id, r.request_datetime AS datetime, r.request_status FROM notification AS n JOIN request_maintenance AS r ON n.id = r.notification_id JOIN purchase_request_list AS p ON r.purchase_request_list_id = p.id WHERE r.usercode = ? ORDER BY r.request_datetime DESC');
    $stmt_count->bind_param('s', $id);
    $stmt_count->execute();
    $result_count = $stmt_count->get_result();
    
    while($row_count = $result_count->fetch_assoc()){
        $return_data[] = $row_count;
    }
    return $return_data;
}

if(isset($_POST['id'])){

    $id = $_POST['id'];
    $purchase_request = getPurchaseNoti($id, $conn);
    $request_request = getRequestNoti($id, $conn);
    print_r(json_encode(array_merge($request_request, $purchase_request)));
    
}