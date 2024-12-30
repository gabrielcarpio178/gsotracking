<?php
include 'dbCon.php';
include 'phpmailer.php';
sleep(1);

echo encrypt("storekeeper", secretKey());

if(isset($_POST['full_name'])&&isset($_POST['birthday'])&&isset($_POST['sex'])&&isset($_POST['email'])&&isset($_POST['pnumber'])&&isset($_POST['department'])&&isset($_POST['position'])&&isset($_POST['employee_id'])){
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $birthday = $_POST['birthday'];
    $sex = $_POST['sex'];
    $employee_id = $_POST['employee_id'];
    $pnumber = $_POST['pnumber'];
    $department = $_POST['department'];
    $position = $_POST['position'];
    $password = intCodeRandom();
    $hashpass = encrypt($password, secretKey());
    $role = 'client';
    $status = 'active';
    $isValidEmail = isValidEmail($conn, $email, $employee_id);
    if($isValidEmail!==1){
        $stmt = $conn->prepare('INSERT INTO users (`usercode`, `email`, `password`, `phone_number`, `fullname`,`birthdate`, `gender`, `role`, `status`, `department`, `position`) VALUES (?,?,?,?,?,?,?,?,?,?,?)');
        $stmt->bind_param('sssssssssss', $employee_id, $email, $hashpass, $pnumber, $full_name, $birthday, $sex, $role, $status, $department, $position);

        if ($stmt->execute()) {
            sendEmail($email, $password , $full_name);
            echo 'Message has been sent';
        } else {
            echo 'Error: ' . $stmt->error;
        }
        $stmt->close();
        $conn->close();
    }else{
        echo 'email or employee ID is already used';
    }
    
}

?>