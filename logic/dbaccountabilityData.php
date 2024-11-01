<?php
require 'dbCon.php';
if(isset($_POST['id'])){
    $id = $_POST['id'];
    $data_res = [];
    // get user account
    $stmt_get = $conn->prepare("SELECT u.fullname, pr.purchase_request_code, pr.status FROM `users` AS u JOIN `purchase_request` AS pr ON u.usercode = pr.requester_code WHERE pr.purchase_request_code = ?");
    $stmt_get->bind_param("s", $id);
    $stmt_get->execute();
    $result_get = $stmt_get->get_result();
    $row_get = $result_get->fetch_assoc();
    $data_res['fname'] = $row_get['fullname'];
    $data_res['item_no'] = $row_get['purchase_request_code'];
    $data_res['status'] = $row_get['status'];
    //get items name
    $stmt_get = $conn->prepare("SELECT `item_name`, `quantity`, `price`, `specs`, `status` FROM `purchase_request_list` WHERE purchase_request_code = ?");
    $stmt_get->bind_param("s", $row_get['purchase_request_code']);
    $stmt_get->execute();
    $result_get = $stmt_get->get_result();
    while($row_get = $result_get->fetch_assoc()){
        $data_res['item'][] = $row_get;
    }

    print_r(json_encode($data_res));

}