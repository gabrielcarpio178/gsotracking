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
$stmt = $conn->prepare('SELECT DISTINCT equipment, category FROM dashboard ORDER BY category ASC, equipment ASC');
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

$stmt2 = $conn->prepare('SELECT * FROM dashboard ORDER BY id DESC');
$stmt2->execute();
$result2 = $stmt2->get_result();
$data2 = [
    'office' => [],
    'construction' => [],
    'electronics' => [],
    'it' => []
];
while ($row2 = $result2->fetch_assoc()) {
    $category2 = strtolower($row2['category']);
    if (array_key_exists($category2, $data2)) {
        $data2[$category2][] = $row2;
    }
}

// Fetch all office, construction, electronics, and IT data without limiting to 6 items
$data2['office'] = $data2['office']; // No slicing here
$data2['construction'] = $data2['construction']; // No slicing here
$data2['electronics'] = $data2['electronics']; // No slicing here
$data2['it'] = $data2['it']; // No slicing here
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CATEGORY</title>
    <link rel="icon" type="image/gif" href="imgOP/gif001.gif">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../styles/admin_category.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        .quantity-input {
            display: flex;
            align-items: center;
            justify-content: flex-start;
        }

        .quantity-input input {
            width: 50px;
            text-align: center;
            margin: 0 5px;
            height: 30px;
        }

        .quantity-btn {
            background-color: #f0f0f0;
            border: 1px solid #ddd;
            padding: 5px 10px;
            cursor: pointer;
            text-align: center;
            align-items: center;
            justify-content: center;
            display: flex;
            border-radius: 50%;
        }

        .price {
            display: flex;
            align-items: center;
            margin-left: 2rem;
        }

        .price input {
            width: 100%;
            margin-left: 5px;
        }

        .edit-modal-body {
            display: flex;
            flex-direction: row;
            align-items: center;
            flex-wrap: wrap;
        }

        .edit-modal-body>* {
            margin-right: 1rem;
        }

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        .pagination button,
        .pagination span {
            background-color: #f0f0f0;
            border: 1px solid #ddd;
            padding: 5px 10px;
            cursor: pointer;
            margin: 0 5px;
        }

        .pagination .active {
            background-color: #007bff;
            color: white;
        }

        .pagination .dots {
            cursor: default;
        }


        /* style of the table of officecontent */

        .officecontent .styled-table {
            width: 100%;
            border-collapse: collapse;
        }

        .officecontent .styled-table th,
        .officecontent .styled-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
            width: 20%;
            font-size: 1.2rem;
        }

        .officecontent .styled-table th {
            background-color: #c1c1c1;
            font-weight: bold;
            padding: 20px;
            text-align: center;

        }

        .officecontent .styled-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .officecontent .styled-table tr:hover {
            background-color: #ddd;
        }

        .styled-table tbody .edit-btn,
        .styled-table tbody .delete-btn {
            padding: 5px 10px;
            margin: 0 5px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        .styled-table tbody .edit-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            width: 70px;
        }

        .styled-table tbody .delete-btn {
            background-color: #f44336;
            color: white;
            padding: 10px;
            width: 70px;
        }
    </style>
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
                    <i class="fa-solid fa-cubes" id="active"></i>
                    <a href="category.php" id="active">EQUIPMENT LIST</a>
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
                    <div class="search">
                        <i class="fa-solid fa-search"></i>
                        <input type="search" placeholder="Search" class="search-input">
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

        <div class="containermain">
            <span id="category">Category of Equipments</span>
            <div class="boxes">
                <div class="box" id="box1">
                    <img src="../styles/images/desk.png" alt="">
                    <span>Office</span>
                    <button>Select</button>
                </div>
                <div class="box" id="box2">
                    <img src="../styles/images/shovel.png" alt="">
                    <span>Construction</span>
                    <button>Select</button>
                </div>
                <div class="box" id="box3">
                    <img src="../styles/images/Electronics.png" alt="">
                    <span>Electronics</span>
                    <button>Select</button>
                </div>
                <div class="box" id="box4"><img src="../styles/images/My Computer.png" alt="">
                    <span>IT</span>
                    <button>Select</button>
                </div>
            </div>
        </div>

        <div class="officecontent">
            <div class="officeheader">Product list</div>
            <div class="mainoffice">
                <div class="mainofficeheader back-button">
                    <i class="fa-solid fa-angle-left"></i>
                    <span>Office</span>
                </div>
                <div class="mainofficecontent">
                    <button id="openOfficeAddProductModal" class="add-product-btn">Add New Product</button>
                </div>
            </div>
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>Equipment</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="officeTbody">
                    <!-- Add your table rows here -->
                    <?php
                    foreach ($data2['office'] as $row2) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($row2['equipment']) . '</td>';
                        echo '<td>' . htmlspecialchars($row2['quantity']) . '</td>';
                        echo '<td>' . htmlspecialchars($row2['price']) . '</td>';
                        echo '<td>' . htmlspecialchars($row2['date_acquired']) . '</td>';
                        echo '<td>
                            <button class="edit-btn">edit</button>
                        </td>';
                        echo '</tr>';
                    }
                    ?>
                    </tr>
                </tbody>
            </table>
            <div class="pagination pagination-office">
                <!-- Pagination buttons will be appended here -->
            </div>
        </div>


        <div class="constructioncontent">
            <div class="constructionheader">Add New Product</div>

            <div class="mainconstruction">
                <div class="mainconstructionheader back-button">
                    <i class="fa-solid fa-angle-left"></i>
                    <span>Construction</span>
                </div>

                <div class="mainconstructioncontent">
                    <button id="openConstructionAddProductModal" class="add-product-btn">Add New Product</button>
                </div>
            </div>
            <table class="styled-table construction-table">
                <thead>
                    <tr>
                        <th>Equipment</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="constructionTbody">
                    <!-- Add your table rows here -->
                    <?php
                    foreach ($data2['construction'] as $row2) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($row2['equipment']) . '</td>';
                        echo '<td>' . htmlspecialchars($row2['quantity']) . '</td>';
                        echo '<td>' . htmlspecialchars($row2['price']) . '</td>';
                        echo '<td>' . htmlspecialchars($row2['date_acquired']) . '</td>';
                        echo '<td>
                            <button class="edit-btn">edit</button>
                        </td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
            <div class="pagination pagination-construction">
                <!-- Pagination buttons will be appended here -->
            </div>
        </div>




        <div class="electronicscontent">

            <div class="electronicsheader">
                Add New Product
            </div>

            <div class="mainelectronics">
                <div class="mainelectronicsheader back-button">
                    <i class="fa-solid fa-angle-left"></i>
                    <span>Electronics</span>
                </div>

                <div class="mainelectronicscontent">
                    <button id="openElectronicsAddProductModal" class="add-product-btn">Add New Product</button>
                </div>
            </div>

            <!-- <div class="search-container">
                <input type="text" class="search-input" placeholder="Search equipment...">
            </div> -->
            <table class="styled-table electronics-table">
                <thead>
                    <tr>
                        <th>Equipment</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="electronicsTbody">
                    <!-- Add your table rows here -->
                    <?php
                    foreach ($data2['electronics'] as $row2) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($row2['equipment']) . '</td>';
                        echo '<td>' . htmlspecialchars($row2['quantity']) . '</td>';
                        echo '<td>' . htmlspecialchars($row2['price']) . '</td>';
                        echo '<td>' . htmlspecialchars($row2['date_acquired']) . '</td>';
                        echo '<td>
                            <button class="edit-btn">edit</button>
                        </td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
            <div class="pagination pagination-electronics">
                <!-- Pagination buttons will be appended here -->
            </div>
        </div>


        <div class="itcontent">
            <div class="itheader">
                Add New Product
            </div>

            <div class="mainit">
                <div class="mainitheader back-button">
                    <i class="fa-solid fa-angle-left"></i>
                    <span>IT</span>
                </div>

                <div class="mainitcontent">
                    <button id="openItAddProductModal" class="add-product-btn">Add New Product</button>
                </div>
            </div>

            <!-- <div class="search-container">
                <input type="text" class="search-input" placeholder="Search equipment...">
            </div> -->
            <table class="styled-table it-table">
                <thead>
                    <tr>
                        <th>Equipment</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="itTbody">
                    <!-- Add your table rows here -->
                    <?php
                    foreach ($data2['it'] as $row2) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($row2['equipment']) . '</td>';
                        echo '<td>' . htmlspecialchars($row2['quantity']) . '</td>';
                        echo '<td>' . htmlspecialchars($row2['price']) . '</td>';
                        echo '<td>' . htmlspecialchars($row2['date_acquired']) . '</td>';
                        echo '<td>
                            <button class="edit-btn">edit</button>
                        </td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
            <div class="pagination pagination-it">
                <!-- Pagination buttons will be appended here -->
            </div>
        </div>
    </div>

    <!-- Single Edit Modal -->
    <div id="editModal" class="it-edit-modal">
        <div class="it-edit-modal-content">
            <span class="it-edit-close">&times;</span>
            <h2>Edit Equipment</h2>
            <div class="it-edit-modal-body">
                <label for="editEquipmentInput">Equipment:</label>
                <input type="text" id="editEquipmentInput">
                <label for="editQuantityInput">Quantity:</label>
                <input type="text" id="editQuantityInput">
                <label for="editPriceInput">Price:</label>
                <input type="text" id="editPriceInput">
                <label for="editDateInput">Date:</label>
                <input type="text" id="editDateInput">
            </div>
            <div class="it-edit-modal-footer">
                <button id="saveEdit">Save</button>
            </div>
        </div>
    </div>

    <!-- Single Delete Confirmation Modal -->
    <div id="deleteConfirmationModal" class="it-delete-modal">
        <div class="it-delete-modal-content">
            <span class="it-delete-close">&times;</span>
            <h2>Are you sure you want to delete this?</h2>
            <div class="it-delete-modal-footer">
                <button id="confirmDelete">Yes, delete it</button>
                <button id="cancelDelete">Cancel</button>
            </div>
        </div>
    </div>

    <!-- Add Product Modals -->
    <div id="officeAddProductModal" class="edit-modal">
        <div class="edit-modal-content">
            <span class="edit-close">&times;</span>
            <h2>Add New Office Product</h2>
            <div class="edit-modal-body">
                <label for="officeAddEquipmentInput">Equipment:</label>
                <div class="dropdown">
                    <input type="text" id="officeAddEquipmentInput" placeholder="Enter item name or select from dropdown">
                    <i class="fa-solid fa-angle-down dropdown-arrow"></i>
                    <div class="dropdown-content">
                        <?php
                        foreach ($data['office'] as $equipment) {
                            echo '<div class="dropdown-item">' . htmlspecialchars($equipment) . '</div>';
                        }
                        ?>
                    </div>
                </div>
                <label for="officeAddQuantityInput">Quantity:</label>
                <div class="quantity-input">
                    <button class="quantity-btn" id="decrease">-</button>
                    <input type="text" id="officeAddQuantityInput" value="1">
                    <button class="quantity-btn" id="increase">+</button>

                    <div class="price">
                        <label for="officeAddPriceInput">Price:</label>
                        <input type="text" id="officeAddPriceInput">
                    </div>
                </div>


            </div>
            <div class="edit-modal-footer">
                <button id="saveOfficeNewProduct">Add</button>
            </div>
        </div>
    </div>

    <div id="constructionAddProductModal" class="edit-modal">
        <div class="edit-modal-content">
            <span class="edit-close">&times;</span>
            <h2>Add New Construction Product</h2>
            <div class="edit-modal-body">
                <label for="constructionAddEquipmentInput">Equipment:</label>
                <div class="dropdown">
                    <input type="text" id="constructionAddEquipmentInput" placeholder="Enter item name or select from dropdown">
                    <i class="fa-solid fa-angle-down dropdown-arrow"></i>
                    <div class="dropdown-content">
                        <?php
                        foreach ($data['construction'] as $equipment) {
                            echo '<div class="dropdown-item">' . htmlspecialchars($equipment) . '</div>';
                        }
                        ?>
                    </div>
                </div>
                <label for="constructionAddQuantityInput">Quantity:</label>
                <div class="quantity-input">
                    <button class="quantity-btn" id="decrease">-</button>
                    <input type="text" id="constructionAddQuantityInput" value="1">
                    <button class="quantity-btn" id="increase">+</button>
                    <div class="price">
                        <label for="constructionAddPriceInput">Price:</label>
                        <input type="text" id="constructionAddPriceInput">
                    </div>
                </div>



            </div>
            <div class="edit-modal-footer">
                <button id="saveConstructionNewProduct">Add</button>
            </div>
        </div>
    </div>

    <div id="electronicsAddProductModal" class="edit-modal">
        <div class="edit-modal-content">
            <span class="edit-close">&times;</span>
            <h2>Add New Electronics Product</h2>
            <div class="edit-modal-body">
                <label for="electronicsAddEquipmentInput">Equipment:</label>
                <div class="dropdown">
                    <input type="text" id="electronicsAddEquipmentInput" placeholder="Enter item name or select from dropdown">
                    <i class="fa-solid fa-angle-down dropdown-arrow"></i>
                    <div class="dropdown-content">
                        <?php
                        foreach ($data['electronics'] as $equipment) {
                            echo '<div class="dropdown-item">' . htmlspecialchars($equipment) . '</div>';
                        }
                        ?>
                    </div>
                </div>
                <label for="electronicsAddQuantityInput">Quantity:</label>
                <div class="quantity-input">
                    <button class="quantity-btn" id="decrease">-</button>
                    <input type="text" id="electronicsAddQuantityInput" value="1">
                    <button class="quantity-btn" id="increase">+</button>
                </div>
                <label for="electronicsAddPriceInput">Price:</label>
                <input type="text" id="electronicsAddPriceInput">
            </div>
            <div class="edit-modal-footer">
                <button id="saveElectronicsNewProduct">Add</button>
            </div>
        </div>
    </div>

    <div id="itAddProductModal" class="edit-modal">
        <div class="edit-modal-content">
            <span class="edit-close">&times;</span>
            <h2>Add New IT Product</h2>
            <div class="edit-modal-body">
                <label for="itAddEquipmentInput">Equipment:</label>
                <div class="dropdown">
                    <input type="text" id="itAddEquipmentInput" placeholder="Enter item name or select from dropdown">
                    <i class="fa-solid fa-angle-down dropdown-arrow"></i>
                    <div class="dropdown-content">
                        <?php
                        foreach ($data['it'] as $equipment) {
                            echo '<div class="dropdown-item">' . htmlspecialchars($equipment) . '</div>';
                        }
                        ?>
                    </div>
                </div>
                <label for="itAddQuantityInput">Quantity:</label>
                <div class="quantity-input">
                    <button class="quantity-btn" id="decrease">-</button>
                    <input type="text" id="itAddQuantityInput" value="1">
                    <button class="quantity-btn" id="increase">+</button>
                </div>
                <label for="itAddPriceInput">Price:</label>
                <input type="text" id="itAddPriceInput">
            </div>
            <div class="edit-modal-footer">
                <button id="saveItNewProduct">Add</button>
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

            // Check localStorage for the last viewed content
            const lastContent = localStorage.getItem('lastContent');
            if (lastContent) {
                replaceMainContent(lastContent);
            } else {
                replaceMainContent('.containermain');
            }

            // Function to replace main content and hide other sections
            function replaceMainContent(contentToShow) {
                // Hide all sections first
                $('.containermain, .officecontent, .constructioncontent, .electronicscontent, .itcontent').hide();
                // Show only the selected section
                $(contentToShow).show();
                // Save the current content to localStorage only if it's not containermain
                if (contentToShow !== '.containermain') {
                    localStorage.setItem('lastContent', contentToShow);
                } else {
                    localStorage.removeItem('lastContent');
                }
            }

            // Box 1 - Office
            $('#box1 button').click(function() {
                replaceMainContent('.officecontent');
            });

            // Box 2 - Construction
            $('#box2 button').click(function() {
                replaceMainContent('.constructioncontent');
            });

            // Box 3 - Electronics
            $('#box3 button').click(function() {
                replaceMainContent('.electronicscontent');
            });

            // Box 4 - IT
            $('#box4 button').click(function() {
                replaceMainContent('.itcontent');
            });

            // Back button functionality
            $('.back-button').click(function() {
                $('.search-input').val(''); // Clear all search inputs
                $('.styled-table tbody tr').show(); // Show all table rows
                replaceMainContent('.containermain');
            });

            // Toggle dropdown content visibility
            $('.dropdown-arrow').click(function() {
                $(this).siblings('.dropdown-content').toggle();
            });

            // Set input value to the clicked dropdown item
            $('.dropdown-item').click(function() {
                $(this).closest('.dropdown').find('input[type="text"]').val($(this).text());
                $('.dropdown-content').hide();
            });

            // Hide dropdown content when clicking outside
            $(document).click(function(event) {
                if (!$(event.target).closest('.dropdown').length) {
                    $('.dropdown-content').hide();
                }
            });

            // Quantity buttons functionality
            $('.quantity-btn').click(function() {
                let input = $(this).siblings('input[type="text"]');
                let quantity = parseInt(input.val());
                if ($(this).attr('id') === 'increase') {
                    input.val(quantity + 1);
                } else if ($(this).attr('id') === 'decrease' && quantity > 1) {
                    input.val(quantity - 1);
                }
            });

            // Function to fetch and load table data
            function loadTableData(category) {
                $.ajax({
                    url: '../ajax-logic/fetchDataCategory.php',
                    method: 'POST',
                    data: {
                        category: category
                    },
                    success: function(response) {
                        const data = JSON.parse(response);
                        const tbody = $(`#${category}Tbody`);
                        tbody.empty();
                        data.slice(0, 6).forEach(item => { // Limit to 6 items
                            const row = `
                                <tr data-id="${item.id}">
                                    <td>${item.equipment}</td>
                                    <td>${item.quantity}</td>
                                    <td>${item.price}</td>
                                    <td>${item.date_acquired}</td>
                                    <td>
                                        <button class="edit-btn">Edit</button>
                                    </td>
                                </tr>
                            `;
                            tbody.append(row);
                        });
                        // Reset search after loading new data
                        let searchInput = tbody.closest('.officecontent, .constructioncontent, .electronicscontent, .itcontent').find('.search-input');
                        searchInput.val('');
                        performSearch(searchInput);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching data:", error);
                    }
                });
            }

            // Load initial data for each category
            ['office', 'construction', 'electronics', 'it'].forEach(category => {
                loadTableData(category);
            });

            // Function to add a new product
            function addNewProduct(category, modalSelector) {
                const equipment = $(`${modalSelector} input[id$="AddEquipmentInput"]`).val();
                const quantity = $(`${modalSelector} input[id$="AddQuantityInput"]`).val();
                const price = $(`${modalSelector} input[id$="AddPriceInput"]`).val();

                $.ajax({
                    url: '../ajax-logic/addDataCategory.php',
                    method: 'POST',
                    data: {
                        category: category,
                        equipment: equipment,
                        quantity: quantity,
                        price: price
                    },
                    success: function(response) {
                        const result = JSON.parse(response);
                        if (result.success) {
                            loadTableData(category);
                            $(modalSelector).hide();
                            $(`${modalSelector} input[type="text"]`).val('');
                            $(`${modalSelector} input[id$="AddQuantityInput"]`).val('1');
                        } else {
                            showErrorMessage(result.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error adding product:", error);
                    }
                });
            }

            // Event handlers for saving new products
            $('#saveOfficeNewProduct').click(function() {
                addNewProduct('office', '#officeAddProductModal');
            });

            $('#saveConstructionNewProduct').click(function() {
                addNewProduct('construction', '#constructionAddProductModal');
            });

            $('#saveElectronicsNewProduct').click(function() {
                addNewProduct('electronics', '#electronicsAddProductModal');
            });

            $('#saveItNewProduct').click(function() {
                addNewProduct('it', '#itAddProductModal');
            });

            // Function to edit a product
            function editProduct(id, category, equipment, quantity, price) {
                $.ajax({
                    url: '../ajax-logic/editDataCategory.php',
                    method: 'POST',
                    data: {
                        id: id,
                        category: category,
                        equipment: equipment,
                        quantity: quantity,
                        price: price
                    },
                    success: function(response) {
                        const result = JSON.parse(response);
                        if (result.success) {
                            loadTableData(category);
                            $('#editModal').hide();
                        } else {
                            showErrorMessage(result.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error editing product:", error);
                    }
                });
            }

            // Event handler for saving edits
            $('#saveEdit').click(function() {
                const id = $(this).data('id');
                const category = $(this).data('category');
                const equipment = $('#editEquipmentInput').val();
                const quantity = $('#editQuantityInput').val();
                const price = $('#editPriceInput').val();
                editProduct(id, category, equipment, quantity, price);
            });

            // Function to delete a product
            function deleteProduct(id, category) {
                $.ajax({
                    url: '../ajax-logic/deleteDataCategory.php',
                    method: 'POST',
                    data: {
                        id: id,
                        category: category
                    },
                    success: function(response) {
                        const result = JSON.parse(response);
                        if (result.success) {
                            loadTableData(category);
                            $('#deleteConfirmationModal').hide();
                        } else {
                            showErrorMessage(result.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error deleting product:", error);
                    }
                });
            }

            // Event handler for confirming delete
            $('#confirmDelete').click(function() {
                const id = $(this).data('id');
                const category = $(this).data('category');
                deleteProduct(id, category);
            });

            // Event delegation for edit and delete buttons
            $(document).on('click', '.edit-btn', function() {
                const row = $(this).closest('tr');
                const id = row.data('id');
                const category = row.closest('tbody').attr('id').replace('Tbody', '');
                const equipment = row.find('td:eq(0)').text();
                const quantity = row.find('td:eq(1)').text();
                const price = row.find('td:eq(2)').text();

                $('#editEquipmentInput').val(equipment);
                $('#editQuantityInput').val(quantity);
                $('#editPriceInput').val(price);
                $('#saveEdit').data('id', id).data('category', category);

                $('#editModal').show();
            });

            // Function to show an error message
            function showErrorMessage(message) {
                alert(message); // You can replace this with a more sophisticated error display method
            }

            // Open Add Product Modal
            $('#openOfficeAddProductModal').click(function() {
                $('#officeAddProductModal').show();
            });

            $('#openConstructionAddProductModal').click(function() {
                $('#constructionAddProductModal').show();
            });

            $('#openElectronicsAddProductModal').click(function() {
                $('#electronicsAddProductModal').show();
            });

            $('#openItAddProductModal').click(function() {
                $('#itAddProductModal').show();
            });

            // Close Add Product Modals
            $('.edit-close').click(function() {
                $(this).closest('.edit-modal').hide();
            });

            // Close modals when clicking on <span> (x)
            $('.close').click(function() {
                $(this).closest('.modal').hide();
            });

            // Close modals when clicking outside of the modal
            $(window).click(function(event) {
                if ($(event.target).hasClass('modal')) {
                    $('.modal').hide();
                }
            });

            // Make price input accept only numbers
            $('input[id$="AddPriceInput"], input[id$="AddQuantityInput"]').on('input', function() {
                this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
            });

            // Function to perform search
            function performSearch(input) {
                let filter = input.val().toUpperCase();
                let table = input.closest('.officecontent, .constructioncontent, .electronicscontent, .itcontent').find('table');
                let rows = table.find('tbody tr');

                rows.each(function() {
                    let equipmentCell = $(this).find('td:first');
                    let equipment = equipmentCell.text().toUpperCase();
                    if (equipment.indexOf(filter) > -1) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }

            // Add event listener for search inputs
            $(document).on('input', '.search-input', function() {
                performSearch($(this));
            });

            // Function to perform search across all tables
            function performGlobalSearch(input) {
                let filter = input.val().toUpperCase();
                let tables = $('.styled-table');

                tables.each(function() {
                    let rows = $(this).find('tbody tr');
                    rows.each(function() {
                        let equipmentCell = $(this).find('td:first');
                        let equipment = equipmentCell.text().toUpperCase();
                        if (equipment.indexOf(filter) > -1) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });
                });
            }

            // Add event listener for the top search input
            $('.header .search-input').on('input', function() {
                performGlobalSearch($(this));
            });

            const rowsPerPage = 6;
            let currentPageOffice = 1;
            let currentPageConstruction = 1;
            let currentPageElectronics = 1;
            let currentPageIT = 1;
            let officeData = <?php echo json_encode($data2['office']); ?>;
            let constructionData = <?php echo json_encode($data2['construction']); ?>;
            let electronicsData = <?php echo json_encode($data2['electronics']); ?>;
            let itData = <?php echo json_encode($data2['it']); ?>;

            function displayTable(data, tbodySelector, page) {
                const tbody = $(tbodySelector);
                tbody.empty();
                const start = (page - 1) * rowsPerPage;
                const end = start + rowsPerPage;
                const paginatedData = data.slice(start, end);

                paginatedData.forEach(item => {
                    const row = `
                        <tr data-id="${item.id}">
                            <td>${item.equipment}</td>
                            <td>${item.quantity}</td>
                            <td>${item.price}</td>
                            <td>${item.date_acquired}</td>
                            <td>
                                <button class="edit-btn">Edit</button>
                            </td>
                        </tr>
                    `;
                    tbody.append(row);
                });
            }

            function renderPagination(data, paginationSelector, currentPage, displayFunction) {
                const paginationDiv = $(paginationSelector);
                paginationDiv.empty();
                const totalPages = Math.ceil(data.length / rowsPerPage);

                const prevButton = $('<button class="prev-page">Prev</button>');
                prevButton.prop('disabled', currentPage === 1);
                prevButton.click(() => {
                    if (currentPage > 1) {
                        currentPage--;
                        displayFunction(currentPage);
                    }
                });
                paginationDiv.append(prevButton);

                for (let i = 1; i <= totalPages; i++) {
                    const pageButton = $(`<button class="page-number">${i}</button>`);
                    if (i === currentPage) {
                        pageButton.addClass('active');
                    }
                    pageButton.click(() => {
                        currentPage = i;
                        displayFunction(currentPage);
                    });
                    paginationDiv.append(pageButton);
                }

                const nextButton = $('<button class="next-page">Next</button>');
                nextButton.prop('disabled', currentPage === totalPages);
                nextButton.click(() => {
                    if (currentPage < totalPages) {
                        currentPage++;
                        displayFunction(currentPage);
                    }
                });
                paginationDiv.append(nextButton);
            }

            function displayOfficeTable(page) {
                displayTable(officeData, '#officeTbody', page);
                renderPagination(officeData, '.pagination-office', page, displayOfficeTable);
            }

            function displayConstructionTable(page) {
                displayTable(constructionData, '#constructionTbody', page);
                renderPagination(constructionData, '.pagination-construction', page, displayConstructionTable);
            }

            function displayElectronicsTable(page) {
                displayTable(electronicsData, '#electronicsTbody', page);
                renderPagination(electronicsData, '.pagination-electronics', page, displayElectronicsTable);
            }

            function displayITTable(page) {
                displayTable(itData, '#itTbody', page);
                renderPagination(itData, '.pagination-it', page, displayITTable);
            }

            displayOfficeTable(currentPageOffice);
            displayConstructionTable(currentPageConstruction);
            displayElectronicsTable(currentPageElectronics);
            displayITTable(currentPageIT);
        });
    </script>
</body>

</html>