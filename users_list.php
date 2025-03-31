<?php
session_start();
include("connect.php");
include("backend/functions.php");
$user_data = check_login($con);
?>

<?php include('header.php'); ?>

<div class="container-fluid">
    <div class="header-title">
        <h1>User Management</h1>
        <div class="actions">
            <a href="add_user.php" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New User
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <?php
            $result = mysqli_query($con, "SELECT * FROM users");
            ?>

            <div class="table-responsive">
                <table class="table table-striped table-bordered mydatatable" id="mydatatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ID</th>
                            <th>Username</th>
                            <th>password</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $rowNumber = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $rowNumber . "</td>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['user_name'] . "</td>";
                            echo "<td>" . $row['password'] . "</td>";
                            echo "<td>
                                <a class='btn btn-sm btn-success' href='backend/edit_user.php?id=" . $row['id'] . "'>
                                    <i class='fas fa-edit'></i> Edit
                                </a>
                                <button class='btn btn-sm btn-danger' onclick='confirmDelete(" . $row['id'] . ")'>
                                    <i class='fas fa-trash'></i> Delete
                                </button>
                            </td>";
                            echo "</tr>";
                            $rowNumber++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    function confirmDelete(userId) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to your delete script with the user ID
                window.location.href = 'delete.php?users_d=' + userId;
            }
        });
    }
</script>

<?php include('footer.php'); ?>