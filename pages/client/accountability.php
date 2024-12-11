<?php
require '../../logic/dbCon.php';
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
    <title>ACCOUNTABILITY</title>
    <link rel="icon" type="image/gif" href="../../styles/images/logo2.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" /> -->
    <link rel="stylesheet" href="../../styles/accountability.css?v=1.1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../../scripts/moment-with-locales.js"></script>
    <?php include 'pushNotification.php'; ?>
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
</head>

<body>
    <div class="request-content" id="req_content">
        <?php include "print_items.php"; ?>
    </div>
    <div class="noti-content" id="noti_content">
        <?php include 'noti_content.php' ?>
    </div>
    <header>

        <div class="user">
            <img src="<?php echo $_SESSION['profile'] ?>" alt="">
            <div>
                <h3 style="letter-spacing: 2px;"><?php echo $_SESSION['fullname'] ?></h3>
                <h5 style="letter-spacing: 2px;"><?php echo $_SESSION['position']  ?></h5>
            </div>
        </div>
        <span class="menutext">menu</span>

        <nav class="navbar">
            <ul>
                <li>
                    <i class="fa-solid fa-cubes"></i>
                    <a href="purchase_request.php">PURCHASE REQUEST</a>
                </li>
                <li>
                    <i class="fa-solid fa-chalkboard-user" id="active"></i>
                    <a href="accountability.php" id="active">ACCOUNTABILITY</a>
                </li>
                <li>
                    <i class="fa-solid fa-wrench"></i>
                    <a href="request_maintenance.php">MAINTENANCE</a>
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
                        <input type="search" id="searchInput" placeholder="Search" class="search-input">
                    </div>
                    <div class="notpic">
                        <div class="ahehe">
                            <a class="noti_bell" id="open_noti">
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


        <main>

            <div class="table-container">
                <table id="dataTable">
                    <thead>
                        <tr>
                            <th>EQUIPMENT ID</th>
                            <th>EQUIPMENT NAME</th>
                            <th>QUANTITY</th>
                            <th>PRICE</th>
                            <th>request status</th>
                            <th>DATE REQUESTED</th>
                            <th>View</th>
                            <!-- <th>SPECS</th> -->
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <?php
                        // $stmt = $conn->prepare("SELECT l.*, p.purchase_request_code FROM purchase_request_list AS l JOIN users AS u ON l.requester_code = u.usercode JOIN purchase_request AS p ON l.purchase_request_code = p.purchase_request_code WHERE u.usercode = ? ORDER BY l.id DESC");
                        // $stmt->bind_param('s', $usercode);
                        // $stmt->execute();
                        // $result = $stmt->get_result();
                        // $group_data = [];
                        // while ($row = $result->fetch_assoc()) {
                        //     $group_data[$row['purchase_request_code']][] = $row;
                        // }
                        // // print_r($group_data);
                        
                        // foreach($group_data as $data){
                        //     print_r($data['purchase_request_code']);
                        // }
                            
                            // $data = [];
                            // $stmt2 = $conn->prepare("SELECT * FROM purchase_request_list WHERE purchase_request_code = ?");
                            // $stmt2->bind_param('s', $row['purchase_request_code']);
                            // $stmt2->execute();
                            // $result2 = $stmt2->get_result();
                            // while ($row2 = $result2->fetch_assoc()) {
                            //     $data[] = $row2;
                            // }
                            // $stmt2->close(); // Move the close statement here

                            // echo "<tr>";
                            // echo "<td>" . htmlspecialchars($row['purchase_request_code']) . "</td>";

                            // // Loop through $data for item details
                            // echo '<td class="quantities">';
                            // foreach ($data as $index => $data2) {
                            //     echo htmlspecialchars($data2['item_name']) . "<br/>";
                            // }

                            // echo '<td class="quantities">';
                            // foreach ($data as $index => $data2) {
                            //     echo htmlspecialchars($data2['quantity']) . "<br/>";
                            // }
                            // echo '</td>';

                            // echo '<td class="prices">';
                            // foreach ($data as $index => $data2) {
                            //     echo htmlspecialchars($data2['price']) . "<br/>";
                            // }
                            // echo '</td>';

                            // echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                            // echo "<td>" . htmlspecialchars(date('Y-m-d H:i a', strtotime($row['datetime']))) . "</td>";
                            // echo "<td><button class='btn-viem-items' onclick='viewitems(".$row['purchase_request_code'].")'>View Items</button></td>";

                            // echo "</tr>";
                        
                        ?>
                    </tbody>
                </table>
                <style>
                    .items {
                        display: flex;
                        flex-direction: column;
                    }
                </style>

                <div class="pagination" id="pagination">
                    <!-- Pagination buttons will be generated here -->
                </div>
            </div>
        </main>
    </div>
    <script src="../../scripts/jquery.min.js"></script>
    <script>
        // THIS IS THE TABLE FUNCTION PAGINATION
        const tableBody = document.getElementById('tableBody');
        const paginationDiv = document.getElementById('pagination');
        const searchInput = document.getElementById('searchInput');

        let currentPage = 1;
        const rowsPerPage = 6; // 6 rows per page
        const maxPageButtons = 3; // Number of page buttons to show at a time

        let data = []; // To hold the original table data

        function fetchcontent(){
            displatData();
            fetchTableData();
        }

        function displatData(){
            $.ajax({
                url: '../../logic/usersAccountable.php',
                type: 'GET',
                data: {
                    userData:'user_data'
                },
                cache: false,
                success: res=>{
                    var results = Object.values(JSON.parse(res));
                    let tableContent = '';              
                    results.forEach(result => {
                        let equipment_name = '';
                        let quantity = '';
                        let price = '';
                        result.forEach(data=>{
                            equipment_name += `${data.item_name}<br>`
                            quantity += `${data.quantity}<br>`
                            price += `${data.price}<br>`
                        })
                        tableContent += `
                            <tr>
                                <td>${result[0].purchase_request_code}</td>
                                <td>${equipment_name}</td>
                                <td>${quantity}</td>
                                <td>${price}</td>
                                <td>${result[0].status!='pending'?'accepted':'pending'}</td>
                                <td>${moment(result[0].datetime).format('LL')}</td>
                                <td><button class='btn-viem-items' onclick='viewitems(${result[0].purchase_request_code})'>View Items</button></td>
                            </tr>
                        `
                    });
                    $("#tableBody").html(tableContent);
                }
            })
        }

        function fetchTableData() {
            data = Array.from(tableBody.rows).map(row => Array.from(row.cells).map(cell => cell.textContent));
            displayTable(currentPage);
        }

        function displayTable(page) {
            const filteredData = filterData();
            const totalPages = Math.ceil(filteredData.length / rowsPerPage);
            const start = (page - 1) * rowsPerPage;
            const end = start + rowsPerPage;
            const paginatedData = filteredData.slice(start, end);

            tableBody.innerHTML = '';
            for (let row of paginatedData) {
                const tr = document.createElement('tr');
                for (let cell of row) {
                    const td = document.createElement('td');
                    td.textContent = cell;
                    tr.appendChild(td);
                }
                tableBody.appendChild(tr);
            }

            renderPagination(totalPages);
        }

        function fetchTableData() {
            data = Array.from(tableBody.rows).map(row => Array.from(row.cells).map(cell => cell.innerHTML));
            displayTable(currentPage);
        }

        function filterData() {
            const searchTerm = searchInput.value.toLowerCase();
            return data.filter(row => row.some(cell => cell.toLowerCase().includes(searchTerm)));
        }

        function displayTable(page) {
            const filteredData = filterData();
            const totalPages = Math.ceil(filteredData.length / rowsPerPage);
            const start = (page - 1) * rowsPerPage;
            const end = start + rowsPerPage;
            const paginatedData = filteredData.slice(start, end);

            tableBody.innerHTML = '';
            for (let row of paginatedData) {
                const tr = document.createElement('tr');
                for (let cell of row) {
                    const td = document.createElement('td');
                    td.innerHTML = cell; // Use innerHTML to preserve HTML content
                    tr.appendChild(td);
                }
                tableBody.appendChild(tr);
            }
            renderPagination(totalPages);
        }

        function renderPagination(totalPages) {
            paginationDiv.innerHTML = '';

            const prevButton = document.createElement('button');
            prevButton.textContent = '<';
            prevButton.onclick = prevPage;
            prevButton.disabled = currentPage === 1;
            paginationDiv.appendChild(prevButton);

            const startPage = Math.max(1, currentPage - Math.floor(maxPageButtons / 2));
            const endPage = Math.min(totalPages, startPage + maxPageButtons - 1);

            if (totalPages <= 3) {
                for (let i = 1; i <= totalPages; i++) {
                    const pageSpan = document.createElement('span');
                    pageSpan.textContent = i;
                    pageSpan.className = (i === currentPage) ? 'active' : '';
                    pageSpan.onclick = () => goToPage(i);
                    paginationDiv.appendChild(pageSpan);
                }
            } else {
                if (startPage > 1) {
                    const dots = document.createElement('span');
                    dots.textContent = '...';
                    dots.className = 'dots';
                    paginationDiv.appendChild(dots);
                }

                for (let i = startPage; i <= endPage; i++) {
                    const pageSpan = document.createElement('span');
                    pageSpan.textContent = i;
                    pageSpan.className = (i === currentPage) ? 'active' : '';
                    pageSpan.onclick = () => goToPage(i);
                    paginationDiv.appendChild(pageSpan);
                }

                if (endPage < totalPages) {
                    const dots = document.createElement('span');
                    dots.textContent = '...';
                    dots.className = 'dots';
                    paginationDiv.appendChild(dots);
                }
            }

            const nextButton = document.createElement('button');
            nextButton.textContent = '>';
            nextButton.onclick = nextPage;
            nextButton.disabled = currentPage === totalPages;
            paginationDiv.appendChild(nextButton);
        }

        function nextPage() {
            const totalPages = Math.ceil(filterData().length / rowsPerPage);
            if (currentPage < totalPages) {
                currentPage++;
                displayTable(currentPage);
            }
        }

        function prevPage() {
            if (currentPage > 1) {
                currentPage--;
                displayTable(currentPage);
            }
        }

        function goToPage(page) {
            currentPage = page;
            displayTable(page);
        }

        searchInput.addEventListener('input', () => {
            currentPage = 1; // Reset to first page on search
            displayTable(currentPage);
        });

        function viewitems(purchase_id){
            document.getElementById("req_content").style.display = "block";
            $.ajax({
                url: '../../logic/dbaccountabilityData.php',
                type: 'POST',
                cache: false,
                data: {
                    id : purchase_id
                },
                success: res=>{
                    // console.log(Object.values(JSON.parse(res)));
                    displayData(Object.values(JSON.parse(res))[0]);
                }
            });
        }

        function remove_content(){
            document.getElementById("req_content").style.display = "none"; 
        }

        function displayData(data){
            $("#btn_print_content").attr("disabled", (data[0].status == 'pending'))
            $("#btn_print_content").attr("style", `${(data[0].status == 'pending')?"display: none":"display: block"}`);
            $("#qr_name").text(data[0].fullname);
            $("#qr_status").text(`${data[0].status!=='pending'?'accepted':'pending'}`);
            $("#qr_item").text(data[0].purchase_request_code);
            let body_table = '';
            let total_price = 0;
            let total_qty = 0;
            for(let i in data){
                total_price += data[i].price;
                total_qty += data[i].quantity;
                body_table +=  `
                    <tr>
                        <td>${data[i].item_name}</td>
                        <td>${data[i].quantity}</td>
                        <td>${data[i].price}</td>
                        <td>${data[i].specs}</td>
                    </tr>
                `;
            }
            $("#table_body").html(body_table);
            canvasData(`${data[0].fullname}-${data[0].purchase_request_code}`);
            
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

        const noti_content =  document.querySelector("#noti_content");
        const open_noti = document.querySelector("#open_noti");

        open_noti.addEventListener('click',()=>{
            noti_content.style.display = "block";
        })
        window.onload = fetchcontent;
    </script>
</body>

</html>