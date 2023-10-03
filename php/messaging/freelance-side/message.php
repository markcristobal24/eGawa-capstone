<?php
require_once dirname(__FILE__) . "/../../classes/DbClass.php";
$db = new DbClass();

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
        $data['address'] = $row['address'];
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
                ':receiver_id' => $fetch['user_id'],
                ':message' => $messageInput
            ]);

            if ($result) {
                $output['success'] = "success";
            }
        }
    }
    echo json_encode($output);
}
?>