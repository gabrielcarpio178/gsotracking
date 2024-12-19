<?php
require 'dbCon.php';

function getData($sql, $conn){
    
    $returnData = [];
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()){
        $returnData[] = $row;   
    }
    return $returnData;

}

if(isset($_POST['search'])){

    $search = $_POST['search']===''?'all':$_POST['search'];


    if($search==='all'){
        $sql = "SELECT u.fullname, l.item_name, p.purchase_request_code, p.datetime, p.status, u.usercode FROM users AS u JOIN purchase_request_list AS l ON l.requester_code = u.usercode JOIN purchase_request AS p ON l.purchase_request_code = p.purchase_request_code ORDER BY l.id DESC;";
        print_r(json_encode(getData($sql, $conn)));
    }else{
        $sql = "SELECT u.fullname, l.item_name, p.purchase_request_code, p.datetime, p.status, u.usercode FROM users AS u JOIN purchase_request_list AS l ON l.requester_code = u.usercode JOIN purchase_request AS p ON l.purchase_request_code = p.purchase_request_code WHERE u.usercode LIKE '%$search%' OR u.fullname LIKE '%$search%' OR p.purchase_request_code LIKE '%$search%' OR l.item_name LIKE '%$search%' ORDER BY l.id DESC;";
        print_r(json_encode(getData($sql, $conn)));
    }

    

}