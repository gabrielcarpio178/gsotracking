<?php
require 'dbCon.php';
sleep(1);

function dataInfo($email, $phone_number, $usercode, $conn){
    $stmt = $conn->prepare("SELECT `email`,`usercode`,`phone_number` FROM `users`");
    $stmt->execute();
    $result = $stmt->get_result();
    $data = [];
    while ($row = $result->fetch_assoc()) {
        if($row['email']!=$email||$row['usercode']!=$usercode||$row['phone_number']!=$phone_number) $data[] = $row;
    }
    return $data;
}

function getCurrentData($id, $conn){
    $stmt = $conn->prepare("SELECT `email`,`usercode`,`phone_number` FROM `users` WHERE `id`= ?");
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function isValidData($datas, $email, $phone_number, $usercode){
    $isTrue = 0;
    foreach ($datas as $data) {
        if($data['email']==$email||$data['phone_number']==$phone_number||$data['usercode']==$usercode){
            $isTrue = 1;
            break;
        }
    }
    return $isTrue;
}

function updateData($id, $full_name, $birthday, $sex, $department, $position, $email, $phone_number, $usercode, $conn){
    $stmt = $conn->prepare("UPDATE `users` SET `usercode`=?,`email`= ?,`phone_number`= ?,`fullname`= ?,`birthdate`= ?,`gender`= ?,`department`= ?,`position`= ? WHERE `id` = ?;");
    $stmt->bind_param('sssssssss', $usercode, $email, $phone_number, $full_name, $birthday, $sex, $department, $position, $id);
    if($stmt->execute()){
        echo 'success';
    }
}

if(isset($_POST['id'])&&isset($_POST['full_name'])&&isset($_POST['birthday'])&&isset($_POST['sex'])&&isset($_POST['email'])&&isset($_POST['pnumber'])&&isset($_POST['department'])&&isset($_POST['employee_id'])&&isset($_POST['position'])){
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $birthday = $_POST['birthday'];
    $sex = $_POST['sex'];
    $department = $_POST['department'];
    $position = $_POST['position'];
    $email = $_POST['email'];
    $phone_number = $_POST['pnumber'];
    $usercode = $_POST['employee_id'];

    $current_data = getCurrentData($id, $conn);
    $datas = dataInfo($current_data['email'], $current_data['phone_number'], $current_data['usercode'], $conn);

    if(isValidData($datas, $email, $phone_number, $usercode)==0){
        updateData($id, $full_name, $birthday, $sex, $department, $position, $email, $phone_number, $usercode, $conn);
    }else{
        echo 'invalid_data';
    }
    
}

?>