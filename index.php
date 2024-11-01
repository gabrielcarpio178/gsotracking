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
    <link rel="stylesheet" href="styles/login.css">
    <script src="scripts/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="styles/sweetalert2.min.css">
    <title>Login</title>
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
                    <h2>NEGROS OCCINDETAL</h2>
                </div>
                <div class="bcc-logo img-content">
                    <img src="styles/images/logo2.png" alt="logo-image" class="bcc-img">
                </div>
            </div>
            <div class="form-content-sumbit">
                <div class="login-content">
                    <h2 class="login-label">Log in</h2>
                    <form id="form_content" class="content-info">
                        <div class="inputs">
                            <label for="username">Email</label>
                            <input type="text" name="username" id="username" class="input-content" required>
                        </div>
                        <div class="inputs">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="input-content" required>
                        </div>
                        <button type="submit" class="btn-submit">Log in</button>
                    </form>
                </div>
                <p class="text-info">Qr Code Scanning with Informed Mechanism Driven & Equipment Tracking System</p>
            </div>
        </section>
    </main>
    <script src="scripts/jquery.min.js"></script>
    <script src="scripts/login.js"></script>
</body>
</html>