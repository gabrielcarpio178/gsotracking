<?php
require 'dbCon.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $stmt_count = $conn->prepare("SELECT COUNT(*) AS count_notSeen FROM notification AS n JOIN purchase_request AS p ON n.id = p.notification_id WHERE n.request_type = 'purchase_request' AND n.storekeeper = 0 AND p.status = 'accept'");
    $stmt_count->execute();
    $result_count = $stmt_count->get_result();
    $row_count = $result_count->fetch_assoc();
    echo $row_count['count_notSeen'];
}