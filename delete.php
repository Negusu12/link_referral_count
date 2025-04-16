<?php
include("connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['ids']) && is_array($data['ids'])) {
        // Sanitize and prepare IDs
        $ids = implode(",", array_map('intval', $data['ids']));

        // Step 1: Delete from referral_logs
        $sql_logs = "DELETE FROM referral_logs WHERE promoter_id IN ($ids)";
        if ($con->query($sql_logs)) {

            // Step 2: Delete from referral_count
            $sql_referral = "DELETE FROM referral_count WHERE promoter_id IN ($ids)";
            if ($con->query($sql_referral)) {

                // Step 3: Delete from promoter
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
            echo json_encode(['success' => false, 'error' => "Error deleting referral logs: " . $con->error]);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid input']);
    }
}

// Extra GET-based deletion for users
if (isset($_GET["users_d"])) {
    $id = intval($_GET['users_d']); // sanitize
    $sql = "DELETE FROM users WHERE id=$id";
    if ($con->query($sql) === TRUE) {
        header('location: users_list.php');
        exit;
    } else {
        echo "Error deleting user record: " . $con->error;
    }
}
