<?php
include('connect.php');

function generateShortCode($length = 8)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $code = '';
    for ($i = 0; $i < $length; $i++) {
        $code .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $code;
}


if (isset($_POST['submit'])) {
    $first_name = addslashes($_POST['first_name']);
    $middle_name = addslashes($_POST['middle_name']);
    $last_name = addslashes($_POST['last_name']);
    $phone = addslashes($_POST['phone']);
    $email = addslashes($_POST['email']);

    // Insert promoter
    $sql = "INSERT INTO promoter (first_name, middle_name, last_name, phone, email) 
            VALUES ('$first_name', '$middle_name', '$last_name', '$phone', '$email')";
    $result = mysqli_query($con, $sql);

    if ($result) {
        $promoter_id = mysqli_insert_id($con);
        $short_code = generateShortCode();

        // Generate referral link
        $referral_link = "https://kingtech.com.et/link.php?code=$short_code";

        // Save referral link in referral_count table
        $insertReferral = "INSERT INTO referral_count (promoter_id, short_code) 
                           VALUES ($promoter_id, '$short_code')";
        mysqli_query($con, $insertReferral);

        // Also update promoter table to store referral link
        $updateLink = "UPDATE promoter SET referral_link = '$referral_link' WHERE promoter_id = $promoter_id";
        mysqli_query($con, $updateLink);
?>
        <!DOCTYPE html>
        <html>

        <head>
            <title>Promoter Added</title>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <style>
                @media (max-width: 768px) {
                    .responsive-swal {
                        width: 90% !important;
                        font-size: 14px;
                    }

                    #referralLink {
                        font-size: 12px;
                    }

                    #copyButton {
                        padding: 6px !important;
                        font-size: 12px;
                    }
                }
            </style>
        </head>

        <body>
            <script>
                window.onload = function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Promoter Added Successfully',
                        html: 'Use the following link for referral:<br>' +
                            '<div style="margin-top: 10px;">' +
                            '<input type="text" id="referralLink" value="<?php echo $referral_link; ?>" readonly style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">' +
                            '<button id="copyButton" style="margin-top: 10px; padding: 8px; background-color: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer; width: 100%;">' +
                            '📋 Copy to Clipboard</button></div>' +
                            '<div style="margin-top: 15px; font-size: 14px; color: #666;"></div>',
                        confirmButtonText: 'OK',
                        width: '600px',
                        customClass: {
                            popup: 'responsive-swal'
                        }
                    }).then(function() {
                        window.location.href = 'add_promoter.php';
                    });

                    document.addEventListener('click', function(event) {
                        if (event.target && event.target.id === 'copyButton') {
                            const linkInput = document.getElementById('referralLink');
                            linkInput.select();
                            document.execCommand("copy");
                            Swal.fire({
                                icon: 'success',
                                title: 'Copied!',
                                text: 'Link copied to clipboard.',
                                timer: 2000,
                                toast: true,
                                position: 'top-end'
                            });
                        }
                    });
                };
            </script>
        </body>

        </html>
<?php
    } else {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Insert Error!',
                text: 'Please fill all fields correctly.',
                confirmButtonText: 'OK'
            });
        </script>";
    }
}


if (isset($_POST['submit_user'])) {
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {
        $user_id = random_num(20);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (user_id, user_name, password, role)
VALUES ('$user_id', '$user_name', '$hashed_password', '$role')";
        $result = mysqli_query($con, $query);

        if ($result) {
            // Set a success flag in the session
            session_start();
            $_SESSION['success'] = true;

            // Redirect to the same page to clear POST data
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "<script>
    window.onload = function() {
        Swal.fire({
            icon: 'error',
            title: 'Please enter valid information!',
            showConfirmButton: false,
            showDenyButton: true,
            denyButtonText: 'OK'
        });
    }
</script>";
        }
    }
}

// Check for success message in the session

if (isset($_SESSION['success']) && $_SESSION['success']) {
    echo "<script>
    window.onload = function() {
        Swal.fire({
            icon: 'success',
            title: 'User has been Registered Successfully',
            showConfirmButton: true,
            confirmButtonText: 'OK',
            timer: 2000
        });
    }
</script>";
    // Unset the success flag
    unset($_SESSION['success']);
}
