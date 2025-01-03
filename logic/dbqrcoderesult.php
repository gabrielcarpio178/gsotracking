<?php

require 'dbCon.php';

if(isset($_POST['code'])){
    $code = $_POST['code'];
    $data = [];
    function getItem($code, $conn){
        $stmt = $conn->prepare("SELECT `id`, `item_name`, `quantity`, `price`, `specs` FROM `purchase_request_list` WHERE `purchase_request_code` = ?;");
        $stmt->bind_param('s', $code);
        $stmt->execute();
        $result_count = $stmt->get_result();
        $return = [];
        while($row = $result_count->fetch_assoc()){
            $return[] = $row;
        }
        return $return;
    }

    try {
        $sql = mysqli_query($conn, "SELECT u.fullname, p.purchase_request_code, p.status FROM purchase_request_list AS l JOIN users AS u ON u.usercode = l.requester_code JOIN purchase_request AS p ON p.purchase_request_code = l.purchase_request_code WHERE p.purchase_request_code = '$code';");
        $row = mysqli_fetch_assoc($sql);
        $data['user_info'] = $row;
        $data['items'] = getItem($code, $conn);
    } catch (\Throwable $th) {
        echo $th;   
    }

    print_r(json_encode($data));
}