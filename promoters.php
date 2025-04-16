<?php
session_start();
include("connect.php");
include("backend/functions.php");
$user_data = check_login($con);
?>

<?php include('header.php'); ?>

<div class="container-fluid">
    <div class="header-title">
        <h1>Promoter Management</h1>
        <div class="actions">
            <a href="add_promoter.php" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Promoter
            </a>
        </div>
    </div>

    <?php
    $result = mysqli_query($con, "SELECT * FROM promoter");
    ?>

    <div class="card">
        <div class="card-body">
            <div class="sel_del mb-3">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="select-all">
                    <label class="form-check-label" for="select-all">Select All</label>
                </div>
                <button id="deleteSelected" class="btn btn-danger btn-sm">
                    <i class="fas fa-trash"></i> Delete Selected
                </button>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered mydatatable" id="mydatatable">
                    <thead>
                        <tr>
                            <th width="50px">Select</th>
                            <th>#</th>
                            <th>Referral ID</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Referral Link</th>
                            <th width="200px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $rowNumber = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td><input type='checkbox' class='delete-checkbox' name='selected_records[]' value='" . $row['promoter_id'] . "'></td>";
                            echo "<td>" . $rowNumber . "</td>";
                            echo "<td>" . $row['promoter_id'] . "</td>";
                            echo "<td>" . $row['first_name'] . "</td>";
                            echo "<td>" . $row['middle_name'] . "</td>";
                            echo "<td>" . $row['last_name'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['phone'] . "</td>";
                            echo "<td>" . $row['referral_link'] . "</td>";
                            echo "<td>
                                <a class='btn btn-sm btn-success' href='backend/edit.php?promoter_id=" . $row['promoter_id'] . "'>
                                    <i class='fas fa-edit'></i>
                                </a>
                                <button class='btn btn-sm btn-danger' onclick='confirmDelete(" . $row['promoter_id'] . ")'>
                                    <i class='fas fa-trash'></i>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(promoter_id) {
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
                window.location.href = 'backend/delete.php?promoter_id=' + promoter_id;
            }
        });
    }

    document.getElementById('deleteSelected').addEventListener('click', () => {
        const checkboxes = document.querySelectorAll('.delete-checkbox:checked');
        const selectedIds = Array.from(checkboxes).map(checkbox => checkbox.value);

        if (selectedIds.length > 0) {
            Swal.fire({
                title: 'Are you sure you want to delete the selected records?',
                text: 'This action cannot be undone!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete them!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('delete.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                ids: selectedIds
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire('Deleted!', 'The records have been deleted.', 'success')
                                    .then(() => location.reload());
                            } else {
                                Swal.fire('Error!', data.error || 'There was a problem deleting the records.', 'error');
                            }
                        });
                }
            });
        } else {
            Swal.fire('No Selection', 'Please select at least one record to delete.', 'info');
        }
    });
</script>

<script src="js/jquery/jquery-3.3.1.min.js"></script>
<script>
    $(document).ready(function() {
        $("#select-all").click(function() {
            var isChecked = $(this).prop("checked");
            $("input[name='selected_records[]']").prop("checked", isChecked);
        });
    });
</script>

<?php include('footer.php'); ?>