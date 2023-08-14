<?php
session_start();
require_once dirname(__FILE__) . "/../php/classes/DbConnection.php";

if (isset($_POST['jobPosts'])) {
    $user_id = $_SESSION['account_id'];

    $post_category = $_POST['post_category'];
    $post_title = $_POST['post_title'];
    $post_description = $_POST['post_description'];
    $post_tags = $_POST['post_tags'];
    $rate = $_POST['rate'];

    date_default_timezone_set("Asia/Manila");
    $currentDateTime = date("Y-m-d H:i:s");


    if ($post_title === "" || $post_description === "" || $post_tags === "" || $rate === "") {
        $output['error'] = "Incomplete Details!";
    } else {
        $sql = $con->prepare("INSERT INTO jobposts (account_id, category, post_title, post_description, post_tags, rate, posted_date) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $sql->bind_param("sssssss", $user_id, $post_category, $post_title, $post_description, $post_tags, $rate, $currentDateTime);
        $sql->execute();

        if ($sql) {
            $output['success'] = "Posted Successfully";
        } else {
            $output['error'] = "Something went wrong. Please try again later.";
        }
    }
    echo json_encode($output);
}

if (isset($_POST['filter_post'])) {
    $filterValue = $_POST['filterValue'];

    $fetch_post = mysqli_query($con, "SELECT * FROM jobposts INNER JOIN account ON jobposts.account_id = account.account_id WHERE jobposts.category = '$filterValue' ORDER BY posted_date DESC");
    $output = array();
    if ($fetch_post->num_rows > 0) {
        $output['success'] = '';
        foreach ($fetch_post as $row) {
            $currentDateTime = $row['posted_date'];
            $dateTimeObj = new DateTime($currentDateTime);
            $posted_date = $dateTimeObj->format("F d, Y h:i A");
            $output['success'] .= '
            <div class="containerPost">
                <span class="titlePost">' . $row['post_title'] . '</span>
                <div>
                    <span class="author">Author: </span>
                    <span class="userPost">' . $row['firstName'] . ' ' . $row['lastName'] . '</span>
                </div>
                <div>
                    <span class="locationPost">' . $row['address'] . '</span>
                    <span>•</span>
                    <span class="datePost">Posted on ' . $posted_date . '</span>
                </div>

                <p class="descPost">
                    ' . $row['post_description'] . '
                </p>
                <div>
                    <button id="viewPostBTN" onclick="new Posts().view_post(' . $row['post_id'] . ');">View Post</button>
                </div>
            </div>
            ';
        }
    } else if ($filterValue === "all") {
        $fetch_post = mysqli_query($con, "SELECT * FROM jobposts INNER JOIN account ON jobposts.account_id = account.account_id ORDER BY posted_date DESC");
        $output = array();
        $output['success'] = '';
        foreach ($fetch_post as $row) {
            $currentDateTime = $row['posted_date'];
            $dateTimeObj = new DateTime($currentDateTime);
            $posted_date = $dateTimeObj->format("F d, Y h:i A");
            $output['success'] .= '
            <div class="containerPost">
                <span class="titlePost">' . $row['post_title'] . '</span>
                <div>
                    <span class="author">Author: </span>
                    <span class="userPost">' . $row['firstName'] . ' ' . $row['lastName'] . '</span>
                </div>
                <div>
                    <span class="locationPost">' . $row['address'] . '</span>
                    <span>•</span>
                    <span class="datePost">Posted on ' . $posted_date . '</span>
                </div>

                <p class="descPost">
                    ' . $row['post_description'] . '
                </p>
                <div>
                    <button id="viewPostBTN" onclick="new Posts().view_post(' . $row['post_id'] . ');">View Post</button>
                </div>
            </div>
            ';
        }
    } else {
        $output['error'] = '<div class="noResult">
                                <div class="noResultIMG">
                                    <img id="noIMG" src="../img/search.png" alt="">
                                </div>
                                <div class="noResultText">
                                    <span>
                                    No post available
                                    </span>
                                </div>
                            </div>';
    }
    echo json_encode($output);
}

if (isset($_POST['view_post'])) {
    $post_id = $_POST['id'];

    $result = mysqli_query($con, "SELECT * FROM jobposts INNER JOIN account ON jobposts.account_id = account.account_id WHERE jobposts.post_id = '$post_id' ORDER BY posted_date DESC");
    $data = array();

    foreach ($result as $row) {
        $data['post_id'] = $row['post_id'];
        $data['account_id'] = $row['account_id'];
        $data['post_title'] = $row['post_title'];
        $data['firstName'] = $row['firstName'];
        $data['lastName'] = $row['lastName'];
        $data['category'] = $row['category'];
        $data['post_tags'] = $row['post_tags'];
        $currentDateTime = $row['posted_date'];
        $dateTimeObj = new DateTime($currentDateTime);
        $posted_date = $dateTimeObj->format("F d, Y h:i A");
        $data['posted_date'] = $posted_date;
        $data['address'] = $row['address'];
        $data['post_description'] = $row['post_description'];
        $data['rate'] = 'PHP' . ' ' . $row['rate'];
    }
    echo json_encode($data);
}

if (isset($_POST['search_post'])) {
    $search_input = $_POST['keyword'];
    $filteredResult = $query = mysqli_query($con, "SELECT * FROM jobposts INNER JOIN account ON jobposts.account_id = account.account_id WHERE jobposts.post_tags LIKE '%$search_input%' ORDER BY posted_date DESC");
    $output = array();
    $output['success'] = '';
    while ($row = $filteredResult->fetch_assoc()) {
        $currentDateTime = $row['posted_date'];
        $dateTimeObj = new DateTime($currentDateTime);
        $posted_date = $dateTimeObj->format("F d, Y h:i A");
        $output['success'] .= '
            <div class="containerPost">
                <span class="titlePost">' . $row['post_title'] . '</span>
                <div>
                    <span class="author">Author: </span>
                    <span class="userPost">' . $row['firstName'] . ' ' . $row['lastName'] . '</span>
                </div>
                <div>
                    <span class="locationPost">' . $row['address'] . '</span>
                    <span>•</span>
                    <span class="datePost">Posted on ' . $posted_date . '</span>
                </div>

                <p class="descPost">
                    ' . $row['post_description'] . '
                </p>
                <div>
                    <button id="viewPostBTN" onclick="new Posts().view_post(' . $row['post_id'] . ');">View Post</button>
                </div>
            </div>
            ';
    }
    $output['error'] = '<div class="noResult">
    <div class="noResultIMG">
        <img id="noIMG" src="../img/search.png" alt="">
    </div>
    <div class="noResultText">
        <span>
        No post available
        </span>
    </div>
</div>';

    echo json_encode($output);
}
?>