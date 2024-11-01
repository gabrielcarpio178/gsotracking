<?php
require 'dbCon.php';

if(isset($_POST['id'])){

    $id = $_POST['id'];
    $return_data = [];
    $stmt_count = $conn->prepare('SELECT `id`, `requester_code`, `purchase_request_code`, `datetime`, `isSeen`, `status` FROM `purchase_request` WHERE `requester_code` = ? ORDER BY `datetime` DESC');
    $stmt_count->bind_param('s', $id);
    $stmt_count->execute();
    $result_count = $stmt_count->get_result();
    
    while($row_count = $result_count->fetch_assoc()){
        $row_count['timeAgo'] = timeAgo($row_count['datetime']);
        $row_count['datetime'] = date('Y-m-d H:i a', strtotime($row_count['datetime']));
        $return_data[] = $row_count;
    }
    print_r(json_encode($return_data));
}