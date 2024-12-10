<?php
require 'dbCon.php';

if(isset($_GET['search'])){
    $search = $_GET['search'];
    $data = [];
    $sql = "";
    if($search==="all"){
        $sql = "SELECT * FROM `users` ORDER BY `id` DESC;";
    }else{
        $sql = "SELECT * FROM `users` WHERE `usercode` LIKE '%$search%' ORDER BY `id` DESC;";
    }

    try {
        $query = mysqli_query($conn, $sql);
        while($row=mysqli_fetch_assoc($query)){
            $data[] = $row;
        }
        print_r(json_encode($data));
    } catch (\Throwable $th) {
        echo $th;
    }


}