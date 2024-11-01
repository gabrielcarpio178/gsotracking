<?php
require 'dbCon.php';

if(isset($_POST['id'])){
    $id = $_POST['id'];
    $stmt = $conn->prepare('SELECT `usercode`,`email`,`phone_number`,`fullname`,`birthdate`,`gender`,`department`,`position` FROM `users` WHERE `usercode` = ?');
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    // $row['birthday'] = date('Y-m-d H:i a', strtotime($row['birthdate']));
    print_r(json_encode($row));
}