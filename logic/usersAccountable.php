<?php
require 'dbCon.php';
session_start();
if(isset($_POST['search'])){
    $usercode = $_SESSION['usercode'];
    $search = $_POST['search'];
    $sql = "SELECT l.*, p.purchase_request_code, p.datetime FROM purchase_request_list AS l JOIN users AS u ON l.requester_code = u.usercode JOIN purchase_request AS p ON l.purchase_request_code = p.purchase_request_code WHERE u.usercode = ? ORDER BY l.id DESC";
    if($search!=='all'){
        $sql = "SELECT l.*, p.purchase_request_code, p.datetime FROM purchase_request_list AS l JOIN users AS u ON l.requester_code = u.usercode JOIN purchase_request AS p ON l.purchase_request_code = p.purchase_request_code WHERE u.usercode = ? AND p.purchase_request_code LIKE '%$search%' ORDER BY l.id DESC";
    }
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $usercode);
    $stmt->execute();
    $result = $stmt->get_result();
    $group_data = [];
    while ($row = $result->fetch_assoc()) {
        $group_data[$row['purchase_request_code']][] = $row;
    }
    print_r(json_encode($group_data));
    
    // foreach($group_data as $data){
    //     print_r($data['purchase_request_code']);
    // }
            
}