<?php
require_once "../phpqrcode/qrlib.php";

function insertEquipmentHistory($conn, $usercode, $items_id, $action){
    $stmt = $conn->prepare("INSERT INTO `equipment_history`(`equiment_id`, `usercode`, `action`) VALUES (?,?,?)");
    $stmt->bind_param("sss", $items_id, $usercode, $action);
    return $stmt->execute();
}
