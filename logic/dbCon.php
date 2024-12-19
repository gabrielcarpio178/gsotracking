<?php
// Update this with the correct host, username, password, and database name
$dbHost = 'localhost'; // Your actual database host
$dbUsername = 'root'; // Your database username
$dbPassword = ''; // Your database password
$dbName = 'qrinfomecha'; // Your database name

// Establishing the connection
$conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if (!$conn) {
    die('Error connecting to the database: ' . mysqli_connect_error());
}
error_reporting(E_ALL);
ini_set('display_errors', 1);


// Functions

function generateUserCode($conn)
{
    $currentYear = date('Y');
    $stmt = $conn->prepare('SELECT usercode FROM users ORDER BY id DESC LIMIT 1');
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $latestCode = $row['usercode'];
        $numericPart = substr($latestCode, 4);
        if (substr($latestCode, 0, 4) == $currentYear) {
            $newNumericPart = str_pad((int)$numericPart + 1, 5, '0', STR_PAD_LEFT);
            return $currentYear . $newNumericPart;
        }
    }
    return $currentYear . '00001';
}

function generateItemCode($conn)
{
    $currentYear = date('Y');
    $stmt = $conn->prepare('SELECT purchase_request_code FROM purchase_request ORDER BY id DESC LIMIT 1');
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $latestCode = $row['purchase_request_code'];
        $numericPart = substr($latestCode, 4);
        if (substr($latestCode, 0, 4) == $currentYear) {
            $newNumericPart = str_pad((int)$numericPart + 1, 3, '0', STR_PAD_LEFT);
            return $currentYear . $newNumericPart;
        }
    }
    return $currentYear . ':001';
}

function secretKey()
{
    return 'capstone_qrcode_secretKey';
}

function encrypt($plaintext, $key)
{
    $method = 'aes-256-cbc';
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($method));
    $ciphertext = openssl_encrypt($plaintext, $method, $key, 0, $iv);
    return base64_encode($iv . $ciphertext);
}

function decrypt($ciphertext_base64, $key)
{
    $method = 'aes-256-cbc';
    $ciphertext_combined = base64_decode($ciphertext_base64);
    $iv_length = openssl_cipher_iv_length($method);
    $iv = substr($ciphertext_combined, 0, $iv_length);
    $ciphertext = substr($ciphertext_combined, $iv_length);
    return openssl_decrypt($ciphertext, $method, $key, 0, $iv);
}

function role($conn)
{
    $stmt = $conn->prepare("SELECT role FROM users");
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->fetch_assoc()) {
        return 'client';
    } else {
        return 'admin';
    }
}

function generateEquipmentID($conn)
{
    $currentYear = date('Y');
    $stmt = $conn->prepare('SELECT equipment_id FROM transaction_log ORDER BY id DESC LIMIT 1');
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $latestCode = $row['equipment_id'];
        $numericPart = substr($latestCode, 4);
        if (substr($latestCode, 0, 4) == $currentYear) {
            $newNumericPart = str_pad((int)$numericPart + 1, 5, '0', STR_PAD_LEFT);
            return $currentYear . $newNumericPart;
        }
    }
    return $currentYear . 'EQ0001';
}

// Function to calculate time ago
function timeAgo($timestamp)
{
    $timeDifference = time() - strtotime($timestamp);
    $seconds = $timeDifference;
    $minutes = round($seconds / 60);
    $hours = round($seconds / 3600);
    $days = round($seconds / 86400);
    $weeks = round($seconds / 604800);
    $months = round($seconds / 2629440);
    $years = round($seconds / 31553280);

    if ($seconds <= 60) {
        return "Just Now";
    } else if ($minutes <= 60) {
        return ($minutes == 1) ? "one minute ago" : "$minutes minutes ago";
    } else if ($hours <= 24) {
        return ($hours == 1) ? "an hour ago" : "$hours hours ago";
    } else if ($days <= 7) {
        return ($days == 1) ? "yesterday" : "$days days ago";
    } else if ($weeks <= 4) {
        return ($weeks == 1) ? "a week ago" : "$weeks weeks ago";
    } else if ($months <= 12) {
        return ($months == 1) ? "a month ago" : "$months months ago";
    } else {
        return ($years == 1) ? "one year ago" : "$years years ago";
    }
}

function quickQuery($conn, $usercode, $column): mixed
{
    $stmt = $conn->prepare("SELECT $column FROM users WHERE usercode = ?");
    $stmt->bind_param("s", $usercode);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc()[$column];
}
