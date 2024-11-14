<?php
session_start();
require '../../logic/dbCon.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/gif" href="../../styles/images/logo2.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link rel="stylesheet" href="../../styles/accountability.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.5/dist/chart.umd.min.js"></script>
    <script src="../../scripts/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="../../styles/sweetalert2.min.css">
    <title>Account</title>
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
        <?php include '../client/loader.php' ?>
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
                    <i class="fa fa-exchange"></i>
                    <a href="equipment_transfer.php" >EQUIPMENT TRANSFER</a>
                </li>

                <li>
                    <i class="fa-solid fa-chart-simple"></i>
                    <a href="analytics.php" >ANALYTICS</a>
                </li>
                <li>
                    <i class="fa-solid fa-file-invoice"></i>
                    <a href="transaction.php">TRANSACTION LOG</a>
                </li>
                <li>
                    <i class="fa-solid fa-user" id="active"></i>
                    <a href="addaccount.php" id="active">ADD ACCOUNT</a>
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
                    <i class="fa-solid fa-gear"></i>
                    <a href="settings.php">SETTINGS</a>
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
                        <img src="../../styles/images/logo1.png" alt="">
                    </div>
                    <p>Qr Code Scanning with Informed Mechanism <br> Driven and Equipment Tracking System</p>
                </div>
            </div>
            <div class="div2">
                <div class="content2">
                    <div class="notpic">
                        <div class="ahehe">
                            <a href=""><i class="fa-solid fa-bell"></i></a>
                        </div>
                        <div class="profile">
                            <img src="../../styles/images/logo1.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .main-content{
                height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 20px 0;
                overflow-y: scroll;
            }
            .form-content{
                width: 50%;
                border-radius: 10px/10px;
                border: 1px solid black;
                padding: 20px 15px;
                margin-top: 150px;
            }
            .submit_form{
                display: flex;
                flex-direction: column;
                
            }
            .input-content{
                display: flex;
                flex-direction: column;
            }
            .input-content > input{
                outline: none;
                background-color: #ECECEC;
                height: 48px;
                border-radius: 3px;
                box-shadow: 73px 71px 15px -69px rgba(0,0,0,0.25) inset;
            -webkit-box-shadow: 73px 71px 15px -69px rgba(0,0,0,0.25) inset;
            -moz-box-shadow: 73px 71px 15px -69px rgba(0,0,0,0.25) inset;
                border: none;
                margin: 10px 0;
                padding: 10px;
                width: 100%;
            }
            .second-input{
                display: flex;
                flex-direction: row;
            }
            .second-input > .input-content:nth-child(1){
                width: 60%;
            }
            .second-input > .input-content:nth-child(2){
                width: 40%;
                display: flex;
                flex-direction: column;
                margin-left: 20px;
                justify-content: center;
            }
            .radio-btn{
                display: flex;
                flex-direction: row;
            }
            input[type=radio]{
                width: 100%;
            }
            .r-input-content{
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: space-between;
                width: 100%;
            }
            button{
                width: 50%;
                align-self: center;
                background-color: #191919;
                color: #f0f0f0;
                border: none;
                cursor: pointer;
                border-radius: 3px;
                height: 7vh;
                transition: all 0.6s ease-in-out;
            }

            button:hover {
                background-color: #f0f0f0;
                color: #191919;
                box-shadow: 73px 71px 15px -69px rgba(0,0,0,0.25) inset;
                -webkit-box-shadow: 73px 71px 15px -69px rgba(0,0,0,0.25) inset;
                -moz-box-shadow: 73px 71px 15px -69px rgba(0,0,0,0.25) inset;
            }
            .btn-content{
                display: flex;
                justify-content: center;
                width: 100%;
            }
            .message{
                color: red;
            }

        </style>
        <div class="main-content">
            <div class="form-content">
                <form id="form_submit" class="submit-form">
                    <div class="input-content">
                        <label for="full_name" class="label-input">Full name</label>
                        <input type="text" class="input-data" id="full_name">
                    </div>
                    <div class="second-input">
                        <div class="input-content">
                            <label for="birthday" class="label-input">Birthday</label>
                            <input type="date" class="input-data" id="birthday">
                        </div>
                        <div class="input-content">
                            <div class="label-input">Sex</div>
                            <div class="radio-btn">
                                <div class="r-input-content">
                                    <label for="male" class="label-input">Male</label>
                                    <input type="radio" value="male" name="sex" id="male">
                                </div>
                                <div class="r-input-content">
                                    <label for="female" class="label-input">Female</label>
                                    <input type="radio" value="female" name="sex" id="female">
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="input-content">
                        <label for="email" class="label-input">Email</label>
                        <input type="email" class="input-data" id="email">
                    </div>
                    <div class="input-content">
                        <label for="pnumber" class="label-input">Phone number <span class="message" id="pmessage"></span></label>
                        <input type="number" class="input-data" id="pnumber">
                    </div>
                    <div class="input-content">
                        <label for="employee_id" class="label-input">Employee ID <span class="message" id="emessage"></span></label>
                        <input type="number" class="input-data" id="employee_id">
                    </div>
                    <div class="input-content">
                        <label for="department" class="label-input">Department</label>
                        <input type="text" class="input-data" id="department">
                    </div>
                    <div class="input-content">
                        <label for="position" class="label-input">Position</label>
                        <input type="text" class="input-data" id="position">
                    </div>
                    <div class="btn-content">
                        <button type="submit" class="btn-submit">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="../../scripts/jquery.min.js"></script>
    <script>
        $(document).ready(()=>{
            $("#form_submit").on('submit',e=>{
                e.preventDefault();
                var full_name = $("#full_name").val();
                var birthday = $("#birthday").val();
                var sex = $('input[name="sex"]:checked').val();
                var email = $("#email").val();
                var pnumber = $("#pnumber").val();
                var employee_id = $("#employee_id").val();
                var department = $("#department").val();
                var position = $("#position").val();

                if(pnumber.length!==11){
                    $("#pmessage").text("-phone number digit must be 11");
                }else if(employee_id.length!==9){
                    $("#emessage").text("-employee ID digit must be 9")
                }
                else{
                    $.ajax({
                        url: '../../logic/dbaddaccount.php',
                        type: 'post',
                        data : {
                            full_name,
                            birthday,
                            sex,
                            email,
                            pnumber,
                            department,
                            employee_id,
                            position
                        },
                        cache: false,
                        beforeSend: ()=>{
                            $("#loader_div").css('display', 'block');
                        },
                        success: res=>{
                            $("#loader_div").css('display', 'none');
                            // console.log(res);
                            if(res!=='email or employee ID is already used'){
                                Swal.fire({
                                    position: "center",
                                    icon: "success",
                                    title: "Message has been sent",
                                    showConfirmButton: false,
                                    timer: 1000
                                }).then(()=>{
                                    window.location.reload();
                                });
                            }else{
                                Swal.fire({
                                    position: "center",
                                    icon: "error",
                                    title: "Email or employee ID is already used",
                                    showConfirmButton: false,
                                    timer: 1000
                                });
                            }
                            
                        }
                    })
                }                
            })
        })
    </script>
</body>
</html>