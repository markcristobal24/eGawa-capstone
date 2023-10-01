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
    if (isset($_POST['apply_message'])) {
        $apply_message = $_POST['apply_message'];
        $sender_id = $_SESSION['account_id'];
        $receiver_id = $fetch['account_id'];

        if ($apply_message !== "") {
            $query = $db->connect()->prepare("INSERT INTO job_application (post_id, freelance_id, user_id, message, timestamp, jobstatus)
            VALUES (:post_id, :sender_id, :receiver_id, :message, :timestamp, :jobstatus)");
            $result = $query->execute([
                ':post_id' => $post_id,
                ':sender_id' => $sender_id,
                ':receiver_id' => $receiver_id,
                ':message' => $apply_message,
                ':timestamp' => $currentDateTime,
                ':jobstatus' => 'PENDING'
            ]);

            if ($result) {
                $output['success'] = "Job Application successfully sent!";
            } else {
                $output['error'] = "Something went wrong! Please try again later.";
            }
        } else {
            $output['error'] = "Please provide an application letter";
        }
    }
    echo json_encode($output);
}

if (isset($_POST['view_job'])) {
    $job_id = $_POST['jobId'];
    $query = $db->connect()->prepare(
        "SELECT * FROM job_application
                                INNER JOIN jobposts ON job_application.post_id = jobposts.post_id
                                INNER JOIN account ON job_application.freelance_id = account.account_id
                                WHERE job_application.application_id = :job_id"
    );
    $query->execute([
        ':job_id' => $job_id
    ]);
    $data = array();
    foreach ($query as $row) {
        $data['application_id'] = $row['application_id'];
        $data['post_title'] = $row['post_title'];
        $data['from_name'] = $row['firstName'] . " " . $row['lastName'];
        $data['jobstatus'] = $row['jobstatus'];
        $data['message'] = $row['message'];
    }
    echo json_encode($data);
}

if (isset($_POST['decline_job'])) {
    $job_id = $_POST['jobId'];

    $query = $db->connect()->prepare("DELETE FROM job_application WHERE application_id = :application_id");
    $result = $query->execute([
        ':application_id' => $job_id
    ]);
    if ($result) {
        $output['success'] = "You have declined the job application!";
    } else {
        $output['error'] = "Something went wrong! Please reload the page.";
    }
    echo json_encode($output);
}

if (isset($_POST['accept_job'])) {
    $job_id = $_POST['jobId'];

    $query = $db->connect()->prepare("UPDATE job_application SET jobstatus = :jobstatus WHERE application_id = :application_id");
    $result = $query->execute([
        ':jobstatus' => 'ONGOING',
        ':application_id' => $job_id
    ]);
    if ($result) {
        $query = $db->connect()->prepare("SELECT * FROM job_application WHERE application_id = :jobId");
        $query->execute([':jobId' => $job_id]);
        $output = array();
        foreach ($query as $row) {
            $output['user_id'] = $row['user_id'];
            $output['freelance_id'] = $row['freelance_id'];
        }
        $output['success'] = "You have accepted the job application!";
    } else {
        $output['error'] = "Something went wrong! Please reload the page.";
    }

    echo json_encode($output);
}

if (isset($_POST['create_convo'])) {
    $user_id = $_POST['user_id'];
    $freelance_id = $_POST['freelance_id'];

    $query = $db->connect()->prepare("INSERT INTO convo (user_id, freelance_id) VALUES (:user_id, :freelance_id)");
    $result = $query->execute([
        ':user_id' => $user_id,
        ':freelance_id' => $freelance_id
    ]);

    if ($result) {
        $query = $db->connect()->prepare("SELECT * FROM convo WHERE user_id = :user_id AND freelance_id = :freelance_id");
        $query->execute([
            ':user_id' => $user_id,
            ':freelance_id' => $freelance_id
        ]);
        $fetch = $query->fetch(PDO::FETCH_ASSOC);
        $convo_id = $fetch['convo_id'];
        $sender = $user_id;
        $receiver = $freelance_id;
        $message = "Hi! I accepted your application. Kindly reply as soon as possible. Thank you!";

        $stmt = $db->connect()->prepare("INSERT INTO messages (convo_id, sender_id, receiver_id, message) VALUES (
            :convo_id, :sender_id, :receiver_id, :message
        )");
        $stmt->execute([
            ':convo_id' => $convo_id,
            ':sender_id' => $sender,
            ':receiver_id' => $receiver,
            ':message' => $message
        ]);
    }

    echo json_encode($output);
}
?>