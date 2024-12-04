<?php
require 'dbCon.php';
sleep(1);
if(isset($_POST['id'])){
    $id = $_POST['id'];
    try {
        mysqli_query($conn, "UPDATE `purchase_request` SET `doingMaintenance`= NOW() WHERE id = '$id'");
        echo "success";
    } catch (\Throwable $th) {
        echo $th;
    }
}    
