<?php
require 'dbCon.php';

if(isset($_POST['duration'])&&isset($_POST['purchase_id'])){
    $duration = $_POST['duration'];
    $purchase_id = $_POST['purchase_id'];
    $stmt = $conn->prepare("UPDATE `purchase_request` SET `maintance`= ?, `doingMaintenance` = NOW() WHERE `id` = ?");
    $stmt->bind_param("ss", $duration, $purchase_id);

    if($stmt->execute()){
        echo 'success';
    }
    


}