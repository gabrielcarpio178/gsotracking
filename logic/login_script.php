<?php
require 'dbCon.php';
session_start();
sleep(1);
if(isset($_POST['email'])&&isset($_POST['password'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare('SELECT `usercode`, `email`, `password`, `fullname`,`role`, `position`, `department`,`status`,`profile`,`gender` FROM users WHERE email = ?');
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $fetchedEmail, $hashedPassword, $fullname, $role, $position, $department,$status, $profile, $gender);
        $stmt->fetch();

        if ($status == 'active') {
            if ($password == decrypt($hashedPassword, secretKey())) {
                
                $_SESSION['usercode'] = $id;
                $_SESSION['fullname'] = $fullname;
                $_SESSION['loginSession'] = true;
                $_SESSION['email'] = $email;
                $_SESSION['position'] = $position;
                $_SESSION['department'] = $department;
                $_SESSION['role'] = $role;
                $_SESSION['profile'] = $profile != '' ? $profile : ($gender == 'male' ? '../../styles/images/boy.jpeg' : '../../styles/images/girl.jpeg');
                // header("Location: ../pages/$role/equipment_list.php");
                if ($role == 'admin') {
                    echo "pages/admin/equipment_transfer.php";
                }

                 else if ($role == 'storekeeper') {
                    echo "pages/storekeeper/equipment_list.php";
                }
                
                else /*if($role == 'client' || $role == 'department head' || $role == 'finance department' || $role == 'mayor')*/ {
                    echo "pages/".$role."/purchase_request.php";
                }
                exit();
            } else {
                echo 'invalid_credential';
            }
        } else {
            echo "deactivated";
        }
    } else {
        echo 'invalid_credential';
    }

    $stmt->close();
    $conn->close();
}
