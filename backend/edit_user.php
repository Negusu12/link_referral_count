<?php

include "../connect.php";

$id = $user_name = $password = "";
$error = $success = "";

if ($_SERVER["REQUEST_METHOD"] == 'GET') {
    if (!isset($_GET['id'])) {
        header('Location: users.php');
        exit;
    }
    $id = $_GET['id'];
    $sql = "SELECT id, user_id, user_name, password, date FROM users WHERE id=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('i', $id);
    if (!$stmt->execute()) {
        $error = "Error: " . $stmt->error;
    } else {
        $stmt->store_result();

        if ($stmt->num_rows == 0) {
            header('Location: users.php');
            exit;
        }

        // Bind result to match selected columns
        $stmt->bind_result($id, $user_id, $user_name, $hashed_password, $date);
        $stmt->fetch();

        $password = $hashed_password; // Assuming this is for display; it shouldn't be.
    }
} else {
    $id = $_POST["id"];
    $user_name = $_POST["user_name"];
    $new_password = $_POST["password"];

    if (empty($error)) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        $sql = "UPDATE users SET user_name=?, password=? WHERE id=?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('ssi', $user_name, $hashed_password, $id);
        if (!$stmt->execute()) {
            $error = "Error: " . $stmt->error;
        } else {
            echo "<script>
            window.onload = function() {
                Swal.fire({
                    icon: 'success',
                    title: 'User Updated Successfully',
                    showConfirmButton: true,
                    confirmButtonText: 'OK',
                }).then(function() {
                    window.location.href = '../users_list.php';
                });
            }
        </script>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit User</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="../css/sweetalert2.min.css">

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f3f7f9;
            margin: 0;
            padding: 0;
            color: #26225B;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            /* Adjusted margin for centering */
            background-color: #FFFFFF;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #34347c;
            font-size: 28px;
            /* Increased font size */
            text-align: center;
            /* Centered text */
            margin-bottom: 20px;
            /* Added margin */
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #34347c;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #34347c;
            border-radius: 5px;
            box-sizing: border-box;
            margin-bottom: 10px;
            /* Added margin for spacing between form elements */
        }

        button {
            background-color: #34347c;
            color: #FFFFFF;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #4D7DBF;
        }

        .alert {
            margin-top: 20px;
            padding: 10px;
            border-radius: 5px;
        }

        .alert-danger {
            background-color: #FFD2D2;
            border: 1px solid #FF5E5E;
            color: #D8000C;
        }

        .alert-success {
            background-color: #DFF2BF;
            border: 1px solid #4F8A10;
            color: #4F8A10;
        }

        .btn-back {
            display: block;
            text-align: right;
            margin-bottom: 10px;
            text-decoration: none;
            color: #34347c;
            font-weight: bold;
        }

        .btn-back:hover {
            color: #4D7DBF;
        }
    </style>
</head>

<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">

                <div id="box" class="box container">
                    <a href="users.php" class="btn-back">Back to Users</a>
                    <h1>Edit User</h1>
                    <form method="post" enctype="multipart/form-data" class="login-form">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">

                        <div class="form-group">
                            <label for="user_name">User Name:</label>
                            <input class="input100" type="text" name="user_name" value="<?php echo $user_name ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="password"> Confirm Password:</label>
                            <input type="password" name="confirm_password" required>
                        </div>




                        <button type="submit">Update</button>
                        <?php if (!empty($error)) { ?>
                            <div class="alert alert-danger"><?php echo $error ?></div>
                        <?php } else if (!empty($success)) { ?>
                            <div class="alert alert-success"><?php echo $success ?></div>
                        <?php } ?>
                    </form>

                </div>
            </div>
        </div>
    </div>


    <script src="../js/sweetalert2.min.js"></script>
    <script src="../js/form_validation.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.login-form').addEventListener('submit', function(e) {
                if (!validatePassword()) {
                    e.preventDefault();
                }
            });

            function validatePassword() {
                var password = document.getElementsByName("password")[0].value;
                var confirmPassword = document.getElementsByName("confirm_password")[0].value;

                if (password !== confirmPassword) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Password and Confirm Password do not match',
                        showConfirmButton: false,
                        showDenyButton: true,
                        denyButtonText: 'OK'
                    });
                    return false;
                }

                // If passwords match, the form will be submitted
                return true;
            }
        });
    </script>
</body>

</html>