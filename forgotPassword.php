<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

require 'logic/dbCon.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/gif" href="styles/images/logo2.png">
    <link rel="stylesheet" href="styles/forgotPassword.css">
    <script src="scripts/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="styles/sweetalert2.min.css">
    <script src="scripts/moment-with-locales.js"></script>
    <title>Forgot Password</title>
</head>
<body>
<style>
    .loader-content{
        position: absolute;
        border: 1px solid black;
        width: 100%;
        height: 100vh;
        background-color: rgba(0, 0, 0, 0.3);
        z-index: 9999;
        left: 0;
        display: none;
    }
</style>
    <div class="loader-content" id="loader_div">
        <?php include 'pages/client/loader.php' ?>
    </div>
    <main class="main-container">
        <section class="section-container">
            <div class="header-content">
                <div class="gso-logo img-content">
                    <img src="styles/images/logo1.png" alt="logo-image" class="gso-img">
                </div>
                <div class="title-content">
                    <h1>CITY OF BAGO</h1>
                    <hr>
                    <h2>Negros Occidental</h2>
                </div>
                <div class="bcc-logo img-content">
                    <img src="styles/images/logo2.png" alt="logo-image" class="bcc-img">
                </div>
            </div>
            <div class="form-content-sumbit">
                <div class="forgot-content">
                    <h1>Forgot password</h1>
                    <form class="forgot-password-form inputs" id="forgot_password">
                        <label for="email">Enter Email</label>
                        <input type="email" name="email" id="input_email" placeholder="Email" class="input-content">
                        <button>Send</button>
                    </form>
                </div>
            </div>
        </section>
    </main>
    <script src="scripts/jquery.min.js"></script>
    <script src="scripts/forgotpassword.js"></script>
</body>
</html>