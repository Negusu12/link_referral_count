<?php
if (isset($_GET["promoter_id"])) {
    include('../connect.php');
    $promoter_id = $_GET['promoter_id'];

    // Delete from referral_logs first
    $sql_logs = "DELETE FROM referral_logs WHERE promoter_id = $promoter_id";
    if ($con->query($sql_logs) === TRUE) {

        // Delete from referral_count next
        $sql_referral = "DELETE FROM referral_count WHERE promoter_id = $promoter_id";
        if ($con->query($sql_referral) === TRUE) {

            // Finally delete from promoter table
            $sql_promoter = "DELETE FROM promoter WHERE promoter_id = $promoter_id";
            if ($con->query($sql_promoter) === TRUE) {
                header('Location: ../promoters.php');
                exit;
            } else {
                echo "❌ Error deleting promoter record: " . $con->error;
            }
        } else {
            echo "❌ Error deleting referral_count record: " . $con->error;
        }
    } else {
        echo "❌ Error deleting referral logs: " . $con->error;
    }
}
