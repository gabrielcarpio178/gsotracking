<?php
require 'dbCon.php';
if(isset($_POST['id'])){
    $id = $_POST['id'];
    $data_res = [];
    // get user account
    $stmt_get = $conn->prepare("SELECT u.fullname, l.*, p.purchase_request_code, p.datetime FROM purchase_request_list AS l JOIN users AS u ON l.requester_code = u.usercode JOIN purchase_request AS p ON l.purchase_request_code = p.purchase_request_code WHERE p.purchase_request_code = ?");
    $stmt_get->bind_param("s", $id);
    $stmt_get->execute();
    $result_get = $stmt_get->get_result();
    //get items name
    while($row_get = $result_get->fetch_assoc()){
        $data_res[$row_get['purchase_request_code']][] = $row_get;
    }

    print_r(json_encode($data_res));

}