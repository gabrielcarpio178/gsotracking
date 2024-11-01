<?php
require '../../logic/dbCon.php';
session_start();
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
    <title>SETTINGS</title>
    <link rel="icon" type="image/gif" href="../../styles/images/logo2.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../styles/admin_settings.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script>
        <?php
        if (isset($_SESSION['error'])) {
            echo 'alert("' . $_SESSION['error'] . '");';
        }
        if (isset($_SESSION['successUps'])) {
            echo 'alert("' . $_SESSION['successUps'] . '");';
        }
        unset($_SESSION['error'], $_SESSION['successUps']);
        ?>
    </script>
    <?php include 'pushNotification.php';?>
    <style>
        .noti_bell{
            position: relative;
            cursor: pointer;
        }
        .noti_count{
            position: absolute;
            width: 75%;
            height: 100%;
            right: 0;
            background-color: red;
            border-radius: 50%;
            text-align: center;
            color: white;
            font-weight: 900;
        }
        .noti-content{
            border-left: 2px solid rgba(0, 0, 0, 0.3);
            height: 100vh;
            width: 30%;
            position: absolute;
            z-index: 1;
            right: 0;
            background-color: white;
            display: none;
            /* overflow: scroll; */
        }
    </style>
</head>

<body>
    <div class="noti-content" id="noti_content">
        <?php include 'noti_content.php' ?>
    </div>
<header>
        <div class="user">
            <img src="<?php echo $_SESSION['profile'] ?>" alt="">
            <div>
                <h3 style="letter-spacing: 2px;"><?php echo $_SESSION['fullname'] ?></h3>
                <h5 style="letter-spacing: 2px;"><?php echo $_SESSION['role'] ?></h5>
            </div>
        </div>
        <span class="menutext">menu</span>

        <nav class="navbar">
            <ul>
                <li>
                    <i class="fa-solid fa-cubes" ></i>
                    <a href="purchase_request.php">PURCHASE REQUEST</a>
                </li>
                <li>
                    <i class="fa-solid fa-chalkboard-user"></i>
                    <a href="accountability.php">ACCOUNTABILITY</a>
                </li>
                <li>
                    <i class="fa-solid fa-gear" id="active"></i>
                    <a href="settings.php" id="active">SETTINGS</a>
                </li>
                <div class="div">
                    <span></span>
                </div>
                <li>
                    <i class="fa-solid fa-door-open"></i>
                    <a href="../../logic/logout.php">LOG OUT</a>
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
                        <img src="../../styles/images/logo1.png" alt="" />
                    </div>
                    <p>Qr Code Scanning with Informed Mechanism <br> Driven and Equipment Tracking System</p>
                </div>
            </div>
            <div class="div2">
                <div class="content2">
                   
                    <div class="notpic">
                        <div class="ahehe">
                            <a class="noti_bell" id="open_noti">
                                <div class="noti_count" id="noti_count"></div>
                                <i class="fa-solid fa-bell"></i>
                            </a>
                        </div>
                        <div class="profile">
                            <img src="<?php echo $_SESSION['profile'] ?>" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <main class="containermain" style="overflow: scroll;">
            <div class="box" >
                <h1>Update Profile</h1>
                <form action="../../logic/UPDATE/update.php" method="post" enctype="multipart/form-data" onsubmit="return validateInput()">
                    <input type="text" name="fullname" placeholder="Fullname" class="f" value="<?php echo $row['fullname']; ?>" required />
                    <div class="bd">
                        <span>Birhdate</span>
                        <input type="date" name="birthdate" value="<?php echo $row['birthdate']; ?>" required />
                    </div>
                    <div class="g">
                        <span>Gender:</span>
                        <span>Male:</span><input type="radio" name="gender" <?php echo $row['gender'] == 'male' ? 'checked' : ''; ?> value="male" required />
                        <span>Female:</span><input type="radio" name="gender" <?php echo $row['gender'] == 'female' ? 'checked' : ''; ?> value="female" required />
                    </div>
                    <div class="ins">
                        <input type="text" name="email" placeholder="Email" value="<?php echo $row['email']; ?>" required />
                        <input type="text" name="phone_number" placeholder="Phone Number" value="<?php echo $row['phone_number']; ?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 11);" required />
                        <input type="password" name="currentPassword" placeholder="Current Password" required />
                        <input type="password" id="password" name="newPassword" placeholder="Enter new password" required />
                        <input type="password" id="confirmPassword" placeholder="Confirm password" required />
                    </div>
                    <div class="ups">
                        <span>Profile</span>
                        <img id="profileImage" src="<?php echo $row['profile'] ?? ''; ?>" alt="" style="height:30px; width:30px; border-radius:50px;" />
                        <input type="file" name="image" accept="image/*" class="upload-picture" onchange="previewImage(event)" />
                    </div>
                    <div class="b">
                        <button type="submit">Update profile</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->

    <script>
        // $(document).ready(function() {
        //     $('#menu').click(function() {
        //         $(this).toggleClass('fa-times');
        //         $('header').toggleClass('toggle');

        //         $(window).on('scroll load', function() {
        //             $('#menu').removeClass('fa-times');
        //             $('header').removeClass('toggle');
        //         });
        //     });
        // });
        function validateInput() {
            var password = document.getElementById('password').value;
            var confirmPassword = document.getElementById('confirmPassword').value;
            if (password != confirmPassword) {
                alert('Passwords do not match!');
                return false;
            }
            return true;
        }

        function previewImage(event) {
            const image = document.getElementById('profileImage');
            image.src = URL.createObjectURL(event.target.files[0]);
        }

        const noti_content =  document.querySelector("#noti_content");
        const open_noti = document.querySelector("#open_noti");

        open_noti.addEventListener('click',()=>{
            noti_content.style.display = "block";
        })
    </script>



</body>

</html>