<?php
session_start();
include("connect.php");
include("backend/functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    if (!empty($user_name) && !empty($password) && !is_numeric(($user_name))) {
        $query = "select * from users where BINARY user_name = '$user_name' limit 1";
        $result = mysqli_query($con, $query);
        if ($result) {
            if ($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);
                if (password_verify($password, $user_data['password'])) {
                    $_SESSION['user_id'] = $user_data['user_id'];
                    $_SESSION['user_name'] = $user_data['user_name'];
                    header("Location: referral_count.php");
                    die;
                }
            }
        }
        echo "<script>
        window.onload = function() {
            Swal.fire({
                icon: 'error',
                title: 'Username or Password is incorrect!',
                text: 'Please enter valid credentials',
                confirmButtonText: 'OK'
            });
        }
        </script>";
    } else {
        echo "<script>
        window.onload = function() {
            Swal.fire({
                icon: 'error',
                title: 'Invalid Input!',
                text: 'Please enter valid information',
                confirmButtonText: 'OK'
            });
        }
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login - Promoter System</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/sweetalert2.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="login-page">
    <div class="login-container">
        <div class="login-card">
            <div class="logo">
                <i class="fas fa-users fa-3x"></i>
                <h2>Promoter System</h2>
            </div>

            <form method="post" class="login-form">
                <div class="form-group">
                    <label for="user_name">Username</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" id="user_name" name="user_name" class="form-control" placeholder="Enter username" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Enter password" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block btn-login">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </form>
        </div>
    </div>

    <script src="js/sweetalert2.min.js"></script>
    <script src="js/form_validation.js"></script>
</body>

</html>