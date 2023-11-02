<?php
require_once dirname(__FILE__) . "/../php/classes/DbClass.php";

$db = new DbClass();

if (isset($_POST['get_information_freelancer'])) {
    $freelance_id = $_SESSION['account_id'];
    $sub_array = array();

    $total_applied_freelancer = $db->connect()->prepare('SELECT * FROM job_application WHERE freelance_id = ' . $freelance_id . '');
    $total_applied_freelancer->execute();
    $sub_array['total_applied_freelancer'] = $total_applied_freelancer->rowCount();

    $total_accepted_freelancer = $db->connect()->prepare('SELECT * FROM job_application WHERE freelance_id = ' . $freelance_id . ' AND jobstatus = "ONGOING" OR jobstatus = "COMPLETED"');
    $total_accepted_freelancer->execute();
    $sub_array['total_accepted_freelancer'] = $total_accepted_freelancer->rowCount();

    $total_declined_freelancer = $db->connect()->prepare('SELECT * FROM job_application WHERE freelance_id = ' . $freelance_id . ' AND jobstatus = "DECLINED"');
    $total_declined_freelancer->execute();
    $sub_array['total_declined_freelancer'] = $total_declined_freelancer->rowCount();

    $data[] = $sub_array;

    $output = array("data" => $data);
    echo json_encode($output);
}

if (isset($_POST['get_information_company'])) {
    $company_id = $_SESSION['account_id'];
    $sub_array = array();

    $total_posts = $db->connect()->prepare('SELECT * FROM jobposts WHERE account_id = ' . $company_id . ' AND post_status != :status');
    $total_posts->execute([':status' => 'ARCHIVED']);
    $sub_array['total_posts'] = $total_posts->rowCount();

    $total_accepted = $db->connect()->prepare('SELECT * FROM job_application WHERE user_id = ' . $company_id . ' AND jobstatus = "ONGOING" OR jobstatus = "COMPLETED"');
    $total_accepted->execute();
    $sub_array['total_accepted'] = $total_accepted->rowCount();

    $total_declined = $db->connect()->prepare('SELECT * FROM job_application WHERE user_id = ' . $company_id . ' AND jobstatus = "DECLINED"');
    $total_declined->execute();
    $sub_array['total_declined'] = $total_declined->rowCount();

    $data[] = $sub_array;

    $output = array("data" => $data);
    echo json_encode($output);
}

if (isset($_POST['get_information_freelancer_employerpov'])) {
    $freelance_id = $_POST['freelance_id'];

    $sub_array = array();

    $total_applied_freelancer = $db->connect()->prepare('SELECT * FROM job_application WHERE freelance_id = ' . $freelance_id . '');
    $total_applied_freelancer->execute();
    $sub_array['total_applied_freelancer'] = $total_applied_freelancer->rowCount();

    $total_accepted_freelancer = $db->connect()->prepare('SELECT * FROM job_application WHERE freelance_id = ' . $freelance_id . ' AND jobstatus = "ONGOING" OR jobstatus = "COMPLETED"');
    $total_accepted_freelancer->execute();
    $sub_array['total_accepted_freelancer'] = $total_accepted_freelancer->rowCount();

    $total_declined_freelancer = $db->connect()->prepare('SELECT * FROM job_application WHERE freelance_id = ' . $freelance_id . ' AND jobstatus = "DECLINED"');
    $total_declined_freelancer->execute();
    $sub_array['total_declined_freelancer'] = $total_declined_freelancer->rowCount();

    $data[] = $sub_array;

    $output = array("data" => $data);
    echo json_encode($output);
}

if (isset($_POST['get_information_company_freelancerpov'])) {
    $company_id = $_POST['company_id'];
    $sub_array = array();

    $total_posts = $db->connect()->prepare('SELECT * FROM jobposts WHERE account_id = ' . $company_id . ' AND post_status != :status');
    $total_posts->execute([':status' => 'ARCHIVED']);
    $sub_array['total_posts'] = $total_posts->rowCount();

    $total_accepted = $db->connect()->prepare('SELECT * FROM job_application WHERE user_id = ' . $company_id . ' AND jobstatus = "ONGOING" OR jobstatus = "COMPLETED"');
    $total_accepted->execute();
    $sub_array['total_accepted'] = $total_accepted->rowCount();

    $total_declined = $db->connect()->prepare('SELECT * FROM job_application WHERE user_id = ' . $company_id . ' AND jobstatus = "DECLINED"');
    $total_declined->execute();
    $sub_array['total_declined'] = $total_declined->rowCount();

    $data[] = $sub_array;

    $output = array("data" => $data);
    echo json_encode($output);
}
