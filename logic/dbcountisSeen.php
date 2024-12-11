<?php
require 'dbCon.php';
if(isset($_POST['id'])){
    $id = $_POST['id'];
    $stmt_count = $conn->prepare('SELECT COUNT(*) AS count_notSeen FROM purchase_request_list AS l JOIN users AS u ON l.requester_code = u.usercode JOIN purchase_request AS p ON l.purchase_request_code = p.purchase_request_code JOIN notification AS n ON n.id = p.notification_id WHERE l.requester_code = ? AND n.client = 0');
    $stmt_count->bind_param('s', $id);
    $stmt_count->execute();
    $result_count = $stmt_count->get_result();
    $row_count = $result_count->fetch_assoc();

    echo $row_count['count_notSeen'];
}
