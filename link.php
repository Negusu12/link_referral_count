<?php
include('connect.php');

// Get promoter_id from the URL
$promoter_id = isset($_GET['promoter_id']) ? intval($_GET['promoter_id']) : 0;

// Get visitor's IP address
$ip_address = $_SERVER['REMOTE_ADDR'];

// Generate browser fingerprint
$fingerprint = generateBrowserFingerprint();

// Check if this IP already exists for this promoter (regardless of fingerprint)
$checkIpQuery = "SELECT * FROM referral_count 
                WHERE promoter_id = $promoter_id 
                AND ip_address = '$ip_address'";
$resultIp = $con->query($checkIpQuery);

// Check if this fingerprint already exists for this promoter (regardless of IP)
$checkFingerprintQuery = "SELECT * FROM referral_count 
                         WHERE promoter_id = $promoter_id 
                         AND fingerprint = '$fingerprint'";
$resultFingerprint = $con->query($checkFingerprintQuery);

// Only count if BOTH IP and fingerprint are new for this promoter
if ($resultIp->num_rows == 0 && $resultFingerprint->num_rows == 0) {
    $insertQuery = "INSERT INTO referral_count (promoter_id, visit_count, ip_address, fingerprint) 
                   VALUES ($promoter_id, 1, '$ip_address', '$fingerprint')";
    $con->query($insertQuery);
}

// Redirect to target page
header("Location: https://t.me/waliyabet");
exit();

function generateBrowserFingerprint()
{
    $components = [
        $_SERVER['HTTP_USER_AGENT'] ?? '',
        $_SERVER['HTTP_ACCEPT'] ?? '',
        $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? '',
        $_GET['screen'] ?? '',
        $_GET['cd'] ?? '',
        $_GET['tz'] ?? '',
        $_GET['pl'] ?? '',
        $_GET['fonts'] ?? '',
        $_GET['wgl'] ?? ''
    ];

    return md5(implode('|', array_filter($components)));
}
// In link.php, modify the check to only look at recent duplicates
$timeWindow = date('Y-m-d H:i:s', strtotime('-24 hours'));

$checkIpQuery = "SELECT * FROM referral_count 
                WHERE promoter_id = $promoter_id 
                AND ip_address = '$ip_address'
                AND created_at > '$timeWindow'";
