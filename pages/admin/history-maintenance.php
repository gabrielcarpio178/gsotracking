<?php
session_start();
require '../../logic/dbCon.php';
function getnumberemployees($conn){
    $stmt = $conn->prepare("SELECT COUNT(*) AS employee_count FROM `users` WHERE role!='admin';");
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['employee_count'];
}
function getnumberitems($conn){
    $stmt = $conn->prepare("SELECT COUNT(*) AS number_items FROM `purchase_request` AS pr JOIN `purchase_request_list` AS pl ON pr.purchase_request_code = pl.purchase_request_code WHERE pr.status = 'accept';");
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['number_items'];
}

function getsum_const($conn){
    $stmt = $conn->prepare("SELECT SUM(pl.price) AS sum_cost FROM `purchase_request` AS pr JOIN `purchase_request_list` AS pl ON pr.purchase_request_code = pl.purchase_request_code WHERE pr.status = 'accept';");
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['sum_cost'];
}
if($_SESSION['role']!=='admin'){
    header("Location: ../../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>ANALYTICS</title>
    <link rel="icon" type="image/gif" href="../../styles/images/logo2.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link rel="stylesheet" href="../../styles/admin_analytics.css">
    <link rel="stylesheet" href="../../styles/accountability.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.5/dist/chart.umd.min.js"></script>
    <script src="../../scripts/jquery.min.js"></script>
    <style>
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
</head>

<body>

    <div class="noti-content" id="noti_content">
        <?php include 'noti_admin_content.php' ?>
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
                    <i class="fa-solid fa-chart-simple" ></i>
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
                    <i class="fa-solid fa-wrench"></i>
                    <a href="equipment.php">Maintenance</a>
                </li>
                <li>
                    <i class="fa-solid fa-history" id="active"></i>
                    <a href="history-maintenance.php" id="active">HISTORY MAINTENANCE</a>
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
                <h2>History Maintenance</h2>
                <hr>
            </div>
            <div class="filter-btn">
                <input type="number" id="search_id" placeholder="Search by ID" oninput="searchId(this.value)">
                <input type="date" id="search_date" oninput="searchDate(this.value)">
            </div>
            <div class="table-content">
                <table id="dataTable">
                    <thead>
                        <tr>
                            <th>Equipment ID</th>
                            <th>Employee</th>
                            <th>equipment name</th>
                            <th>Quantity</th>
                            <th>PURCHASE DATE</th>
                            <th>Maintenance Date</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">

                    </tbody>    
                </table>
            </div>
            
            
        </div>
    </div>

    
    <script>
        let search_id = 'all';
        let search_date = 'all'
        $(document).ready(function() {
            getContentMaintenanceHistory('all','all');
        })

        function searchId(id){
            search_id = id;
            getContentMaintenanceHistory(search_date, search_id);
        }
        function searchDate(dateTime){
            search_date = dateTime;
            getContentMaintenanceHistory(search_date, search_id);
        }

        function getContentMaintenanceHistory(dateSearch, purchase_request_code){
            $.ajax({
                url: '../../logic/getContentMaintenanceHistory.php',
                type: 'POST',
                data: {
                    dateSearch, purchase_request_code
                },
                cache: false,
                success: res=>{
                    var datas = JSON.parse(res);
                    let table_body = '';
                    datas.forEach(data=>{
                        table_body += `
                        <tr>
                            <td>${data.purchase_request_code}</td>
                            <td>${data.fullname}</td>
                            <td>${data.item_name}</td>
                            <td>${data.quantity}</td>
                            <td>${moment(data.datetime).format('MMMM DD YYYY')}</td>
                            <td>${moment(data.maintenance_datetime).format('MMMM DD YYYY hh:mm a')}</td>
                        </tr>
                        `
                    })
                    $("#tableBody").html(table_body);
                }
            })
        }
    </script>
</body>

</html>