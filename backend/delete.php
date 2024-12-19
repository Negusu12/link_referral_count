<?php
if (isset($_GET["promoter_id"])) {
    include('../connect.php');
    $promoter_id = $_GET['promoter_id'];

    // Delete records from referral_count table first
    $sql_referral = "DELETE FROM referral_count WHERE promoter_id=$promoter_id";
    if ($con->query($sql_referral) === TRUE) {
        // After deleting from referral_count, delete from promoter table
        $sql_promoter = "DELETE FROM promoter WHERE promoter_id=$promoter_id";
        if ($con->query($sql_promoter) === TRUE) {
            header('Location: ../promoters.php');
        } else {
            echo "Error deleting promoter record: " . $con->error;
        }
    } else {
        echo "Error deleting referral_count records: " . $con->error;
    }
}
