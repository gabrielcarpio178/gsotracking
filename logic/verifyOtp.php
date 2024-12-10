<?php
session_start();
require 'dbCon.php';
include 'phpmailer.php';
if(isset($_POST['otp'])){
    $result = json_decode($_SESSION['result'], true);
    $hastOtp = $result['encrypted_otp'];
    $email = $result['email'];
    $id = $result['user_id'];
    $fullname = $result['fullname'];
    $otp = $_POST['otp'];
    if($otp == decrypt($hastOtp, secretKey())){
        $password = intCodeRandom();
        $hashpass = encrypt($password, secretKey());
        sendEmail($email, $password, $fullname);
        $stmt = $conn->prepare("UPDATE `users` SET `password` = ? WHERE `id` =?");
        $stmt->bind_param("ss", $hashpass, $id);
        if($stmt->execute()){
            session_unset();
            session_destroy();
            echo "success";
        }
       
    }else{
        echo "invalid_otp";
    }
    

}