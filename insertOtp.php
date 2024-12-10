<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

require 'logic/dbCon.php';
session_start();
if(!isset($_SESSION['result'])){
    header("Location: forgotpassword.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/gif" href="styles/images/logo2.png">
    <link rel="stylesheet" href="styles/insertOtp.css">
    <script src="scripts/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="styles/sweetalert2.min.css">
    <script src="scripts/moment-with-locales.js"></script>
    <title>Verify OTP</title>
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
            <div class="verify-content-sumbit">
                <div class="verify-content">
                    <h1>Verify OTP</h1>
                    <form class="verify-form" id="verify_form">
                        <div class="inputs-tag">
                            <input type="text" class="input_number" maxlength="1" oninput="this.value=this.value.replace(/(?![0-9])./gmi,'')" required>
                            <input type="text" class="input_number" maxlength="1" oninput="this.value=this.value.replace(/(?![0-9])./gmi,'')" required>
                            <input type="text" class="input_number" maxlength="1" oninput="this.value=this.value.replace(/(?![0-9])./gmi,'')" required>
                            <input type="text" class="input_number" maxlength="1" oninput="this.value=this.value.replace(/(?![0-9])./gmi,'')" required>
                        </div>
                        <div class="btn-verify-content">
                            <p class="whitespace-nowrap text-[15px] text-slate-500" id="timer">This OTP will be expire in <span id="expire_time"></span> mins</p>
                            <button>Verify</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </section>
    </main>
    <script src="scripts/jquery.min.js"></script>
    <script>
        $(document).ready(()=>{
            var {sentDateTime, encrypted_otp} = <?=$_SESSION['result']?>;
            var durition_time = 60;
            displayExpired(durition_time, sentDateTime)
            $("#verify_form").on('submit',e=>{
                e.preventDefault();
                var isExpiredOtp = durition(durition_time, sentDateTime);
                if(isExpiredOtp!=="expired_otp"){
                    var inputs = document.querySelectorAll(".input_number")
                    let otp = ''
                    inputs.forEach(element => {
                        otp += $(element).val();
                    });
                    verifySubmit(parseInt(otp));
                }else{
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: "OTP expired",
                        showConfirmButton: false,
                        timer: 1000
                    });
                }
                
            })
        })

        function durition(timer, sentDateTime){
            var current_date = moment()
            var expire_date = moment(sentDateTime, 'YYYY-MM-DD hh:mm').add(timer, 'minutes');
            var seconds = expire_date.diff(current_date, 'seconds')
            return expire_date>=current_date?moment.utc(seconds*1000).format('mm:ss'):"expired_otp";
        }

        function displayExpired(timer, sentDateTime){
            setInterval(()=>{
                $("#expire_time").text(durition(timer, sentDateTime));
                if(durition(timer, sentDateTime)==="expired_otp"){
                    $("#timer").text("Your OTP timer is Over");
                    $("#timer").css("color", "red");   
                }
            }, 1000);
            
        }

        function verifySubmit(otp){
           $.ajax({
            url: 'logic/verifyOtp.php',
            type: 'POST',
            data: {
                otp
            },
            cache: false,
            beforeSend: ()=>{
                $("#loader_div").css('display', 'block');
            },
            success: res=>{
                $("#loader_div").css('display', 'none');
                if(res==="invalid_otp"){
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: "Invalid OTP",
                        showConfirmButton: false,
                        timer: 1000
                    });
                }else{
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Check new password in your email",
                        showConfirmButton: false,
                        timer: 1000
                    }).then(()=>{
                        window.location = "index.php";
                    })
                }
            }
           })
        }
    </script>
</body>
</html>