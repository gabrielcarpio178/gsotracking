<?php
require 'dbCon.php';
if(isset($_POST['id'])){
    $id = $_POST['id'];
    $stmt_count = $conn->prepare('SELECT COUNT(*) AS count_isSeen FROM `purchase_request` WHERE `requester_code` = ?  AND isSeen = 1');
    $stmt_count->bind_param('s', $id);
    $stmt_count->execute();
    $result_count = $stmt_count->get_result();
    $row_count = $result_count->fetch_assoc();

    echo $row_count['count_isSeen'];
}
