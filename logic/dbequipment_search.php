<?php
require 'dbCon.php';
if(isset($_POST['search'])){
    $seach = '%'.$_POST['search'].'%';
    $stmt = $conn->prepare("SELECT u.usercode ,u.fullname, u.department, u.position, p.purchase_request_code, p.datetime, p.status FROM purchase_request AS p JOIN users AS u ON p.requester_code = u.usercode WHERE p.purchase_request_code LIKE ? ORDER BY p.id DESC;");
    $stmt->bind_param('s', $seach);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $row['datetime'] = date("M-d-Y h:s a", strtotime($row['datetime']));
        $data[] = $row;
    }
    print_r(json_encode($data));
}   