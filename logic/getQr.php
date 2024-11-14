<?php
require 'dbCon.php';

function getData($sql, $conn){
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = [];
    while($row = $result->fetch_assoc()){
        $row['status_img'] = "item_".$row['status'].".png";
        $row['datetime'] =date('M-d-Y', strtotime($row['datetime']));
        $data[] = $row;
    }
    return $data;
}

if(isset($_POST['search'])){
    $search = $_POST['search'];
    $sql = '';
    if($search === 'all'){
        $sql = "SELECT l.`id`, l.`purchase_request_code`, l.`item_name`, l.`quantity`, l.`specs`, l.`status`, p.`datetime`, u.`fullname` FROM `users` AS u JOIN `purchase_request` AS p ON u.`usercode` = p.`requester_code` JOIN `purchase_request_list` AS l ON l.`purchase_request_code` = p.`purchase_request_code` WHERE l.`status` != 'pending';";
    }else{
        $sql = "SELECT l.`id`, l.`purchase_request_code`, l.`item_name`, l.`quantity`, l.`specs`, l.`status`, p.`datetime`, u.`fullname` FROM `users` AS u JOIN `purchase_request` AS p ON u.`usercode` = p.`requester_code` JOIN `purchase_request_list` AS l ON l.`purchase_request_code` = p.`purchase_request_code` WHERE l.`status` != 'pending' AND l.`purchase_request_code` LIKE '%$search%';";
    }
    $res = getData($sql, $conn);
    print_r(json_encode($res));
}