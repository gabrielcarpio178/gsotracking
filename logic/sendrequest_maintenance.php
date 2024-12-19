<?php
require 'dbCon.php';
include 'pusherNoti.php';
session_start();
sleep(1);

function insertRequest($usercode, $notification_id, $request_code, $conn){
    $stmt = $conn->prepare("INSERT INTO `request_maintenance`( `usercode`, notification_id, `purchase_request_list_id`) VALUES (?, ?, ?)");
    $stmt->bind_param('sss', $usercode, $notification_id, $request_code);
    return $stmt->execute();
}

function updateRequest($request_code, $conn){
    $stmt = $conn->prepare("UPDATE `purchase_request_list` SET `request_maintenance`= NOW() WHERE `id` = ?");
    $stmt->bind_param('s', $request_code);
    return $stmt->execute();
}

function getNotification_id($conn){
    $stmt = $conn->prepare("SELECT `id` FROM `notification` ORDER BY `id` DESC LIMIT 1;");
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        return $result->fetch_assoc()['id'];
    }else{
        return 1;
    }
    
}

function insertNotification($conn){
    $stmt = $conn->prepare("INSERT INTO `notification`(`request_type`) VALUES ('request_maintenance')");
    if ($stmt->execute()) {
        return "success";
    }
}

if(isset($_POST['purchase_request_code'])&&isset($_POST['item_name'])&&isset($_POST['fullname'])){
    $usercode = $_SESSION['usercode'];
    $request_code = $_POST['purchase_request_code'];
    $item_name = $_POST['item_name'];
    $fullname = $_POST['fullname'];
    $notification_id = getNotification_id($conn)+1;
    if(insertRequest($usercode, $notification_id, $request_code, $conn)){
        if(updateRequest($request_code, $conn)){
            $data = [
                "item_name"=>$item_name,
                "message"=>"Request Maintenance",
                "request_code"=>$request_code,
                "fullname"=>$fullname,
                'noti_type'=>'request_maintenance'
            ];
            $pusher->trigger('my-channel', 'my-event', json_encode($data));
        }
        insertNotification($conn);
    }
    
}