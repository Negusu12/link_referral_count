</div> <!-- Close main-content div -->

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
<script src="js/sweetalert2.min.js"></script>
<script src="js/form_validation.js"></script>

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
</body>

</html>