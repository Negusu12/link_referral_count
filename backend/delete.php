<?php
if (isset($_GET["promoter_id"])) {
    include('../connect.php');
    $promoter_id = $_GET['promoter_id'];
    //Delete the line
    $sql = "DELETE FROM promoter WHERE promoter_id=$promoter_id";
    if ($con->query($sql) == TRUE) {
        header('location:../promoters.php');
    } else {
        echo "Error delete record: ";
    }
}
