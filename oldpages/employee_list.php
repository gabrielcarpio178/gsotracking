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
    <link rel="stylesheet" href="../styles/">
    <link rel="icon" type="image/gif" href="imgOP/gif001.gif">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <title>Employee List</title>
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
        overflow-y: auto;
        /* Allow vertical scrolling */
        box-sizing: border-box;
        /* Ensure padding doesn't affect overall width/height */
        gap: 20px;
    }


    .h {
        display: flex;
        align-items: flex-start;
        justify-content: flex-start;
        padding: 2rem;
        border-bottom: 2px solid #EFEFEF;
        font-size: 18px;
    }


    .bd {
        display: flex;
        flex-direction: column;
        height: 100%;
        width: 100%;
        padding: 1rem;

    }


    .bch {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .bc {
        display: flex;
        flex-direction: row;
        gap: 20px;
    }

    .bcl,
    .bcr {
        padding: 10px;
        width: 100%;
    }

    .bcl {
        display: flex;
        flex-direction: row;
        gap: 5rem;
    }


    .bclt {
        display: flex;
        flex-direction: column;
        gap: 10px;
        align-items: flex-start;
        justify-content: flex-start;
        font-size: 20px;
        width: 100%;
    }

    .bcli {
        width: 100%;
        display: flex;
        flex-direction: column;
        gap: 10px;
        align-items: flex-start;
        justify-content: flex-start;
    }

    .bcli input {
        width: 100%;
        padding: .5rem;
        background-color: #EFEFEF;
    }

    .vs {
        margin-top: 2rem;
        display: flex;
        flex-direction: row;
        gap: 10px;
    }

    .vs button {
        padding: 8px;
        width: 130px;
        text-align: center;
        font-size: 14px;
        border: 2px solid;
        border-radius: 20px;
        cursor: pointer;
    }

    #viewRecordBtn.clicked {
        background-color: #39D048;
        color: white;
        border: 2px solid;
    }

    .bcr {
        display: flex;
        flex-direction: column;
    }

    .bcrh {
        display: flex;
        flex-direction: row;
        align-items: flex-start;
        justify-content: flex-start;
        padding: 5px;
        gap: 10px;
    }

    .bcrh span {
        width: 15px;
        height: 15px;
        border-radius: 50%;
        background-color: #0FDF18;
    }

    .bcrbox {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .bcrpic {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        width: 150px;
        height: 150px;
        box-shadow: 0px 8px 15px -3px rgba(0, 0, 0, 0.1);
    }

    .bpic {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        object-fit: cover;
        overflow: hidden;
    }

    .bpic img {
        width: 100%;
        height: 100%;
    }

    .viewcontents {
        display: flex;
        flex-direction: column;
        padding: 10px;
        width: 100%;
        align-items: center;
        justify-content: center;
    }


    .styled-table {
        width: 100%;
        border-collapse: collapse;
        margin: 25px 0;
        font-size: 13px;
        text-align: left;
    }

    .styled-table th,
    .styled-table td {
        padding: 12px 15px;
    }

    .styled-table thead tr {
        background-color: #E7E7E7;
        color: #000000;
        text-align: left;
    }

    .styled-table tbody tr {
        border-bottom: 1px solid #E7E7E7;
    }

    .styled-table tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
    }

    .styled-table tbody tr:last-of-type {
        border-bottom: 2px solid #E7E7E7;
    }

    .styled-table tbody tr:hover {
        background-color: #f1f1f1;
        cursor: pointer;
    }
</style>

<body>
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
                            <i class="fa fa-exchange"></i>
                            <a href="equipment_transfer.php">EQUIPMENT TRANSFER</a>
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
                            <a href="employee_list.php" id="active">EMPLOYEE LIST</a>
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
                    <div class="search">
                        <i class="fa-solid fa-search"></i>
                        <input type="search" placeholder="Search" class="search-input">
                    </div>
                    <div class="notpic">
                        <!-- <div class="ahehe">
                            <a href=""><i class="fa-solid fa-bell"></i></a>
                        </div>
                        <div class="profile">
                            <img src="../styles/images/logo1.png" alt="">
                        </div> -->
                    </div>
                </div>
            </div>
        </div>


        <div class="cm">

            <div class="h">
                <span>Basic Employee Information</span>
            </div>


            <div class="bd">
                <div class="bch">

                    <div class="bc">
                        <div class="bcl">



                            <div class="bclt">
                                <p>Employee Id:</p>
                                <p>Employee Name:</p>
                                <p>Position:</p>
                                <p>Department:</p>
                            </div>

                            <div class="bcli">

                                <input type="text">
                                <input type="text">
                                <input type="text">
                                <input type="text">

                                <div class="vs">
                                    <button id="viewRecordBtn">View Record</button>
                                    <button>Save</button>
                                </div>

                            </div>

                        </div>
                        <div class="bcr">
                            <div class="bcrh">

                                <span></span>
                                <p>Is active</p>

                            </div>

                            <div class="bcrbox">
                                <div class="bcrpic">

                                    <div class="bpic">
                                        <img src="../styles/images/logo1.png" alt="">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="viewcontents" id="viewContents" style="display:none;">
                        <table class="styled-table">
                            <thead>
                                <tr>
                                    <th>Employee ID</th>
                                    <th>Employee Name</th>
                                    <th>Equipment Name</th>
                                    <th>Specification</th>
                                    <th>Date Acquired</th>
                                    <th>Time Acquired</th>
                                    <th>Position</th>
                                    <th>Department</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>001</td>
                                    <td>John Doe</td>
                                    <td>Laptop</td>
                                    <td>16GB RAM, 512GB SSD</td>
                                    <td>2024-01-10</td>
                                    <td>09:30 AM</td>
                                    <td>Manager</td>
                                    <td>IT</td>
                                </tr>
                                <!-- More rows here -->
                            </tbody>
                        </table>

                    </div>

                </div>



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



        document.getElementById('viewRecordBtn').addEventListener('click', function() {
            var viewContents = document.getElementById('viewContents');
            var button = document.getElementById('viewRecordBtn');

            if (viewContents.style.display === "none" || viewContents.style.display === "") {
                viewContents.style.display = "flex";
                button.classList.add('clicked'); // Add 'clicked' class to change bg to green
            } else {
                viewContents.style.display = "none";
                button.classList.remove('clicked'); // Remove 'clicked' class to revert bg
            }
        });
    </script>






</body>




</html>