<?php
require_once dirname(__FILE__) . "/../php/classes/DbClass.php";
$db = new DbClass();

if (isset($_POST['logout'])) {
    $query = $db->connect()->prepare("INSERT INTO activity_logs (account_id, event, user_type) VALUES (:account_id, :event, :user_type)");
    $query->execute([
        ':account_id' => $_SESSION['account_id'],
        ':event' => 'Logged Out',
        ':user_type' => $_SESSION['userType']
    ]);
    session_unset();
    session_destroy();

    $output['success'] = "Logging out...";
    echo json_encode($output);
}
