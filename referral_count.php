<?php

include("connect.php");

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
    </style>
</head>

<body>
    <div class="container-fluid">

        <div class="header-title">
            <h1 class="text-center">Promoter Referral Count</h1>
        </div>

        <?php
        $result = mysqli_query($con, "SELECT * FROM promoter_count");
        ?>
        <section class="table-responsive">
            <table class="table table-striped table-bordered mydatatable" id="mydatatable">
                <thead class="thead-dark">
                    <tr>
                        <th>Row No.</th>
                        <th>Full Name</th>
                        <th>Total Visit Count</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $rowNumber = 1; // Initialize row number
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $rowNumber . "</td>"; // Display row number
                        echo "<td>" . $row['full_name'] . "</td>";
                        echo "<td>" . $row['total_visit_count'] . "</td>";
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
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
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
</body>

</html>