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
    <script src="../../scripts/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- <script src="https://unpkg.com/html5-qrcode"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.2/html2pdf.bundle.min.js" integrity="sha512-MpDFIChbcXl2QgipQrt1VcPHMldRILetapBl5MPCA9Y8r7qvlwx1/Mc9hNTzY+kS5kX6PdoDq41ws1HiVNLdZA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    

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

        .fraction-label{
            width: 100%;
            text-align: end;
            font-size: 1.5rem;
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
                    <i class="fa-solid fa-camera"></i>
                    <a href="storekeep_qr.php">QR CODE SCANNING</a>
                </li>
                <li>
                    <i class="fa-solid fa-qrcode" id="active"></i>
                    <a href="print_qr.php" id="active">PRINT QR</a>
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
            .main-content{
                padding: 1rem 2rem; 
                display: flex;
                flex-direction: column;
            }
            .qr-content{
                width: 100%;
                height: 9vh;
            }
            .qr-content > .qrs{
                position: relative;
            }
            .qr-content > .qrs > button{
                position: absolute;
                right: 0;
               
            }
            button{
                width: 15%;
                padding: 5px 0;
                background-color: #4ECB71;
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 10px;
                cursor: pointer;
                align-items: center;
                text-align: center;
                justify-content: center;
                display: flex;
            }
            button > .qr_count{
                margin-left: 10px;
                color: red;
                font-weight: bold;
            }
            .selectall{
                display: flex;
                flex-direction: column;
                gap: 10px 0;
            }
            .selectall > input{
                outline: none;
                background-color: #ECECEC;
                height: 38px;
                border-radius: 3px;
                box-shadow: 73px 71px 15px -69px rgba(0,0,0,0.25) inset;
            -webkit-box-shadow: 73px 71px 15px -69px rgba(0,0,0,0.25) inset;
            -moz-box-shadow: 73px 71px 15px -69px rgba(0,0,0,0.25) inset;
                border: none;
                margin: 10px 0;
                padding: 10px;
                width: 20%;
            }
            .qrs_list{
                overflow-y: scroll;
                height: 50vh;
                display: grid;
                grid-template-columns: 1fr 1fr 1fr 1fr;
                gap: 10px;
                padding: 10px;
            }
            .qr-data-content{
                border: 1px solid black;
                border-radius: 15px/15px;
                display: flex;
                flex-direction: column;
                align-items: center;
                padding: 1rem;
            }
            .data-label{
                width: 100%;
                padding: 0 10px;    
            }
            .qr-data-content > .qr_img{
                width: 100%;
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            .qr_img > img{
                max-width: 100%;
            }
            .qr-contents{
                cursor: pointer;
            }
            input[type='checkbox']{
                display: none;
            }
            input[type='checkbox']:checked+div{
                box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px, rgb(51, 51, 51) 0px 0px 0px 3px;
            }
            .item_name{
                font-weight: bold;
                font-size: 1.5rem;
                text-transform: uppercase;
            }
            .view-selected_qrs{
                position: fixed;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 99999;
                left: 0;
                width: 100%;
                height: 100vh;
            }
            .text-label-content{
                font-size: 2.5rem;
            }
            .view_prints{
                height: 90vh;
                margin: 25px;
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 20px 0;
                background-color: white;
                padding: 10px;
                border-radius: 10px/10px;
                overflow-y: scroll;
            }
            .qrs_view{
                display: grid;
                grid-template-columns: 1fr 1fr 1fr 1fr;
                gap: 10px;
            }
            .qrs_view > section{
                border: 1px solid black;
                padding: 20px;
                border-radius: 10px/10px;
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            .qrs_view > section > .qr-data_content-content > .item_name {
                text-align: center;
            }

            .data_content-label{
                width: 100%;
            }

            .qrs_view > section > .qr-data_content-content > .qr_img{
                display: flex;
                flex-direction: column;
                align-items: center;
                width: 100%;
            }
            .close_icon{
                align-self: end;
                font-size: 2.5rem;
                cursor: pointer;
            }
        </style>

        <div class="view-selected_qrs" id="qrs_print" style="display: none;">
            <div class="view_prints">
                <div class="close_icon" onclick="close_print()">&#x2716;</div>
                <div class="qrs_view" id="qr_lists_view">
                
                </div>
                <button onclick="print()">Print</button>
            </div>
        </div>  
        
        <div class="main-content">
            <div class="qr-content">
                <div class="qrs">
                    <button onclick="viewselected()">Equipments <span class="qr_count" id="selected_count">0</span></button>
                </div>
            </div>
            <div class="selectall">
                <button onclick="selectAll();">Select All</button>
                <input oninput="getResult(this.value)" type="number" placeholder="Equipment Code" class="search_input">
            </div>
            <div class="text-label-content">
                SELECT QR TO PRINT
            </div>
            <div class="qrs_list" id="qr_lists">
                
            </div>
        </div>   
          
    </div>
     
    <script>
            $(document).ready(()=>{
                getResult("all");
            })
            let ids = [];
            let selected_data = [];
            function getResult(search){
                if(search === ''){
                    search = 'all';
                }
                $.ajax({
                    url: '../../logic/getQr.php',
                    type: 'post',
                    data : {
                        search
                    },
                    cache: false,
                    success: res=>{
                        // console.log(res);
                        var datas = JSON.parse(res);
                        if(datas.length!==0){
                           displayQr(datas) 
                        }else{
                            $("#qr_lists").html("<div>Not Found</div>");
                        }
                        
                    }
                })
            }

            function displayQr(datas){
                let qr_lists = ''
                datas.forEach(data=>{
                    qr_lists += `
                        <section class="qr-contents" onclick=selectedCheck(this) id='tracking_${data.id}'>
                            <input type="checkbox" value='${JSON.stringify(data)}'>
                            <div class="qr-data-content">
                                <div class="qr-title">Equipment Tracking Information</div>
                                <div class="item_name">${data.item_name}</div>
                                <div class="qr_img">
                                    <img src="../../qrcode_img/${data.equipmentTracking_img}"
                                </div>
                                <div class="data-label">
                                    <div class="fullname"><span>Fullname: </span>${data.fullname}</div>
                                    <div class="code"><span>Equipment Code: </span>${data.purchase_request_code}</div>
                                    <div class="quantity"><span>Quantity: </span>${data.quantity}</div>
                                    <div class="spec"><span>Specs: </span>${(data.specs)}</div>
                                    <div class="purchase_date"><span>Purchase Date: </span>${data.datetime}</div>
                                </div> 
                            </div>
                        </section>
                    `
                })
                $("#qr_lists").html(qr_lists);
                selectData(ids);
            }

            function removeItem(array, itemToRemove) {
                const index = array.indexOf(itemToRemove);
                if (index !== -1) {
                    array.splice(index, 1);
                }
                return array;
            }

            function selectedCheck(element){
                var id = $(element).attr('id');
                var dataCons = JSON.parse($(element.children).val());
                var obj_data = JSON.stringify(dataCons);
                // console.log(obj_data);
                var isCheck = $(element.children[0]).prop('checked');
                if(isCheck){
                    ids = removeItem(ids, id);
                    selected_data = removeItem(selected_data, obj_data)
                    $(element.children[0]).attr('checked',false);
                }else{
                    $(element.children[0]).attr('checked',true);
                    selected_data.push(obj_data)
                    ids.push(id);
                }
                $("#selected_count").text(ids.length)
            }

            function selectData(ids){
                ids.forEach(id=>{
                    $($(`#${id}`)[0].children[0]).attr('checked', true);
                })
                
            }

            function selectAll(){
                $(".qr-contents").each((index ,element) =>{
                    element.click();
                })
            }

            function viewselected(){
                // var data_print = JSON.parse();
                let data_html = ''
                selected_data.forEach(data=>{
                    var data_content = JSON.parse(data);
                    for(let i = 1; i<=data_content.quantity; i++){
                        data_html += `
                            <section class="qr-contents" onclick=selectedCheck(this) id=${data_content.id}>
                                <div class="fraction-label">${i+"/"+data_content.quantity}</div>
                                <div class="qr-data_content-content">
                                    <div class="qr-title" style="text-align: center">Equipment Tracking Information</div>
                                    <div class="item_name">${data_content.item_name}</div>
                                    <div class="qr_img">
                                        <img src="../../qrcode_img/${data_content.equipmentTracking_img}"
                                    </div>
                                    <div class="data_content-label">
                                        <div class="fullname"><span>Fullname: </span>${data_content.fullname}</div>
                                        <div class="code"><span>Equipment Code: </span>${data_content.purchase_request_code}</div>
                                        <div class="quantity"><span>Quantity: </span>${data_content.quantity}</div>
                                        <div class="spec"><span>Specs: </span>${(data_content.specs)}</div>
                                        <div class="purchase_date"><span>Purchase Date: </span>${data_content.datetime}</div>
                                    </div> 
                                </div>
                            </section>
                        `
                    }
                    
                    
                })
                $("#qr_lists_view").html(data_html);
                $("#qrs_print").css('display', 'block')
            }

            function close_print(){
                $("#qrs_print").css('display', 'none')
            }

            function print(){
                var element = document.getElementById('qr_lists_view');
                var opt = {
                    margin:       1,
                    filename:     'qrs_list.pdf',
                    image:        { type: 'jpeg', quality: 0.98 },
                    html2canvas:  { scale: 2 },
                    jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
                };
                html2pdf().from(element).set(opt).save();
            }

        </script>    
</body>
</html>