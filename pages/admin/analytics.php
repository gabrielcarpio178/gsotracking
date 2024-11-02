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
    <style>
        .header-label{
            padding: 1% 2%;
            width: 100%;
        }
        .chartData{
            padding: 5% 3%;
            display: grid;
            place-items: center;
        }
        .chartData > canvas{
            width: 80%;
            height: 85%;
        }
    </style>
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
                    <a href="equipment_transfer.php" >EQUIPMENT TRANSFER</a>
                </li>

                <li>
                    <i class="fa-solid fa-chart-simple" id="active"></i>
                    <a href="analytics.php" id="active">ANALYTICS</a>
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

        <div class="header-label">
            <h2>Equipment Records</h2>
            <hr>
        </div>
        <style>
            .datas-display{
                display: flex;
                flex-direction: row;
                gap: 10px 0;
                padding: 10px 20px;
            }
            .icon{
                font-size: 8rem;
            }
            .datas-numbers{
                display: flex;
                flex-direction: column;
                /* border: 1px solid black; */
                width: 30%;
                height: 100vh;
                gap: 25px 0;
            }
            .data-number{
                height: 22%;
                border-radius: 10px/10px;
                display: flex;
                flex-direction: row;
                align-items: center;
                gap: 0 10px;
                padding: 0 20px;
                box-shadow: 1px 1px 6px 1px rgba(0,0,0,0.75);
-webkit-box-shadow: 1px 1px 6px 1px rgba(0,0,0,0.75);
-moz-box-shadow: 1px 1px 6px 1px rgba(0,0,0,0.75);
            }
            .number-label{
                font-size: 1.5rem;
                font-weight: bold;
                width: 100%;
                text-align: center;
                line-height: 25px;
            }
            .number{
                font-size: 2.5rem;
            }
        </style>
        <div class="datas-display">
            <div class="datas-numbers">
                <div class="employee_number data-number">
                    <i class="fa-solid fa-user icon"></i>
                    <div class="number-label">
                        <div class="label">Number Of Employees</div>
                        <div class="number"><?=getnumberemployees($conn) ?></div>
                    </div>
                </div>
                <div class="items_purchase_number data-number">
                    <i class="fa-solid fa-cart-shopping icon"></i>
                    <div class="number-label">
                        <div class="label">Number Of Items Purchase</div>
                        <div class="number"><?=getnumberitems($conn) ?></div>
                    </div>
                </div>
                <div class="total_cost_number data-number">
                    <i class="fa-solid fa-money-check-dollar icon"></i>
                    <div class="number-label">
                        <div class="label">Total Cost</div>
                        <div class="number">₱ <?=number_format(getsum_const($conn), 2, '.', '') ?></div>
                    </div>
                </div>
            </div>
            <div class="chartData">
                <canvas id="myChart"></canvas>
            </div>
        </div>

    </div>

    <script src="../../scripts/jquery.min.js"></script>
    <script>
        $(document).ready(function() {

            $.ajax({
                url: '../../logic/dbanalytics.php',
                type: 'POST',
                data: {
                    role: "admin"
                },
                cache: false,
                success: res=>{
                    var data = JSON.parse(res);
                    displayGraph(data);
                }
            })

            $('#menu').click(function() {
                $(this).toggleClass('fa-times');
                $('header').toggleClass('toggle');
                $(window).on('scroll load', function() {
                    $('#menu').removeClass('fa-times');
                    $('header').removeClass('toggle');
                });
            });
        });

        function displayGraph(datas){
            var month_label = []; 
            var count_label = []; 
            datas.forEach(data=>{
                month_label.push(data.month_label);
                count_label.push(data.count_label);
            })
            graph(month_label, count_label);
        }

        function graph(month, count){
            const ctx = document.getElementById('myChart');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: month,
                    datasets: [{
                    label: 'Total count of purchase request per month',
                    data:  count,
                    borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                    y: {
                        beginAtZero: true
                    }
                    }
                }
            });
        }
    </script>
</body>

</html>