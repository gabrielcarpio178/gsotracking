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
    <title>View Items</title>
    <link rel="icon" type="image/gif" href="../../styles/images/logo2.png"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="../../styles/accountability.css?v=1.1">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.2/html2pdf.bundle.min.js" integrity="sha512-MpDFIChbcXl2QgipQrt1VcPHMldRILetapBl5MPCA9Y8r7qvlwx1/Mc9hNTzY+kS5kX6PdoDq41ws1HiVNLdZA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
<style>
    .btn_print{
        left: 50%;
        position: absolute;
        top: 60%;
        width: 100%;
    }
    .btn_print > button{
        width: 20%;
    }
    .container{
        border: none;
    }
 
    </style>
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
                    <i class="fa-solid fa-qrcode"></i>
                    <a href="storekeep_qr.php">QR CODE SCANNING</a>
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
    <div class="container"  id="print_content">
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
                        <div class="profile">
                            <img src="../../styles/images/logo1.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

        <main class="containermain" style="border: none; background-color: white;">
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
    <div class="btn_print"><button class="btn-viem-items" onclick="print()">Print</button></div>
    <script src="../../scripts/jquery.min.js"></script>
    <script>
        $(document).ready(()=>{
            loadDataResult(<?=$id?>)
        });

        function print(){
            var element = document.getElementById('print_content');
            var opt = {
                margin:       0,
                filename:     'gso-tracking-items.pdf',
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2 },
                jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
            };
            html2pdf().from(element).set(opt).save();
        }

        function loadDataResult(code){
            $.ajax({
                url: '../../logic/dbqrcoderesult.php',
                type: 'POST',
                data: {
                    code:code
                },
                cache: false,
                success: res=>{
                    
                    displayData(JSON.parse(res))
                }
            })
        }
        function displayData(datas){
            $("#qr_name").text(datas.user_info.fullname);
            $("#qr_item").text(datas.user_info.purchase_request_code);
            $("#qr_status").text(datas.user_info.status);
            var isHide = datas.user_info.status == "accept"?'block':'none';
            $(".btn_print").css('display', isHide);
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
        document.getElementById("print").addEventListener('click', ()=>{
            alert('click')
        })
    </script>
    
</body>

</html>