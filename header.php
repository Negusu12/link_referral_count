<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
$isLoggedIn = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Referral Management System</title>
    <link rel="shortcut icon" type="image/icon" href="images/logo.png" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="css/bootstrap/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="css/bootstrap/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="css/sweetalert2.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Responsive Navigation */
        .navbar {
            display: flex;
            flex-wrap: wrap;
            padding: 0.5rem 1rem;
            background: #076e56;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            font-size: 1.25rem;
            font-weight: 600;
            color: #fff;
            padding: 0.5rem 0;
            margin-right: auto;
        }

        .hamburger {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0.5rem;
            order: 1;
        }

        .nav-menu {
            display: flex;
            flex-direction: row;
            list-style: none;
            margin: 0;
            padding: 0;
            width: 100%;
            order: 3;
        }

        .nav-item {
            position: relative;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: #fff;
            text-decoration: none;
            transition: all 0.3s;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #007bff;
            background: rgba(0, 123, 255, 0.1);
        }

        .nav-link i {
            margin-right: 0.5rem;
            font-size: 1.1rem;
        }

        .user-profile {
            display: flex;
            align-items: center;
            margin-left: auto;
            padding: 0.5rem 0;
            order: 2;
        }

        .user-name {
            margin: 0 0.75rem;
            font-weight: 600;
            white-space: nowrap;
        }

        .main-content {
            padding: 1rem;
            transition: margin-left 0.3s;
        }

        /* Mobile Styles */
        @media (max-width: 992px) {
            .hamburger {
                display: block;
            }

            .nav-menu {
                flex-direction: column;
                width: 100%;
                max-height: 0;
                overflow: hidden;
                transition: max-height 0.3s ease-out;
            }

            .nav-menu.active {
                max-height: 500px;
            }

            .nav-item {
                width: 100%;
            }

            .nav-link {
                padding: 1rem;
                border-bottom: 1px solid #eee;
            }

            .user-profile {
                margin-left: 0;
                width: 100%;
                justify-content: flex-end;
                padding: 0.5rem 0;
            }
        }

        @media (max-width: 576px) {
            .navbar-brand {
                font-size: 1rem;
            }

            .user-name {
                display: none;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <a href="index" class="navbar-brand">
            <i class="fas fa-users"></i> &nbsp;&nbsp;&nbsp;Referral Management System
        </a>

        <?php if ($isLoggedIn): ?>
            <button class="hamburger">
                <i class="fas fa-bars"></i>
            </button>

            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="index.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="promoters.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'promoters.php' ? 'active' : '' ?>">
                        <i class="fas fa-user-tie"></i> Promoters
                    </a>
                </li>
                <li class="nav-item">
                    <a href="referral_count.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'referral_count.php' ? 'active' : '' ?>">
                        <i class="fas fa-chart-line"></i> Referral Count
                    </a>
                </li>
                <li class="nav-item">
                    <a href="users_list.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'users_list.php' ? 'active' : '' ?>">
                        <i class="fas fa-users-cog"></i> Users
                    </a>
                </li>
                <li class="nav-item">
                    <a href="add_promoter.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'add_promoter.php' ? 'active' : '' ?>">
                        <i class="fas fa-user-plus"></i> Add Promoter
                    </a>
                </li>
                <li class="nav-item">
                    <a href="add_user.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'add_user.php' ? 'active' : '' ?>">
                        <i class="fas fa-user-shield"></i> Add User
                    </a>
                </li>
            </ul>

            <div class="user-profile">
                <i class="fas fa-user-circle" style="font-size: 1.5rem;"></i>
                <span class="user-name"><?= htmlspecialchars($_SESSION['user_name'] ?? 'Admin') ?></span>
                <a href="logout.php" class="btn btn-danger ml-2" style="padding: 0.25rem 0.5rem;">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        <?php endif; ?>
    </nav>

    <div class="main-content">

        <script>
            // Mobile menu toggle
            document.addEventListener('DOMContentLoaded', function() {
                const hamburger = document.querySelector('.hamburger');
                const navMenu = document.querySelector('.nav-menu');

                if (hamburger && navMenu) {
                    hamburger.addEventListener('click', function() {
                        navMenu.classList.toggle('active');
                        hamburger.innerHTML = navMenu.classList.contains('active') ?
                            '<i class="fas fa-times"></i>' : '<i class="fas fa-bars"></i>';
                    });
                }

                // Close menu when clicking outside on mobile
                document.addEventListener('click', function(e) {
                    if (window.innerWidth <= 992) {
                        if (!e.target.closest('.navbar') && navMenu.classList.contains('active')) {
                            navMenu.classList.remove('active');
                            hamburger.innerHTML = '<i class="fas fa-bars"></i>';
                        }
                    }
                });
            });
        </script>