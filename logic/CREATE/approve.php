<?php
require '../dbCon.php';
session_start();
require_once "../../phpqrcode/qrlib.php";
require __DIR__ . '/../../vendor/autoload.php';
$options = array(
    'cluster' => 'ap1',
    'useTLS' => true
);

$pusher = new Pusher\Pusher(
    '65b69d50985fd3578ab3',
    '5162ecfa7669af493dbf',
    '1768766',
    $options
);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

function intCodeRandom($length = 10){
    $intMin = (10 ** $length) / 10; // 100...
    $intMax = (10 ** $length) - 1;  // 999...
    $codeRandom = mt_rand($intMin, $intMax);
    return $codeRandom;
}

function isValidGenCode($generateCode, $conn){
    $stmt = $conn->prepare("SELECT COUNT(`status`) AS total_count FROM `purchase_request_list` WHERE `status` = ?");
    $stmt->bind_param("s", $generateCode);
    $stmt->execute();
    $result_data = $stmt->get_result();
    $row = $result_data->fetch_assoc();
    return $row['total_count'];
}

function generateCode($conn){
    $random = intCodeRandom();
    $checkCode = isValidGenCode($random, $conn);
    if($checkCode === 0){
        return $random;
    }
    generateCode($conn);
}

function generateQrCode($dataInsert, $dataUpdate){
    $insertData = $dataInsert;
    $path = "../../qrcode_img/";
    $qrkey = $insertData;
    $qr = $path."item_".$dataUpdate.".png";
    // $qrnamimage = "item_".$qrkey.".png";
    QRcode :: png($qrkey, $qr, 'H', 4, 4);
    return 'success';
}



function getAllItems($conn, $id){
    $stmt = $conn->prepare("SELECT l.item_name, u.fullname, l.quantity, p.datetime, l.maintance, p.purchase_request_code, u.department FROM purchase_request AS p JOIN purchase_request_list AS l ON p.purchase_request_code = l.purchase_request_code JOIN users AS u ON l.requester_code = u.usercode WHERE l.id = ?;");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $fullname =  "Fullname: ". $row['fullname']."\n";
    $item_name =  "Equiment name: ". $row['item_name']."\n";
    $quantity =  "Quantity: ". $row['quantity']."\n";
    $datetime =  "Purchase Date: ". date_format(date_create($row['datetime']),"Y/m/d h:i a")."\n";
    $maintance =  "Maintenance: ". $row['maintance']."\n";
    $equiment_code =  "Equiment Code: ". $row['purchase_request_code']."\n";
    $department =  "Department: ". $row['department']."\n";
    $insertData = $fullname." ".$item_name." ".$quantity." ".$datetime." ".$equiment_code." ".$department." ".$maintance;
    return generateQrCode($insertData, $row['purchase_request_code']);
}

function insertEquipmentHistory($conn, $request_data, $request_data_list, $action){
    $item_data = json_decode($request_data_list, true);
    $request = json_decode($request_data, true);
    $usercode = $request['usercode'];
    foreach ($item_data as $ids) {
        $id= $ids['id'];
        $stmt = $conn->prepare("INSERT INTO `equipment_history`(`equiment_id`, `usercode`, `action`) VALUES (?,?,?)");
        $stmt->bind_param("sss", $id, $usercode, $action);
        $stmt->execute();
    }
    return 1;
}


function generateCodePerItem($items_list, $conn){
    foreach($items_list as $item){
        $random = generateCode($conn);
        $stmt = $conn->prepare("UPDATE `purchase_request_list` SET `status`= ?, doingMaintenance = NOW() WHERE id = ?");
        $stmt->bind_param("ss", $random, $item['id']);
        if($stmt->execute()){
            return getAllItems($conn, $item['id'])==="success";
        }
    }
}



if(isset($_POST['status'])&&isset($_POST['request_code'])&&isset($_POST['request_data'])&&isset($_POST['request_data_list'])){
    $status =  $_POST['status'];
    $request_code =  $_POST['request_code'];
    $request_data =  $_POST['request_data'];
    $request_data_list =  $_POST['request_data_list'];
    $isSeen = 1;
    $items_list = json_decode($request_data_list, true);

    
    if(generateCodePerItem($items_list, $conn)){
        if(insertEquipmentHistory($conn, $request_data, $request_data_list, 'borrowed')){

            $stmt = $conn->prepare("UPDATE purchase_request SET status = ? WHERE purchase_request_code = ?");
            $stmt->bind_param("ss", $status, $request_code);

            if ($stmt->execute()) {
                $data = [
                    'message' => $status == 'accept'? 'your request was accepted by admin' : 'your request was rejected by admin',
                    'status' => $status,
                    'request_data' => $request_data,
                    'request_data_list' => $request_data_list,
                    'noti_type'=>'purchase_request'
                ];
                $pusher->trigger('my-channel', 'my-event', json_encode($data));
                header('Location: ../../pages/admin/purchase_request.php');
            }
            $stmt->close();
            $conn->close();
        }

    }

}