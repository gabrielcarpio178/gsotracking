<?php
session_start();
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
    <script src="../../scripts/moment-with-locales.js"></script>
    <script src="../../scripts/jquery.min.js"></script>
    <link rel="stylesheet" href="../../styles/sweetalert2.min.css">
    <title>Equipment</title>
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
        .set-durition-form{
            position: absolute;
            width: 100%;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.3);
            z-index: 9999;
            left: 0;
            display: none;
        }

        .input-content{
            display: flex;
            flex-direction: column;
        }

        .input-content-data > input{
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

        .form-duriton{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .durition-content{
            background-color: white;
            padding: 1rem;
            border-radius: 10px/10px;
        }
        .btn-content{
            display: flex;
            justify-content: center;
        }
        .btn-content > button{
            width: 100%;
        }
        .input-content-data{
            display: flex;
            align-items: center;
        }
        .day-text{
            font-size: 1.5rem;
        }

        .close-content-form{
            
            position: relative;
            width: 18%;
        }
        .close-content-form > div{
            position: absolute;
            right: 0;
            top: 0;
            font-size: 2rem;
            cursor: pointer;
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
        <?php include 'noti_admin_content.php' ?>
    </div>

    <div class="set-durition-form" id="form_durition">
        
        <form class="form-duriton">
            <div class="close-content-form">
                <div onclick="hideForm()">
                    &times;
                </div>
            </div>
            <div class="durition-content">
                <input type="hidden" id="purchase_id">
                
                <div class="input-content">
                    <label for="setDurition" class="label-input">Set Durition</label>
                    <div class="input-content-data">
                        <input type="number" class="input-data" id="setDurition" required>
                        <div class="day-text">
                            /day
                        </div>
                    </div>
                </div>
                
                <div class="btn-content">
                    <button type="submit" class="btn-submit">Save</button>
                </div>
            </div>
        </form>
    </div>

    <header>
        <div class="user">
            <img src="<?php echo $_SESSION['profile'] ?>" alt="">
            <div>
                <h3 style="letter-spacing: 2px;"><?php echo $_SESSION['fullname'] ?></h3>
                <h5 style="letter-spacing: 2px;"><?php echo $_SESSION['role'] ?></h5>
            </div>
        </div>
        <nav class="navbar">
            <ul>
                <li>
                    <i class="fa fa-exchange"></i>
                    <a href="equipment_transfer.php" >EQUIPMENT TRANSFER</a>
                </li>

                <li>
                    <i class="fa-solid fa-chart-simple"></i>
                    <a href="analytics.php">Analytics</a>
                </li>
                <li>
                    <i class="fa-solid fa-file"></i>
                    <a href="report.php">Report</a>
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
                    <i class="fa-solid fa-wrench" id="active"></i>
                    <a href="equipment.php"  id="active">Maintenance</a>
                </li>
                <li>
                    <i class="fa-solid fa-gear"></i>
                    <a href="settings.php">SETTINGS</a>
                </li>
               
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
                        <div class="notification" onclick="openNotification()">
                            <i class="fa-solid fa-bell"></i>
                        </div>
                        <div class="profile">
                            <img src="../../styles/images/logo1.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>
            .main-container{
                display: flex;
                flex-direction: column;
                gap: 10px 0;
                padding: 10px 20px;
            }
            table{
                margin-top: 10px;
            }
            .filter-btn input {
                background-color: #E7E7E7;
                outline: none;
                padding: 7px;
                width: 220px;
                padding-left: 35px;
                border-radius: 4.23px;
            }

            .table-content{
                height: 70vh;
                overflow-y: scroll;
            }
            button{
                cursor: pointer;
                padding: 5px;
                background-color: #4ECB71;
                color: white;
                border: none;
                border-radius: 5px/5px;
            }
            
            .qr-btn{
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            .qr-btn > img{
                width: 6rem;
            } 
            .request-maintenance{
                color: red;
            }
        </style>

        <div class="main-container">
            <div class="header-label">
                <h2>Equipment</h2>
                <hr>
            </div>
            <div class="filter-btn">
                <input type="number" id="search" placeholder="Search by ID" oninput="getdata(`${this.value}`)">
            </div>
            <div class="table-content">
                <table id="dataTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>equipment name</th>
                            <th>Employee</th>
                            <th>Quantity</th>
                            <th>PURCHASE DATE</th>
                            <th>REQUEST maintenance</th>
                            <th>Maintenance Date</th>
                            <th>Maintenance Duration</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">

                    </tbody>    
                </table>
            </div>
            
            
        </div>
    </div>

    
    <script>
        $(document).ready(()=>{
            getdata("all")
        })

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

        function isMaintenanceNull(duration){
            return duration!=null;
        }
        

        function getdata(search){
            $.ajax({
                url: '../../logic/getEquipment.php',
                type: 'post',
                data : {
                    search
                },
                cache: false,
                success: res=>{
                    var datas = JSON.parse(res);
                    let table_body = '';
                    datas.forEach(data=>{
                        if(data.request_maintenance==null){
                            table_body += `
                                <tr>
                                    <td>${data.purchase_request_code}</td>
                                    <td>${data.item_name}</td>
                                    <td>${data.fullname}</td>
                                    <td>${data.quantity}</td>
                                    <td>${moment(data.datetime).format('LL')}</td>
                                    <td>--</td>
                                    <td>${isMaintenanceNull(data.maintance_durition)?getDuration(data.maintance_durition, data.doingMaintenance):"<div style='color: red;'>Not Set Duration</div>"}</td>
                                    <td>
                                        <div>
                                            ${isMaintenanceNull(data.maintance_durition)?data.maintance_durition+" days":"Please Set Duration"}
                                        </div>
                                        <button onclick="setDurition(${data.id}, ${data.maintance_durition})">${isMaintenanceNull(data.maintance_durition)?"Edit Duration":"Set Duration"}</button>
                                    </td>
                                    <td><button onclick="resetMain(${data.id}, ${!isMaintenanceNull(data.maintance_durition)})"}>Reset Maintance</button></td>
                                </tr>
                            `;
                           
                        }else{
                            table_body += `
                                <tr class="request-maintenance">
                                    <td>${data.purchase_request_code}</td>
                                    <td>${data.item_name}</td>
                                    <td>${data.fullname}</td>
                                    <td>${data.quantity}</td>
                                    <td>${moment(data.datetime).format('LL')}</td>
                                    <td>${isMaintenanceNull(data.maintance_durition)?getDuration(data.maintance_durition, data.doingMaintenance):"<div style='color: red;'>Not Set Duration</div>"}</td>
                                    <td>${moment(data.request_maintenance).format('MMM D, YYYY hh:mm a')}</td>
                                    <td>
                                        --
                                    </td>
                                    <td><button onclick="acceptRequest(${data.usercode}, ${data.purchase_request_id})"}>Accepted</button></td>
                                </tr>
                            `;
                        }
                        
                    })
                    $("#tableBody").html(table_body)
                }
            })
        }

        function setDurition(id, duration){
            $("#form_durition").show();
            $("#purchase_id").val(id);
            $("#setDurition").val(duration!==null?duration:"");
        }

        function hideForm(){
            $("#form_durition").hide();
        }

        function resetMain(id, isSetDuration){
            if(!isSetDuration){
                Swal.fire({
                    title: "Are you sure?",
                    text: `Do want to reset`,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '../../logic/updateMaintance.php',
                            type: 'post',
                            data : {
                                id
                            },
                            beforeSend: ()=>{
                                $("#loader_div").css('display', 'block');
                            },
                            success: res=>{
                                $("#loader_div").css('display', 'none');
                                Swal.fire({
                                    position: "center",
                                    icon: "success",
                                    title: "Reset Success",
                                    showConfirmButton: false,
                                    timer: 1000
                                }).then(()=>{
                                    getdata("all")
                                })
                            }
                        })
                    }
                });
            }else{
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "Please Set Duration",
                    showConfirmButton: false,
                    timer: 1000
                })
            }
            
        }

        document.querySelector("#form_durition").addEventListener('submit', e=>{
            e.preventDefault();
            const duration = $("#setDurition").val();
            const purchase_id = $("#purchase_id").val();
            $.ajax({
                url: '../../logic/setDurationMaintan.php',
                type: 'post',
                data : {
                    duration: duration, 
                    purchase_id: purchase_id
                },
                cache: false,
                beforeSend: ()=>{
                    $("#loader_div").css('display', 'block');
                },
                success: res=>{
                    $("#loader_div").css('display', 'none');
                    hideForm();
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Reset Success",
                        showConfirmButton: false,
                        timer: 1000
                    }).then(()=>{
                        getdata("all")
                    })
                }
            })     
        })
        function acceptRequest(usercode, purchase_request_code){
            Swal.fire({
                    title: "Are you sure?",
                    text: `Do Want to Accepted`,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '../../logic/acceptrequest_maintenance.php',
                            type: 'POST',
                            data: {
                                usercode, purchase_request_code
                            },
                            cache: false,
                            beforeSend: ()=>{
                                $("#loader_div").css('display', 'block');
                            },
                            success: res=>{
                                
                                $("#loader_div").css('display', 'none');
                                hideForm();
                                Swal.fire({
                                    position: "center",
                                    icon: "success",
                                    title: "Success",
                                    showConfirmButton: false,
                                    timer: 1000
                                }).then(()=>{
                                    getdata("all")
                                })
                            }
                        })
                    }
                })
            
        }
    </script>
</body>