<?php
require 'dbCon.php';

if(isset($_POST['user'])){
    $user = $_POST['user'];
    if($user=='storekeeper'){
        
        $stmt = $conn->prepare("SELECT n.id ,p.purchase_request_code, n.request_type, n.storekeeper, n.transaction_date AS datetime, p.status FROM purchase_request AS p JOIN notification AS n ON n.id = p.notification_id WHERE n.request_type = 'purchase_request' AND p.status = 'accept' ORDER BY n.id DESC;");
        $stmt->execute();
        $result = $stmt->get_result();
        $return_data = [];
        while($row = $result->fetch_assoc()){
            $return_data[] = $row;
        }
        print_r(json_encode($return_data));

    }
}


?>