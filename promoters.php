<?php
session_start();
include("connect.php");
include("backend/functions.php");
$user_data = check_login($con);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promoter Referral Count</title>
    <link rel="icon" type="image/png" href="images/logo.png" />
    <link rel="stylesheet" href="css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="css/bootstrap/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="css/bootstrap/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/sweetalert2.min.css">
    <!-- Add your custom CSS styles here --
    <link rel="stylesheet" href="css/style.css">

    <!-- Add a Google Font for better typography -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,600&display=swap">
    <style>
        body {
            background-color: #f5f5f5;
        }

        .title-text {
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            letter-spacing: 2px;
            font-family: 'Arial', sans-serif;
            color: #fff;
            /* Set a white text color for better visibility */
        }

        .sel_del {
            margin-left: auto;
            max-width: 300px;
            padding: 20px;
            background-color: #f5f5f5;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        /* Style the "Select All" checkbox */
        .sel_del #select-all {
            margin-bottom: 10px;
        }

        .sel_del .btn-delete-multiple {
            background-color: #dc3545;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .sel_del .btn-delete-multiple:hover {
            background-color: #c82333;
        }
    </style>
</head>

<body>
    <div class="container-fluid">

        <div class="header-title">
            <h1 class="text-center">Promoter Referral Count</h1>
        </div>

        <?php
        $result = mysqli_query($con, "SELECT * FROM promoter");
        ?>
        <section class="table-responsive">
            <div class="sel_del">
                <input type="checkbox" id="select-all">
                <label for="select-all">Select All</label>
                <br>
                <button id="deleteSelected" class="btn btn-danger">Delete Selected</button>
            </div>
            <table class="table table-striped table-bordered mydatatable" id="mydatatable">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">box</th>
                        <th>Row No.</th>
                        <th>Referral ID</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $rowNumber = 1; // Initialize row number
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
                        echo "<td>
        <a class='btn btn-success' href='backend/edit.php?promoter_id=" . $row['promoter_id'] . "'>Edit</a>
        <button class='btn btn-danger' onclick='confirmDelete(" . $row['promoter_id'] . ")'>Delete</button>
      </td>";
                        echo "</tr>";

                        $rowNumber++; // Increment row number for the next row
                    }
                    ?>
                </tbody>
            </table>
            <br>
        </section>

    </div>

    <script src="js/sweetalert2.min.js"></script>
    <script src="js/jquery/jquery-3.3.1.min.js"></script>
    <script src="js/jquery/jquery.dataTables.min.js"></script>
    <script src="js/bootstrap/dataTables.bootstrap4.min.js"></script>
    <script src="js/bootstrap/dataTables.buttons.min.js"></script>
    <script src="js/bootstrap/buttons.bootstrap4.min.js"></script>
    <script src="js/bootstrap/jszip.min.js"></script>
    <script src="js/bootstrap/pdfmake.min.js"></script>
    <script src="js/bootstrap/vfs_fonts.js"></script>
    <script src="js/bootstrap/buttons.html5.min.js"></script>
    <script src="js/bootstrap/buttons.print.min.js"></script>
    <script src="js/bootstrap/buttons.colVis.min.js"></script>
    <script src="js/bootstrap/dataTables.responsive.min.js"></script>
    <script src="js/bootstrap/buttons.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            var isDataTableInitialized = $.fn.DataTable.isDataTable('#mydatatable');
            if (isDataTableInitialized) {
                $('#mydatatable').DataTable().destroy();
            }

            var table = $('#mydatatable').DataTable({
                ordering: true,
                buttons: ['excel', 'pdf', 'colvis'],
                pagingType: 'full_numbers',
                lengthMenu: [
                    [25, 50, -1],
                    [25, 50, "All"]
                ],
                responsive: true // Enable responsive design
            });

            table.columns().every(function() {
                var that = this;
                var input = $('<input type="text" class="form-control" placeholder="Filter"/>')
                    .appendTo($(this.header()))
                    .on('keyup change', function() {
                        that.search($(this).val()).draw();
                    });
            });

            table.buttons().container()
                .appendTo('#mydatatable_wrapper .col-md-6:eq(0)');
        });
    </script>
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
                    // Redirect to your delete script with the user ID
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
                        // Send IDs to the server for deletion
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
                                        .then(() => location.reload()); // Reload the page
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
    <script>
        $(document).ready(function() {
            // Function to handle select all checkbox
            $("#select-all").click(function() {
                // Check if the select all checkbox is checked
                var isChecked = $(this).prop("checked");
                // Set the checked status of all checkboxes in the table to match the select all checkbox
                $("input[name='selected_records[]']").prop("checked", isChecked);
            });
        });
    </script>
</body>

</html>