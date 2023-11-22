<?php
require_once dirname(__FILE__) . "/../php/classes/DbClass.php";
$db = new DbClass();
date_default_timezone_set("Asia/Manila");
$currentDateTime = date("Y-m-d H:i:s");
if (isset($_POST['logout'])) {
    $query = $db->connect()->prepare("INSERT INTO activity_logs (account_id, timestamp, event, user_type) VALUES (:account_id, :timestamp, :event, :user_type)");
    $query->execute([
        ':account_id' => $_SESSION['account_id'],
        ':timestamp' => $currentDateTime,
        ':event' => 'Logged Out',
        ':user_type' => $_SESSION['userType']
    ]);
    session_unset();
    session_destroy();

    $output['success'] = "Logging out...";
    echo json_encode($output);
}

if (isset($_POST['logout_admin'])) {
    session_unset();
    session_destroy();

    $output['success'] = "Logging out...";
    echo json_encode($output);
}
