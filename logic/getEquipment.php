<?php
require 'dbCon.php';

function getData($query, $conn){
    $data = [];
    try {
        $sql = mysqli_query($conn, $query);
        while($row=mysqli_fetch_assoc($sql)){
            $row['maintance'] = timeAgo($row['maintance']);
            $row['datetime'] =date('M-d-Y', strtotime($row['datetime']));
            $row['status'] = 'item_'.$row['status'].'.png';
            $data[] = $row;
        }
    } catch (\Throwable $th) {
        echo $th;
    }
    return $data;
}

if(isset($_POST['search'])){
    $search = $_POST['search'];
    if($search==='all'){
        $sql = "SELECT u.`fullname`, p.`purchase_request_code`, p.`datetime`, l.`item_name`, l.`quantity`, l.`status`, l.`maintance`, l.`id` FROM `users` AS u JOIN `purchase_request` AS p ON u.`usercode` = p.`requester_code` JOIN `purchase_request_list` AS l ON l.`purchase_request_code` = p.`purchase_request_code` WHERE l.status != 'pending' ORDER BY l.`id` DESC";
    }else{
        $sql = "SELECT u.`fullname`, p.`purchase_request_code`, p.`datetime`, l.`item_name`, l.`quantity`, l.`status`, l.`maintance`, l.`id` FROM `users` AS u JOIN `purchase_request` AS p ON u.`usercode` = p.`requester_code` JOIN `purchase_request_list` AS l ON l.`purchase_request_code` = p.`purchase_request_code` WHERE l.status != 'pending' AND p.purchase_request_code LIKE '%$search%' ORDER BY l.`id` DESC";
    }
    print_r(json_encode(getData($sql, $conn)));
}