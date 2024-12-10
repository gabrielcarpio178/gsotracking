<?php
require 'dbCon.php';
include 'phpmailer.php';
session_start();
date_default_timezone_set("Asia/Manila"); 

function foundEmail($email, $conn){
    $stmt = $conn->prepare("SELECT `id`, `email`, `fullname` FROM `users` WHERE `email` = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows===0){
        return ['email'=>"not found email"];
    }
    return $result->fetch_assoc();
}

function generateOTPRandom($length = 4)
{
    $intMin = (10 ** $length) / 10; // 100...
    $intMax = (10 ** $length) - 1;  // 999...
    $codeRandom = mt_rand($intMin, $intMax);
    return $codeRandom;
}

function sendOTPEmail($email, $fullname, $id){
    $otp = generateOTPRandom();
    $encrypted_otp = encrypt($otp, secretKey());
    sendOTPForgotpasswordEmail($email, $otp, $fullname);
    $date = date('Y-m-d H:i');
    return ['user_id'=>$id, 'email'=>$email,'fullname'=>$fullname ,'encrypted_otp'=>$encrypted_otp, 'sentDateTime'=>$date];
}


if(isset($_POST['email'])){
    $email = $_POST['email'];
    $result = foundEmail($email, $conn);
    if($result['email']==='not found email'){
        echo $result['email'];
    }else{
        $_SESSION['result'] = json_encode(sendOTPEmail($result['email'], $result['fullname'], $result['id']));
        echo "success";
    }
}
