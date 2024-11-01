<?php
require '../../logic/dbCon.php';
session_start();
$usercode = $_SESSION['usercode'];
$stmt = $conn->prepare("SELECT * FROM users WHERE usercode =?");
$stmt->bind_param("s", $usercode);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$defaultProfile = $row['gender'] == 'male' ? '../../styles/images/boy.jpeg' : '../../styles/images/girl.jpeg';
$profile = $row['profile'] ?? $defaultProfile;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>PURCHASE REQUEST</title>
    <link rel="icon" type="image/gif" href="../../styles/images/logo2.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../styles/accountability.css?v=1.1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="../../scripts/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="../../styles/sweetalert2.min.css">
    <style>
        .noti_bell{
            position: relative;
            cursor: pointer;
        }
        .noti_count{
            position: absolute;
            width: 75%;
            height: 100%;
            right: 0;
            background-color: red;
            border-radius: 50%;
            text-align: center;
            color: white;
            font-weight: 900;
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
            /* overflow: scroll; */
        }
    </style>
    <?php include 'pushNotification.php';?>
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
        <?php include 'loader.php' ?>
    </div>
    <div class="noti-content" id="noti_content">
        <?php include 'noti_content.php' ?>
    </div>
    <header>
        <div class="user">
            <img src="<?php echo $_SESSION['profile'] ?>" alt="">
            <div>
                <h3 style="letter-spacing: 2px;"><?php echo $_SESSION['fullname'] ?></h3>
                <h5 style="letter-spacing: 2px;"><?php echo $_SESSION['position'] ?></h5>
            </div>
        </div>
        <span class="menutext">menu</span>

        <nav class="navbar">
            <ul>
                <li>
                    <i class="fa-solid fa-cubes" id="active"></i>
                    <a href="purchase_request.php" id="active">PURCHASE REQUEST</a>
                </li>
                <li>
                    <i class="fa-solid fa-chalkboard-user"></i>
                    <a href="accountability.php">ACCOUNTABILITY</a>
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
                            <a hre="" class="noti_bell" id="open_noti">
                                <div class="noti_count" id="noti_count"></div>
                                <i class="fa-solid fa-bell"></i>
                            </a>
                        </div>
                        <div class="profile">
                            <img src="<?php echo $_SESSION['profile'] ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        

        <style>
            .main-body-content{
                width: 100%;
                padding: 0 3%;
                display: flex;
                flex-direction: column;
                gap: 10px 0;
                overflow: scroll;
            }
            .headstext{
                display: flex;
                padding: 1% 0;
                height: 80%;
                align-items: center;
                gap: 0 10px;
                
            }
            .headstext > div{
                background-color: black;
                height: 100%;
                width: 2px;
                border: 1px solid black;
            }
            .horizontal{
                background-color: black;
                width: 100%;
                height: 3px;
            }
            .forms-content{
                display: flex;
                flex-direction: row;
                gap: 0 22px;
            }
            .form-submit{
                width: 50%;
            }
            .personal-info{
                width: 50%;
            }
            .inputs-data{
                display: flex;
                flex-direction: column;
                gap: 5px 0;
                margin-top: 2%;
            }
            .inputs-data > input{
                border: 1px solid black;
                height: 6vh;
                border-radius: 5px/5px;
                padding: 0 1%;
            }
            .btn-buttons{
                width: 100%;
                display: flex;
                gap: 0 10px;
            }

            .btn-button{
                margin: 10px 0;
                width: 50%;
                align-self: center;
                background-color: #191919;
                color: #f0f0f0;
                border: none;
                cursor: pointer;
                border-radius: 3px;
                height: 5vh;
                transition: all 0.6s ease-in-out;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 0 10px;
            }
            .btn-button > .list-count{
                width: 10%;
                border-radius: 50%;
                background-color: red;
            }

            button:hover {
                background-color: #f0f0f0;
                color: #191919;
                box-shadow: 73px 71px 15px -69px rgba(0,0,0,0.25) inset;
                -webkit-box-shadow: 73px 71px 15px -69px rgba(0,0,0,0.25) inset;
                -moz-box-shadow: 73px 71px 15px -69px rgba(0,0,0,0.25) inset;
            }

            input[type=text] ,  input[type=number], textarea,  input[type=date]{
                width: 100%;
                padding: 12px 20px;
                margin: 8px 0;
                display: inline-block;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }

            .list-content-request{
                width: 50%;
                height: 70%;
                display: none;
            }
            .request-total{
                text-align: right;
                font-size: 2rem;
                font-weight: 900;
            }
            .list-info{
                overflow: scroll;
                height: 100%;
                overflow-x: hidden;
            }

            .btn-remove{
                background-color: #f44336;
                padding: 1px 3px;
                border: 10px/10px;
            }

        </style>

        <section class="main-body-content">
            <div class="headstext">
                <h1>PURCHASE REQUEST</h1>
                <div></div>
                <h1>Request From</h1>
            </div>
            <div class="horizontal"></div>
            <div class="note">
                <p>Note: Make sure to fill up all necessary information.</p>
            </div>
            <div class="forms-content">
                <div class="personal-info">
                    <div class="inputs-data">
                         <label for="employee_id">Employee ID</label>
                        <input type="text" class="input-data" id="employee_id" readonly value="<?=$usercode ?>">
                    </div>
                    <div class="inputs-data">
                         <label for="employee_name">Employee Name</label>
                        <input type="text" class="input-data" id="employee_name" readonly value="<?=$row['fullname'] ?>">
                    </div>
                    <div class="inputs-data">
                         <label for="department">Department</label>
                        <input type="text" class="input-data" id="department" readonly value="<?=$row['department'] ?>">
                    </div>
                    <div class="inputs-data">
                         <label for="position">Position</label>
                        <input type="text" class="input-data" id="position" readonly value="<?=$row['position'] ?>">
                    </div>
                    <div class="inputs-data">
                         <label for="contact_num">Contact Number</label>
                        <input type="number" class="input-data" id="contact_num" readonly value="<?=$row['phone_number'] ?>">
                    </div>
                </div>
                <form id="add_request_list" class="form-submit">
                    <div class="inputs-data">
                        <label for="request_date">Request Date</label>
                       <input type="date" class="input-data" id="request_date" readonly value="<?=date('Y-m-d') ?>">
                   </div>
                    <div class="inputs-data">
                        <label for="item">Item</label>
                       <input type="text" class="input-data" id="item" required>
                   </div>
                   
                    <div class="inputs-data">
                        <label for="item">Preferred Specs</label>
                        <textarea type="text" name="specs" id="specs"></textarea>
                   </div>
                   
                    <div class="inputs-data">
                        <label for="quantity">Quantity</label>
                       <input type="number" class="input-data" id="quantity" required oninput="getEstimatedCost()">
                   </div>
                    <div class="inputs-data">
                        <label for="estimated">Estimated Per Unit</label>
                       <input type="number" class="input-data" id="estimated" required oninput="getEstimatedCost()">
                   </div>
                    <div class="inputs-data">
                        <label for="estimated_cost">Estimated Total Cost</label>
                       <input type="number" class="input-data" id="estimated_cost" readonly>
                   </div>
                   <div class="btn-buttons">
                        <button type="button" class="btn-button" id="show_table"><span class="label-btn">Show list</span><span class="list-count" id="list_count"></span></button>
                        <button type="submit" class="btn-button">Add List</button>
                   </div>
                </form>
                <div class="list-content-request" id="table_content">
                    <h2>List of request</h2>
                    <div class="list-info">
                        <div class="data-request">
                            <table class="request-table">
                                <thead>
                                    <tr>
                                        <td>Item</td>
                                        <td>Specs</td>
                                        <td>Quentity</td>
                                        <td>Estimated Unit</td>
                                        <td>Estimated Cost</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody class="body-table" id="table_body">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="request-total">Total: <span id="total_request_count"></span></div>
                    <div class="btn-buttons">
                        <button type="button" class="btn-button" id="add_more">Add more</button>
                        <button type="submit" class="btn-button" id="submit_request">Submit Request</button>
                   </div>
                </div>
            </div>
        </section>
        
    </div>
    <script src="../../scripts/jquery.min.js"></script>
    <script>
    const add_request_list = document.querySelector("#add_request_list");
    var item = document.querySelector("#item");
    var quantity = document.querySelector("#quantity");
    var estimated = document.querySelector("#estimated");
    var estimated_cost = document.querySelector("#estimated_cost");
    var specs = document.querySelector("#specs");
    let data_lists = [];

    function getEstimatedCost(){
        let quantity_g = (quantity.value!=0)?quantity.value:0;
        let estimated_g = (estimated.value!=0)?estimated.value:0;
        estimated_cost.value = parseInt(quantity_g)*parseInt(estimated_g)
    }
    
    add_request_list.addEventListener('submit', e=>{
        e.preventDefault();
        var item_ = item.value;
        var quantity_ = quantity.value;
        var estimated_ = estimated.value;
        var specs_ = specs.value;

        var data_list = {
            "item-name":item_,
            "quantity":quantity_,
            "budget":estimated_,
            "specs":specs_
        };
        data_lists.push(data_list);
        inputClear();
        countList();
        putTolists(data_lists);
    })

    function inputClear(){
        item.value = "";
        quantity.value = "";
        estimated.value = "";
        estimated_cost.value = "";
        specs.value = "";
    }

    function putTolists(dataList){
        let content_element = '';
        let total_cost = 0;
        let id = 0;
        data_lists.forEach(data=>{
            total_cost += parseInt(data['quantity'])*parseInt(data['budget']);
            content_element += `
                <tr>
                    <td>${data['item-name']}</td>
                    <td>${data['specs']}</td>
                    <td>${data['quantity']}</td>
                    <td>${data['budget']}</td>
                    <td>${parseInt(data['quantity'])*parseInt(data['budget'])}</td>
                    <td><button class="btn-remove" onclick="removeData(${id})">remove</button></td>
                </tr>
            `;
            id++;
        })
        document.querySelector("#table_body").innerHTML = content_element;
        document.querySelector("#total_request_count").textContent = total_cost;
        
    }

    function countList(){
        document.querySelector("#list_count").textContent = data_lists.length;
        document.querySelector("#total_request_count").textContent = 0;
    }

    document.querySelector("#show_table").addEventListener('click', ()=>{
        document.querySelector("#table_content").style.display = "block";
        add_request_list.style.display = "none";
    })

    document.querySelector("#add_more").addEventListener('click', ()=>{
        document.querySelector("#table_content").style.display = "none";
        add_request_list.style.display = "block";
    })

    function removeData(id){
        console.log(id);
        data_lists.splice(id, 1);
        putTolists(data_lists);
    }

    const noti_content =  document.querySelector("#noti_content");
    const open_noti = document.querySelector("#open_noti");

    open_noti.addEventListener('click',()=>{
        noti_content.style.display = "block";
    })

    document.getElementById("submit_request").addEventListener('click', ()=>{
        sendtoData(data_lists)
    })

    function sendtoData(dataLists){
        if(dataLists.length!=0){
            data_string = JSON.stringify(dataLists);
            $.ajax({
                url: "../../logic/CREATE/myRequest.php",
                type: "POST",
                data: {
                    send_data : data_string
                },
                cache: false,
                beforeSend: ()=>{
                    $("#loader_div").css('display', 'block');
                },
                success: res=>{
                    if(res=='success'){
                        $("#loader_div").css('display', 'none');
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "Purchase sent success.",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        document.querySelector("#total_request_count").textContent = 0;
                        data_lists = [];
                        putTolists(data_lists);
                    }
                }
            })
        }else{
            Swal.fire({
                position: "center",
                icon: "warning",
                title: "Request list is empty",
                showConfirmButton: false,
                timer: 1000
            });
        }
    }

    window.onload = countList;
</script>

</body>

</html>