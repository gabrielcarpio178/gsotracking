<?php
require '../dbCon.php';
session_start();
// print_r($_POST);
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

$status =  $_POST['status'];
$request_code =  $_POST['request_code'];
$request_data =  $_POST['request_data'];
$request_data_list =  $_POST['request_data_list'];
$isSeen = 1;
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
