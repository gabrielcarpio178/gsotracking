<?php
session_start();
// if ($_SESSION['role'] != 'admin') {
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
    <title>TRANSACTION</title>
    <link rel="icon" type="image/gif" href="../../styles/images/logo2.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link rel="stylesheet" href="../../styles/admin_transaction.css">
    <script src="../../scripts/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>

<body>
    <style>
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
                    <a href="equipment_transfer.php">EQUIPMENT TRANSFER</a>
                </li>

                <li>
                    <i class="fa-solid fa-chart-simple"></i>
                    <a href="analytics.php">Analytics</a>
                </li>
                <li>
                    <i class="fa-solid fa-file-invoice" id="active"></i>
                    <a href="transaction.php" id="active">TRANSACTION LOG</a>
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
                    <a href="equipment.php">Maintenance</a>
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
                    <div class="search">
                        <i class="fa-solid fa-search"></i>
                        <input type="search" id="searchInput" placeholder="Search">
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
        <main>
            
        </main>
    </div>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
    <script>
        // THIS IS THE BURGER BUTTON 
        $(document).ready(function() {
            $('#menu').click(function() {
                $(this).toggleClass('fa-times');
                $('header').toggleClass('toggle');

                $(window).on('scroll load', function() {

                    $('#menu').removeClass('fa-times');
                    $('header').removeClass('toggle');
                });
            });
        });

        // THIS IS THE TABLE FUNCTION PAGINATION
        const tableBody = document.getElementById('tableBody');
        const paginationDiv = document.getElementById('pagination');

        let currentPage = 1;
        const rowsPerPage = 6; // Changed from 6 to 10
        const maxPageButtons = 3; // Number of page buttons to show at a time

        // Fetch static data from the table body
        const data = Array.from(tableBody.rows).map(row => Array.from(row.cells).map(cell => cell.textContent));
        const totalPages = Math.ceil(data.length / rowsPerPage);

        function displayTable(page) {
            tableBody.innerHTML = '';
            const start = (page - 1) * rowsPerPage;
            const end = start + rowsPerPage;
            const paginatedData = data.slice(start, end);

            for (let row of paginatedData) {
                const tr = document.createElement('tr');
                for (let cell of row) {
                    const td = document.createElement('td');
                    td.textContent = cell;
                    tr.appendChild(td);
                }
                tableBody.appendChild(tr);
            }

            renderPagination(data.length); // Pass total number of items
        }

        function renderPagination(totalItems) {
            paginationDiv.innerHTML = '';
            const totalPages = Math.ceil(totalItems / rowsPerPage);

            const prevButton = document.createElement('button');
            prevButton.textContent = '<';
            prevButton.onclick = prevPage;
            prevButton.disabled = currentPage === 1;
            paginationDiv.appendChild(prevButton);

            const startPage = Math.max(1, currentPage - Math.floor(maxPageButtons / 2));
            const endPage = Math.min(totalPages, startPage + maxPageButtons - 1);

            if (startPage > 1) {
                const firstPageSpan = document.createElement('span');
                firstPageSpan.textContent = '1';
                firstPageSpan.onclick = () => goToPage(1);
                paginationDiv.appendChild(firstPageSpan);

                if (startPage > 2) {
                    const dots = document.createElement('span');
                    dots.textContent = '...';
                    dots.className = 'dots';
                    paginationDiv.appendChild(dots);
                }
            }

            for (let i = startPage; i <= endPage; i++) {
                const pageSpan = document.createElement('span');
                pageSpan.textContent = i;
                pageSpan.className = (i === currentPage) ? 'active' : '';
                pageSpan.onclick = () => goToPage(i);
                paginationDiv.appendChild(pageSpan);
            }

            if (endPage < totalPages) {
                if (endPage < totalPages - 1) {
                    const dots = document.createElement('span');
                    dots.textContent = '...';
                    dots.className = 'dots';
                    paginationDiv.appendChild(dots);
                }

                const lastPageSpan = document.createElement('span');
                lastPageSpan.textContent = totalPages;
                lastPageSpan.onclick = () => goToPage(totalPages);
                paginationDiv.appendChild(lastPageSpan);
            }

            const nextButton = document.createElement('button');
            nextButton.textContent = '>';
            nextButton.onclick = nextPage;
            nextButton.disabled = currentPage === totalPages;
            paginationDiv.appendChild(nextButton);
        }

        function nextPage() {
            if (currentPage < Math.ceil(data.length / rowsPerPage)) {
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

        // Modify the searchTable function
        function searchTable() {
            const searchInput = document.getElementById('searchInput');
            const filter = searchInput.value.toLowerCase();
            const filteredData = data.filter(row =>
                row.some(cell => cell.toLowerCase().includes(filter))
            );

            currentPage = 1;
            displayFilteredTable(filteredData);
        }

        // Modify the displayFilteredTable function
        function displayFilteredTable(filteredData) {
            tableBody.innerHTML = '';
            const start = (currentPage - 1) * rowsPerPage;
            const end = start + rowsPerPage;
            const paginatedData = filteredData.slice(start, end);

            if (paginatedData.length === 0) {
                // No results found
                const tr = document.createElement('tr');
                const td = document.createElement('td');
                td.textContent = 'No results found';
                td.colSpan = 9; // Span across all columns
                td.style.textAlign = 'center';
                tr.appendChild(td);
                tableBody.appendChild(tr);

                // Hide pagination
                paginationDiv.style.display = 'none';
            } else {
                // Display results
                for (let row of paginatedData) {
                    const tr = document.createElement('tr');
                    for (let cell of row) {
                        const td = document.createElement('td');
                        td.textContent = cell;
                        tr.appendChild(td);
                    }
                    tableBody.appendChild(tr);
                }

                // Show pagination
                paginationDiv.style.display = 'flex';
                renderPagination(filteredData.length);
            }
        }

        // Modify the initial display call
        displayTable(currentPage);

        // Add event listener for search input
        document.getElementById('searchInput').addEventListener('input', searchTable);

        displayTable(currentPage);
    </script>
</body>

</html>