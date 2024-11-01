<?php
require '../dbCon.php';
if(isset($_GET['employee_id'])){
    $search = $_GET['employee_id'];
    if($search!=""){
        $search = "%$search%";  // Add wildcards for the LIKE query
        $stmt = $conn->prepare("SELECT * FROM users WHERE usercode LIKE ? ORDER BY id DESC");
        $stmt->bind_param('s', $search);
    }else{
        $stmt = $conn->prepare("SELECT * FROM users ORDER BY id DESC");
    }
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $userData = [];
        while ($row = $result->fetch_assoc()) {
            $userData[] = $row;
        }
        echo json_encode($userData);
    } else {
        echo json_encode([]);
    }
}


?>
