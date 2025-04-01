<?php
session_start();
include("connect.php");
include("backend/functions.php");
$user_data = check_login($con);
?>

<?php include('header.php'); ?>

<div class="container-fluid">
    <div class="header-title">
        <h1>Referral Count Report</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <?php
            $result = mysqli_query($con, "SELECT * FROM promoter_count");
            ?>

            <div class="table-responsive">
                <table class="table table-bordered mydatatable" id="mydatatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Referral ID</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Total Visits</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $rowNumber = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $rowNumber . "</td>";
                            echo "<td>" . $row['promoter_id'] . "</td>";
                            echo "<td>" . $row['first_name'] . "</td>";
                            echo "<td>" . $row['middle_name'] . "</td>";
                            echo "<td>" . $row['last_name'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['phone'] . "</td>";
                            echo "<td><span class='badge bg-primary'>" . $row['total_visit_count'] . "</span></td>";
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

<?php include('footer.php'); ?>