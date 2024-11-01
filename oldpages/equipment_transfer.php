<?php
session_start();
if ($_SESSION['role'] == 'user') {
    header("Location: admin_dashboard.php");
    exit();
}
if (!isset($_SESSION['loginSession'])) {
    header('LOCATION: ../');
    exit();
}
require '../logic/dbCon.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/gif" href="imgOP/gif001.gif">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../styles/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <title>Equipment Transfer</title>
</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');


    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        text-decoration: none;
        outline: none;
        border: none;
        /* text-transform:capitalize; */
        transition: all .2s linear;
        font-family: "Poppins", sans-serif;
    }

    /* *::selection{
    background:#7eabae;
    color:#443434;
} */

    html {
        font-size: 58.5%;
        overflow-x: hidden;
    }

    /* html::-webkit-scrollbar{
    width: 1.4rem;
  }
html::-webkit-scrollbar-track{
    background: #eadbc4;
    border: 1px solid #443434;
  }
html::-webkit-scrollbar-thumb{
    background: #443434;
    border-radius: 5px; } */

    body {
        background: #7eabae;
        overflow-x: hidden;
        padding-left: 27rem;
    }

    header {
        position: fixed;
        top: 0;
        left: 0;
        z-index: 100;
        height: 100%;
        width: 27rem;
        background: #F8F8F8;
        display: flex;
        align-items: center;
        /* justify-content:center; */
        flex-flow: column;
        filter: drop-shadow(3px 1px 1px #adadad);
    }

    header .user {
        margin-top: 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: row;
        width: 20rem;
        height: 5rem;
        /* border: 2px solid black; */
        background-color: #FFFFFF;
        border-radius: 20px;
        gap: 1rem;
    }

    header .user img {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 4rem;
        width: 4rem;
        /* border: 2px solid black; */
        border-radius: 50%;
        object-fit: cover;
    }

    .menutext {
        font-size: 1.5rem;
        margin-left: -25%;
        text-transform: capitalize;
        font-weight: 800;
        margin-top: 3rem;
        margin-bottom: 1rem;
        /* margin-right: auto; */
    }

    header .navbar {
        width: 100%;
    }

    header .navbar ul li {
        list-style: none;

        transition: background-color 0.3s, color 0.3s;
        position: relative;
    }

    .navbar ul li:hover {
        /* background-color: #007bff;  */
        color: white;
    }

    .navbar ul li:hover a {
        background: #000000;
        color: white;
        /* Change the color of the link text on hover */
    }


    .navbar ul li i {
        font-size: 2.5rem;
        left: 33%;
        top: 1.7rem;
        /* margin-right: 1rem; */
        position: absolute;
        margin-left: -6rem;
    }

    header .navbar ul #active {
        background-color: #000000;
        color: #F8F8F8;
    }


    header .navbar ul li a {
        display: block;
        border-radius: 15px 0 0 15px;
        padding-left: 15rem;
        background: #F8F8F8;
        padding-top: 20px;
        height: 6rem;
        margin-left: -6rem;
        color: #000000;
        font-size: 1.5rem;
        font-weight: bold;
    }




    header .navbar ul li:last-child {
        position: absolute;
        bottom: 0;
        width: 100%;
    }

    .div {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .div span {
        border: 1px solid #D4D4D4;
        width: 40rem;
        margin-right: 3rem;
        margin-left: 2rem;
        margin-top: 2rem;
    }


    #menu {
        position: fixed;
        top: 2rem;
        right: 2rem;
        background: transparent;
        color: #443434;
        cursor: pointer;
        font-size: 2.5rem;
        padding: 1rem 1.5rem;
        z-index: 1000;
        display: none;
    }





    @media (max-width:1200px) {
        html {
            font-size: 55%;
        }

    }


    @media (max-width:991px) {
        header {

            left: -120%;
        }

        #menu {
            display: block;
        }

        header.toggle {
            left: 0;
        }

        body {
            padding: 0;
        }
    }


    @media (max-width:768px) {
        html {
            font-size: 50%;
        }

    }






    @media (max-width:400px) {
        header {
            width: 100wh;
        }


    }




    .container {
        background-color: #ffffff;
        height: 100vh;
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }


    .container .header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 80px;
        background-image: url(../styles/images/Rectangle\ 1.png);
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        padding: 3rem;
    }



    .div1 {
        /* margin-top: -4rem; */
        /* margin-bottom: -3rem; */
        display: flex;
        width: 400px;
        height: 100px;
    }



    .div1 .content {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        margin-left: 1rem;
    }

    .div1 .logo {
        margin-right: 1rem;
        border: 2px solid #7eabae;
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 50%;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .div1 .logo img {
        width: 100%;
        height: 100%;
    }

    .div1 .content p {
        font-size: 12px;
        color: #F8F8F8;
    }

    .div2 .content2 {
        /* width: 500px; */
        /* margin-top: -4rem; */
        height: 100px;
        /* margin-bottom: -5rem; */
        display: flex;
        align-items: center;
        justify-content: flex-start;
        /* border: 2px solid #fffefe; */
        padding: 2rem;
    }

    .search {
        /* border: 2px solid #fff; */
        /* width: 300px; */
        position: relative;

    }

    .search i {
        position: absolute;
        font-size: 1.5rem;
        color: rgb(121, 97, 97);
        top: 1rem;
        left: 1.5rem;
    }

    .search input {
        width: 100%;
        padding: .6rem;
        border-radius: 20px;
        border: none;
        padding-left: 4rem;
    }

    .notpic {
        display: flex;
        align-items: center;
        justify-content: center;
        justify-content: center;
        /* margin-left: auto; */
        gap: 3rem;
        width: 200px;
        /* border: 2px solid #fffefe; */
    }

    .notpic .ahehe a i {
        font-size: 2.5rem;
        text-decoration: none;
        color: #F8F8F8;
    }

    .notpic .profile img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 50%;
    }

    .cm {
        display: flex;
        flex-direction: column;
        padding: 2rem;
        height: 100%;
        gap: 20px;
    }

    .sb {
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: flex-start;
        padding: 2rem;
        border-bottom: 2px solid #EFEFEF;
        gap: 10px;
        position: relative;
        font-size: 18px;
    }

    .s {
        display: flex;
        flex-direction: row;
        position: relative;
    }

    .s i {
        position: absolute;
        font-size: 13px;
        bottom: 10px;
        left: 10px;

    }

    .s input {
        background-color: #E7E7E7;
        outline: none;
        padding: 7px;
        width: 220px;
        padding-left: 35px;
        border-radius: 4.23px;
    }


    /* .records {
        display: flex;
        flex-direction: row;
        justify-content: flex-start;
        align-items: flex-start;
        height: 100%;
        width: 100%;
        padding: 2rem;
        gap: 20px;
    } */

    .records {
        display: flex;
        flex-wrap: wrap;
        /* Allow items to wrap if they overflow */
        justify-content: flex-start;
        align-items: flex-start;
        gap: 20px;
        /* Space between the records */
        padding: 2rem;
        width: 100%;
        height: calc(65vh - 10px);
        overflow: auto;
        /* Adjust height based on content */
        box-sizing: border-box;
        /* Ensure padding and border are included in width/height */
    }


    .ri {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content: flex-start;
        gap: 10px;
    }

    .hd {
        display: flex;
        flex-direction: row;
        gap: 10px;
    }

    .pp {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 50%;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid;
    }

    .pp img {
        width: 100%;
        height: 100%;
    }

    .en {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content: flex-start;
    }

    .en .n {
        font-size: 22px;
        color: #3B3B3B;
    }

    .stat {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .en .act {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: #2DED77;
    }

    .bd {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content: flex-start;
        gap: 20px;
        font-size: 10px;
        max-width: 300px;
    }

    .bd span {
        font: 600;
        font-size: 14px;
    }

    .bdc {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: flex-start;
        gap: 10px;
    }

    .rs,
    .ls {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content: flex-start;
        gap: 15px;
    }

    .ft {
        display: flex;
        flex-direction: row;
        align-items: flex-start;
        justify-content: flex-start;
        text-align: center;
        gap: 10px;
    }

    .ft button:first-child {
        background-color: #000000;
        color: #ffffff;
        text-align: center;
        padding: 1rem;
        border-radius: 8px;
        border: 2px solid #000000;
        font-size: 10px;
        cursor: pointer;
        transition: all .6s ease-in-out;

    }

    .ft button:last-child {
        border: 2px solid #000000;
        color: #000000;
        background-color: #ffffff;
        text-align: center;
        padding: .9rem;
        border-radius: 8px;
        font-size: 10px;
        cursor: pointer;
        transition: all .6s ease-in-out;
    }

    .ft button:last-child:hover {
        background-color: #000000;
        color: #ffffff;
    }

    .ft button:first-child:hover {
        background-color: #ffffff;
        color: #000000;
        border: 2px solid #000000;
    }

    /* modal */


    #overlay {
        display: none;
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        z-index: 101;
        background-color: rgba(.5, .5, .5, 0.5);
        /* Semi-transparent black for the overlay */
        backdrop-filter: blur(2px);
        justify-content: center;
        align-items: center;
    }

    #modal i {
        display: flex;
        justify-content: flex-end;
        align-items: flex-end;
        font-size: 20px;
        cursor: pointer;
    }



    #modal {
        padding: 1.5rem;
        width: 1120px;
        height: 600px;
        margin: auto;
        background-color: white;
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        border-radius: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    td {
        border-bottom: 1px solid #ddd;
        padding: 12px;
        text-align: left;
        /* Optional: Add min-width to ensure column widths are consistent */
        min-width: 100px;
        /* Adjust as needed */
    }

    th {
        border: none;
        background-color: #FFFFFF;
        color: #000000;
        padding: 12px;
        text-align: left;
        /* Optional: Add min-width to ensure column widths are consistent */
        min-width: 100px;
        /* Adjust as needed */
    }

    tr {
        height: 50px;
        /* Set a fixed height for rows */
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tr:hover {
        background-color: #f1f1f1;
    }


    button {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 8px 12px;
        border-radius: 4px;
        cursor: pointer;
    }

    button:hover {
        background-color: #0056b3;
    }



    #pagination {
        margin-top: 20px;
        text-align: center;
    }

    #pagination button {
        background-color: white;
        color: black;
        border: 1px solid #ccc;
        padding: 8px 12px;
        margin: 0 4px;
        border-radius: 4px;
        cursor: pointer;
    }

    #pagination button:hover {
        background-color: #f0f0f0;
    }

    #pagination button:disabled {
        background-color: #d6d6d6;
        color: #a0a0a0;
        cursor: not-allowed;
    }

    #pagination button#prev,
    #pagination button#next {
        background-color: black;
        color: white;
        border: none;
    }

    #pagination button#prev:hover,
    #pagination button#next:hover {
        background-color: #333;
    }

    #pagination button.active {
        background-color: black;
        color: white;
    }
</style>

<body>

    <div id="overlay">
        <div id="modal">
            <i class="fa-solid fa-xmark" id="close-modal-btn"></i>
            <table id="data-table">
                <tr>
                    <th>Equipment Name</th>
                    <th>Category</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Satus</th>
                    <th>Date Barrowed</th>
                    <th></th>
                </tr>
                <!-- <tr id="result">
                    <td>Laptop</td>
                    <td>Electronics</td>
                    <td>5</td>
                    <td>$1200</td>
                    <td>Available</td>
                    <td>2024-08-15</td>
                    <td><button>View Specs</button></td>
                </tr> -->
                <tbody id="result">
                    <!-- Data will be dynamically loaded here -->
                </tbody>
            </table>
            <div id="pagination">
                <button id="prev" disabled>&lt;</button>
                <button class="page" data-page="1">1</button>
                <button class="page" data-page="2">2</button>
                <button class="page" data-page="3">3</button>
                <button id="next">&gt;</button>
            </div>
        </div>
    </div>
    <header>
        <div class="user">
            <img src="../styles/images/logo1.png" alt="">
            <h3 style="letter-spacing: 4px;"><?php echo $_SESSION['role']; ?></h3>
        </div>
        <span class="menutext">menu</span>
        <nav class="navbar">
            <ul>
                <li>
                    <i class="fa-solid fa-cubes"></i>
                    <a href="category.php">EQUIPMENT LIST</a>
                </li>
                <?php if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'staff' || $_SESSION['role'] == 'storekeeper'): ?>
                    <?php if ($_SESSION['role'] == 'admin'): ?>
                        <li>
                            <i class="fa fa-exchange" id="active"></i>
                            <a href="equipment_transfer.php" id="active">EQUIPMENT TRANSFER</a>
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
                            <i class="fa-solid fa-user"></i>
                            <a href="employee_list.php">EMPLOYEE LIST</a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
                <li>
                    <i class="fa-solid fa-gear"></i>
                    <a href="settings.php">SETTINGS</a>
                </li>
                <div class="div">
                    <span></span>
                </div>
                <li>
                    <i class="fa-solid fa-door-open"></i>
                    <a href="../logic/logout.php">LOG OUT</a>
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
                        <img src="../styles/images/logo1.png" alt="">
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
                            <img src="../styles/images/logo1.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="cm">
            <div class="sb">
                <span>Search by Employee ID</span>
                <div class="s">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="search" placeholder="Search" oninput="searchEmployeeId(this)">
                </div>
            </div>
            <div class="records">
                <!-- result here -->
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#menu').click(function() {
                $(this).toggleClass('fa-times');
                $('header').toggleClass('toggle');

                $(window).on('scroll load', function() {
                    $('#menu').removeClass('fa-times');
                    $('header').removeClass('toggle');
                });
            });
        })

        function searchEmployeeId(search) {
            const records = document.querySelector('.records');
            records.innerHTML = ''; // Clear previous results

            $.ajax({
                url: '../logic/READ/fetchEmployeeById.php',
                type: 'GET',
                data: {
                    employee_id: search.value
                },
                success: function(response) {
                    const data = JSON.parse(response);
                    // console.log(data);

                    if (Array.isArray(data) && data.length > 0) { // Check if data is an array with at least one record
                        data.forEach((employee) => { // Loop through each employee record
                            const ri = document.createElement('div');
                            ri.classList.add('ri');
                            ri.innerHTML = `
                            <div class="hd">
                                <div class="pp">
                                    <img src="${employee.profile ? employee.profile : (employee.gender == 'male' ? '../profile/boy.jpeg' : '../profile/girl.jpeg')}" alt="">
                                </div>
                                <div class="en">
                                    <span class="n">${employee.fullname}</span>
                                    <div class="stat">
                                        <span class="act"></span>
                                        <p>${employee.status === 'active' ? 'Active now' : 'Inactive'}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bd">
                                <span>Employee Information</span>
                                <div class="bdc">
                                    <div class="rs">
                                        <p>Employee Id:</p>
                                        <p>Name:</p>
                                        <p>Position:</p>
                                        <p>BirthDate:</p>
                                        <p>Reason Code:</p>
                                    </div>
                                    <div class="ls">
                                        <p>${employee.usercode}</p>
                                        <p>${employee.fullname}</p>
                                        <p>${employee.role}</p>
                                        <p>${employee.birthdate}</p>
                                        <p>No reason</p>
                                    </div>
                                </div>
                            </div>
                            <div class="ft">
                                <button>Transfer Accountability</button>
                                <button type="button" onclick="viewRecords('${employee.usercode}')">View Records</button>
                            </div>
                        `;
                            records.appendChild(ri); // Append each employee's record to the 'records' div
                        });
                    } else {
                        console.log("No employee data found.");
                    }
                },
                error: function(error) {
                    console.error(error);
                }
            });
        }



        // modal
        const overlay = document.querySelector('#overlay');

        // document.querySelector('#show-modal-btn').addEventListener("click", () => {
        //     overlay.style.display = "block";
        // })

        document.querySelector('#close-modal-btn').addEventListener("click", () => {
            overlay.style.display = "none";
        })
        // let specs = {};

        function viewRecords(employee_id) {
            overlay.style.display = "block";
            const tableBodyTr = document.querySelector('#result');
            tableBodyTr.innerHTML = '';
            $.ajax({
                url: '../logic/READ/fetchEmployeeRecords.php',
                type: 'GET',
                data: {
                    employee_id: employee_id
                },
                success: function(response) {
                    console.log(response);
                    const data = JSON.parse(response);
                    console.log(data);
                    // specs = data.specs;
                    if (Array.isArray(data) && data.length > 0) {
                        data.forEach((record) => {
                            const tr = document.createElement('tr');
                            tr.innerHTML = `
                            <td>${record.equipment_name}</td>
                            <td>${record.category}</td>
                            <td>${record.quantity}</td>
                            <td>${record.price}</td>
                            <td>${record.status}</td>
                            <td>${record.date_borrowed}</td>
                            <td><button type="button" onclick"viewSpecs('${record.borrower_id}')">View Specs</button></td>
                            `;
                            tableBodyTr.appendChild(tr);
                        });
                    }
                }
            });
        }

        function viewSpecs(){
            // const specs = JSON.parse(specs);
            console.log(specs);
            // display specs here
            //...
        }


        // pagination 
        document.addEventListener('DOMContentLoaded', function() {
            const rowsPerPage = 6;
            const maxPagesToShow = 3; // Number of page buttons to show at a time
            const table = document.getElementById('data-table');
            const pagination = document.getElementById('pagination');
            const prevButton = document.getElementById('prev');
            const nextButton = document.getElementById('next');
            let currentPage = 1;
            let startPage = 1;

            function updateTable() {
                const rows = table.getElementsByTagName('tr');
                const totalRows = rows.length - 1; // Exclude header row
                const totalPages = Math.ceil(totalRows / rowsPerPage);

                let startIndex = (currentPage - 1) * rowsPerPage + 1;
                let endIndex = startIndex + rowsPerPage - 1;

                // Hide all rows
                for (let i = 1; i < rows.length; i++) {
                    rows[i].style.display = 'none';
                }

                // Show rows for the current page
                for (let i = startIndex; i <= endIndex && i < rows.length; i++) {
                    rows[i].style.display = '';
                }

                // Calculate the page range to display
                const endPage = Math.min(totalPages, startPage + maxPagesToShow - 1);

                // Update the prev and next buttons
                prevButton.disabled = startPage === 1;
                nextButton.disabled = endPage === totalPages;

                // Remove old page buttons
                pagination.innerHTML = '';

                // Add 'prev' button if needed
                if (startPage > 1) {
                    pagination.appendChild(prevButton);
                }

                // Create page buttons
                for (let i = startPage; i <= endPage; i++) {
                    const button = document.createElement('button');
                    button.className = 'page';
                    button.dataset.page = i;
                    button.textContent = i;
                    if (i === currentPage) {
                        button.classList.add('active');
                    }
                    pagination.appendChild(button);
                }

                // Add 'next' button if needed
                if (endPage < totalPages) {
                    pagination.appendChild(nextButton);
                }
            }

            function handlePageChange(e) {
                const totalPages = Math.ceil((table.getElementsByTagName('tr').length - 1) / rowsPerPage);
                if (e.target.classList.contains('page')) {
                    currentPage = parseInt(e.target.dataset.page);
                    updateTable();
                } else if (e.target === prevButton) {
                    if (startPage > 1) {
                        startPage = Math.max(1, startPage - maxPagesToShow);
                        currentPage = Math.max(1, currentPage - maxPagesToShow);
                        updateTable();
                    }
                } else if (e.target === nextButton) {
                    const endPage = Math.min(totalPages, startPage + maxPagesToShow - 1);
                    if (endPage < totalPages) {
                        startPage = Math.min(totalPages - maxPagesToShow + 1, startPage + maxPagesToShow);
                        currentPage = Math.min(totalPages, currentPage + maxPagesToShow);
                        updateTable();
                    }
                }
            }

            // Initialize
            updateTable();
            pagination.addEventListener('click', handlePageChange);
        });
    </script>






</body>

</html>