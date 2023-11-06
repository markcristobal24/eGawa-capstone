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
