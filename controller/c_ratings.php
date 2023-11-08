<?php
require_once dirname(__FILE__) . "/../php/classes/DbClass.php";
require_once dirname(__FILE__) . "/../php/classes/Email.php";
require_once dirname(__FILE__) . "/../php/classes/Account.php";

$db = new DbClass();

if (isset($_POST['rating_data'])) {
    $review_img = $_FILES['review_ss']['tmp_name'];
    $image_link = $review_img;

    if ($review_img !== '') {
        $generate_name = new Account();
        $image_filename = $generate_name->generate_imageName(3);
        $image_directory = '../img/uploads/company/reviews/' . $image_filename . basename($_FILES['review_ss']['name']);
        $image_link = $image_filename . basename($_FILES['review_ss']['name']);
        move_uploaded_file($review_img, $image_directory);
    }

    $data = array(
        ':company_id' => $_SESSION['account_id'],
        ':user_rating' => $_POST['rating_data'],
        ':user_review' => $_POST['user_review'],
        ':review_ss' => $image_link,
        ':application_id' => $_SESSION['application_id'],
        ':freelancer_id' => $_POST['freelance_id'],
        ':datetime' => time()
    );

    $query = $db->connect()->prepare("INSERT INTO reviews (application_id, company_id, freelancer_id, rating, review, screenshot, timestamp)
    VALUES (:application_id, :company_id, :freelancer_id, :user_rating, :user_review, :review_ss, :datetime)");
    $result = $query->execute($data);

    if ($result) {
        $output['success'] = "Your reviews has been submitted.";
        $query = $db->connect()->prepare("UPDATE job_application SET jobstatus= :jobstatus WHERE application_id = :application_id");
        $exec = $query->execute([
            ':jobstatus' => 'COMPLETED',
            ':application_id' => $_SESSION['application_id']
        ]);
        if ($exec) {
            $query = $db->connect()->prepare("INSERT INTO activity_logs (account_id, event, user_type) VALUES (:account_id, :event, :user_type)");
            $query->execute([
                ':account_id' => $_SESSION['account_id'],
                ':event' => 'Added a review',
                ':user_type' => 'company'
            ]);
        }
    } else {
        $output['error'] = "Something went wrong. Please try again later.";
    }

    echo json_encode($output);
}

if (isset($_POST['action'])) {
    $average_rating = 0;
    $total_review = 0;
    $five_star_review = 0;
    $four_star_review = 0;
    $three_star_review = 0;
    $two_star_review = 0;
    $one_star_review = 0;
    $total_user_rating = 0;
    $review_content = array();

    date_default_timezone_set("Asia/Manila");

    $query = $db->connect()->prepare("SELECT * FROM reviews INNER JOIN account ON account.account_id = reviews.company_id WHERE reviews.freelancer_id = :freelance_id ORDER BY timestamp DESC");
    $query->execute([':freelance_id' => $_SESSION['freelance_id']]);

    foreach ($query as $row) {
        $review_content[] = array(
            'user_name' => $row['firstName'] . ' ' . $row['lastName'],
            'user_review' => $row['review'],
            'rating' => $row['rating'],
            'screenshot' => $row['screenshot'],
            'user_image' => $row['user_image'],
            'datetime' => date('l jS, F Y h:i:s A', $row['timestamp'])
        );

        if ($row['rating'] == '5') {
            $five_star_review++;
        }

        if ($row['rating'] == '4') {
            $four_star_review++;
        }

        if ($row['rating'] == '3') {
            $three_star_review++;
        }

        if ($row['rating'] == '2') {
            $two_star_review++;
        }

        if ($row['rating'] == '1') {
            $one_star_review++;
        }

        $total_review++;

        $total_user_rating = $total_user_rating + $row['rating'];
    }

    $average_rating = $total_user_rating / $total_review;

    $output = array(
        'average_rating' => number_format($average_rating, 1),
        'total_review' => $total_review,
        'five_star_review' => $five_star_review,
        'four_star_review' => $four_star_review,
        'three_star_review' => $three_star_review,
        'two_star_review' => $two_star_review,
        'one_star_review' => $one_star_review,
        'review_data' => $review_content
    );

    echo json_encode($output);
}

if (isset($_POST['fetch_ratings_freelancerpov'])) {
    $freelancer_id = $_POST['freelance_id'];
    $average_rating = 0;
    $total_review = 0;
    $five_star_review = 0;
    $four_star_review = 0;
    $three_star_review = 0;
    $two_star_review = 0;
    $one_star_review = 0;
    $total_user_rating = 0;
    $review_content = array();

    date_default_timezone_set("Asia/Manila");

    $query = $db->connect()->prepare("SELECT * FROM reviews INNER JOIN account ON account.account_id = reviews.company_id  WHERE reviews.freelancer_id = :freelance_id");
    $query->execute([':freelance_id' => $freelancer_id]);

    foreach ($query as $row) {
        $review_content[] = array(
            'user_name' => $row['firstName'] . ' ' . $row['lastName'],
            'user_review' => $row['review'],
            'rating' => $row['rating'],
            'screenshot' => $row['screenshot'],
            'user_image' => $row['user_image'],
            'datetime' => date('l jS, F Y h:i:s A', $row['timestamp'])
        );

        if ($row['rating'] == '5') {
            $five_star_review++;
        }

        if ($row['rating'] == '4') {
            $four_star_review++;
        }

        if ($row['rating'] == '3') {
            $three_star_review++;
        }

        if ($row['rating'] == '2') {
            $two_star_review++;
        }

        if ($row['rating'] == '1') {
            $one_star_review++;
        }

        $total_review++;

        $total_user_rating = $total_user_rating + $row['rating'];
    }

    $average_rating = $total_user_rating / $total_review;

    $output = array(
        'average_rating' => number_format($average_rating, 1),
        'total_review' => $total_review,
        'five_star_review' => $five_star_review,
        'four_star_review' => $four_star_review,
        'three_star_review' => $three_star_review,
        'two_star_review' => $two_star_review,
        'one_star_review' => $one_star_review,
        'review_data' => $review_content
    );

    echo json_encode($output);
}
