<?php

require 'dbCon.php';
if(isset($_POST['dateSearch'])&&isset($_POST['purchase_request_code'])){

    $dateSearch = $_POST['dateSearch']==='all'?'':$_POST['dateSearch'];
    $purchase_request_code = $_POST['purchase_request_code']==='all'?'':$_POST['purchase_request_code'];

    if($dateSearch!==''){
        $dateSearch = " AND CAST(m.maintenance_datetime AS DATE) = '$dateSearch'";
    }

    if($purchase_request_code !== ''){
        $purchase_request_code = " AND pl.purchase_request_code LIKE '%$purchase_request_code%'";
    }

    $stmt = $conn->prepare("SELECT pl.purchase_request_code, u.fullname, pl.quantity, p.datetime, m.maintenance_datetime, pl.item_name FROM maintenance AS m JOIN purchase_request_list AS pl ON m.purchase_request_list_id = pl.id JOIN users AS u ON u.usercode = pl.requester_code JOIN purchase_request AS p ON p.purchase_request_code = pl.purchase_request_code WHERE 1=1".$dateSearch.$purchase_request_code." ORDER BY m.id DESC");
    $stmt->execute();
    $result = $stmt->get_result();
    $userData = [];
    while ($row = $result->fetch_assoc()) {
        $userData[] = $row;
    }
    print_r(json_encode($userData));
}