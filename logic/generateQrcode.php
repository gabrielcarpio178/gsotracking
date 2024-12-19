<?php
require_once "../phpqrcode/qrlib.php";
require 'dbCon.php';
function unlinkRecentImg($imgLink){
    return unlink($imgLink);
}

function generateQr($datatable, $filename){
    $path = "../qrcode_img/";
    $qrkey = $datatable;
    $qr = $path."item_history".$filename.".png";
    QRcode :: png($qrkey, $qr, 'H', 4, 4);
    return 'success';
}

function generateQrtoDoesNotHave($conn){

    $stmt = $conn->prepare("");
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        
    }

};