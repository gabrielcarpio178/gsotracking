<?php
session_start();
// if ($_SESSION['role'] == 'user') {
//     header("Location: admin_dashboard.php");
//     exit();
// }
if (!isset($_SESSION['loginSession'])) {
    header('LOCATION: ../');
    exit();
}
require '../../logic/dbCon.php';
$stmt = $conn->prepare('SELECT DISTINCT equipment, category FROM equipment ORDER BY category ASC, equipment ASC');
$stmt->execute();
$result = $stmt->get_result();
$data = [
    'office' => [],
    'construction' => [],
    'electronics' => [],
    'it' => []
];
while ($row = $result->fetch_assoc()) {
    $category = strtolower($row['category']);
    if (array_key_exists($category, $data)) {
        $data[$category][] = $row['equipment'];
    }
}

$stmt2 = $conn->prepare('SELECT * FROM equipment ORDER BY id DESC');
$stmt2->execute();
$result2 = $stmt2->get_result();
$data22 = [
    'office' => [],
    'construction' => [],
    'electronics' => [],
    'it' => []
];
while ($row2 = $result2->fetch_assoc()) {
    $category2 = strtolower($row2['category']);
    if (array_key_exists($category2, $data22)) {
        $data22[$category2][] = $row2;
    }
}

// Fetch all office, construction, electronics, and IT data without limiting to 6 items
$data2['office'] = $data22['office']; // No slicing here
$data2['construction'] = $data22['construction']; // No slicing here
$data2['electronics'] = $data22['electronics']; // No slicing here
$data2['it'] = $data22['it']; // No slicing here
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CATEGORY</title>
    <link rel="icon" type="image/gif" href="../../styles/images/logo2.png">    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="../../styles/admin_category.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="../../styles/accountability.css?v=1.1">
    <script src="../../scripts/jquery.min.js"></script>  
</head>

<body>
    
    <style>
        .request-content{
            position: absolute;
            background: rgba(0, 0, 0, 0.3);
            width: 100%;
            height: 100vh;
            z-index: 9999;
            left: 0;
            padding: 5% 35%;
            overflow: scroll;
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
    <div class="noti-content" id="noti_content">
        <?php include 'noti_storekeeper_content.php' ?>
    </div>
    <!-- <div class="request-content" id="req_content">
        <?php
        //  include "../client/print_items.php";
         //   include "print_purchase.php"; 
         ?>
    </div> -->
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
                    <i class="fa-solid fa-cubes" id="active"></i>
                    <a href="equipment_list.php" id="active">EQUIPMENT LIST</a>
                </li>
                <li>
                    <i class="fa-solid fa-camera"></i>
                    <a href="storekeep_qr.php">QR CODE SCANNING</a>
                </li>
                <li>
                    <i class="fa-solid fa-qrcode"></i>
                    <a href="print_qr.php">PRINT QR</a>
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
                        <input type="number" placeholder="Item no." class="search-input" id="searchInput" oninput="getsearch(this.value)">
                    </div>
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

        <main class="containermain">
            <div class="table-container">
                <table id="dataTable">
                    <thead>
                        <tr>
                            <th>ITEMS NO.</th>
                            <th>USER ID</th>
                            <th>FULLNAME</th>
                            <th>DEPARTMENT</th>
                            <th>POSITION</th>
                            <th>DATE REQUESTED</th>
                            <th>STATUS</th>
                            <th>View</th>
                            <!-- <th>SPECS</th> -->
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <?php
                        $stmt = $conn->prepare("SELECT u.usercode ,u.fullname, u.department, u.position, p.purchase_request_code, p.datetime, p.status FROM purchase_request AS p JOIN purchase_request_list AS l ON l.purchase_request_code = p.purchase_request_code JOIN users AS u ON l.requester_code = u.usercode ORDER BY p.id DESC;");
                        $stmt->execute();
                        $result = $stmt->get_result();
                        while ($row = $result->fetch_assoc()) {
                            echo '
                                <tr>
                                    <td>'. htmlspecialchars($row['purchase_request_code']). 
                                    '</td>
                                    <td>'. htmlspecialchars($row['usercode']). 
                                    '</td>
                                    <td>'. htmlspecialchars($row['fullname']). 
                                    '</td>
                                    <td>'. htmlspecialchars($row['department']). 
                                    '</td>
                                    <td>'. htmlspecialchars($row['position']). 
                                    '</td>
                                    <td>'. htmlspecialchars($row['status']). 
                                    '</td>
                                    <td>'. date("M-d-Y h:s a", strtotime($row['datetime'])). 
                                    '</td>
                                    <td><button class="btn-viem-items" onclick="viewitems('.$row["purchase_request_code"].')">View Items</button></td>
                                </tr>
                            ';
                        }

                        
                        ?>
                    </tbody>
                </table>
            </div>
        </main>    
    </div>                  
    <script>
        $(document).ready(()=>{
            const urlParams = new URLSearchParams(window.location.search);
            const id = urlParams.get('data_id');
            if(id!==null){
                getsearch(id);
            }
        })
        function getsearch(search){
            $.ajax({
                url: '../../logic/dbequipment_search.php',
                type: 'POST',
                data: {
                    search : search
                },
                cache: false,
                success: res =>{
                    displaysearch(JSON.parse(res));
                }
            })
        }

        function displaysearch(datas){
            let data_content = '';
            datas.forEach(data=>{
                data_content += `
                    <tr>
                        <td>${data.purchase_request_code}</td>
                        <td>${data.usercode}</td>
                        <td>${data.fullname}</td>
                        <td>${data.department}</td>
                        <td>${data.position}</td>
                        <td>${data.status}</td>
                        <td>${data.datetime}</td>
                        <td><button class="btn-viem-items" onclick="viewitems(${data.purchase_request_code})">View Items</button></td>
                    </tr>
                `
            })
            $("#tableBody").html(data_content);
        }

        function viewitems(purchase_id){
            window.location = `qrcoderesult.php?id=${purchase_id}`
            // console.log(purchase_id);
            // document.getElementById("req_content").style.display = "block";

            // $.ajax({
            //     url: '../../logic/dbaccountabilityData.php',
            //     type: 'POST',
            //     cache: false,
            //     data: {
            //         id : purchase_id
            //     },
            //     success: res=>{
            //         displayData(JSON.parse(res))
            //     }
            // });
        }

        function displayData(data){
            var img = (data.status == 'accept')?data.item_no:'default_image';
            $("#btn_print_content").attr("disabled", (data.status != 'accept'))
            $("#btn_print_content").attr("style", `${(data.status != 'accept')?"display: none":"display: block"}`);
            $("#qr_name").text(data.fname);
            $("#qr_status").text(data.status);
            $("#qr_item").text(data.item_no);
            $("#img_qr").attr("src",`../../qrcode_img/${img}.png`);
            let body_table = '';
            let total_price = 0;
            let total_qty = 0;
            for(let i in data.item){
                total_price += data.item[i].price;
                total_qty += data.item[i].quantity;
                body_table +=  `
                    <tr>
                        <td>${data.item[i].item_name}</td>
                        <td>${data.item[i].quantity}</td>
                        <td>${data.item[i].price}</td>
                        <td>${data.item[i].specs}</td>
                    </tr>
                `;
            }
            $("#table_body").html(body_table);
            canvasData(`${data.fname}-${data.item_no}`);
            
        }

        function remove_content(){
            document.getElementById("req_content").style.display = "none"; 
        }

        function canvasData(name){
            var link = document.querySelector("#save_data");
            html2canvas(document.querySelector("#print_canvas")).then(canvas=>{
                link.setAttribute("download",`${name}.png`);
                link.setAttribute("href",canvas.toDataURL("image/png").replace("image/png","image/octet-stream"));
            })
        }

        function printCanvas(){
            var link = document.querySelector("#save_data");
            link.click();
        }

    </script>
</body>

</html>