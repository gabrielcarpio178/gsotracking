<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>QR SCANNING</title>
    <link rel="icon" type="image/gif" href="../../styles/images/logo2.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../styles/storekeeper_qr.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="../../scripts/moment-with-locales.js"></script>
    <script src="../../scripts/jquery.min.js"></script>  
    <!-- <script src="https://unpkg.com/html5-qrcode"></script> -->

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

    
    .noti-content{
            border-left: 2px solid rgba(0, 0, 0, 0.3);
            height: 100vh;
            width: 30%;
            position: absolute;
            z-index: 1;
            right: 0;
            background-color: white;
            display: none;
        }
        .notification{
            font-size: 3rem;
            cursor: pointer;
        }
        .notification > i{
            color: white;
            
        }


    </style>
    <div class="loader-content" id="loader_div">
        <?php include '../client/loader.php' ?>
    </div>
    <div class="noti-content" id="noti_content">
        <?php include 'noti_storekeeper_content.php' ?>
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
                    <i class="fa-solid fa-cubes"></i>
                    <a href="equipment_list.php">EQUIPMENT LIST</a>
                </li>
                <li>
                    <i class="fa-solid fa-camera" id="active"></i>
                    <a href="storekeep_qr.php" id="active">QR CODE SCANNING</a>
                </li>
                <li>
                    <i class="fa-solid fa-qrcode"></i>
                    <a href="print_qr.php">PRINT QR</a>
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
                        <div class="notification noti_bell" onclick="openNotification()">
                            <div class="noti_count" id="noti_count"></div>
                            <i class="fa-solid fa-bell "></i>
                        </div>
                        <div class="profile">
                            <img src="../../styles/images/logo1.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="cm">
            <div class="bd">
                <video class="sq" id="qr-reader"></video>
                <div id="results" style="margin-top: 20px; text-align: center; font-size: 18px;"></div>
                <div class="ft">
                    <div class="r">
                        <div class="pic" onclick="document.getElementById('qr-input-file').click()">
                            <img src="../../styles/images/qrup.png" alt="">
                        </div>
                        <div class="text">Upload Qr code</div>
                        <input type="file" id="qr-input-file" accept="image/*" style="display: none;" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal">
        <div class="modal-data">
        </div>
    </div>
    <!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script> -->
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsqr@1.4.0/dist/jsQR.min.js"></script>
    <script>
        let resultsDiv = document.getElementById('results');
        let qrReader = document.getElementById('qr-reader');
        document.addEventListener('DOMContentLoaded', function() {
            let scanner = new Instascan.Scanner({
                video: document.getElementById('qr-reader')
            }); 
            function startScanning() {
                Instascan.Camera.getCameras().then(function(cameras) {
                    if (cameras.length > 0) {
                        scanner.start(cameras[0]);
                        qrReader.style.display = 'block';
                    } else {
                        alert('No cameras found');
                    }
                }).catch(function(error) {
                    console.error('Error accessing cameras:', error);
                });
            }

            scanner.addListener('scan', function(content) {
                // resultsDiv.textContent = 'Scanned: ' + content;
                fetchInformation(content);
                // console.log(content);
            });

            

            // Start scanning automatically when the page loads
            startScanning();

            let fileInput = document.getElementById('qr-input-file');

            fileInput.addEventListener('change', function(e) {
                let file = e.target.files[0];
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function(e) {
                        let img = new Image();
                        img.onload = function() {
                            let canvas = document.createElement('canvas');
                            let context = canvas.getContext('2d');
                            canvas.width = img.width;
                            canvas.height = img.height;
                            context.drawImage(img, 0, 0, img.width, img.height);
                            let imageData = context.getImageData(0, 0, canvas.width, canvas.height);
                            let code = jsQR(imageData.data, imageData.width, imageData.height);

                            if (code) {
                                // resultsDiv.textContent = 'Scanned from file: ' + code.data;
                                // console.log(code.data);
                                fetchInformation(code.data);
                            } else {
                                resultsDiv.textContent = 'No QR code found in the image.';
                            }
                        };
                        img.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
        });

        function getDuration(num_days, doingMaintenance){
            
            var maintenance_day = moment(doingMaintenance).add(num_days, 'days').format('YYMMDD');
            var today = moment().format('YYMMDD');
            if(maintenance_day>=today){
                return moment(doingMaintenance).add(num_days, 'days').format('LL');
            }else{
                $("#maintenance_date").css("color", 'red');
                return '<div style="color: red;">Need Maintenance</div>'
            }
        }

        function fetchInformation(code) {
            Swal.fire({
                html: `
                    ${code}
                `
            })

            // $.ajax({
            //     url: '../../logic/READ/fetchEmployeeData.php',
            //     method: 'POST',
            //     data: {
            //         code: code
            //     },
            //     beforeSend: ()=>{
            //         $("#loader_div").css("display", "block");
            //     },
            //     success: function(res) {
            //         $("#loader_div").css("display", "none");
            //         var result = JSON.parse(res);
            //         if(res.length!==0){
            //             Swal.fire({
            //                 html: `
            //                     <strong style="text-align: left;">Request Equipment</strong>
            //                     <strong style="text-align: left;">Name: </strong> ${result[0].fullname}<br/>
            //                     <strong style="text-align: left;">Item-name: </strong> ${result[0].item_name}<br/>
            //                     <strong style="text-align: left;">Quantity:</strong> ${result[0].quantity}<br/>
            //                     <strong style="text-align: left;">Purchase Date:</strong> ${result[0].datetime}<br/>
            //                     <strong style="text-align: left;">Maintenance:</strong> ${getDuration(result[0].maintenance, result[0].maintance.doingMaintenance)}<br/>
                                
            //                 `
            //             })
            //         }else{
            //             $("#loader_div").css("display", "none");
            //             resultsDiv.textContent = 'Error fetching data. Please try again.';
            //         }   
            //     },
            //     error: function() {
            //         resultsDiv.textContent = 'Error fetching data. Please try again.';
            //     }
            // });
        }
    </script>
</body>

</html>