<?php

require 'dbCon.php';
if(isset($_POST['id'])&&isset($_POST['isDisabled'])){
    $id = $_POST['id'];
    $isDisabled = $_POST['isDisabled']=="working"?"disabled":"working";
    $stmt = $conn->prepare("UPDATE `purchase_request_list` SET `isDisabled`= ? WHERE `id` = ?");
    $stmt->bind_param("ss", $isDisabled, $id);
    if($stmt->execute()){
        echo "success";
    }

}