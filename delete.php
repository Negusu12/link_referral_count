<?php
include("connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['ids']) && is_array($data['ids'])) {
        // Sanitize and prepare IDs
        $ids = implode(",", array_map('intval', $data['ids']));

        // Delete records from referral_count table first
        $sql_referral = "DELETE FROM referral_count WHERE promoter_id IN ($ids)";
        if ($con->query($sql_referral)) {
            // Delete records from promoter table after successful referral_count deletion
            $sql_promoter = "DELETE FROM promoter WHERE promoter_id IN ($ids)";
            if ($con->query($sql_promoter)) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => "Error deleting promoter records: " . $con->error]);
            }
        } else {
            echo json_encode(['success' => false, 'error' => "Error deleting referral_count records: " . $con->error]);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid input']);
    }
}
