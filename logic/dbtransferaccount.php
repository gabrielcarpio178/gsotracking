<?php
require 'dbCon.php';
require 'phpmailer.php';

function getdata($conn, $usercode){
    $stmt = $conn->prepare('SELECT `id`, `email`, `fullname`, `usercode` FROM `users` WHERE `usercode` = ?');
    $stmt->bind_param('s', $usercode);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row;
}

function updateEquipment($conn, $to, $equipment_id){

    $stmt = $conn->prepare("UPDATE `purchase_request` SET `requester_code` = ? WHERE `purchase_request_code` = ?");
    $stmt->bind_param('ss', $to, $equipment_id);
    return $stmt->execute();
    

}

function transfersEquipment($conn, $to, $selected_equipments){
    $result = false;
    if(count($selected_equipments)!==0){
        foreach ($selected_equipments as $equipment) {
            
            if(!updateEquipment($conn, $to, $equipment)){
                $result = true; 
            }
        }
    }
    return $result;
}


function userData($conn, $from, $to, $tofullname, $sex, $birthday, $email, $current_email, $pnumber, $employee_id, $department, $position, $isResetPass, $selected_equiments){
    $todata = getdata($conn, $to);
    $fromdata = getdata($conn, $from);

    if($isResetPass==="true"){
        $password = intCodeRandom();
        $hashpass = encrypt($password, secretKey());
        $isValidEmail = isValid($conn, $email, $current_email);
        if($isValidEmail!==1){
            $stmt_to = $conn->prepare("UPDATE `users` SET `password`= ? WHERE `id` = ?");
            $stmt_to->bind_param("ss", $hashpass, $fromdata['id']);
            if ($stmt_to->execute()) {
                sendEmail($email, $hashpass, $tofullname);
                if(!transfersEquipment($conn, $to, $selected_equiments)){
                    echo "success";
                }
            }else{
                echo "error occur";
            }
        }else{
            echo 'email is already used';
        }

    }else{
        if(!transfersEquipment($conn, $to, $selected_equiments)){
            echo "success";
        }else{
            echo "error occur";
        }
    }
}

// sleep(1);
if(isset($_POST['from'])&&isset($_POST['to'])&&isset($_POST['tofullname'])&&isset($_POST['sex'])&&isset($_POST['birthday'])&&isset($_POST['email'])&&isset($_POST['pnumber'])&&isset($_POST['employee_id'])&&isset($_POST['department'])&&isset($_POST['position'])&&isset($_POST['isResetPass'])&&isset($_POST['current_email'])){
    $from = $_POST['from'];
    $to = $_POST['to'];
    $tofullname = $_POST['tofullname'];
    $sex = $_POST['sex'];
    $birthday = $_POST['birthday'];
    $email = $_POST['email'];
    $current_email = $_POST['current_email'];
    $pnumber = $_POST['pnumber'];
    $employee_id = $_POST['employee_id'];
    $department = $_POST['department'];
    $position = $_POST['position'];
    $isResetPass = $_POST['isResetPass'];
    $selected_equiments = isset($_POST['selected_equiments'])?$_POST['selected_equiments']:[];

    userData($conn, $from, $to, $tofullname, $sex, $birthday, $email, $current_email, $pnumber, $employee_id, $department, $position, $isResetPass, $selected_equiments);
    // // print_r($selected_equiments);

    // echo $to;

    // transfersEquipment($conn, $to, $selected_equiments);






    
}
