<?php
require 'dbCon.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $stmt_count = $conn->prepare("SELECT COUNT(*) AS count_notSeen FROM notification WHERE admin = 0");
    $stmt_count->execute();
    $result_count = $stmt_count->get_result();
    $row_count = $result_count->fetch_assoc();
    echo $row_count['count_notSeen'];
}
