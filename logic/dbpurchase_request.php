<?php
require 'dbCon.php';
if(isset($_POST['purchase_code'])){
    $data = [];
    $purchase_code = $_POST['purchase_code'];
    //get purchase request code
    $stmt_rq = $conn->prepare("SELECT `requester_code`, `purchase_request_code`,`datetime` FROM `purchase_request` WHERE `purchase_request_code` = ?");
    $stmt_rq->bind_param("s", $purchase_code);
    $stmt_rq->execute();
    $result_rq = $stmt_rq->get_result();
    $row_rq = $result_rq->fetch_assoc();

    $data['purchase_request_code'] = $row_rq['purchase_request_code'];
    $data['datetime'] = date('M d-Y H:i a', strtotime($row_rq['datetime']));

    //get purchase request list
    $stmt_rl = $conn->prepare("SELECT `item_name`, `quantity`, `price`, `specs`, `status` FROM `purchase_request_list` WHERE `purchase_request_code` = ?");
    $stmt_rl->bind_param("s", $purchase_code);
    $stmt_rl->execute();
    $result_rl = $stmt_rl->get_result();

    while($row_rl = $result_rl->fetch_assoc()){
        $data['item_name'][] = $row_rl;
    }

    //get full name
    $stmt_fn = $conn->prepare("SELECT `fullname`, `position` FROM `users` WHERE `usercode` =  ?");
    $stmt_fn->bind_param("s", $row_rq['requester_code']);
    $stmt_fn->execute();
    $result_fn = $stmt_fn->get_result();
    $row_fn = $result_fn->fetch_assoc();
    $data['fname'] = $row_fn['fullname'];
    $data['position'] = $row_fn['position'];

    //pass to front end respowns data
    print_r(json_encode($data));
}