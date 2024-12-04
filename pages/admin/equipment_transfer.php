<?php
session_start();
// if ($_SESSION['role'] == 'user') {
//     header("Location: admin_dashboard.php");
//     exit();
// }
if (!isset($_SESSION['loginSession'])) {
    header('LOCATION: ../../');
    exit();
}
require '../../logic/dbCon.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/gif" href="../../styles/images/logo2.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="../styles/"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="../../scripts/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="../../styles/sweetalert2.min.css">
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
        transition: all .2s linear;
        font-family: "Poppins", sans-serif;
    }

    html {
        font-size: 58.5%;
        overflow-x: hidden;
    }

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
        color: white;
    }

    .navbar ul li:hover a {
        background: #000000;
        color: white;
    }

    .navbar ul li i {
        font-size: 2.5rem;
        left: 33%;
        top: 1.7rem;
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
        background-image: url(../../styles/images/Rectangle\ 1.png);
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
        text-transform: capitalize;
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
        text-transform: capitalize;
    }

    .ft {
        display: flex;
        flex-direction: row;
        align-items: flex-start;
        justify-content: flex-start;
        text-align: center;
        gap: 10px;
    }

    .ft button:nth-child(1) {
        background-color: #000000;
        color: #ffffff;
        text-align: center;
        padding: 1rem;
        border-radius: 8px;
        border: 2px solid #000000;
        font-size: 10px;
        cursor: pointer;
        transition: all .6s ease-in-out;
        justify-content: center;
    }

    .ft button:nth-child(2) {
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

    .ft button:nth-child(2):hover {
        background-color: #000000;
        color: #ffffff;
    }

    .ft button:nth-child(1):hover{
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
    #form-content {
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

    #form-modal{
        padding: 1.5rem;
        width: 500px;
        height: 550px;
        margin: auto;
        overflow-y: scroll;
        background-color: white;
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        border-radius: 20px;
    }

    .form-content{
        width: 50%;
        border-radius: 10px/10px;
        border: 1px solid black;
        padding: 20px 15px;
        margin-top: 150px;
    }
    .submit_form{
        display: flex;
        flex-direction: column;
        
    }
    .input-content{
        display: flex;
        flex-direction: column;
    }
    .input-content > input,  .input-content > select{
        outline: none;
        background-color: #ECECEC;
        height: 48px;
        border-radius: 3px;
        box-shadow: 73px 71px 15px -69px rgba(0,0,0,0.25) inset;
    -webkit-box-shadow: 73px 71px 15px -69px rgba(0,0,0,0.25) inset;
    -moz-box-shadow: 73px 71px 15px -69px rgba(0,0,0,0.25) inset;
        border: none;
        margin: 10px 0;
        padding: 10px;
        width: 100%;
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
        justify-content: center;
    }
    .radio-btn{
        display: flex;
        flex-direction: row;
    }
    input[type=radio]{
        width: 100%;
    }

    .r-input-content{
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-between;
        width: 100%;
    }
    button{
        width: 50%;
        align-self: center;
        background-color: #191919;
        color: #f0f0f0;
        border: none;
        cursor: pointer;
        border-radius: 3px;
        height: 7vh;
        transition: all 0.6s ease-in-out;
    }

    button:hover {
        background-color: #f0f0f0;
        color: #191919;
        box-shadow: 73px 71px 15px -69px rgba(0,0,0,0.25) inset;
        -webkit-box-shadow: 73px 71px 15px -69px rgba(0,0,0,0.25) inset;
        -moz-box-shadow: 73px 71px 15px -69px rgba(0,0,0,0.25) inset;
    }

    .btn-content{
        width: 100%;
        display: flex;
        justify-content: center;
    }

    .btn-content > button{
        width: 48%;
     
    }
    .btn-content > button > .count-equiment{
        font-weight: bolder;
    }
    .message{
        color: red;
    }





    #modal {
        padding: 1.5rem;
        width: 1120px;
        height: 600px;
        margin: auto;
        overflow-y: scroll;
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

    .header-content-modal{
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }
    .equipment-user-list{
        display: flex;
        flex-direction: column;
        gap: 10px 0;
    }
    
    .equipment-user-list > .equipment, .equipment > div{
        display: flex;
        flex-direction: row;
    }
    .equipment-user-list > .equipment{
        justify-content: space-between;
        align-items: center;
        border: 1px solid black;
        padding: 0 5px;
        cursor: pointer;
        border-radius: 5px/5px;
    }
    .equipment > div{
        width: 100%;
    }
    .check-box{
        display: none;
    }
    .check-box:checked+label{
        background-color: #007bff;
        color: white;
        border: 1px solid #007bff;
    }

    .message-purchase{
        color: red;
    }

    .swal2-actions{
        display: flex;
        flex-direction: row;
        width: 100%;
    }
    .swal2-actions>button{
        width: 90%;
    }


</style>

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
    <div id="form-content">
        <div id="form-modal">
            <div class="header-content-modal">
                <h1>Transfer account</h1>
                <i class="fa-solid fa-xmark" style="font-size: 2rem" onclick="document.getElementById('form-content').style.display='none'"></i>
            </div>
            <form id="form_submit" class="submit-form">
                
                <div class="input-content">
                    <label for="from" class="label-input">From</label>
                    <select name="from" id="from" class="input-data" disabled>
                        
                    </select>
                </div>
                <div class="input-content">
                    <label for="to" class="label-input">To</label>
                    <select name="from" id="to" class="input-data" require>

                    </select>
                </div>
                
                <div class="second-input">
                    <div class="input-content">
                        <label for="birthday" class="label-input">Birthday</label>
                        <input type="date" class="input-data" id="birthday" disabled>
                    </div>
                    <div class="input-content">
                        <div class="label-input">Sex</div>
                        <div class="radio-btn">
                            <div class="r-input-content">
                                <label for="male" class="label-input">Male</label>
                                <input type="radio" value="male" name="sex" id="male" disabled>
                            </div>
                            <div class="r-input-content">
                                <label for="female" class="label-input">Female</label>
                                <input type="radio" value="female" name="sex" id="female" disabled>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="input-content">
                    <label for="email" class="label-input">Email</label>
                    <input type="email" class="input-data" id="email" disabled>
                    <input type="hidden" class="input-data" id="current_email">
                </div>
                <div class="input-content">
                    <label for="pnumber" class="label-input">Phone number <span class="message" id="pmessage"></span></label>
                    <input type="number" class="input-data" id="pnumber" disabled>
                </div>
                <div class="input-content">
                    <label for="employee_id" class="label-input">Employee ID <span class="message" id="emessage"></span></label>
                    <input type="number" class="input-data" id="employee_id" disabled>
                </div>
                <div class="input-content">
                    <label for="department" class="label-input">Department</label>
                    
                    <select name="department" id="department" class="input-data" required disabled>
                        <option value="BAC">BAC</option>
                        <option value="ASSESSOR">ASSESSOR'S</option>
                        <option value="BUDGET">BUDGET</option>
                        <option value="CDRRMC">CDRRMC</option>
                        <option value="LEGAL">LEGAL</option>
                        <option value="CMO-SPORTS">CMO-SPORTS</option>
                        <option value="CTO-LICENSE">CTO-LICENSE</option>
                        <option value="VET">VET</option>
                        <option value="HRMO">HRMO</option>
                        <option value="LIBRARY">LIBRARY</option>
                        <option value="LCR">LCR</option>
                        <option value="NUTRITION">NUTRITION</option>
                    </select>
                </div>
                
                <div class="input-content">
                    <label for="position" class="label-input">Position</label>
                    <input type="text" class="input-data" id="position" disabled>
                </div>
                <div class="input-content">
                    Purchase Record
                </div>
                <div class="input-content equipment-user-list" id="equipment_user_list">

                </div>

                <div class="btn-content">
                    <button type="submit" class="btn-submit">Transfer</button>
                </div>
            </form>
        </div>
    </div>
    <div id="overlay">
        <div id="modal">
            <div class="header-content-modal">
                <h1>Employee ID: <span id="employee_id"></span></h1>
                <i class="fa-solid fa-xmark" id="close-modal-btn"></i>
            </div>
            <div class="message-info" id="message_info"></div>
            <table id="data-table">
                    <tr>
                        <th>EQUIPMENT ID</th>
                        <th>EQUIPMENT NAME</th>
                        <th>QUANTITY</th>
                        <th>PRICE</th>
                        <th>DATE REQUESTED</th>
                        <th>STATUS</th>
                    </tr>
                </tr> 
                <tbody id="result">
                    <!-- Data will be dynamically loaded here -->
                </tbody>
            </table>
        </div>
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
                    <i class="fa fa-exchange" id="active"></i>
                    <a href="equipment_transfer.php" id="active">EQUIPMENT TRANSFER</a>
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
                    <i class="fa-solid fa-money-check-dollar"></i>
                    <a href="purchase_request.php">PURCHASE REQUEST</a>
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
        <div class="cm">
            <div class="sb">
                <span>Search by Employee ID</span>
                <div class="s">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="search" placeholder="Search" oninput="searchEmployeeId(this.value)">
                </div>
            </div>
            <div class="records">
                <!-- result here -->
            </div>
        </div>
    </div>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
     <script src="../../scripts/jquery.min.js"></script>
    <script>
        
        $(document).ready(function() {
            searchEmployeeId("");
            $('#menu').click(function() {
                $(this).toggleClass('fa-times');
                $('header').toggleClass('toggle');

                $(window).on('scroll load', function() {
                    $('#menu').removeClass('fa-times');
                    $('header').removeClass('toggle');
                });
            });
        })

        function getAllfullname(name){
            $.ajax({
                url: '../../logic/dbgetallfullname.php',
                type: 'GET',
                data: {
                    user: 'admin'
                },
                cache: false,
                success: res=>{
                    var fullnames = JSON.parse(res);
                    let from_options = '';
                    let to_options = '<option value="" selected disabled>To</option>';
                    fullnames.forEach(data=>{
                        from_options+=`<option ${data.fullname===name?'selected':''} value="${data.usercode}">${data.fullname}</option>`
                        if(data.fullname!==name){
                            to_options+=`<option value="${data.usercode}">${data.fullname}</option>`
                        }
                    })
                    $("#from").html(from_options);
                    $("#to").html(to_options);
                }
            })
        }

        function searchEmployeeId(search) {
            const records = document.querySelector('.records');
            records.innerHTML = ''; // Clear previous results

            $.ajax({
                url: '../../logic/READ/fetchEmployeeById.php',
                type: 'GET',
                data: {
                    employee_id: search
                },
                success: function(response) {
                    const data = JSON.parse(response);

                    if (Array.isArray(data) && data.length > 0) { // Check if data is an array with at least one record
                        data.forEach((employee) => { // Loop through each employee record
                           
                            const ri = document.createElement('div');
                            ri.classList.add('ri');
                            ri.innerHTML = `
                            <div class="hd">
                                <div class="pp">
                                    <img src="${employee.profile ? employee.profile : (employee.gender == 'male' ? '../../profile/boy.jpeg' : '../../profile/girl.jpeg')}" alt="">
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
                                        <p>Department:</p>
                                        <p>BirthDate:</p>
                                    </div>
                                    <div class="ls">
                                        <p>${employee.usercode}</p>
                                        <p>${employee.fullname}</p>
                                        <p>${employee.position}</p>
                                        <p>${employee.department}</p>
                                        <p>${employee.birthdate}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="ft">
                                <button onclick="transferAccount('${employee.usercode}')">Transfer Account</button>
                                <button type="button" onclick="viewRecords('${employee.usercode}')">View Records</button>
                            </div>
                        `;
                            records.appendChild(ri); // Append each employee's record to the 'records' div
                        });
                    } else {
                        // console.log("No employee data found.");
                        records.innerHTML = 'No employee data found.'
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
            // console.log(employee_id)
            overlay.style.display = "block";
            const tableBodyTr = document.querySelector('#result');
            tableBodyTr.innerHTML = '';
            $.ajax({
                url: '../../logic/READ/fetchEmployeeRecords.php',
                type: 'GET',
                data: {
                    employee_id: employee_id
                },
                success: function(response) {
                    $("#employee_id").text(employee_id);
                    const data = JSON.parse(response);
                    if (Array.isArray(data) && data.length > 0) {
                        $("#message_info").text("")
                        $("#data-table").show();
                        data.forEach((record) => {
                            const tr = document.createElement('tr');
                            tr.innerHTML = `
                            <td>${record.purchase_request_code}</td>
                            <td>${record.item_name}</td>
                            <td>${record.quantity}</td>
                            <td>${record.price}</td>
                            <td>${record.datetime}</td>
                            <td>${record.status}</td>
                            `;
                            tableBodyTr.appendChild(tr);
                        });
                    }else{
                        $("#data-table").hide();
                        $("#message_info").text("No transaction data");
                    }
                }
            });
        }

        function viewSpecs() {
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

        //view account
        function transferAccount(id){
            
            $.ajax({
                url: '../../logic/dbGetDataAccount.php',
                type: 'POST',
                data: {
                    id
                },
                cache: false,
                success: res=>{
                    var data_res = JSON.parse(res);
                    var {data, equipments_list} = data_res;
                    getAllfullname(data.fullname);
                    $(`input[name=sex][value='${data.gender}']`).prop("checked",true);
                    $("#birthday").val(data.birthdate);
                    $("#email").val(data.email);
                    $("#current_email").val(data.email);
                    $("#pnumber").val(data.phone_number);
                    $("#employee_id").val(data.usercode);
                    $("#department").val(data.department);
                    $("#position").val(data.position);
                    $("#form-content").show();
                    $("#transfer_equiment").attr('data-id', data.usercode)
                    

                    let equiment_html = '';

                    if(equipments_list.length!=0){
                        equipments_list.forEach(equipment=>{
                            equiment_html+=`
                                <input type="checkbox" class="check-box equipment_list" value="${equipment.purchase_request_code}" id="${equipment.purchase_request_code}">
                                <label for="${equipment.purchase_request_code}" class="equipment">
                                    <div class="equipment-info">
                                        <div class="equipment-label">Equipment Name: </div>
                                        <div class="equipment-data">${equipment.item_name}</div>
                                    </div>
                                    <div class="equipment-info">
                                        <div class="equipment-label">Quantity: </div>
                                        <div class="equipment-data">${equipment.quantity}</div>
                                    </div>
                                    <div class="equipment-info">
                                        <div class="equipment-label">Purchase Data: </div>
                                        <div class="equipment-data">${equipment.datetime}</div>
                                    </div>
                                    
                                </label>
                                <div class="equipment-line">  
                                </div>
                            `
                        })
                        $("#equipment_user_list").html(equiment_html);
                    }else{
                        $("#equipment_user_list").html('<div class="message-purchase">No Purchase record</div>');
                    }
                    

                }
            })
        }


        document.getElementById("form_submit").addEventListener('submit', e=>{
            e.preventDefault();
            var from = $("#from").val();
            var fullname = $("#from>option:selected").text();
            var to = $("#to").val();
            var tofullname = $("#to>option:selected").text();
            var sex = $('input[name="sex"]:checked').val();
            var birthday = $("#birthday").val();
            var email = $("#email").val();
            var current_email = $("#current_email").val();
            var pnumber = $("#pnumber").val();
            var employee_id = $("#employee_id").val();
            var position = $("#position").val();
            var department = $("#department").val();
            var selected_equiments = document.querySelectorAll('.equipment_list:checked');
            let data_selected = [];
            selected_equiments.forEach((element)=>{
                data_selected.push($(element).val());
            })
            
            if(to===null){
                Swal.fire({
                    position: "center",
                    icon: "warning",
                    title: "Selected Reciever",
                    showConfirmButton: false,
                    timer: 1000
                })
                return
            }

            if(data_selected.length===0){
                Swal.fire({
                    position: "center",
                    icon: "warning",
                    title: "Please Select equipment",
                    showConfirmButton: false,
                    timer: 1000
                })
            }else{
                Swal.fire({
                    title: `Do you want to reset the password of ${fullname}`,
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: "Yes",
                    denyButtonText: "No"
                }).then((result)=>{
                    if(data_selected.length!==0){
                        sendTransfer(from, to, tofullname, sex, current_email, birthday, email, pnumber, employee_id, department, position, result.isConfirmed, data_selected)
                    }
                })
            }
        })
        
        function sendTransfer(from, to, tofullname, sex, current_email, birthday, email, pnumber, employee_id, department, position, isResetPass, selected_equiments){
            $.ajax({
                url: '../../logic/dbtransferaccount.php',
                type: 'POST',
                data: {
                    from, to, tofullname, sex, current_email, birthday, email, pnumber, employee_id, department, position, isResetPass, selected_equiments
                },
                cache: false,
                beforeSend: ()=>{
                    $("#loader_div").css('display', 'block');
                },
                success: res=>{
                    $("#loader_div").css('display', 'none');
                    if(res!=='email is already used'){
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "Transfer Account success",
                            showConfirmButton: false,
                            timer: 1000
                        }).then(()=>{
                            window.location.reload();
                        });
                    }else{
                        Swal.fire({
                            position: "center",
                            icon: "error",
                            title: "Email is already used",
                            showConfirmButton: false,
                            timer: 1000
                        })
                    }
                 }
            })
        }

    </script>






</body>

</html>