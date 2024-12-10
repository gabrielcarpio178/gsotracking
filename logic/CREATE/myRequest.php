<?php
require '../../logic/dbCon.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
sleep(1);

session_start();
$usercode = $_SESSION['usercode'];

function sendRequest($usercode, $request_code, $status, $notification_id,$send_data, $conn){

    $stmt = $conn->prepare("INSERT INTO purchase_request (requester_code, notification_id, purchase_request_code, datetime, status) VALUES (?, ?, ?, NOW(), ?)");

    $stmt->bind_param('ssss', $usercode, $notification_id, $request_code, $status);

    if ($stmt->execute()) {
        $stmt->close();
        //insert request database
        foreach($send_data as $data){
            $stmt = $conn->prepare("INSERT INTO purchase_request_list (purchase_request_code, item_name, quantity, price, specs, status) VALUES (?,?,?,?,?,?)");
            $stmt->bind_param('ssssss', $request_code, $data['item-name'], $data['quantity'], $data['budget'], $data['specs'], $status);
            $stmt->execute();
            $stmt->close();
        }
        return "success";
    }
}

function insertNotification($conn){
    $stmt = $conn->prepare("INSERT INTO `notification`(`request_type`) VALUES ('purchase_request')");
    if ($stmt->execute()) {
        return "success";
    }
}

function getNotification_id($conn){
    $stmt = $conn->prepare("SELECT `id` FROM `notification` ORDER BY `id` DESC LIMIT 1;");
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        return $result->fetch_assoc()['id']+1;
    }else{
        return 1;
    }
    
}

if (isset($_POST['send_data'])) {
    $send_data = json_decode($_POST['send_data'], true);
    $request_code = generateItemCode($conn);
    $status = 'pending';

    $notification_id = getNotification_id($conn);
    if(sendRequest($usercode, $request_code, $status, $notification_id,$send_data, $conn)=='success'){
        echo insertNotification($conn);
    }

}
