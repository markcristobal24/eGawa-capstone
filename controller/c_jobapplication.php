<?php
require_once dirname(__FILE__) . "/../php/classes/DbClass.php";
require_once dirname(__FILE__) . "/../php/classes/Account.php";
require_once dirname(__FILE__) . "/../php/classes/Email.php";

$db = new DbClass();
$acc = new Account();
$email_notif = new Email();

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
                $query = $db->connect()->prepare("SELECT * FROM account WHERE account_id = :account_id");
                $query->execute([':account_id' => $receiver_id]);
                $fetch = $query->fetch(PDO::FETCH_ASSOC);
                $email = $fetch['email'];
                $subject = "Job Application";
                $link = "/user/user_message.php";
                $notice = "A freelancer sent an application to your job post.<br><br>" . $apply_message;
                $button_value = "Go to Account";
                $body = $acc->apply_email($link, $notice, $button_value);
                $email_notif->sendEmail("eGawa", $email, $subject, $body);
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
        $data['freelance_id'] = $row['freelance_id'];
    }
    $_SESSION['application_id'] = $data['application_id'];
    echo json_encode($data);
}

if (isset($_POST['view_job_f'])) {
    $job_id = $_POST['jobId'];
    $query = $db->connect()->prepare(
        "SELECT * FROM job_application
                                INNER JOIN jobposts ON job_application.post_id = jobposts.post_id
                                INNER JOIN account ON job_application.user_id = account.account_id
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
        $data['user_id'] = $row['user_id'];
    }
    $_SESSION['application_id'] = $data['application_id'];
    echo json_encode($data);
}

if (isset($_POST['decline_job'])) {
    $job_id = $_POST['jobId'];

    $query = $db->connect()->prepare("UPDATE job_application SET jobstatus = :jobstatus WHERE application_id = :application_id");
    $result = $query->execute([
        ':jobstatus' => 'DECLINED',
        ':application_id' => $job_id
    ]);
    if ($result) {
        $output['success'] = "You have declined the job application!";
        $query = $db->connect()->prepare("SELECT * FROM job_application INNER JOIN account ON account.account_id = job_application.freelance_id WHERE job_application.application_id = :application_id");
        $query->execute([':application_id' => $job_id]);
        $fetch_id = $query->fetch(PDO::FETCH_ASSOC);
        $email = $fetch_id['email'];
        $lastname = $fetch_id['lastName'];
        $subject = "Job Application";
        $notice = "Dear Mr./Mrs./Ms. $lastname:<br><br>I hope this message finds you well. We want to express our appreciation for your interest on our job post.
        We carefully reviewed your application, and while your qualifications are impressive, we regret to inform you that we have chosen to move forward
        with another candidate who closely aligns with our requirements.";
        $body = $acc->deny_email($notice);
        $email_notif->sendEmail("eGawa", $email, $subject, $body);
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
        $query = $db->connect()->prepare("SELECT * FROM job_application INNER JOIN account ON account.account_id = job_application.freelance_id INNER JOIN jobposts ON jobposts.post_id = job_application.post_id WHERE job_application.application_id = :application_id");
        $query->execute([':application_id' => $job_id]);
        $fetch_id = $query->fetch(PDO::FETCH_ASSOC);
        $email = $fetch_id['email'];
        $lastname = $fetch_id['lastName'];
        $post_id = $fetch_id['post_id'];
        $subject = "Job Application - " . strtoupper($fetch_id['post_title']);
        $link = "/freelance/freelance_message.php";
        $notice = "Dear Mr./Mrs./Ms. $lastname:<br><br>Hi! I accepted your application. Kindly reply as soon as possible. Thank you!";
        $button_value = "Go to Account";
        $body = $acc->apply_email($link, $notice, $button_value);
        if ($email_notif->sendEmail("eGawa", $email, $subject, $body)) {
            $query = $db->connect()->prepare("UPDATE jobposts SET post_status = :post_status WHERE post_id = :post_id");
            $query->execute([
                ':post_status' => 'ARCHIVED',
                ':post_id' => $post_id
            ]);
        }
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
