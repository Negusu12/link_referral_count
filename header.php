<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in (you'll need to adjust this based on your auth system)
$isLoggedIn = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
</head>

<body>
    <nav class="navbar">
        <a href="index" class="navbar-brand" style="text-decoration: none; color: inherit; font-weight: inherit; font-size: inherit; font-family: inherit;">
            <i class="fas fa-users"></i> &nbsp;&nbsp;&nbsp;Referral Management System
        </a>

        <?php if ($isLoggedIn): ?>
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
                <i class="fas fa-user-circle" style="font-size: 2rem;"></i>
                <span class="user-name"><?= htmlspecialchars($_SESSION['user_name'] ?? 'Admin') ?></span>
                <a href="logout.php" class="btn btn-danger ml-3" style="padding: 0.25rem 0.5rem;">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        <?php endif; ?>
    </nav>

    <div class="main-content">