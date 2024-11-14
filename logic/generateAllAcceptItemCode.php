<?php
require 'dbCon.php';
require_once "../phpqrcode/qrlib.php";

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

function getAllId($conn){
    $ids = [];
    try {
        $sql = mysqli_query($conn, "SELECT l.`id`, r.`status` FROM `purchase_request` AS r JOIN `purchase_request_list` AS l ON r.`purchase_request_code` = l.purchase_request_code WHERE r.status = 'accept'");
        while($row=mysqli_fetch_assoc($sql)){
            $ids[] = ['id'=>$row['id']];
        }
        return $ids;
    } catch (\Throwable $th) {
        echo $th;
    }
}

function generateCodePerItem($items_list, $conn){
    foreach($items_list as $item){
        $random = generateCode($conn);
        $stmt = $conn->prepare("UPDATE `purchase_request_list` SET `status`= ?, maintance = NOW() WHERE id = ?");
        $stmt->bind_param("ss", $random, $item['id']);
        if($stmt->execute()){
            $path = "../qrcode_img/";
            $qrkey = $random;
            $qr = $path."item_".$qrkey.".png";
            $qrnamimage = "item_".$qrkey.".png";
            QRcode :: png($qrkey, $qr, 'H', 4, 4);
        }
    }
}

if(isset($_GET['password'])){
    if($_GET['password']==='change'){
        $accepted = getAllId($conn);
        generateCodePerItem($accepted, $conn);
        echo 'success';
    }
    else{
        echo 'wrong password';
    }
}


