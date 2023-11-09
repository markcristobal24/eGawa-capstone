<?php
require_once dirname(__FILE__) . "/../php/classes/DbClass.php";
require_once dirname(__FILE__) . "/../php/classes/Email.php";

$db = new DbClass();
$send_email = new Email();

if (isset($_POST['accept_id'])) {
    $id = $_POST['id'];

    $query = $db->connect()->prepare("SELECT * FROM id_verification INNER JOIN account ON id_verification.account_id = account.account_id
    WHERE id_verification.id = :id");
    $query->execute([':id' => $id]);
    $fetch = $query->fetch(PDO::FETCH_ASSOC);

    if ($query->rowCount() > 0) {
        $stmt = $db->connect()->prepare("UPDATE id_verification SET verify_status = :status WHERE id = :id");
        $result = $stmt->execute([':status' => "VERIFIED", ':id' => $id]);

        if ($result) {
            $output['success'] = "Verification has been accepted.";
            $email = $fetch['email'];
            $subject = "Successful ID Verification";
            $body = "<b>Dear Mr./Ms./Mrs. " . $fetch['lastName'] . "</b><br><br>
            We are pleased to inform you that your recent ID verification request has been successfully accepted. After a comprehensive review, we have verified the provided identification to our required standards.

Congratulations on completing the verification process! This marks an important step in your interaction with our services, and we appreciate your commitment to upholding the necessary security measures. <br><br><br>
Best Regards, <br><br> <b>eGawa</b>";
            $send_email->sendEmail("eGawa", $email, $subject, $body);

            if ($send_email) {
                $checkmark = '<i class="text-primary bi bi-patch-check-fill"></i>';
                $verified_check = $db->connect()->prepare("UPDATE account SET checkmark = :checkmark WHERE account_id = :account_id");
                $verified_check->execute([
                    ':checkmark' => $checkmark,
                    ':account_id' => $fetch['account_id']
                ]);
            }
        }
    } else {
        $output['error'] = "Something went wrong. Please try again later.";
    }

    echo json_encode($output);
}

if (isset($_POST['deny_id'])) {
    $id = $_POST['id'];

    $query = $db->connect()->prepare("SELECT * FROM id_verification INNER JOIN account ON id_verification.account_id = account.account_id
    WHERE id_verification.id = :id");
    $query->execute([':id' => $id]);
    $fetch = $query->fetch(PDO::FETCH_ASSOC);

    if ($query->rowCount() > 0) {
        $stmt = $db->connect()->prepare("UPDATE id_verification SET verify_status = :status WHERE id = :id");
        $result = $stmt->execute([':status' => "DENIED", ':id' => $id]);

        if ($result) {
            $output['success'] = "Verification has been denied.";
            $email = $fetch['email'];
            $subject = "Denial of ID Verification";
            $body = "<b>Dear Mr./Ms./Mrs. " . $fetch['lastName'] . "</b><br><br>
            <p>We regret to inform you that your recent ID verification request has been denied. After a thorough review, we were unable to verify the provided identification to our required standards.

Please note that this decision is not a reflection of your credibility but rather a result of our stringent verification processes. We understand that this may be disappointing, and we sincerely apologize for any inconvenience this may cause.</p><br><br>
Best Regards, <br><br> <b>eGawa</b>";
            $send_email->sendEmail("eGawa", $email, $subject, $body);
        }
    } else {
        $output['error'] = "Something went wrong. Please try again later.";
    }

    echo json_encode($output);
}

if (isset($_POST['fetch_report'])) {
    $report_id = $_POST['report_id'];

    $query = $db->connect()->prepare("SELECT * FROM reports INNER JOIN account ON account.account_id = reports.reported_id WHERE report_id = :report_id");
    $query->execute([':report_id' => $report_id]);
    $data = array();
    foreach ($query as $row) {
        $data['reporter'] = $_POST['reporter'];
        $data['account_id'] = $row['account_id'];
        $data['reported_account'] = $row['firstName'] . ' ' . $row['lastName'];
        $data['reason'] = $row['reason'];
        $data['screenshot'] = $row['screenshot'];
    }

    echo json_encode($data);
}

if (isset($_POST['search_logs'])) {
    $type = $_POST['type'];

    if ($type == 'freelancer') {
        $filter_value = $_POST['filter_value'];
        $query = $db->connect()->prepare("SELECT * FROM activity_logs INNER JOIN account ON account.account_id = activity_logs.account_id WHERE user_type = :user_type 
        AND (activity_logs.account_id LIKE '$filter_value%' OR timestamp LIKE '%$filter_value%' OR firstName LIKE '$filter_value%' OR lastName LIKE '$filter_value%') ORDER BY activity_logs.timestamp DESC");
        $query->execute([':user_type' => 'freelancer']);
        $output = array();
        $output['result'] = '';

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $currentDateTime = $row['timestamp'];
            $dateTimeObj = new DateTime($currentDateTime);
            $timestamp = $dateTimeObj->format("Y-m-d h:i A");

            $output['result'] .= '
            <tr>
                                    <th scope="row">' . $row['event_id'] . '</th>
                                    <td>' . $timestamp . '</td>
                                    <td>' . $row['account_id'] . '</td>
                                    <td>' . $row['firstName'] . ' ' . $row['lastName'] . '</td>
                                    <td>' . $row['event'] . '</td>
                                </tr>
            ';
        }
        $output['error'] = '
         <tr>
                                    <th scope="row"></th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
        ';

        echo json_encode($output);
    } else if ($type == 'company') {
        $filter_value = $_POST['filter_value'];
        $query = $db->connect()->prepare("SELECT * FROM activity_logs INNER JOIN account ON account.account_id = activity_logs.account_id WHERE (user_type = :user_type 
        OR user_type = :other) AND (activity_logs.account_id LIKE '$filter_value%' OR timestamp LIKE '%$filter_value%' OR firstName LIKE '$filter_value%' OR lastName LIKE '$filter_value%') ORDER BY activity_logs.timestamp DESC");
        $query->execute([':user_type' => 'company', ':other' => 'user']);
        $output = array();
        $output['result'] = '';

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $currentDateTime = $row['timestamp'];
            $dateTimeObj = new DateTime($currentDateTime);
            $timestamp = $dateTimeObj->format("Y-m-d h:i A");

            $output['result'] .= '
            <tr>
                                    <th scope="row">' . $row['event_id'] . '</th>
                                    <td>' . $timestamp . '</td>
                                    <td>' . $row['account_id'] . '</td>
                                    <td>' . $row['firstName'] . ' ' . $row['lastName'] . '</td>
                                    <td>' . $row['event'] . '</td>
                                </tr>
            ';
        }
        $output['error'] = '
         <tr>
                                    <th scope="row"></th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
        ';

        echo json_encode($output);
    } else if ($type == 'message') {
        $filter_value = $_POST['filter_value'];
        $query = $db->connect()->prepare("SELECT * FROM messages WHERE sender_id LIKE '$filter_value%' OR receiver_id LIKE '$filter_value%' ORDER BY timestamp DESC");
        $query->execute();
        $output = array();
        $output['result'] = '';

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $currentDateTime = $row['timestamp'];
            $dateTimeObj = new DateTime($currentDateTime);
            $timestamp = $dateTimeObj->format("Y-m-d h:i A");

            $output['result'] .= '
            <tr>
                                        <th scope="row">' . $row['message_id'] . '</th>
                                        <td>' . $timestamp . '</td>
                                        <td>' . $row['sender_id'] . '</td>
                                        <td>' . $row['receiver_id'] . '</td>
                                        <td>' . $row['message'] . '</td>
                                    </tr>
            ';
        }
        $output['error'] = '
         <tr>
                                    <th scope="row"></th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
        ';

        echo json_encode($output);
    }
}
