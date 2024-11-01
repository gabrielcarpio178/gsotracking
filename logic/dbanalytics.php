<?php
require 'dbCon.php';
if(isset($_POST['role'])){
    $stmt = $conn->prepare("SELECT COUNT(*) AS count_label, CAST(`datetime` AS date) AS month_label FROM `purchase_request` GROUP BY MONTH(`datetime`);");
    $stmt->execute();
    $result = $stmt->get_result();
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = ["count_label"=>$row["count_label"], "month_label"=>date("M",strtotime($row["month_label"]))];
    }

    echo json_encode($data);
}