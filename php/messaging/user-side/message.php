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
if (isset($_POST['fetch_info_convo'])) {
    $convo_id = $_POST['convoId'];

    $query = $db->connect()->prepare("SELECT * FROM convo
    INNER JOIN account on account.account_id = convo.freelance_id
    INNER JOIN profile on profile.account_id = convo.freelance_id
    WHERE convo.convo_id = :convo_id");
    $query->execute([':convo_id' => $convo_id]);
    $data = array();
    foreach ($query as $row) {
        // $data['receiver'] = $row['$freelance_id'];
        $data['convo_id'] = $row['convo_id'];
        $data['imageProfile'] = $row['imageProfile'];
        $data['fullname'] = $row['firstName'] . ' ' . $row['lastName'];
        $data['email'] = $row['email'];
        $data['address'] = $row['address'];
        $data['freelance_id'] = $row['freelance_id'];
        $data['user_id'] = $row['user_id'];
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
                'convoId' => $convo_id,
                'sender' => ($sender_id == $_SESSION['account_id']) ? 'self' : 'other',
                'message' => $message,
                'timestamp' => $row['timestamp']
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
            $query = $db->connect()->prepare("INSERT INTO messages (convo_id, sender_id, receiver_id, message) VALUES (
                :convo_id, :sender_id, :receiver_id, :message
            )");
            $result = $query->execute([
                ':convo_id' => $convo_id,
                ':sender_id' => $_SESSION['account_id'],
                ':receiver_id' => $fetch['freelance_id'],
                ':message' => $messageInput
            ]);

            if ($result) {
                $output['success'] = "success";
                $data['message'] = $messageInput;
                $message = $data['message'];
                $channel = 'message-channel-' . $_SESSION['account_id'] . "-" . $fetch['freelance_id'];
                $event = 'message-event';
                $pusher->trigger($channel, $event, array('message' => $message, 'sender' => ($fetch['freelance_id'] == $_SESSION['account_id']) ? 'self' : 'other'));
            }
        }
    }
    echo json_encode($output);
}
