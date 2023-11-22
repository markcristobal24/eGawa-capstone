<?php
require_once dirname(__FILE__) . "/../../classes/DbClass.php";
require '../../../vendor/autoload.php';
$db = new DbClass();

$options = array(
    'cluster' => 'ap1',
    'useTLS' => true
);
$pusher = new Pusher\Pusher(
    '7717fc588fb67a40c2c6',
    'ce2de37e95416673e758',
    '1650503',
    $options
);
date_default_timezone_set('Asia/Manila');
$currentDateTime = date("Y-m-d H:i");
if (isset($_POST['fetch_info_convo'])) {
    $convo_id = $_POST['convoId'];

    $query = $db->connect()->prepare("SELECT * FROM convo
    INNER JOIN account on account.account_id = convo.user_id
    WHERE convo.convo_id = :convo_id");
    $query->execute([':convo_id' => $convo_id]);
    $data = array();
    foreach ($query as $row) {
        // $data['receiver'] = $row['$freelance_id'];
        $data['imageProfile'] = $row['user_image'];
        $data['fullname'] = $row['firstName'] . ' ' . $row['lastName'];
        $data['email'] = $row['email'];
        $data['barangay'] = $row['barangay'];
        $data['municipality'] = $row['municipality'];
        $data['province'] = $row['province'];
        $data['freelance_id'] = $row['freelance_id'];
        $data['user_id'] = $row['user_id'];
        $data['username'] = $row['username'];
    }
    echo json_encode($data);
}

if (isset($_POST['fetch_messages'])) {
    $convo_id = $_POST['convoId'];

    $query = $db->connect()->prepare("SELECT * FROM messages WHERE convo_id = :convo_id ORDER BY timestamp ASC");
    $query->execute([':convo_id' => $convo_id]);

    if ($query->rowCount() > 0) {
        $messages = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $sender_id = $row['sender_id'];
            $message = $row['message'];

            $messageData = array(
                'sender' => ($sender_id == $_SESSION['account_id']) ? 'self' : 'other',
                'message' => $message
            );

            $messages[] = $messageData;

            // if ($sender_id == $_SESSION['account_id']) {
            //     $data['sender'] = 'self';
            //     $data['message'] = $message;
            // } else {
            //     $data['sender'] = 'other';
            //     $data['message'] = $message;
            // }
        }
        // $pusher->trigger('my-channel', 'new-message', array('messages' => $messages));
        echo json_encode(array('messages' => $messages));
    }
}

if (isset($_POST['send_message'])) {
    $convo_id = $_POST['convoId'];
    $query = $db->connect()->prepare("SELECT * FROM convo WHERE convo_id = :convo_id");
    $result = $query->execute([':convo_id' => $convo_id]);
    $fetch = $query->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $messageInput = $_POST['messageInput'];
        if ($messageInput !== '') {
            $query = $db->connect()->prepare("INSERT INTO messages (convo_id, sender_id, receiver_id, message, timestamp) VALUES (
                :convo_id, :sender_id, :receiver_id, :message, :timestamp
            )");
            $result = $query->execute([
                ':convo_id' => $convo_id,
                ':sender_id' => $_SESSION['account_id'],
                ':receiver_id' => $fetch['user_id'],
                ':message' => $messageInput,
                ':timestamp' => $currentDateTime
            ]);

            if ($result) {
                $output['success'] = "success";
                $data['message'] = $messageInput;
                $message = $data['message'];
                $channel = 'message-channel-' . $fetch['user_id'] . "-" . $_SESSION['account_id'];
                $event = 'message-event';
                $pusher->trigger($channel, $event, array('message' => $message, 'sender' => ($fetch['user_id'] == $_SESSION['account_id']) ? 'self' : 'other'));
            }
        }
    }
    echo json_encode($output);
}

if (isset($_POST['send_report'])) {
    $reported_id = $_POST['id'];
    $account_id = $_SESSION['account_id'];
    $report_screenshot = $_FILES['report_ss']['tmp_name'];
    $report_reason = $_POST['report_reason'];

    if ($report_screenshot != '' && $report_reason !== '') {
        $image_link = $report_screenshot;
        $image_directory = '../../../img/uploads/reports/' . basename($_FILES['report_ss']['name']);
        $image_link = basename($_FILES['report_ss']['name']);
        move_uploaded_file($report_screenshot, $image_directory);

        $query = $db->connect()->prepare("INSERT INTO reports (account_id, reported_id, screenshot, reason, report_status, timestamp)
        VALUES (:account_id, :reported_id, :screenshot, :reason, :report_status, :timestamp)");
        $result = $query->execute([
            ':account_id' => $account_id,
            ':reported_id' => $reported_id,
            ':screenshot' => $image_link,
            ':reason' => $report_reason,
            ':report_status' => 'PENDING',
            ':timestamp' => $currentDateTime
        ]);

        if ($result) {
            $output['success'] = "Report submitted successfully";
            $query = $db->connect()->prepare("INSERT INTO activity_logs (account_id, timestamp, event, user_type) VALUES (:account_id, :timestamp, :event, :user_type)");
            $query->execute([
                ':account_id' => $_SESSION['account_id'],
                ':timestamp' => $currentDateTime,
                ':event' => 'Submit a report',
                ':user_type' => $_SESSION['userType']
            ]);
        }
    } else {
        $output['error'] = "Incomplete Details.";
    }

    echo json_encode($output);
}
