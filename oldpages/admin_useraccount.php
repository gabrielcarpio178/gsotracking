<?php
session_start();
if($_SESSION['role'] != 'admin'){
    header("Location: admin_dashboard.php");
    exit();
}
require '../logic/dbCon.php';
$usercode = $_SESSION['usercode'];
$stmt = $conn->prepare("SELECT * FROM users WHERE usercode =?");
$stmt->bind_param("s", $usercode);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$defaultProfile = $row['gender'] == 'male' ? '../styles/images/boy.jpeg' : '../styles/images/girl.jpeg';
$profile = $row['profile'] ?? $defaultProfile;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>USERACCOUNT</title>
    <link rel="icon" type="image/gif" href="imgOP/gif001.gif">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" /> -->
    <link rel="stylesheet" href="../styles/admin_useraccount.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />


</head>

<body>
    <header>

        <div class="user">
            <img src="../styles/images/logo1.png" alt="">
            <h3 style="letter-spacing: 4px;"><?php echo $_SESSION['role'];?></h3>
        </div>
        <span class="menutext">menu</span>

        <nav class="navbar">
            <ul>

                <li>
                    <i class="fa-solid fa-laptop-file"></i>
                    <a href="admin_dashboard.php">
                        DASHBOARD
                    </a>
                </li>

                <li>
                    <i class="fa-solid fa-chart-simple"></i>
                    <a href="admin_analytics.php">
                        ANALYTICS
                    </a>
                </li>

                <li>
                    <i class="fa-solid fa-file-invoice"></i>
                    <a href="admin_transaction.php">
                        TRANSACTION LOG
                    </a>
                </li>

                <li>
                    <i class="fa-solid fa-cubes"></i>
                    <a href="admin_category.php">
                        CATEGORY
                    </a>
                </li>

                <li>
                    <i class="fa-solid fa-comment-dots"></i>
                    <a href="admin_messages.php">
                        MESSAGES
                    </a>
                </li>
                <li>

                    <i class="fa-solid fa-user" id="active"></i>
                    <a href="admin_useraccount.php" id="active">
                        USER ACCOUNT
                    </a>
                </li>
                <li>
                    <i class="fa-solid fa-gear"></i>
                    <a href="admin_settings.php">
                        SETTINGS
                    </a>
                </li>

                <div class="div">
                    <span></span>
                </div>


                <li>
                    <i class="fa-solid fa-door-open"></i>
                    <a href="">LOG OUT</a>
                </li>
            </ul>

        </nav>

    </header>

    <div id="menu" class="fas fa-bars"></div>

    <div class="container">
        <div class="header">
            <div class="div1">
                <div class="content">
                    <div class="logo">
                        <img src="../styles/images/logo1.png" alt="">
                    </div>
                    <p>Qr Code Scanning with Informed Mechanism <br> Driven and Equipment Tracking System</p>
                </div>
            </div>
            <div class="div2">
                <div class="content2">
                    <div class="search">
                        <i class="fa-solid fa-search"></i>
                        <input type="search" placeholder="Search" class="search-input">
                    </div>
                    <div class="notpic">
                        <div class="ahehe">
                            <a href=""><i class="fa-solid fa-bell"></i></a>
                        </div>
                        <div class="profile">
                            <img src="../styles/images/logo1.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="containermain">
            <div class="profile-box">
                <div class="profile-pic">
                    <img src="<?php echo $profile;?>" alt="Profile Picture" style="border-radius:50px;"/>
                </div>
                <div class="profile-name">
                    <h2><?php echo $row['fullname'];?></h2>
                </div>
                <div class="profile-email">
                    <p><?php echo $row['email'];?></p>
                </div>

                <div class="account">
                    <span>Account Details</span>
                </div>

                <div class="account-details">
                    <div class="div1">
                        <span>Username:</span>
                        <span>Email:</span>
                        <span>Phone Number:</span>
                        <span>Role:</span>
                    </div>
                    <div class="div2">
                        <span><?php echo $row['email'];?></span>
                        <span><?php echo $row['email'];?></span>
                        <span><?php echo $row['phone_number'];?></span>
                        <span><?php echo $row['role'];?></span>

                    </div>

                </div>
            </div>
        </div>


















    </div>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#menu').click(function() {
                $(this).toggleClass('fa-times');
                $('header').toggleClass('toggle');

                $(window).on('scroll load', function() {
                    $('#menu').removeClass('fa-times');
                    $('header').removeClass('toggle');
                });
            });

        });
    </script>







</body>

</html>