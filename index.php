<?php
session_start();
include("connect.php");
include("backend/functions.php");
$user_data = check_login($con);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Navigation</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: #fff;
            padding: 15px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            position: fixed;
            height: 100%;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            margin: 15px 0;
        }

        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 16px;
            display: block;
            padding: 10px;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .sidebar ul li a:hover {
            background-color: #34495e;
        }

        /* Main Content Styles */
        .main-content {
            margin-left: 250px;
            flex-grow: 1;
            padding: 20px;
            background-color: #ecf0f1;
            overflow-y: auto;
        }

        iframe {
            width: 100%;
            height: calc(100vh - 40px);
            border: none;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h2>Navigation</h2>
        <ul>
            <?php if (!in_array($user_data['role'], [1])) : ?>
                <li><a href="add_promoter.php">Add Promoter</a></li>
            <?php endif; ?>
            <?php if (in_array($user_data['role'], [1])) : ?>
                <li><a href="add_promoter.php" onclick="loadPage(event, 'add_promoter.php')">Add Promoter</a></li>
                <li><a href="promoters.php" onclick="loadPage(event, 'promoters.php')">Manage Promoters</a></li>
                <li><a href="referral_count.php" onclick="loadPage(event, 'referral_count.php')">Referral Count</a></li>
                <li><a href="add_user.php" onclick="loadPage(event, 'add_user.php')">Add User</a></li>
                <li><a href="users_list.php" onclick="loadPage(event, 'users_list.php')">Users List</a></li>
                <li><a href="logout.php" onclick="loadPage(event, 'logout.php')">Log Out</a></li>
            <?php endif; ?>
        </ul>
    </div>

    <div class="main-content">
        <!-- Set iframe src to the default saved page or blank -->
        <iframe id="content-frame"></iframe>
    </div>

    <script>
        // Function to load page in iframe and store the page in localStorage
        function loadPage(event, page) {
            event.preventDefault(); // Prevent default link behavior
            document.getElementById('content-frame').src = page; // Load page in iframe
            localStorage.setItem('currentPage', page); // Save the current page to localStorage
        }

        // Load the last page from localStorage on page refresh
        window.onload = function() {
            const savedPage = localStorage.getItem('currentPage'); // Get the last loaded page from localStorage
            const iframe = document.getElementById('content-frame');
            if (savedPage) {
                iframe.src = savedPage; // Load the saved page in iframe
            } else {
                iframe.src = 'referral_count.php'; // Default page (optional)
            }
        };
    </script>
</body>

</html>