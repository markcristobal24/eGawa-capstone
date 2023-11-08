<?php
// session_start();
require_once dirname(__FILE__) . "/../php/classes/DbClass.php";

$db = new DbClass();

if (isset($_POST['jobPosts'])) {
    $user_id = $_SESSION['account_id'];

    $post_category = $_POST['post_category'];
    $post_title = $_POST['post_title'];
    $post_description = $_POST['post_description'];
    $post_description = htmlspecialchars($post_description, ENT_QUOTES);
    $post_tags = $_POST['post_tags'];
    $rate = $_POST['rate'];

    date_default_timezone_set("Asia/Manila");
    $currentDateTime = date("Y-m-d H:i:s");


    if ($post_title === "" || $post_description === "" || $post_tags === "" || $rate === "") {
        $output['error'] = "Incomplete Details!";
    } else {
        $query = $db->connect()->prepare("INSERT INTO jobposts (account_id, category, post_title, post_description, post_tags, rate, posted_date)
        VALUES (:account_id, :category, :post_title, :post_description, :post_tags, :rate, :posted_date)");
        $result = $query->execute([':account_id' => $user_id, ':category' => $post_category, ':post_title' => $post_title, ':post_description' => $post_description, ':post_tags' => $post_tags, ':rate' => $rate, ':posted_date' => $currentDateTime]);

        if ($result) {
            $output['success'] = "Posted Successfully";
            if ($success) {
                $query = $db->connect()->prepare("INSERT INTO activity_logs (account_id, event, user_type) VALUES (:account_id, :event, :user_type)");
                $query->execute([
                    ':account_id' => $_SESSION['account_id'],
                    ':event' => 'Posted a job',
                    ':user_type' => 'company'
                ]);
            }
        } else {
            $output['error'] = "Something went wrong. Please try again later.";
        }
    }
    echo json_encode($output);
}

if (isset($_POST['filter_post'])) {
    $filterValue = $_POST['filterValue'];

    $query = $db->connect()->prepare(
        "SELECT * FROM jobposts
        INNER JOIN account ON jobposts.account_id = account.account_id
        WHERE jobposts.category = :filterValue AND post_status != :post_status
        ORDER BY posted_date DESC"
    );
    $query->execute([':filterValue' => $filterValue, ':post_status' => 'ARCHIVED']);
    $output = array();
    if ($query->rowCount() > 0) {
        $output['success'] = '';
        foreach ($query as $row) {
            $currentDateTime = $row['posted_date'];
            $dateTimeObj = new DateTime($currentDateTime);
            $posted_date = $dateTimeObj->format("F d, Y h:i A");
            $output['success'] .= '
            <div class="containerPost">

                <div class="post-col-1">
                    <img class="author-pic" src="../img/uploads/company/' . $row['user_image'] . '" alt="">
                </div>
                
                <div class="post-col-2">
                    <span class="titlePost">' . $post_title = strtoupper($row['post_title']) . '</span>
                    <div>
                        <span class="author">Author: </span>
                        <span class="userPost">' . $row['firstName'] . ' ' . $row['lastName'] . '</span>
                    </div>
                    <div>
                        <span class="locationPost">' . $row['barangay'] . ', ' . $row['municipality'] . ', ' . $row['province'] . '</span>
                        <span>•</span>
                        <span class="datePost">Posted on ' . $posted_date . '</span>
                    </div>

                    <p class="descPost">
                        ' . $row['post_description'] . '
                    </p>
                    <div>
                        
                        <button id="viewPostBTN"  data-bs-toggle="modal" data-bs-target="#view-post-modal" onclick="new Posts().view_post(' . $row['post_id'] . ')">View Post</button>
                    </div>
                </div>
            </div>
            ';
        }
    } else if ($filterValue == "all") {
        $query = $db->connect()->prepare(
            "SELECT * FROM jobposts
        INNER JOIN account ON jobposts.account_id = account.account_id 
        WHERE post_status != :post_status
        ORDER BY posted_date DESC"
        );
        $query->execute([':post_status' => 'ARCHIVED']);
        $output = array();
        $output['success'] = '';
        foreach ($query as $row) {
            $currentDateTime = $row['posted_date'];
            $dateTimeObj = new DateTime($currentDateTime);
            $posted_date = $dateTimeObj->format("F d, Y h:i A");
            $output['success'] .= '
            <div class="containerPost">

                <div class="post-col-1">
                    <img class="author-pic" src="../img/uploads/company/' . $row['user_image'] . '" alt="">
                </div>
                <div class="post-col-2">
                    <span class="titlePost">' . $post_title = strtoupper($row['post_title']) . '</span>
                    <div>
                        <span class="author">Author: </span>
                        <span class="userPost">' . $row['firstName'] . ' ' . $row['lastName'] . '</span>
                    </div>
                    <div>
                        <span class="locationPost">' . $row['barangay'] . ', ' . $row['municipality'] . ', ' . $row['province'] . '</span>
                        <span>•</span>
                        <span class="datePost">Posted on ' . $posted_date . '</span>
                    </div>

                    <p class="descPost">
                        ' . $row['post_description'] . '
                    </p>
                    <div>
                        <button id="viewPostBTN" data-bs-toggle="modal" data-bs-target="#view-post-modal" onclick="new Posts().view_post(' . $row['post_id'] . ');">View Post</button>
                    </div>
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

if (isset($_POST['fetch_post'])) {
    $post_id = $_POST['postId'];

    $query = $db->connect()->prepare(
        "SELECT * FROM jobposts
        INNER JOIN account ON jobposts.account_id = account.account_id
        WHERE jobposts.post_id = :post_id
        ORDER BY posted_date DESC"
    );
    $query->execute([':post_id' => $post_id]);
    $data = array();
    foreach ($query as $row) {
        $data['post_id'] = $row['post_id'];
        $data['author'] = $row['firstName'] . " " . $row['lastName'];
        $data['account_id'] = $row['account_id'];
        $data['post_title'] = $row['post_title'];
        $data['category'] = $row['category'];
        $data['post_tags'] = $row['post_tags'];
        $currentDateTime = $row['posted_date'];
        $dateTimeObj = new DateTime($currentDateTime);
        $posted_date = $dateTimeObj->format("F d, Y h:i A");
        $data['posted_date'] = $posted_date;
        $data['barangay'] = $row['barangay'];
        $data['municipality'] = $row['municipality'];
        $data['province'] = $row['province'];
        $data['post_description'] = $row['post_description'];
        $data['rate'] = 'PHP' . ' ' . $row['rate'];
    }
    echo json_encode($data);
}

if (isset($_POST['view_post'])) {
    $post_id = $_POST['id'];

    $query = $db->connect()->prepare(
        "SELECT * FROM jobposts
        INNER JOIN account ON jobposts.account_id = account.account_id
        WHERE jobposts.post_id = :post_id
        ORDER BY posted_date DESC"
    );
    $query->execute([':post_id' => $post_id]);
    $data = array();
    foreach ($query as $row) {
        $data['post_id'] = $row['post_id'];
        $data['author'] = $row['firstName'] . " " . $row['lastName'];
        $data['account_id'] = $row['account_id'];
        $data['post_title'] = $row['post_title'];
        $data['category'] = $row['category'];
        $data['post_tags'] = $row['post_tags'];
        $currentDateTime = $row['posted_date'];
        $dateTimeObj = new DateTime($currentDateTime);
        $posted_date = $dateTimeObj->format("F d, Y h:i A");
        $data['posted_date'] = $posted_date;
        $data['barangay'] = $row['barangay'];
        $data['municipality'] = $row['municipality'];
        $data['province'] = $row['province'];
        $data['post_description'] = $row['post_description'];
        $data['rate'] = 'PHP' . ' ' . $row['rate'];
        $data['post_rate'] = $row['rate'];
    }
    echo json_encode($data);
}

if (isset($_POST['search_post'])) {
    $search_input = $_POST['keyword'];

    $query = $db->connect()->prepare(
        "SELECT * FROM jobposts INNER JOIN account ON jobposts.account_id = account.account_id WHERE jobposts.post_tags LIKE '%$search_input%' AND post_status != :post_status ORDER BY posted_date DESC"
    );
    $query->execute([':post_status' => 'ARCHIVED']);
    $output = array();
    $output['success'] = '';
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $currentDateTime = $row['posted_date'];
        $dateTimeObj = new DateTime($currentDateTime);
        $posted_date = $dateTimeObj->format("F d, Y h:i A");
        $output['success'] .= '

        <div class="containerPost">

            <div class="post-col-1">
                <img class="author-pic" src="../img/uploads/company/' . $row['user_image'] . '" alt="">
            </div>
            
            <div class="post-col-2">
                <span class="titlePost">' . $post_title = strtoupper($row['post_title']) . '</span>
                <div>
                    <span class="author">Author: </span>
                    <span class="userPost">' . $row['firstName'] . ' ' . $row['lastName'] . '</span>
                </div>
                <div>
                    <span class="locationPost">' . $row['barangay'] . ', ' . $row['municipality'] . ', ' . $row['province'] . '</span>
                    <span>•</span>
                    <span class="datePost">Posted on ' . $posted_date . '</span>
                </div>

                <p class="descPost">
                    ' . $row['post_description'] . '
                </p>
                <div>
                    <button id="viewPostBTN" data-bs-toggle="modal" data-bs-target="#view-post-modal" onclick="new Posts().view_post(' . $row['post_id'] . ');">View Post</button>
                </div>
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

if (isset($_POST['delete_post'])) {
    $post_id = $_POST['post_id'];

    $query = $db->connect()->prepare("UPDATE jobposts SET post_status = :post_status WHERE post_id = :post_id");
    $result = $query->execute([':post_status' => 'ARCHIVED', ':post_id' => $post_id]);

    if ($result) {
        $output['success'] = "Post deleted successfully.";
        $query = $db->connect()->prepare("INSERT INTO activity_logs (account_id, event, user_type) VALUES (:account_id, :event, :user_type)");
        $query->execute([
            ':account_id' => $_SESSION['account_id'],
            ':event' => 'Deletes a job post',
            ':user_type' => 'company'
        ]);
    } else {
        $output['error'] = "Something went wrong. Please try again later.";
    }

    echo json_encode($output);
}

if (isset($_POST['edit_post'])) {
    $post_id = $_POST['post_id'];
    $post_category = $_POST['new_post_category'];
    $post_title = $_POST['new_post_title'];
    $post_description = $_POST['new_post_description'];
    $post_tags = $_POST['new_post_tags'];
    $post_rate = $_POST['new_rate'];

    $query = $db->connect()->prepare("SELECT * FROM jobposts WHERE post_id = :post_id");
    $query->execute([':post_id' => $post_id]);
    $row = $query->fetch(PDO::FETCH_ASSOC);

    if ($query->rowCount() > 0) {
        if (($post_category == "" || $post_title == "" || $post_description == "" || $post_tags == "" || $post_rate == "")) {
            $output['error'] = "All fields are required.";
        } else if ($post_category != $row['category'] || $post_title != $row['post_title'] || $post_description != $row['post_description'] || $post_tags != $row['post_tags'] || $post_rate != $row['rate']) {
            $query = $db->connect()->prepare("UPDATE jobposts SET category = :category, post_title = :post_title, post_description = :post_description, post_tags = :post_tags, rate = :rate WHERE post_id = :post_id");
            $result = $query->execute([
                ':category' => $post_category,
                ':post_title' => $post_title,
                ':post_description' => $post_description,
                ':post_tags' => $post_tags,
                ':rate' => $post_rate,
                ':post_id' => $post_id
            ]);

            if ($result) {
                $output['success'] = "Post updated successfully.";
                $query = $db->connect()->prepare("INSERT INTO activity_logs (account_id, event, user_type) VALUES (:account_id, :event, :user_type)");
                $query->execute([
                    ':account_id' => $_SESSION['account_id'],
                    ':event' => 'Edit a job post',
                    ':user_type' => 'company'
                ]);
            }
        } else {
            $output['success'] = "No changes have been made.";
        }
    } else {
        $output['error'] = "Something went wrong. Please try again later.";
    }

    echo json_encode($output);
}
