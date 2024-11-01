<?php
require '../logic/dbCon.php';
session_start();
if (!isset($_SESSION['loginSession'])) {
    header('location: ../');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="icon" type="image/gif" href="imgOP/gif001.gif">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" /> -->
    <link rel="stylesheet" href="../styles/admin_dashboard.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />



</head>

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
                    <i class="fa-solid fa-laptop-file" id="active"></i>
                    <a href="admin_dashboard.php" id="active">DASHBOARD</a>
                </li>
                <?php if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'staff' || $_SESSION['role'] == 'storekeeper'): ?>
                    <?php if ($_SESSION['role'] == 'admin'): ?>
                        <li>
                            <i class="fa-solid fa-chart-simple"></i>
                            <a href="admin_analytics.php">ANALYTICS</a>
                        </li>

                        <li>
                            <i class="fa-solid fa-file-invoice"></i>
                            <a href="admin_transaction.php">TRANSACTION LOG</a>
                        </li>
                    <?php endif; ?>
                    <li>
                        <i class="fa-solid fa-cubes"></i>
                        <a href="admin_category.php">CATEGORY</a>
                    </li>
                <?php endif; ?>
                <li>
                    <i class="fa-solid fa-comment-dots"></i>
                    <a href="admin_messages.php">MESSAGES</a>
                </li>
                <?php if ($_SESSION['role'] == 'admin'): ?>
                    <li>
                        <i class="fa-solid fa-user"></i>
                        <a href="admin_useraccount.php">USER ACCOUNT</a>
                    </li>
                <?php endif; ?>
                <li>
                    <i class="fa-solid fa-gear"></i>
                    <a href="admin_settings.php">SETTINGS</a>
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
                        <input type="search" id="searchInput" placeholder="Search">
                    </div>

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

        <main>
            <div class="table-container">
                <table id="dataTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NAME</th>
                            <th>EQUIPMENT</th>
                            <th>QUANTITY</th>
                            <th>PRICE</th>
                            <th>STATUS</th>
                            <th>DATE AQUIRED</th>
                            <th>LOCATION</th>
                            <th>LIFESPAN</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <!-- Static data rows -->
                        <?php
                        $stmt = $conn->prepare("
                        SELECT * 
                        FROM dashboard
                        JOIN users ON users.usercode = dashboard.buyer
                        ORDER BY dashboard.id DESC
                        ");
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $i = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($i) . '</td>';
                            echo '<td>' . $row['fullname'] . '</td>';
                            echo '<td>' . $row['equipment'] . '</td>';
                            echo '<td>' . $row['quantity'] . '</td>';
                            echo '<td>' . $row['price'] . '</td>';
                            echo '<td>' . $row['status'] . '</td>';
                            echo '<td>' . $row['date_acquired'] . '</td>';
                            echo '<td>' . $row['location'] . '</td>';
                            echo '<td>' . $row['life_span'] . '</td>';
                            echo '</tr>';
                            $i++;
                        }
                        ?>
                    </tbody>
                </table>

                <div class="pagination" id="pagination">
                    <!-- Pagination buttons will be generated here -->
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
        const rowsPerPage = 6; // 6 rows per page
        const maxPageButtons = 3; // Number of page buttons to show at a time

        // Fetch static data from the table body
        const data = Array.from(tableBody.rows).map(row => Array.from(row.cells).map(cell => cell.textContent));
        const totalPages = Math.ceil(data.length / rowsPerPage);

        const searchInput = document.getElementById('searchInput');
        let filteredData = [...data];

        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            filteredData = data.filter(row =>
                row.some(cell => cell.toLowerCase().includes(searchTerm))
            );
            currentPage = 1;
            displayTable(currentPage);
        });

        function displayTable(page) {
            tableBody.innerHTML = '';
            const start = (page - 1) * rowsPerPage;
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
                renderPagination();
            }
        }

        function renderPagination() {
            paginationDiv.innerHTML = '';
            const totalPages = Math.ceil(filteredData.length / rowsPerPage);

            const prevButton = document.createElement('button');
            prevButton.textContent = '<';
            prevButton.onclick = prevPage;
            prevButton.disabled = currentPage === 1;
            paginationDiv.appendChild(prevButton);

            // Ensure at least three buttons are shown initially
            const startPage = Math.max(1, currentPage - Math.floor(maxPageButtons / 2));
            const endPage = Math.min(totalPages, startPage + maxPageButtons - 1);

            // Always show default pagination <1 2 3> if there are less than 4 pages
            if (totalPages <= 3) {
                for (let i = 1; i <= totalPages; i++) {
                    const pageSpan = document.createElement('span');
                    pageSpan.textContent = i;
                    pageSpan.className = (i === currentPage) ? 'active' : '';
                    pageSpan.onclick = () => goToPage(i);
                    paginationDiv.appendChild(pageSpan);
                }
            } else {
                // For more than 3 pages, handle pagination dynamically
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
            if (currentPage < Math.ceil(filteredData.length / rowsPerPage)) {
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

        displayTable(currentPage);
    </script>
</body>

</html>