<?php
require 'logic/dbCon.php';
function equipmentTracking($conn, $id){
    $stmt = $conn->prepare("SELECT u.fullname, u.department, u.position, pl.purchase_request_code, pl.item_name, pl.quantity, pl.price, pl.doingMaintenance, pl.status, pl.maintance, eh.action, eh.transaction_date FROM equipment_history AS eh JOIN purchase_request_list AS pl ON eh.equiment_id = pl.id JOIN users AS u ON u.usercode = eh.usercode WHERE pl.id = ? ORDER BY eh.id DESC");
    $stmt->bind_param("s",  $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = [];
    while($row = $result->fetch_assoc()){
        $data[] = $row;
    }
    return $data;
}

function getEquipmentData($conn, $id){
    $stmt = $conn->prepare("SELECT `item_name`, `quantity`, `price`, `specs`, `purchase_request_code` FROM `purchase_request_list` WHERE id = ?");
    $stmt->bind_param("s",  $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $getEquipmentData = getEquipmentData($conn, $id);
    $equipmentTrackings = equipmentTracking($conn, $id);
}else{
    header("Location: /qrcodeupsss/S");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/gif" href="styles/images/logo2.png">
    <link rel="stylesheet" href="styles/equipement-tracking.css">
    <title>Equipment Tracking</title>
</head>
<body>
    <main class="main-container">
        <section class="header-container">
            <div class="header-content">
                <div class="image-logo">
                    <img src="styles/images/logo1.png" alt="bago city logo">
                </div>
                <div class="content-title">
                    <div class="main-title">
                        <h2>City of bago</h2>
                        <h2>negros occidental</h2>
                    </div>
                    <div class="body-title">
                        <p>Qr Code Scanning with Informed Mechanism
                        Driven and Equipment Tracking System</p>
                    </div>
                </div>
                <div class="image-logo">
                    <img src="styles/images/logo2.png" alt="gso logo">
                </div>
            </div>
            <h1>
                Equipment Tracking Information
            </h1>
        </section>
        <section class="equipment-data">
            <div class="equipment-name">Name: <?=$getEquipmentData['item_name'] ?></div>
            <div class="equipment-id">ID: <?=$getEquipmentData['purchase_request_code'] ?></div>
            <div class="equipment-specs">Specs: <?=$getEquipmentData['specs'] ?></div>
            <div class="equipment-quantity">quantity: <?=$getEquipmentData['quantity'] ?></div>
            <div class="equipment-price">Price: <?=number_format($getEquipmentData['price']) ?></div>
        </section>
        <section class="table-content">
            <?=print_r($equipmentTrackings)?>
            table>thead>tr>td
        </section>
    </main>
</body>
</html>