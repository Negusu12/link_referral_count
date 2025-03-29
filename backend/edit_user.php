<?php
include "../connect.php";

$id = $user_name = $password = "";
$error = $success = "";

if ($_SERVER["REQUEST_METHOD"] == 'GET') {
    // [Keep your existing GET handling code...]
} else {
    // [Keep your existing POST handling code...]
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promoter Management System</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../css/bootstrap/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="../css/bootstrap/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../css/sweetalert2.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<div class="container-fluid">
    <div class="main-block">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Edit User</h1>
            <a href="../users_list.php" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Users
            </a>
        </div>

        <form method="post" class="edit-form">
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <div class="form-group">
                <label for="user_name">Username</label>
                <input type="text" class="form-control" name="user_name" value="<?php echo htmlspecialchars($user_name) ?>" required>
            </div>

            <div class="form-group">
                <label for="password">New Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" class="form-control" name="confirm_password" required>
            </div>

            <button type="submit" class="btn btn-primary btn-block">
                <i class="fas fa-save"></i> Update User
            </button>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger mt-3"><?php echo htmlspecialchars($error) ?></div>
            <?php endif; ?>
        </form>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('.edit-form').addEventListener('submit', function(e) {
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
                    title: 'Password Mismatch',
                    text: 'Password and Confirm Password do not match',
                    confirmButtonText: 'OK'
                });
                return false;
            }

            if (password.length < 6) {
                Swal.fire({
                    icon: 'error',
                    title: 'Password Too Short',
                    text: 'Password must be at least 6 characters long',
                    confirmButtonText: 'OK'
                });
                return false;
            }

            return true;
        }
    });
</script>
<script src="../js/jquery/jquery-3.3.1.min.js"></script>
<script src="../js/jquery/jquery.dataTables.min.js"></script>
<script src="../js/bootstrap/dataTables.bootstrap4.min.js"></script>
<script src="../js/bootstrap/dataTables.buttons.min.js"></script>
<script src="../js/bootstrap/buttons.bootstrap4.min.js"></script>
<script src="../js/bootstrap/jszip.min.js"></script>
<script src="../js/bootstrap/pdfmake.min.js"></script>
<script src="../js/bootstrap/vfs_fonts.js"></script>
<script src="../js/bootstrap/buttons.html5.min.js"></script>
<script src="../js/bootstrap/buttons.print.min.js"></script>
<script src="../js/bootstrap/buttons.colVis.min.js"></script>
<script src="../js/bootstrap/dataTables.responsive.min.js"></script>
<script src="../js/sweetalert2.min.js"></script>
<script src="../js/form_validation.js"></script>

<script>
    $(document).ready(function() {
        // Initialize all DataTables
        $('.mydatatable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
            ],
            responsive: true,
            pageLength: 25
        });

        // Active link highlighting
        $('.nav-link').each(function() {
            if (this.href === window.location.href) {
                $(this).addClass('active');
            }
        });
    });
</script>