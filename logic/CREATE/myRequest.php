<?php
require '../../logic/dbCon.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
sleep(1);

session_start();
$usercode = $_SESSION['usercode'];

if (isset($_POST['send_data'])) {
    $send_data = json_decode($_POST['send_data'], true);

    // Generate request code
    $request_code = generateItemCode($conn);
    // $specs = $_POST['specs'];

    // Retrieve form data
    $request_date = date('Y-m-d H:i:s');
    $date = date('Y-m-d H:i:s', strtotime($request_date));
    $status = 'pending';

    // File upload handling
    // $file_name = $_FILES['file']['name'];
    // $file_tmp = $_FILES['file']['tmp_name'];
    // $file_destination = '../../uploads/' . $file_name;

    // Move uploaded file to destination

    // move_uploaded_file($file_tmp, $file_destination);


    // Prepare SQL statement for each item
    $stmt = $conn->prepare("INSERT INTO purchase_request (requester_code, purchase_request_code, datetime, status) VALUES (?, ?, ?, ?)");

    $stmt->bind_param('ssss', $usercode, $request_code, $date, $status);

    if ($stmt->execute()) {
        $stmt->close();
        //insert request database
        foreach($send_data as $data){
            $stmt = $conn->prepare("INSERT INTO purchase_request_list (purchase_request_code, item_name, quantity, price, specs, status) VALUES (?,?,?,?,?,?)");
            $stmt->bind_param('ssssss', $request_code, $data['item-name'], $data['quantity'], $data['budget'], $data['specs'], $status);
            $stmt->execute();
            $stmt->close();
        }
        echo "success";
        $conn->close();
        exit();
    }
}
