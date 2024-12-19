<?php
require '../dbCon.php';
session_start();
$usercode = $_SESSION['usercode'];
$fullname = $_POST['fullname'] ?? ''; // Use null coalescing to provide a default value
$email = $_POST['email'] ?? '';
$birthdate = $_POST['birthdate'] ?? '';
$gender = $_POST['gender'] ?? '';
$phone_number = $_POST['phone_number'] ?? '';
$currentPassword = $_POST['currentPassword'] ?? '';
$newPassword = $_POST['newPassword'] ?? '';
$newPassword = encrypt($newPassword, secretKey());

$stmt = $conn->prepare('SELECT profile,password FROM users WHERE usercode = ?');
$stmt->bind_param('s', $usercode);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$oldPath = $row['profile']; // Store the old image path
if ($currentPassword != decrypt($row['password'], secretKey())) {
    $_SESSION['error'] = 'old password is incorrect';
    header("Location: ../../pages/".$_SESSION['role']."/settings.php");
    exit();
}
$stmt->close();

// Check if the image file was uploaded
$image = $_FILES['image'] ?? null; // Access the uploaded file correctly
// echo $image; // Removed this line

if (isset($image) && $image['error'] === UPLOAD_ERR_OK) { // Check for upload errors
    $path = '../../profile/';
    $target_file = $path . basename($image["name"]); // Use the correct key for the file name
    // echo $target_file;
    if (move_uploaded_file($image["tmp_name"], $target_file)) { // Use $image instead of $_POST
        // Delete the old image if it exists
        if (file_exists($oldPath)) {
            unlink($oldPath);
        }
    } else {
        // Handle error if the image upload fails
        echo "Error uploading the image.";
    }
} else {
    // If no new image is uploaded, keep the old image path
    $target_file = $oldPath; // Retain the old image path
}

// echo $target_file;

// Prepare and execute the update statement
$stmt = $conn->prepare('UPDATE users SET fullname=?, email=?, birthdate=?, gender=?, phone_number=?, profile=?, password=? WHERE usercode = ?');
$stmt->bind_param('sssssssi', $fullname, $email, $birthdate, $gender, $phone_number, $target_file, $newPassword, $usercode); // Ensure correct number of parameters
if ($stmt->execute()) {
    $_SESSION['profile'] = isset($image) && $image['error'] === UPLOAD_ERR_OK?$target_file:$_SESSION['profile'];
    $_SESSION['fullname'] = $fullname;
    $_SESSION['email'] = $email;
    $_SESSION['successUps'] = 'update successful';
    header("Location: ../../pages/".$_SESSION['role']."/settings.php");
    exit();
} else {
    echo 'error uploading!!';
}
