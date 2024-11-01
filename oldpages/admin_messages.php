<?php
require '../logic/dbCon.php';
session_start();

$stmt = $conn->prepare("SELECT * FROM users WHERE usercode = ?");
$stmt->bind_param('s', $_SESSION['usercode']);
$stmt->execute();
$result = $stmt->get_result();
$userData = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>MESSAGES</title>
    <link rel="icon" type="image/gif" href="imgOP/gif001.gif">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" /> -->
    <link rel="stylesheet" href="../styles/admin_messages.css?v=1.1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script>
        <?php
        if (isset($_SESSION['message'])) {
            echo 'alert("' . $_SESSION['message'] . '");';
        }
        unset($_SESSION['message']);
        ?>
    </script>
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
                    <i class="fa-solid fa-laptop-file"></i>
                    <a href="admin_dashboard.php">DASHBOARD</a>
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
                    <i class="fa-solid fa-comment-dots" id="active"></i>
                    <a href="admin_messages.php" id="active">MESSAGES</a>
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
                    <div class="logo"><img src="../styles/images/logo1.png" alt=""></div>
                    <p>Qr Code Scanning with Informed Mechanism <br> Driven and Equipment Tracking System</p>
                </div>
            </div>
            <div class="div2">
                <div class="content2">
                    <div class="search">
                        <i class="fa-solid fa-search"></i>
                        <input type="search" placeholder="Search" class="search-input" id="search-input">
                    </div>
                    <div class="notpic">
                        <div class="ahehe">
                            <a href=""><i class="fa-solid fa-bell"></i></a>
                        </div>
                        <div class="profile"><img src="../styles/images/logo1.png" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="containermain">
            <div class="compose">
                <i class="fa-solid fa-pencil"></i>
                <button id="show-modal-btn">Compose</button>
            </div>
            <div class="containermain-header">
                <h1>MESSAGES</h1>
            </div>

            <div class="containermain-body">

                <div id="overlay">
                    <div id="modal">
                        <form action="../logic/sendMessage.php" method="post">
                            <div class="modal-header">
                                <button id="close-modal-btn">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="from">From:</label>
                                    <input type="text" id="from" name="from" value="<?php echo $_SESSION['email']; ?>" readonly />
                                </div>
                                <div class="form-group">
                                    <label for="to">To:</label>
                                    <input type="text" id="to" name="to" oninput="searchUsersEmail(this)" required>
                                    <input type="hidden" id="usercode" name="usercode" />
                                    <ul id="sendTo"></ul>
                                </div>
                                <textarea id="message" name="message" rows="10" placeholder="Type your message here..." required></textarea>
                            </div>
                            <div class="modalfooter">
                                <i class="fa-solid fa-paper-plane"></i>
                                <button id="send-message-btn" type="submit">Send</button>
                            </div>
                        </form>
                    </div>
                </div>


                <div class="recently">
                    <h3>Recently</h3>
                </div>

                <?php
                echo '' . $_SESSION['usercode'] . '';
                $stmt = $conn->prepare("
                SELECT * 
                FROM messages 
                JOIN users ON messages.sender = users.usercode
                WHERE messages.sender = ? OR messages.receiver = ?
                ORDER BY messages.datetime DESC
                ");
                $usercode = $_SESSION['usercode'];
                $stmt->bind_param("ss", $usercode, $usercode);
                $stmt->execute();
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {

                    $whoIsSender = $row['sender'] == $_SESSION['usercode'] ? 'to: ' . ($row['receiver'] == $_SESSION['usercode'] ? 'me' : quickQuery($conn, $row['receiver'], 'fullname')) : 'from: ' . quickQuery($conn, $row['sender'], 'fullname');

                    $profile = $row['sender'] == $_SESSION['usercode'] ? (quickQuery($conn, $row['receiver'], 'profile') != '' ? quickQuery($conn, $row['receiver'], 'profile') : (quickQuery($conn, $row['receiver'], 'gender') == 'male' ? '../styles/images/boy.jpeg' : '../styles/images/girl.jpeg')) : (quickQuery($conn, $row['sender'], 'profile') != '' ? quickQuery($conn, $row['sender'], 'profile') : (quickQuery($conn, $row['sender'], 'gender') == 'male' ? '../styles/images/boy.jpeg' : '../styles/images/girl.jpeg'));

                    $whoMessage = $row['sender'] == $_SESSION['usercode'] ? 'You message... ' . ($row['receiver'] == $row['sender'] ? 'ur self' : quickQuery($conn, $row['receiver'], 'fullname')) : quickQuery($conn, $row['sender'], 'fullname') . '... Message you papi';

                    $time = $row['datetime'];
                    $timeAgo = timeAgo($time);
                    echo '
                    <div class="message" data-sender="' . $whoIsSender . '">
                        <div class="user-info">
                            <div class="userimage">
                                <img src="' . $profile . '" alt="">
                            </div>
                            <div class="username">
                                <h3>' . $whoIsSender . '</h3>
                            </div>
                        </div>
                        <div class="messagearea">
                            <p class="short-text">' . $whoMessage . '</p>
                            <p class="more-text" style="display: none;">' . $row['message'] . '</p>
                            <a href="#" class="see-more">See More</a>
                        </div>
                        <div class="time">
                            <span>' . $timeAgo . '</span>
                        </div>
                    </div>
                    ';
                }
                ?>

            </div>

            <!-- Pagination controls -->
            <div class="pagination">
                <a href="#" class="prev"><i class="fa-solid fa-arrow-left"></i></a>
                <a href="#" class="page-num">1</a>
                <a href="#" class="page-num">2</a>
                <a href="#" class="page-num">3</a>
                <a href="#" class="next"><i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        function searchUsersEmail(searchInput) {
            const ul = document.getElementById('sendTo');
            ul.style.display = 'none'; // Hide initially

            $.ajax({
                url: '../ajax-logic/fetchUsersEmail.php',
                type: 'POST',
                data: {
                    search: searchInput.value
                },
                success: function(response) {
                    ul.innerHTML = '';
                    const users = JSON.parse(response);
                    users.forEach(function(user) {
                        const li = document.createElement('li');
                        li.textContent = "email: " + user.email + " / name: " + user.fullname
                        li.dataset.usercode = user.usercode;
                        li.onclick = function() {
                            document.getElementById('usercode').value = user.usercode;
                            document.getElementById('to').value = user.email; // Set input value
                            ul.style.display = 'none'; // Hide the list after selection
                        };
                        ul.appendChild(li);
                    });
                    ul.style.display = users.length > 0 ? 'block' : 'none'; // Show or hide based on results
                }
            });
        }

        function validateEmail(email) {
            return $.ajax({
                url: '../ajax-logic/validateEmail.php', // Create this PHP file to check email
                type: 'POST',
                data: {
                    email: email
                }
            });
        }

        document.querySelector('#send-message-btn').addEventListener('click', function(e) {
            const emailTo = document.getElementById('to').value;
            e.preventDefault(); // Prevent form submission initially

            validateEmail(emailTo).then(response => {
                const data = JSON.parse(response);
                if (data.email === 'exists') {
                    document.getElementById('usercode').value = data.usercode;
                    document.querySelector('form').submit(); // Submit the form if email exists
                } else {
                    alert('The email does not match any user. Please select a valid email from the list or enter a valid one.');
                }
            });
        });

        // Hide the list when input is not focused
        document.getElementById('to').addEventListener('blur', function() {
            const ul = document.getElementById('sendTo');
            ul.style.display = 'none'; // Hide the list when input loses focus
        });

        // Close button functionality
        document.addEventListener('click', function(event) {
            const ul = document.getElementById('sendTo');
            if (!ul.contains(event.target) && event.target.id !== 'to') {
                ul.style.display = 'none'; // Hide if clicking outside
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-input');
            const messages = document.querySelectorAll('.message');

            searchInput.addEventListener('input', function() {
                const searchValue = this.value.toLowerCase();
                messages.forEach(function(message) {
                    const senderName = message.dataset.sender.toLowerCase();
                    message.style.display = senderName.includes(searchValue) ? '' : 'none';
                });
            });

            const menu = document.getElementById('menu');
            menu.addEventListener('click', function() {
                this.classList.toggle('fa-times');
                document.querySelector('header').classList.toggle('toggle');
            });

            // Add the see-more click event handler
            messages.forEach(function(message) {
                const moreText = message.querySelector('.more-text');
                const shortText = message.querySelector('.short-text');
                const seeMoreButton = message.querySelector('.see-more');

                if (shortText.textContent.length < 100) {
                    seeMoreButton.style.display = 'none';
                } else {
                    seeMoreButton.style.display = '';
                }

                seeMoreButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (moreText.style.display === 'block') {
                        moreText.style.display = 'none';
                        shortText.style.display = 'block';
                        this.textContent = 'See More';
                    } else {
                        moreText.style.display = 'block';
                        shortText.style.display = 'none';
                        this.textContent = 'See Less';
                    }
                });
            });

            // Pagination logic
            const messagesPerPage = 4;
            const totalPages = Math.ceil(messages.length / messagesPerPage);
            const paginationRange = 3;

            function showPage(page) {
                messages.forEach((msg, index) => {
                    msg.style.display = (index >= (page - 1) * messagesPerPage && index < page * messagesPerPage) ? '' : 'none';
                });
                updatePagination(page);
            }

            function updatePagination(currentPage) {
                const pagination = document.querySelector('.pagination');
                pagination.innerHTML = '';

                let startPage = Math.max(1, currentPage - Math.floor(paginationRange / 2));
                let endPage = Math.min(totalPages, currentPage + Math.floor(paginationRange / 2));

                if (currentPage <= Math.floor(paginationRange / 2)) {
                    endPage = Math.min(totalPages, paginationRange);
                }

                if (currentPage + Math.floor(paginationRange / 2) >= totalPages) {
                    startPage = Math.max(1, totalPages - paginationRange + 1);
                }

                for (let i = startPage; i <= endPage; i++) {
                    const pageLink = document.createElement('a');
                    pageLink.href = '#';
                    pageLink.textContent = i;
                    pageLink.className = (i === currentPage) ? 'page-num active' : 'page-num';
                    pageLink.addEventListener('click', function(e) {
                        e.preventDefault();
                        showPage(i);
                    });
                    pagination.appendChild(pageLink);
                }

                const nextLink = document.createElement('a');
                nextLink.href = '#';
                nextLink.className = 'next';
                nextLink.innerHTML = '<i class="fa-solid fa-arrow-right"></i>';
                nextLink.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (currentPage < totalPages) {
                        showPage(currentPage + 1);
                    }
                });
                pagination.appendChild(nextLink);

                const prevLink = document.createElement('a');
                prevLink.href = '#';
                prevLink.className = 'prev';
                prevLink.innerHTML = '<i class="fa-solid fa-arrow-left"></i>';
                prevLink.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (currentPage > 1) {
                        showPage(currentPage - 1);
                    }
                });
                pagination.prepend(prevLink);
            }

            // Initialize the first page
            showPage(1);
        });

        const overlay = document.querySelector('#overlay');

        document.querySelector('#show-modal-btn').addEventListener("click", () => {
            overlay.style.display = "block";
        });

        document.querySelector('#close-modal-btn').addEventListener("click", () => {
            overlay.style.display = "none";
        });
    </script>
</body>

</html>