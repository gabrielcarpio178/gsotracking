<?php
require 'dbCon.php';
if(isset($_POST['id'])&&isset($_POST['isSeen'])){
    $id = $_POST['id'];
    $isSeen = ($_POST['isSeen']==0)?1:0;
    $stmt = $conn->prepare('UPDATE `notification` SET `admin` = ? WHERE `id` = ?');
    $stmt->bind_param("ss", $isSeen ,$id);
    if($stmt->execute()){
        print_r(json_encode(['message'=>'success', 'isSeen'=>$isSeen]));
    }
}