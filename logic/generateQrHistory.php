<?php
require_once "../phpqrcode/qrlib.php";

function insertEquipmentHistory($conn, $usercode, $items_id, $isDisabled, $action){
    $stmt = $conn->prepare("INSERT INTO `equipment_history`(`equiment_id`, `usercode`, `isDisabled`, `action`) VALUES (?,?,?,?)");
    $stmt->bind_param("ssss", $items_id, $usercode, $isDisabled, $action);
    return $stmt->execute();
}
