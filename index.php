<?php
session_start();
include("connect.php");
include("backend/functions.php");
$user_data = check_login($con);

// Get counts for dashboard
$promoter_count = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) as count FROM promoter"))['count'];
$user_count = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) as count FROM users"))['count'];
$referral_count = mysqli_fetch_assoc(mysqli_query($con, "SELECT SUM(total_visit_count) as count FROM promoter_count"))['count'];
?>

<?php include('header.php'); ?>

<div class="container-fluid">
    <div class="header-title">
        <h1>Dashboard</h1>
    </div>

    <div class="dashboard-cards">
        <div class="card">
            <div class="card-icon">
                <i class="fas fa-user-tie"></i>
            </div>
            <h3 class="card-title">Total Promoters</h3>
            <h2 class="card-value"><?= $promoter_count ?></h2>
            <a href="promoters.php" class="btn btn-primary mt-2">View All</a>
        </div>

        <div class="card">
            <div class="card-icon">
                <i class="fas fa-users"></i>
            </div>
            <h3 class="card-title">System Users</h3>
            <h2 class="card-value"><?= $user_count ?></h2>
            <a href="users_list.php" class="btn btn-primary mt-2">Manage Users</a>
        </div>

        <div class="card">
            <div class="card-icon">
                <i class="fas fa-chart-line"></i>
            </div>
            <h3 class="card-title">Total Referrals</h3>
            <h2 class="card-value"><?= $referral_count ?></h2>
            <a href="referral_count.php" class="btn btn-primary mt-2">View Report</a>
        </div>

        <div class="card">
            <div class="card-icon">
                <i class="fas fa-plus-circle"></i>
            </div>
            <h3 class="card-title">Quick Actions</h3>
            <div class="d-flex flex-column">
                <a href="add_promoter.php" class="btn btn-success mb-2">Add Promoter</a>
                <a href="add_user.php" class="btn btn-warning">Add User</a>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <h3 class="mb-3">Recent Promoters</h3>
        <div class="table-responsive">
            <?php
            $result = mysqli_query($con, "SELECT * FROM promoter ORDER BY promoter_id DESC LIMIT 5");
            if (mysqli_num_rows($result) > 0):
            ?>
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?= $row['promoter_id'] ?></td>
                                <td><?= $row['first_name'] . ' ' . $row['last_name'] ?></td>
                                <td><?= $row['email'] ?></td>
                                <td><?= $row['phone'] ?></td>
                                <td>
                                    <a href="backend/edit.php?promoter_id=<?= $row['promoter_id'] ?>" class="btn btn-sm btn-success">Edit</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert alert-info">No promoters found.</div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>