<?php
include('connect.php');

// Get promoter_id from the URL
$promoter_id = isset($_GET['promoter_id']) ? intval($_GET['promoter_id']) : 0;

// Check if promoter_id exists in referral_count table
$checkQuery = "SELECT * FROM referral_count WHERE promoter_id = $promoter_id";
$result = $con->query($checkQuery);

if ($result->num_rows == 0) {
    // If promoter_id doesn't exist, insert a new record
    $insertQuery = "INSERT INTO referral_count (promoter_id, visit_count) VALUES ($promoter_id, 1)";
    $con->query($insertQuery);
} else {
    // If promoter_id exists, update the visit count
    $updateQuery = "UPDATE referral_count SET visit_count = visit_count + 1 WHERE promoter_id = $promoter_id";
    $con->query($updateQuery);
}

// Redirect to the specified website
header("Location: https://abhpartners.com/");
exit();
