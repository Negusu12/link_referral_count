<?php
include('connect.php');
if (isset($_POST['submit'])) {
    $full_name = /*addlashes so it accept commas and sympols*/ addslashes($_POST['full_name']);
    $remark = addslashes($_POST['remark']);

    $sql = "insert into `promoter`(full_name,remark)
    values ('$full_name', '$remark')";
    $result = mysqli_query($con, $sql);
    if ($result) {

        echo "<script>
        window.onload = function() {
            Swal.fire({
                icon: 'success',
                title: 'Promoter Added successfully',
                showConfirmButton: true,
                confirmButtonText: 'OK',
            }).then(function() {
                window.location.href = 'add_promoter.php';
            });
        }
    </script>";
    } else {
        echo "<script>
        window.onload = function() {
            Swal.fire({
                icon: 'error',
                title: 'Something is wrong, Make sure all fields are inserted correctly',
                showConfirmButton: false,
                showDenyButton: true,
                denyButtonText: 'OK'
            });
        }
    </script>";
    }
}
