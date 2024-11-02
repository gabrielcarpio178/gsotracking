<?php
require 'dbCon.php';
require 'phpmailer.php';
sleep(1);
if(isset($_POST['fullname'])&&isset($_POST['sex'])&&isset($_POST['birthday'])&&isset($_POST['email'])&&isset($_POST['pnumber'])&&isset($_POST['employee_id'])&&isset($_POST['department'])&&isset($_POST['position'])&&isset($_POST['current_email'])){
    $fullname = $_POST['fullname'];
    $sex = $_POST['sex'];
    $birthday = $_POST['birthday'];
    $email = $_POST['email'];
    $current_email = $_POST['current_email'];
    $pnumber = $_POST['pnumber'];
    $employee_id = $_POST['employee_id'];
    $department = $_POST['department'];
    $position = $_POST['position'];
    $password = intCodeRandom();
    $hashpass = encrypt($password, secretKey());
    $isValidEmail = isValid($conn, $email, $current_email);

    if($isValidEmail!==1){
        $stmt = $conn->prepare("UPDATE `users` SET `email`= ?,`password`= ?,`phone_number`= ?,`fullname`= ?,`birthdate`= ?,`gender`= ?,`department`=?,`position`=? WHERE `usercode` = ?");
        $stmt->bind_param("sssssssss", $email, $hashpass, $pnumber, $fullname, $birthday, $sex, $department, $position ,$employee_id);
        if ($stmt->execute()) {
            sendEmail($email, $password, $fullname);
            echo "success";
        }else{
            echo "error occur";
        }
    }else{
        echo 'email is already used';
    }

    
}
