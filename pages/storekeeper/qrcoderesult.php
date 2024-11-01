<?php
    require '../../logic/dbCon.php';
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }else{
        header("Location: storekeep_qr.php");
    }
?>

<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <title>QR Result</title>
    <link rel="icon" type="image/gif" href="../../styles/images/logo2.png">    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="../../styles/accountability.css?v=1.1">

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
                    <i class="fa-solid fa-cubes"></i>
                    <a href="equipment_list.php">EQUIPMENT LIST</a>
                </li>
                <li>
                    <i class="fa-solid fa-qrcode" id="active"></i>
                    <a href="storekeep_qr.php" id="active">QR CODE SCANNING</a>
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

        <main class="containermain">
            <h1>RESULT</h1>
            <div class="personal_info">
                <div class="qr-fname">Full name: <span id="qr_name"></span></div>
                <div class="qr-item-no">Item No.: <span id="qr_item"></span></div>
                <div class="qr-status">Status.: <span id="qr_status"></span></div>
            </div>
            
            <div class="table-container">
                <table id="dataTable">
                    <thead>
                        <tr>
                            <th>ITEM NAME</th>
                            <th>SPECS</th>
                            <th>QUANTITY</th>
                            <th>PRICE</th>
                            <th>TOTAL PRICE</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        
                    </tbody>
                </table>
                <div class="total_cost">Total Cost: <span id="total_cost"></span></div>
            </div>
        </main>
    </div>  
    <script src="../../scripts/jquery.min.js"></script>
    <script>
        $(document).ready(()=>{
            loadDataResult(<?=$id?>)
        });

        function loadDataResult(code){
            $.ajax({
                url: '../../logic/dbqrcoderesult.php',
                type: 'POST',
                data: {
                    code:code
                },
                cache: false,
                success: res=>{
                    console.log(JSON.parse(res));
                    displayData(JSON.parse(res))
                
                }
            })
        }
        function displayData(datas){
            $("#qr_name").text(datas.user_info.fullname);
            $("#qr_item").text(datas.user_info.purchase_request_code);
            $("#qr_status").text(datas.user_info.status);
            let data_html = '';
            let total_cost = 0;
            datas.items.forEach(data=>{
                total_cost += (data.price)*(data.quantity);
                data_html += `
                    <tr>
                        <td>${data.item_name}</td>
                        <td>${data.specs}</td>
                        <td>${data.quantity}</td>
                        <td>${data.price}.00</td>
                        <td>${(data.price)*(data.quantity)}.00</td>
                    </tr>
                `;
            })
            $("#tableBody").html(data_html);
            $("#total_cost").text(total_cost);
        }
    </script>
    
</body>

</html>