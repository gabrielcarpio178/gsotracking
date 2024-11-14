<?php
// print_r($_POST);
require '../dbCon.php';
session_start();

require __DIR__ . '/../../vendor/autoload.php';
require_once "../../phpqrcode/qrlib.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


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
if(isset($_POST['status'])&&isset($_POST['request_code'])&&isset($_POST['request_data'])&&isset($_POST['request_data_list'])){
    $status =  $_POST['status'];
    $request_code =  $_POST['request_code'];
    $request_data =  $_POST['request_data'];
    $request_data_list =  $_POST['request_data_list'];
    $isSeen = 1;
    $items_list = json_decode($request_data_list, true);

    function intCodeRandom($length = 10)
    {
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

    function generateCodePerItem($items_list, $conn){
        foreach($items_list as $item){
            $random = generateCode($conn);
            $stmt = $conn->prepare("UPDATE `purchase_request_list` SET `status`= ?, maintance = NOW() WHERE id = ?");
            $stmt->bind_param("ss", $random, $item['id']);
            if($stmt->execute()){
                $path = "../../qrcode_img/";
                $qrkey = $random;
                $qr = $path."item_".$qrkey.".png";
                $qrnamimage = "item_".$qrkey.".png";
                QRcode :: png($qrkey, $qr, 'H', 4, 4);
            }
        }
    }

    generateCodePerItem($items_list, $conn);

    $stmt = $conn->prepare("UPDATE purchase_request SET status = ?, isSeen = ? WHERE purchase_request_code = ?");
    $stmt->bind_param("sss", $status, $isSeen, $request_code);

    if ($stmt->execute()) {
        $data = [
            'message' => $status == 'accept'? 'your request was accepted by admin' : 'your request was rejected by admin',
            'status' => $status,
            'request_data' => $request_data,
            'request_data_list' => $request_data_list
        ];
        $pusher->trigger('my-channel', 'my-event', json_encode($data));


        
        $path = "../../qrcode_img/";
        $qrkey = $request_code;
        $qr = $path.$qrkey.".png";
        $qrnamimage = $qrkey.".png";
        QRcode :: png($qrkey, $qr, 'H', 4, 4);
        header('Location: ../../pages/admin/purchase_request.php');
    }
    $stmt->close();
    $conn->close();
}