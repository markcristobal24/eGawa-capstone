<?php
require_once dirname(__FILE__) . "/../php/classes/DbConnection.php";

if (isset($_POST['jobPosts'])) {
    $user_id = $_SESSION['account_id'];

    $post_category = $_POST['post_category'];
    $post_title = $_POST['post_title'];
    $post_description = $_POST['post_description'];
    $post_tags = $_POST['post_tags'];
    $rate = $_POST['rate'];

    $currentDateTime = date("Y-m-d H:i:s");
    $dateTimeObj = new DateTime($currentDateTime);
    $posted_date = $dateTimeObj->format("F d, Y h:i A");

    if ($post_title === "" || $post_description === "" || $post_tags === "" || $rate === "") {
        $output['error'] = "Incomplete Details!";
    } else {

    }
}
?>