<?php
require '../../logic/dbCon.php';
session_start();
$usercode = $_SESSION['usercode'];
$stmt = $conn->prepare("SELECT * FROM users WHERE usercode =?");
$stmt->bind_param("s", $usercode);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$defaultProfile = $row['gender'] == 'male' ? '../../styles/images/boy.jpeg' : '../../styles/images/girl.jpeg';
$profile = $row['profile'] ?? $defaultProfile;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>SETTINGS</title><link rel="icon" type="image/gif" href="../../styles/images/logo2.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link rel="stylesheet" href="../../styles/admin_settings.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>


@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');


*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    text-decoration:none;
    outline:none;
    border:none;
    /* text-transform:capitalize; */
    transition:all .2s linear;
    font-family: "Poppins", sans-serif;
}

/* *::selection{
    background:#7eabae;
    color:#443434;
} */

 html{
    font-size:58.5%;
    overflow-x:hidden;
}

/* html::-webkit-scrollbar{
    width: 1.4rem;
  }
html::-webkit-scrollbar-track{
    background: #eadbc4;
    border: 1px solid #443434;
  }
html::-webkit-scrollbar-thumb{
    background: #443434;
    border-radius: 5px; } */
  
body{
   background:#7eabae;
   overflow-x:hidden;
   padding-left:27rem;
}
header{
    position:fixed;
    top:0;
    left:0;
    z-index:1000;
    height:100%;
    width:27rem;
    background:#F8F8F8;
    display:flex;
    align-items:center;
    /* justify-content:center; */
    flex-flow:column;
    filter: drop-shadow(3px 1px 1px #adadad);
}

header .user{
    margin-top: 2rem;
    display: flex;
    align-items: center;
    justify-content:center;
    flex-direction: row;
    width: 20rem;
    height:5rem;
    /* border: 2px solid black; */
    background-color: #FFFFFF;
    border-radius: 20px;
    gap: 1rem;
}

header .user img{
    display: flex;
    align-items: center;
    justify-content: center;
    height:4rem;
    width:4rem;
    /* border: 2px solid black; */
    border-radius:50%;
    object-fit:cover;
}

.menutext{
    font-size: 1.5rem;
    margin-left: -25%;
    text-transform: capitalize;
    font-weight: 800;
    margin-top: 3rem;
    margin-bottom: 1rem;
    /* margin-right: auto; */
}

header .navbar{
    width:100%;
}

header .navbar ul li{
    list-style:none;

    transition: background-color 0.3s, color 0.3s;
    position: relative;
}
 .navbar ul li:hover {
    /* background-color: #007bff;  */
    color: white; 
} 

.navbar ul li:hover a {
    background:#000000;
    color: white; /* Change the color of the link text on hover */
}


.navbar ul li i{
    font-size: 2.5rem;
    left: 33%;
    top: 1.7rem;
    /* margin-right: 1rem; */
    position: absolute;
    margin-left: -6rem;
}

header .navbar ul  #active{
    background-color: #000000;
    color: #F8F8F8;
}


header .navbar ul li  a{
    display:block;
    border-radius: 15px 0 0 15px;
    padding-left: 15rem;
    background:#F8F8F8;
    padding-top: 20px;
    height: 6rem;
    margin-left:-6rem;
    color:#000000;
    font-size:1.5rem;
    font-weight: bold;
}




header .navbar ul li:last-child{
    position: absolute;
    bottom: 0;
    width: 100%;
} 

.div{
    display: flex;
    align-items: center;
    justify-content: center;
}

.div span{
    border: 1px solid #D4D4D4;
    width: 40rem;
    margin-right: 3rem;
    margin-left: 2rem;
    margin-top: 2rem;
}


#menu{
    position:fixed;
    top:2rem;
    right:2rem;
    background: transparent;
    color:#443434;
    cursor:pointer;
    font-size:2.5rem;
    padding:1rem 1.5rem;
    z-index:1000;
    display:none;
}





@media (max-width:1200px){
    html{
        font-size:55%;
    }
    
}


@media (max-width:991px){
    header{
        
        left:-120%;
    }
    
    #menu{
        display:block;
    }
    
    header.toggle{
        left:0;
    }
    
    body{
        padding:0;
    }
}


@media (max-width:768px){
    html{
        font-size:50%;
    }
    
}






@media (max-width:400px){
    header{
        width:100wh;
    }
    

}
    </style>



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
</head>

<body>
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
                    <i class="fa fa-exchange"></i>
                    <a href="equipment_transfer.php">EQUIPMENT TRANSFER</a>
                </li>

                <li>
                    <i class="fa-solid fa-chart-simple"></i>
                    <a href="analytics.php">ANALYTICS</a>
                </li>
                <li>
                    <i class="fa-solid fa-file-invoice"></i>
                    <a href="transaction.php">TRANSACTION LOG</a>
                </li>

                <li>
                    <i class="fa-solid fa-user"></i>
                    <a href="addaccount.php">ADD ACCOUNT</a>
                </li>
                <li>
                    <i class="fa-solid fa-money-check-dollar"></i>
                    <a href="purchase_request.php">PURCHASE REQUEST</a>
                </li>
                <li>
                    <i class="fa-solid fa-money-check-dollar"></i>
                    <a href="equipment.php">EQUIPMENT</a>
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
                    <div class="search">
                        <i class="fa-solid fa-search"></i>
                        <input type="search" placeholder="Search" class="search-input" />
                    </div>
                    <div class="notpic">
                        <div class="ahehe">
                            <a href=""><i class="fa-solid fa-bell"></i></a>
                        </div>
                        <div class="profile">
                            <img src="../../styles/images/logo1.png" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="containermain">
            <div class="box">
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
        </div>
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
    </script>



</body>

</html>