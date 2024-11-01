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
    <title>ACCOUNTABILITY</title>
    <link rel="icon" type="image/gif" href="imgOP/gif001.gif">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" /> -->
    <link rel="stylesheet" href="../../styles/accountability.css?v=1.1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        .noti_bell{
            position: relative;
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
    </style>
</head>

<body>

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
                    <i class="fa-solid fa-cubes"></i>
                    <a href="purchase_request.php">PURCHASE REQUEST</a>
                </li>
                <li>
                    <i class="fa-solid fa-chalkboard-user" id="active"></i>
                    <a href="accountability.php" id="active">ACCOUNTABILITY</a>
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
                            <a href=""><i class="fa-solid fa-bell"></i></a>
                        </div>
                        <div class="profile">
                            <img src="../<?php echo $profile = $row['profile']; ?>" alt="">
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
                            <th>DATE REQUESTED</th>
                            <th>STATUS</th>
                            <!-- <th>SPECS</th> -->
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <?php
                        $stmt = $conn->prepare("
                            SELECT * FROM purchase_request_list
                            JOIN purchase_request ON purchase_request.purchase_request_code = purchase_request_list.purchase_request_code
                            WHERE purchase_request.requester_code = ?
                        ");
                        $status = 'success';
                        $stmt->bind_param('s', $usercode);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['purchase_request_code']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['item_name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['quantity']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['price']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['datetime']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['status']) . "</td>";

                            // Decode the specs JSON
                            // $specs = json_decode($row['specs'], true);

                            // if ($specs && is_array($specs)) {
                            //     echo '<td><ul>';
                            //     foreach ($specs as $key => $value) {
                            //         // Add spaces or format the keys as desired
                            //         $formattedKey = str_replace('_', ' ', ucfirst($key));  // Replace underscores with spaces
                            //         echo '<li>' . $formattedKey . ': ' . htmlspecialchars($value) . '</li>';
                            //     }
                            //     echo '</ul></td>';
                            // } else {
                            //     echo '<td>No specs available</td>';
                            // }

                            echo "</tr>";
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
    <script>
        // THIS IS THE TABLE FUNCTION PAGINATION
        const tableBody = document.getElementById('tableBody');
        const paginationDiv = document.getElementById('pagination');
        const searchInput = document.getElementById('searchInput');

        let currentPage = 1;
        const rowsPerPage = 6; // 6 rows per page
        const maxPageButtons = 3; // Number of page buttons to show at a time

        let data = []; // To hold the original table data

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

        function filterData() {
            const query = searchInput.value.toLowerCase();
            return data.filter(row => row.some(cell => cell.toLowerCase().includes(query)));
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

        fetchTableData();
    </script>
</body>

</html>