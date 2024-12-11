<?php
require 'dbCon.php';

function getData($query, $conn){
    $data = [];
    try {
        $sql = mysqli_query($conn, $query);
        while($row=mysqli_fetch_assoc($sql)){
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
        $sql = "SELECT u.`fullname`, u.`usercode`, p.`purchase_request_code`, p.`datetime`, l.`item_name`, l.`quantity`, l.`status`, l.`id` AS purchase_request_id, l.`doingMaintenance`, p.`id`, l.`maintance` AS maintance_durition, l.`request_maintenance` FROM purchase_request_list AS l JOIN purchase_request AS p ON p.purchase_request_code = l.purchase_request_code JOIN users AS u ON l.requester_code = u.usercode WHERE l.status != 'pending' ORDER BY l.`id` DESC";
    }else{
        $sql = "SELECT u.`fullname`, u.`usercode`, p.`purchase_request_code`, p.`datetime`, l.`item_name`, l.`quantity`, l.`status`, l.`id` AS purchase_request_id, l.`doingMaintenance`, p.`id`, l.`maintance` AS maintance_durition, l.`request_maintenance` FROM purchase_request_list AS l JOIN purchase_request AS p ON p.purchase_request_code = l.purchase_request_code JOIN users AS u ON l.requester_code = u.usercode WHERE l.status != 'pending' AND p.purchase_request_code LIKE '%$search%' ORDER BY l.`id` DESC";
    }
    print_r(json_encode(getData($sql, $conn)));
}
