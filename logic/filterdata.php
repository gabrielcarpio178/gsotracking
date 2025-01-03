<?php
require 'dbCon.php';

if(isset($_POST['search'])&&isset($_POST['status'])&&isset($_POST['date_data'])){
    //get purchase request list data
    function getpurchasereq($purchase_request_code, $conn){
        $stmt = $conn->prepare("SELECT `id`, `item_name`, `quantity`, `price`, `specs` FROM `purchase_request_list` WHERE purchase_request_code = ?");
        $stmt->bind_param("s", $purchase_request_code);
        $stmt->execute();
        $result_data = $stmt->get_result();
        $result = [];
        while($row =$result_data->fetch_assoc()){
            $result[] = $row;
        }
        return $result;
    }

    $search = "%".$_POST['search']."%";
    $status = $_POST['status'];
    $date_data = $_POST['date_data'];
    $search_sql = "";
    $filter_sql = "";
    $date_date_sql = "";
    // SELECT * FROM purchase_request WHERE `requester_code` LIKE ? AND `status` = ? AND CAST(`datetime` AS DATE) = ? ORDER BY id DESC;
    if($_POST['search']!=""){
        $search_sql = "WHERE (u.`fullname` LIKE '%$search%' OR p.`purchase_request_code` LIKE '%$search%') ";
    }
    if($search_sql!=""&&$status!=""){
        $filter_sql = "AND p.`status` LIKE '$status' ";
    }else if($status!=""){
        $filter_sql = "WHERE p.`status` LIKE '$status' ";
    }
    if($date_data!=""&&$filter_sql!=""){
        $date_date_sql = "AND CAST(`datetime` AS DATE) = '$date_data'";
    }else if($search_sql!=""&&$date_data!=""){
        $date_date_sql = "AND CAST(`datetime` AS DATE) = '$date_data'";
    }else if($_POST['search']==""&&$_POST['status']==""&&$date_data!=""){
        $date_date_sql = "WHERE CAST(`datetime` AS DATE) = '$date_data'";
    }

    //get all data to this display
    $data_res = [];
    try {
        $sql = mysqli_query($conn, "SELECT pl.requester_code, p.purchase_request_code,p.datetime, u.fullname, u.`position`, u.`department`, u.`usercode`, p.`status` FROM `purchase_request` AS p JOIN `purchase_request_list` AS pl ON p.`purchase_request_code` = pl.`purchase_request_code` JOIN `users` AS u ON pl.`requester_code` = u.`usercode` ".$search_sql.$filter_sql.$date_date_sql." GROUP BY p.purchase_request_code ORDER BY p.id DESC");
        while($row=mysqli_fetch_assoc($sql)){
            $data_res[] = ['purchase_request_code'=>$row['purchase_request_code'], 'status'=>$row['status'],'usercode'=>$row['usercode'],'position'=>$row['position'], 'department'=>$row['department'], 'fullname'=>$row['fullname'], 'timeago'=>timeAgo($row['datetime']), 'date'=>date('M-d-Y H:i a', strtotime($row['datetime'])),'purchase_list'=>getpurchasereq($row['purchase_request_code'], $conn), "request_data"=>htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8'), "request_data_list"=>htmlspecialchars(json_encode(getpurchasereq($row['purchase_request_code'], $conn)), ENT_QUOTES, 'UTF-8')];
        }
        print_r(json_encode($data_res));
    } catch (\Throwable $th) {
        echo $th;
    }
}