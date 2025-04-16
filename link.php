<?php
session_start();
include('connect.php');

function generateBrowserFingerprint()
{
    $components = [
        $_SERVER['HTTP_USER_AGENT'] ?? '',
        $_SERVER['HTTP_ACCEPT'] ?? '',
        $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? '',
        $_SERVER['HTTP_ACCEPT_ENCODING'] ?? ''
    ];
    return md5(implode('|', array_filter($components)));
}

try {
    $short_code = isset($_GET['code']) ? mysqli_real_escape_string($con, $_GET['code']) : '';
    if (!$short_code) {
        header("Location: https://t.me/waliyabet");
        exit();
    }

    $query = "SELECT promoter_id FROM referral_count WHERE short_code = '$short_code' LIMIT 1";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $promoter_id = intval($row['promoter_id']);
    } else {
        header("Location: https://t.me/waliyabet");
        exit();
    }

    $ip_address = mysqli_real_escape_string($con, $_SERVER['REMOTE_ADDR']);
    $fingerprint = generateBrowserFingerprint();
    $timeWindow = date('Y-m-d H:i:s', strtotime('-24 hours'));

    $checkQuery = "SELECT 1 FROM referral_logs 
                   WHERE promoter_id = $promoter_id 
                   AND (ip_address = '$ip_address' OR fingerprint = '$fingerprint') 
                   AND created_at > '$timeWindow' LIMIT 1";
    $checkResult = mysqli_query($con, $checkQuery);

    if (mysqli_num_rows($checkResult) === 0) {
        mysqli_query($con, "INSERT INTO referral_logs (promoter_id, ip_address, fingerprint, created_at)
                            VALUES ($promoter_id, '$ip_address', '$fingerprint', NOW())");

        mysqli_query($con, "UPDATE referral_count SET visit_count = visit_count + 1 WHERE short_code = '$short_code'");
    }
} catch (Exception $e) {
    error_log("Referral error: " . $e->getMessage());
}

header("Location: https://t.me/waliyabet");
exit();
