<?php
require 'dbCon.php';

if(isset($_GET['user'])){
    $fullnames = [];
    $stmt = $conn->prepare('SELECT `fullname`, `usercode` FROM `users` ORDER BY `id` DESC;');
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $fullnames[] = $row;
    }
    print_r(json_encode($fullnames));

}