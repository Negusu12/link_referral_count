<?php
include('connect.php');

// Get promoter_id from the URL
$promoter_id = isset($_GET['promoter_id']) ? intval($_GET['promoter_id']) : 0;

// Get the visitor's IP address
$ip_address = $_SERVER['REMOTE_ADDR'];

// Check if the IP address has already visited for the given promoter_id
$checkIpQuery = "SELECT * FROM referral_count WHERE promoter_id = $promoter_id AND ip_address = '$ip_address'";
$resultIp = $con->query($checkIpQuery);

if ($resultIp->num_rows == 0) {
    // If the IP address is new, insert a new record and increment the visit count
    $insertQuery = "INSERT INTO referral_count (promoter_id, visit_count, ip_address) VALUES ($promoter_id, 1, '$ip_address')";
    $con->query($insertQuery);
} else {
    // If the IP address has already visited, do not increment the visit count
    // You may choose to do nothing here or log this action for reference
}

// Redirect to the specified website
header("Location: https://abhpartners.com/");
exit();
