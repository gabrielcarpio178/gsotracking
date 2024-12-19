<?php
session_start();
require '../../logic/dbCon.php';
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
    <script src="../../scripts/jquery.min.js"></script>
    <link rel="stylesheet" href="../../styles/sweetalert2.min.css">
    <title>Account</title>
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
                    <i class="fa-solid fa-chart-simple"></i>
                    <a href="analytics.php">ANALYTICS</a>
                </li>
                <li>
                    <i class="fa-solid fa-file-invoice"></i>
                    <a href="transaction.php">TRANSACTION LOG</a>
                </li>
                <li>
                    <i class="fa-solid fa-user" id="active"></i>
                    <a href="addaccount.php" id="active">ADD ACCOUNT</a>
                </li>
                <li>
                    <i class="fa-solid fa-money-check-dollar"></i>
                    <a href="purchase_request.php">PURCHASE REQUEST</a>
                </li>
                <li>
                    <i class="fa-solid fa-wrench"></i>
                    <a href="equipment.php">MAINTENANCE</a>
                </li>
                <li>
                    <i class="fa-solid fa-history"></i>
                    <a href="history-maintenance.php">HISTORY MAINTENANCE</a>
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
                padding: 1% 3%;
            }
            .table-container{
                height: 78vh;
                overflow-y: scroll;
            }
            .search-content{
                width: 100%;
                display: flex;
                justify-content: right;
            }
            .input-content-btn{
                display: flex;
                flex-direction: row;
                align-items: center;
                gap: 0 10px;
            }
            .input-content-btn > input, .input-content-btn > select{
                outline: none;
                background-color: #ECECEC;
                height: 40px;
                border-radius: 3px;
                box-shadow: 73px 71px 15px -69px rgba(0,0,0,0.25) inset;
            -webkit-box-shadow: 73px 71px 15px -69px rgba(0,0,0,0.25) inset;
            -moz-box-shadow: 73px 71px 15px -69px rgba(0,0,0,0.25) inset;
                border: none;
                margin: 10px 0;
                padding: 10px;
                width: 100%;
            }
            .table-content{
                cursor: pointer;
            }

            .table-content:hover{
                background-color: #ECECEC;
            }
            button{
                width: 100%;
                height: 40px;
                border-radius: 10px/10px;
                cursor: pointer;
                transition: all 0.6s ease-in-out;
                background-color: #191919;
                color: white;
            }
            button:hover {
                background-color: #f0f0f0;
                color: #191919;
                box-shadow: 73px 71px 15px -69px rgba(0,0,0,0.25) inset;
                -webkit-box-shadow: 73px 71px 15px -69px rgba(0,0,0,0.25) inset;
                -moz-box-shadow: 73px 71px 15px -69px rgba(0,0,0,0.25) inset;
            }
            .form-container, .form-container-edit{
                position: absolute;
                background-color: rgba(0, 0, 0, 0.3);
                width: 100%;
                height: 100vh;
                left: 0;
                z-index: 9999;
                top: 0;
                display: flex;
                flex-direction: row;
                align-items: center;
                justify-content: center;
            }
            .form-content{
                background-color: white;
                width: 50%;
                border-radius: 10px/10px;
                padding: 1%;
                position: relative;
            }
            .second-input{
                display: flex;
                flex-direction: row;
            }
            .second-input > .input-content:nth-child(1){
                width: 60%;
            }
            .second-input > .input-content:nth-child(2){
                width: 40%;
                display: flex;
                flex-direction: column;
                margin-left: 20px;
                align-items: start;
                justify-content: center;
                gap: 15px 0;
            }
            .second-input > .input-content:nth-child(2) > .radio-btn{
                display: flex;
                flex-direction: row;
                justify-content: center;
                gap: 0 10px;
            }
            .second-input > .input-content:nth-child(2) > .radio-btn > .r-input-content{
                display: flex;
                flex-direction: row;
                justify-content: center;
                gap: 0 5px;
            }
            .input-content{
                display: flex;
                flex-direction: column;
            }
            .input-content>label{
                align-self: start;
            }
            .close-container{
                font-size: 3rem;
                position: absolute;
                right: 16px;
                top: 0;
                cursor: pointer;
            }
            tr > td{
                text-transform: uppercase;
            }
        </style>
        <div class="main-content">
            <div class="form-info" id="form_container">
                <div class="form-container" id="form_content_data">
                    <div class="form-content">
                        <div class="close-container" onclick="close_form()">&times;</div>
                        <form id="form_submit_adddata" class="submit-form">
                            <div class="input-content-btn input-content">
                                <label for="full_name" class="label-input">Full name</label>
                                <input type="text" class="input-data" id="full_name">
                            </div>
                            <div class="second-input">
                                <div class="input-content-btn input-content birthday-content">
                                    <label for="birthday" class="label-input">Birthday</label>
                                    <input type="date" class="input-data" id="birthday">
                                </div>
                                <div class="input-content-btn input-content">
                                    <div class="label-input">Sex</div>
                                    <div class="radio-btn">
                                        <div class="r-input-content">
                                            <label for="male" class="label-input">Male</label>
                                            <input type="radio" value="male" name="sex" id="male">
                                        </div>
                                        <div class="r-input-content">
                                            <label for="female" class="label-input">Female</label>
                                            <input type="radio" value="female" name="sex" id="female">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="input-content-btn input-content">
                                <label for="email" class="label-input">Email</label>
                                <input type="email" class="input-data" id="email">
                            </div>
                            <div class="input-content-btn input-content">
                                <label for="pnumber" class="label-input">Phone number <span class="message" id="pmessage_add"></span></label>
                                <input type="number" class="input-data" id="pnumber">
                            </div>
                            <div class="input-content-btn input-content">
                                <label for="employee_id" class="label-input">Employee ID <span class="message" id="emessage_add"></span></label>
                                <input type="number" class="input-data" id="employee_id">
                            </div>
                            <div class="input-content-btn input-content">
                                <label for="department" class="label-input">Department</label>
                                <select class="input-data" id="department">
                                    
                                </select>
                            </div>
                            <div class="input-content-btn input-content">
                                <label for="position" class="label-input">Position</label>
                                <input type="text" class="input-data" id="position">
                            </div>
                            <div class="btn-content">
                                <button type="submit" class="btn-submit">Create</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="form-container-edit" id="form_content_data_edit">
                    <div class="form-content">
                        <div class="close-container" onclick="close_form_edit()">&times;</div>
                        <form id="form_submit_edit" class="submit-form">
                            <input type="hidden" id="hidden_id">
                            <div class="input-content-btn input-content">
                                <label for="full_name" class="label-input">Full name</label>
                                <input type="text" class="input-data" id="full_name_edit">
                            </div>
                            <div class="second-input">
                                <div class="input-content-btn input-content birthday-content">
                                    <label for="birthday" class="label-input">Birthday</label>
                                    <input type="date" class="input-data" id="birthday_edit">
                                </div>
                                <div class="input-content-btn input-content">
                                    <div class="label-input">Sex</div>
                                    <div class="radio-btn">
                                        <div class="r-input-content">
                                            <label for="male" class="label-input">Male</label>
                                            <input type="radio" value="male" name="sex_edit" id="male">
                                        </div>
                                        <div class="r-input-content">
                                            <label for="female" class="label-input">Female</label>
                                            <input type="radio" value="female" name="sex_edit" id="female">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="input-content-btn input-content">
                                <label for="email" class="label-input">Email</label>
                                <input type="email" class="input-data" id="email_edit">
                            </div>
                            <div class="input-content-btn input-content">
                                <label for="pnumber" class="label-input">Phone number <span class="message" id="pmessage"></span></label>
                                <input type="number" class="input-data" id="pnumber_edit">
                            </div>
                            <div class="input-content-btn input-content">
                                <label for="employee_id" class="label-input">Employee ID <span class="message" id="emessage"></span></label>
                                <input type="number" class="input-data" id="employee_id_edit">
                            </div>
                            <div class="input-content-btn input-content">
                                <label for="department" class="label-input">Department</label>
                                <select class="input-data" id="department_edit">
                                    
                                </select>
                            </div>
                            <div class="input-content-btn input-content">
                                <label for="position" class="label-input">Position</label>
                                <input type="text" class="input-data" id="position_edit">
                            </div>
                            <div class="btn-content">
                                <button type="submit" class="btn-submit">Save</button>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
            <div class="search-content">
                <div class="input-content-btn">
                    <input type="text" class="input-data" placeholder="Search employee ID" oninput="getUserData(this.value)">
                    <button class="btn-add-employee" id="add_employee_form">Add Employee</button>
                </div>
            </div>
            <div class="table-container">
                <table id="dataTable">
                    <thead>
                        <tr>
                            <th>Employee ID</th>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Department</th>
                            <th>Email</th>
                            <th>Phone number</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <script>
        var departments = ['BAC', 'ASSESSOR', 'BUDGET', 'CDRRMC', 'LEGAL', 'CMO SPORTS', 'CTO LICENSE', 'VET', 'HRMO', 'LIBRARY', 'LCR', 'NUTRITION', 'CEMO', 'CMO CIO', 'CMO CIPC', 'CMO TRAFFIC', 'CTO CASH', 'CEO', 'CSSDO', 'CTO ADMIN', 'UPAHO', 'POPCOM', 'SP', 'OSCA', 'OCA', 'BRGY', 'CPDO', 'GSO', 'AGRI', 'TLDC', 'CMO ADMIN', 'CMO TOURISM', 'BCC', 'BCH', 'BACIWAD', 'FISCAL', 'RTC', 'COA', 'BJMP', 'MTC', 'DILG', 'BFP', 'BIR', 'PNP', 'CMO', 'DEPED'];
        $(document).ready(()=>{
            getUserData('all');
            $("#form_content_data").hide();
            $("#form_content_data_edit").hide();
            $("#add_employee_form").on('click',()=>{
                $("#form_content_data").show();
            })

            let options = '<option value="" selected disabled></option>';
            departments.forEach(department=>{
                options += `<option value="${department}">${department}</option>`
            })
        
            $("#department").html(options);
        
            $("#form_submit_adddata").on('submit',e=>{
                e.preventDefault();
                var full_name = $("#full_name").val();
                var birthday = $("#birthday").val();
                var sex = $('input[name="sex"]:checked').val();
                var email = $("#email").val();
                var pnumber = $("#pnumber").val();
                var employee_id = $("#employee_id").val();
                var department = $("#department").val();
                var position = $("#position").val();
                
                if(pnumber.length!==11){
                    $("#pmessage_add").text("-phone number digit must be 11");
                }else if(employee_id.length!==9){
                    $("#emessage_add").text("-employee ID digit must be 9")
                }

                else{
               
                    $.ajax({
                        url: '../../logic/dbaddaccount.php',
                        type: 'post',
                        data : {
                            full_name,
                            birthday,
                            sex,
                            email,
                            pnumber,
                            department,
                            employee_id,
                            position
                        },
                        cache: false,
                        beforeSend: ()=>{
                            $("#loader_div").css('display', 'block');
                            close_form();
                        },
                        success: res=>{
                        
                            $("#loader_div").css('display', 'none');
                            console.log(res);
                            if(res!=='email or employee ID is already used'){
                                Swal.fire({
                                    position: "center",
                                    icon: "success",
                                    title: "Message has been sent",
                                    showConfirmButton: false,
                                    timer: 1000
                                }).then(()=>{
                                    window.location.reload();
                                });
                            }else{
                                Swal.fire({
                                    position: "center",
                                    icon: "error",
                                    title: "Email or employee ID is already used",
                                    showConfirmButton: false,
                                    timer: 1000
                                });
                            }
                            
                        }
                    })
                }

            })
            $("#form_content_data_edit").on('submit',e=>{
                e.preventDefault();
                var id = $("#hidden_id").val();
                var full_name = $("#full_name_edit").val();
                var birthday = $("#birthday_edit").val();
                var sex = $('input[name="sex_edit"]:checked').val();
                var email = $("#email_edit").val();
                var pnumber = $("#pnumber_edit").val();
                var employee_id = $("#employee_id_edit").val();
                var department = $("#department_edit").val();
                var position = $("#position_edit").val();

                if(pnumber.length!==11){
                    $("#pmessage_edit").text("-phone number digit must be 11");
                }else if(employee_id.length!==9){
                    $("#emessage_edit").text("-employee ID digit must be 9")
                }

                else{
                    $.ajax({
                        url: '../../logic/dbeditaccount.php',
                        type: 'post',
                        data : {
                            id,
                            full_name,
                            birthday,
                            sex,
                            email,
                            pnumber,
                            department,
                            employee_id,
                            position
                        },
                        cache: false,
                        beforeSend: ()=>{
                            $("#loader_div").css('display', 'block');
                            close_form_edit()
                        },
                        success: res=>{
                            $("#loader_div").css('display', 'none');
                            if(res=='success'){
                                Swal.fire({
                                    position: "center",
                                    icon: "success",
                                    title: "Update Success",
                                    showConfirmButton: false,
                                    timer: 1000
                                }).then(()=>{
                                    window.location.reload();
                                });
                            }else{
                                Swal.fire({
                                    position: "center",
                                    icon: "error",
                                    title: "Email, Phone Number and Employee ID is already use",
                                    showConfirmButton: false,
                                    timer: 1000
                                });
                            }
                            
                        }
                    })

                }

            })

        })

        function getUserData(search){
            if(search===''){
                search="all";
            }
            $.ajax({
                url: '../../logic/dbgetUserData.php',
                type: 'GET',
                data:{
                    search
                },
                cache: false,
                success: res=>{
                    var result = JSON.parse(res);
                    let table_body = '';
                    for(let i in result){
                        var {birthdate, department, email, fullname, gender, password, phone_number, position, profile, role, status, usercode} = result[i];
                        table_body += `
                        <tr class="table-content" onclick='edit_form(${JSON.stringify(result[i])})'>
                            <td>${usercode}</td>
                            <td>${fullname}</td>
                            <td>${position}</td>
                            <td>${department}</td>
                            <td>${email}</td>
                            <td>${phone_number}</td>
                        </tr>
                        `;
                    }
                    $("#tableBody").html(table_body);
                }
            })            
        }

        function close_form(){
            $("#form_content_data").hide();
            $("#full_name").val();
            $("#birthday").val()
            $('input[name="sex"]').attr('checked','');
            $("#email").val();
            $("#pnumber").val();
            $("#employee_id").val();
            $("#department").val();
            $("#position").val();
        }

        function close_form_edit(){
            $("#form_content_data_edit").hide();
        }

        function edit_form(datas){
            $("#form_content_data_edit").show();
            $("#full_name_edit").val(datas.fullname);
            $("#birthday_edit").val(datas.birthdate)
            var radios_btn = document.querySelectorAll('input[name="sex_edit"]');
            radios_btn.forEach(element=>{
                var data_value = $(element).val()
                if(data_value==datas.gender) $(element).attr('checked', '');
            })
            $("#email_edit").val(datas.email);
            $("#pnumber_edit").val(datas.phone_number);
            $("#employee_id_edit").val(datas.usercode);
            $("#position_edit").val(datas.position);
            let options = '<option value="" selected disabled></option>';
            departments.forEach(department=>{
                options += `<option value="${department}" ${datas.department===department?"selected":""}>${department}</option>`
            })
            $("#hidden_id").val(datas.id)
            $("#department_edit").html(options);
        }

        
    </script>
</body>
</html>
