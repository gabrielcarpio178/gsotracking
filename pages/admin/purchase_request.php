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
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Purchase Request</title>
    <link rel="icon" type="image/gif" href="../../styles/images/logo2.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../styles/accountability.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" /> 
    <!-- Include jQuery and jQuery UI -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.2/html2pdf.bundle.min.js" integrity="sha512-MpDFIChbcXl2QgipQrt1VcPHMldRILetapBl5MPCA9Y8r7qvlwx1/Mc9hNTzY+kS5kX6PdoDq41ws1HiVNLdZA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../../scripts/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="../../styles/sweetalert2.min.css">
    <script src="../../scripts/jquery.min.js"></script>
    <style>
        /* *{
            outline: 1px solid black;
        } */
        main {
            display: flex;
            flex-direction: column;
            gap: 2rem;
            height: 100vh;
            width: 100%;
        }

        .holder {
            display: flex;
            flex-direction: column;
            padding: 3rem;
            gap: 2rem;
            justify-content: center;
            align-items: center;
        }

        .holds {
            display: flex;
            flex-direction: column;
            border: 1px solid #C4C4C4;
            border-radius: 20px;
            width: 100%;
            padding: 3rem;
        }

        .personal_info{
            display: flex;
            flex-direction: column;
            
        }

        .personal-header{
            border-bottom: 2px solid black;
            padding: 10px;
        }

        .system-name{
            padding: 1% 0;
            display: flex;
            flex-direction: column;
            gap: 5px 0;
        }
        .system-name > .user-data{
            display: flex;
            gap: 0 10px;
        }

        .data-request{
            display: flex;
            flex-direction: column;
            gap: 10px 0;
            
        }
        
        .items-info{
            display: flex;
            flex-direction: row;
            /* border: 1px solid black; */
            gap: 0 10px;
        }

        .form{
            display: flex;
            flex-direction: row;
            gap: 0 15px;
        }

        .form .btn-reject{
            background-color: red;
        }

        .form button {
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
            margin-top: 20px;
            width: 400px;
        }
        .request-content{
            position: absolute;
            background: rgba(0, 0, 0, 0.3);
            width: 100%;
            height: 100vh;
            z-index: 9999;
            left: 0;
            padding: 5% 5%;
            overflow: scroll;
            display: none;
        }
        .label-pages{
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            width: 100%;
        }
        .filter-input > input, .filter-input > select{
            padding: 10px;
        }
    </style>
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
    <div class="request-content" id="req_content">
        <?php include "print_request.php"; ?>
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
                    <a href="equipment_transfer.php">EQUIPMENT TRANSFER</a>
                </li>

                <li>
                    <i class="fa-solid fa-chart-simple"></i>
                    <a href="analytics.php">DASHBOARD</a>
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
                    <i class="fa-solid fa-money-check-dollar" id="active"></i>
                    <a href="purchase_request.php" id="active">PURCHASE REQUEST</a>
                </li>
                <li>
                    <i class="fa-solid fa-wrench"></i>
                    <a href="equipment.php">EQUIPMENT</a>
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
                    <div class="search">
                        <i class="fa-solid fa-search"></i>
                        <input type="number" class="search-input" id="filterInput" placeholder="Search by employee ID" oninput="getsearch(this.value)"/>
                        <i class="fa-solid fa-calendar-days" id="toggleDatepicker" style="cursor: pointer;"></i>
                    </div>
                    <div class="notpic">
                        <div class="ahehe">
                            <a href=""><i class="fa-solid fa-bell"></i></a>
                        </div>
                        <div class="profile">
                            <img src="<?php echo $profile = $row['profile']; ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <main>
            <div class="label-pages">
                <h2>Purchase Request View</h2>
                <div class="filter-input">
                    <select name="status_data" id="status_data" onchange="getstatus(this.value)">
                        <option value="">All</option>
                        <option value="accept">Accept</option>
                        <option value="pending">Pending</option>
                        <option value="reject">Reject</option>
                    </select>
                    <input type="date" name="filter_date" id="filter_date" oninput="getdate(this.value)">
                </div>
            </div>
            <form id="submitdata" style="display: none;" action="../../logic/CREATE/approve.php" method="POST">
                <input type="text" id="request_code" name="request_code"  value=""/>
                <input type="text" id="request_data" name="request_data" value="" />
                <input type="text" id="request_data_list" name="request_data_list" value="" />
                <input type="text" id="status" name="status" value="">
            </form>
            <div class="holder" id="holder">
                
            <?php
                // $status = 'pending';
                // $status2 = 'send';

                // // Fetching purchase requests
                // $stmt = $conn->prepare("SELECT * FROM purchase_request ORDER BY id DESC");
                // $stmt->execute();
                // $result = $stmt->get_result();

                // if ($result->num_rows > 0) {
                //     $data32 = [];
                //     while ($row = $result->fetch_assoc()) {
                //         // Determine button based on status
                //         $button = $row['status'] == 'pending'
                //             ? '<button type="button" onclick="confirmation(`accept`, '.$row['purchase_request_code'].')" value="accept">ACCEPT</button><button type="button" onclick="confirmation(`reject`, '.$row['purchase_request_code'].')" value="reject" class="btn-reject">REJECT</button>'
                //             : ($row['status'] == 'reject'
                //                 ? '<button type="button" disabled>REQUEST REJECTED</button>'
                //                 : '<button type="button" disabled>REQUEST ACCEPTED</button><button type="button" onclick="printPDF('.$row['purchase_request_code'].')">PRINT</button>');

                //         // Sanitize output to prevent XSS
                //         $requestCode = htmlspecialchars($row['purchase_request_code']);
                //         $requesterCode = htmlspecialchars($row['requester_code']);
                //         $fullname = htmlspecialchars(quickQuery($conn, $requesterCode, 'fullname'));
                //         $department = htmlspecialchars(quickQuery($conn, $requesterCode, 'department'));
                //         $phoneNumber = htmlspecialchars(quickQuery($conn, $requesterCode, 'phone_number'));
                //         $role = htmlspecialchars(quickQuery($conn, $requesterCode, 'role'));
                //         $datetime = date('Y-m-d', strtotime($row['datetime']));
                //         $timeAgo = timeAgo($row['datetime']);

                //         // Fetch purchase request items
                //         $stmt2 = $conn->prepare("SELECT * FROM purchase_request_list WHERE purchase_request_code = ?");
                //         $stmt2->bind_param("s", $requestCode);
                //         $stmt2->execute();
                //         $result2 = $stmt2->get_result();

                //         $data = [];
                //         if ($result2->num_rows > 0) {
                //             while ($row2 = $result2->fetch_assoc()) {
                //                 $data[] = $row2; // Collect all rows
                //             }
                //         }
                //         $stmt2->close(); // Close second statement

                //         // Output the request details
                //         echo '
                //         <div class="holds">
                //             <div class="personal_info">
                //                 <div class="personal-header">
                //                     <h2 class="client">
                //                         From Client
                //                     </h2>
                //                     </div>
                //                     <div class="system-name">
                //                         <h2 class="personal-name">' . $fullname . '</h2>
                //                         <div class="user-data">
                //                             <div class="time-ago">' . $timeAgo . '</div>
                //                             <div class="department-position">' . $department . '</div>
                //                             <div class="personal-id">ID: ' . $requesterCode . '</div>
                //                             <div class="Date">Date: ' . date('M-d-Y H:i a', strtotime($row['datetime'])) . '</div>
                //                         </div>
                //                     </div>
                //                 </div>
                //             <div class="data-request">
                //                 <div class="data-list">
                //             ';

                //         // Displaying purchase request items
                //         $total_list = 0;
                //         foreach ($data as $index => $data2) {
                //             $total_list += $data2['price']*$data2['quantity'];
                //             echo '
                //                 <div class="items-info">
                //                     <div class="items item">' . $index+1 . '.</div>
                //                     <div class="items item">Item: ' . $data2['item_name'] . '</div>
                //                     <div class="items specs">Specs: ' . $data2['specs'] . '</div>
                //                     <div class="items quantity">Quantity: ' . $data2['quantity'] . '</div>
                //                     <div class="items est-unit">Estemated Unit: ' . $data2['price'] . '.00</div>
                //                     <div class="items est-Cost">Estemated Cost: ' . $data2['price']*$data2['quantity'] . '.00</div>
                //                 </div>
                //             ';
                //         }

                //         // Form for approving/rejecting request
                //         echo '
                //             </div>
                //             <div class="total_cost">
                //                 Total Cost: <span class="total_data">'.$total_list.'.00</span>
                //             </div>
                //             <form action="../../logic/CREATE/approve.php" method="POST" id="form_submit_'.$row['purchase_request_code'].'">
                //                 <input type="hidden" name="request_code" value="' . $requestCode . '"/>
                //                 <input type="hidden" name="request_data" value=\'' . htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8') . '\' />
                //                 <input type="hidden" name="request_data_list" value=\'' . htmlspecialchars(json_encode($data), ENT_QUOTES, 'UTF-8') . '\' />
                //                 <input type="hidden" name="status" value="" id="status">
                //                 ' . $button . '
                //             </form>
                //             </div>
                //         </div>';
                //     }
                // } else {
                //     echo "<p>No pending purchase requests.</p>";
                // }

                // $stmt->close(); // Close first statement
                // ?>


<script>
                    let search_in = '';
                    let date_data_in = '';
                    let status_data_in = ''
                    $(function() {
                        var isDatepickerActive = false;
                        filtercontent(search_in, status_data_in, date_data_in);
                        const req_content = document.querySelector("#req_content");
                        $("#toggleDatepicker").on('click', function() {
                            if (!isDatepickerActive) {
                                $("#filterInput").datepicker({
                                    dateFormat: "yy-mm-dd",
                                    onSelect: function(dateText) {
                                        var requests = document.querySelectorAll('.holds');

                                        requests.forEach(function(request) {
                                            var text = request.textContent.toLowerCase();
                                            if (text.includes(dateText)) {
                                                request.style.display = '';
                                            } else {
                                                request.style.display = 'none';
                                            }
                                        });
                                    }
                                }).datepicker("show");
                                isDatepickerActive = true;
                            } else {
                                $("#filterInput").datepicker("destroy");
                                isDatepickerActive = false;
                            }
                        });

                        // Text input filtering
                        $("#filterInput").on('keyup', function() {
                            if (!isDatepickerActive) {
                                var filterValue = this.value.toLowerCase();
                                var requests = document.querySelectorAll('.holds');

                                requests.forEach(function(request) {
                                    var text = request.textContent.toLowerCase();
                                    if (text.includes(filterValue)) {
                                        request.style.display = '';
                                    } else {
                                        request.style.display = 'none';
                                    }
                                });
                            }
                        });

                    });

                    function confirmation(request_data_list, request_data, purchase_request_code, action, form){
                        //console.log(request_data_list, request_data, purchase_request_code, action, form);
                        $("#status").val(action);
                        $("#request_code").val(purchase_request_code);
                        $("#request_data").val(request_data);
                        $("#request_data_list").val(request_data_list);
                        Swal.fire({
                            title: "Are you sure?",
                            text: `Do want to ${action}`,
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Yes",
                            cancelButtonText: "No",
                        }).then((result) => {
                            // console.log(result);
                            if (result.isConfirmed) {
                                setTimeout(function() {
                                    $("#loader_div").css("display", "block");
                                }, 1000);
                                $("#loader_div").css("display", "none");
                                $(`#submitdata`).submit();
                            }
                        });
                    }

                    function addCommas(number) {
                        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    }

                    function filtercontent(search, status_data, date_data){
                        $.ajax({
                            url: '../../logic/filterdata.php',
                            type: 'POST',
                            data: {
                                search : search,
                                status : status_data,
                                date_data : date_data
                            },
                            cache: false,
                            success: res=>{
                                // console.log(res);
                                var result = JSON.parse(res);
                                
                                let data_html = '';
                                for(let i in result){
                                    var button = result[i].status == 'pending'
                            ? `<button type="button" onclick="confirmation('${result[i].request_data_list}', '${result[i].request_data}', '${result[i].purchase_request_code}', 'accept', '${result[i].purchase_request_code}')" value="accept">ACCEPT</button><button type="button" onclick="confirmation('${result[i].request_data_list}', '${result[i].request_data}', '${result[i].purchase_request_code}', 'reject', '${result[i].purchase_request_code}')" value="reject" class="btn-reject">REJECT</button>`
                            : (result[i].status == 'reject'
                                ? '<button type="button" disabled>REQUEST REJECTED</button>'
                                : `<button type="button" disabled>REQUEST ACCEPTED</button><button type="button" onclick="printPDF('${result[i].purchase_request_code}')">PRINT</button>`);
                                    data_html += `
                                        
                                        <div class="holds">
                                            <div class="personal_info">
                                                <div class="personal-header">
                                                    <h2 class="client">
                                                        From Client
                                                    </h2>
                                                    </div>
                                                    <div class="system-name">
                                                        <h2 class="personal-name">${result[i].fullname}</h2>
                                                        <div class="user-data">
                                                            <div class="time-ago">${result[i].timeago}</div>
                                                            <div class="department-position">${result[i].department}</div>
                                                            <div class="personal-id">ID: ${result[i].usercode}</div>
                                                            <div class="Date">Date: ${result[i].date}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <div class="data-request">
                                                <div class="data-list">
                                                    ${dataHtml(result[i].purchase_list)}
                                                </div>
                                                <div class="total_cost">
                                                    Total Cost: <span class="total_data">3900.00</span>
                                                </div>
                                                <div class="form">
                                                    ${button}
                                                </div>
                                            </div>
                                        </div>
                                    `;
                                }
                                $("#holder").html(data_html);
                                
                            }
                        })
                    }

                    function cancel(){
                        req_content.style.display = 'none';
                    }
                    function printPDF(purchase_request_code){
                        // console.log(purchase_request_code);
                        req_content.style.display = 'block';
                        $.ajax({
                            url: "../../logic/dbpurchase_request.php",
                            type: "POST",
                            cache: false,
                            data: {
                                purchase_code: purchase_request_code,
                            },
                            cache: false,
                            success: res=>{
                                // console.log(res);
                                var data = JSON.parse(res);
                                displaydata(data);
                            }
                        })
                    }
                    function displaydata(res_obj){
                        // console.log(res_obj);
                        let items_des_text = '';
                        let quantity = 0;
                        let cost = 0;
                        let estimated_unit = '';
                        let estimated_cost = '';
                        let total_cost = 0;
                        for(let i in res_obj.item_name){
                            quantity += ((res_obj.item_name)[i].quantity);
                            cost += ((res_obj.item_name)[i].price);
                            items_des_text +=`
                                <p>${(res_obj.item_name)[i].item_name} x${(res_obj.item_name)[i].quantity}</p>
                            `;
                            estimated_unit += `
                                <p>₱ ${(res_obj.item_name)[i].price}.00</p>
                            `
                            total_cost += ((res_obj.item_name)[i].price*(res_obj.item_name)[i].quantity)
                            estimated_cost += `
                                <p>₱ ${(res_obj.item_name)[i].price*(res_obj.item_name)[i].quantity}.00</p>
                            `

                        }
                        var name_ =  `<b>${res_obj.fname}</b>`;
                        var date_ = res_obj.datetime;
                        $("#position_name").html(res_obj.position);
                        $("#data_name").html(name_);
                        $("#date_print").html(date_);
                        $("#total_cost").html(`<span><b>Total: </b></span> ₱${addCommas(total_cost)}.00`);
                        $("#estimated_unit").html(addCommas(estimated_unit));
                        $("#estimated_cost").html(addCommas(estimated_cost));
                        $("#date_").html(date_);
                        $("#item_no").text(res_obj.purchase_request_code);
                        $("#quantity").text(quantity);
                        $("#item_des").html(items_des_text);
                    }
                    function print(){
                        var element = document.getElementById('print_content');
                        var opt = {
                            margin:       1,
                            filename:     'purchase_request.pdf',
                            image:        { type: 'jpeg', quality: 0.98 },
                            html2canvas:  { scale: 2 },
                            jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
                        };
                        html2pdf().from(element).set(opt).save();
                    }

                    //get filter data
                    
                    function getstatus(status_data){
                        status_data_in = status_data
                        filtercontent(search_in, status_data_in, date_data_in);
                    }
                    function getdate(date_data){
                        date_data_in = date_data;
                        filtercontent(search_in, status_data_in, date_data_in);
                    }
                    function getsearch(search){
                        search_in = search;
                        filtercontent(search_in, status_data_in, date_data_in);
                    }
                    
                    function dataHtml(datas){
                        let content = '';
                        let x = 1;
                        datas.forEach(data=>{
                            content+=`
                                <div class="items-info">
                                    <div class="items item">${x++}</div>
                                    <div class="items item">Item: ${data.item_name}</div>
                                    <div class="items specs">Specs: ${data.specs}</div>
                                    <div class="items quantity">Quantity: ${data.quantity}.00</div>
                                    <div class="items est-unit">Estemated Unit: ${addCommas(data.price)}</div>
                                    <div class="items est-Cost">Estemated Cost: ${addCommas(data.quantity*data.price)}.</div>
                                </div>
                            `
                        })
                        return content;
                    }
                </script>



                
            </div>
        </main>
    </div>

    
    
    
</body>

</html>