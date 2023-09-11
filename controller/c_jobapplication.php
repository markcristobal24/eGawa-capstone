<?php
require_once dirname(__FILE__) . "/../php/classes/DbClass.php";

$db = new DbClass();

if (isset($_POST['send_job'])) {
    date_default_timezone_set("Asia/Manila");
    $currentDateTime = date("Y-m-d H:i:s");

    $post_id = $_POST['postId'];
    $query = $db->connect()->prepare("SELECT * FROM jobposts WHERE post_id = :post_id");
    $query->execute([':post_id' => $post_id]);
    $fetch = $query->fetch(PDO::FETCH_ASSOC);
    if(isset($_POST['apply_message'])) {
        $apply_message = $_POST['apply_message'];
        $sender_id = $_SESSION['account_id'];
        $receiver_id = $fetch['account_id'];

        if ($apply_message !== "") {
            $query = $db->connect()->prepare("INSERT INTO job_application (sender_id, receiver_id, message, timestamp, status)
            VALUES (:sender_id, :receiver_id, :message, :timestamp, :status)");
            $result = $query->execute([
                ':sender_id' => $sender_id,
                ':receiver_id' => $receiver_id,
                ':message' => $apply_message,
                ':timestamp' => $currentDateTime,
                ':status' => 'PENDING'
            ]);

            if ($result) {
                $output['success'] = "Job Application successfully sent!";
            }
            else {
                $output['error'] = "Something went wrong! Please try again later.";
            }
        }
        else {
            $output['error'] = "Please provide an application letter";
        }
    } 
    echo json_encode($output);
}
?>