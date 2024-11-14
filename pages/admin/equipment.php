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
                    <i class="fa-solid fa-user"></i>
                    <a href="addaccount.php">ADD ACCOUNT</a>
                </li>
                <li>
                    <i class="fa-solid fa-money-check-dollar"></i>
                    <a href="purchase_request.php">PURCHASE REQUEST</a>
                </li>
                <li>
                    <i class="fa-solid fa-money-check-dollar"></i>
                    <a href="equipment.php"  id="active">EQUIPMENT</a>
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
                            <th>Maintenance</th>
                            <th>Quantity</th>
                            <th>PURCHASE DATE</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">

                    </tbody>    
                </table>
            </div>
            
            
        </div>
    </div>

    <script src="../../scripts/jquery.min.js"></script>
    <script>
        $(document).ready(()=>{
            getdata("all")
        })

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
                        table_body += `
                            <tr>
                                <td>${data.purchase_request_code}</td>
                                <td>${data.item_name}</td>
                                <td>${data.fullname}</td>
                                <td>${data.maintance}</td>
                                <td>${data.quantity}</td>
                                <td>${data.datetime}</td>
                                <td><button onclick="resetMain(${data.id})">Reset Maintance</button></td>
                            </tr>
                        `;
                    })
                    $("#tableBody").html(table_body)
                }
            })
        }

        function resetMain(id){

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
        }
    </script>
</body>