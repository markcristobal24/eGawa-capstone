<?php
//session_start();
// require_once dirname(__FILE__) . "/../php/classes/DbConnection.php";
require_once dirname(__FILE__) . "/../php/classes/DbClass.php";
// require_once dirname(__FILE__) . "/../php/classes/Image.php";
require_once dirname(__FILE__) . "/../php/classes/Account.php";

$db = new DbClass();

if (isset($_POST['create_fprofile'])) {
    $email = $_SESSION['email'];
    $profileImg = $_FILES['imageProfile']['tmp_name'];
    //$imageData = file_get_contents($profileImg);

    $image_link = $profileImg;
    if (!empty($profileImg)) {
        // $upload_image = new Image();
        // $data = $upload_image->upload_image($profileImg, $email, "egawa/freelancer/");
        // $image_link = "v" . $data['version'] . "/" . $data['public_id'];
        $generate_name = new Account();
        $image_filename = $generate_name->generate_imageName(6);
        $image_directory = '../img/uploads/freelancer/' . $image_filename . basename($_FILES['imageProfile']['name']);
        $image_link = $image_filename . basename($_FILES['imageProfile']['name']);
        move_uploaded_file($profileImg, $image_directory);
    }

    $selectedData = $_POST['jobRole'];


    $optionsString = implode(',', $selectedData);

    // $address = $_POST['address'];
    $barangay = $_POST['barangay'];
    $municipality = $_POST['municipality'];
    $province = $_POST['province'];
    // $company = $_POST['companyName'];
    // $workTitle = $_POST['workTitle'];

    // $startDate = $_POST['dateStarted'];
    // $endDate = $_POST['dateEnded'];

    // $jobDesc = $_POST['jobDesc'];
    // $jobDesc = trim($jobDesc);
    // $jobDesc = htmlspecialchars($jobDesc);

    $query = $db->connect()->prepare("SELECT * FROM account WHERE email = :email");
    $query->execute([':email' => $email]);
    $fetch = $query->fetch(PDO::FETCH_ASSOC);

    $account_id = $fetch['account_id'];


    if ($query->rowCount() > 0) {
        $query = $db->connect()->prepare("INSERT INTO profile (account_id, email, imageProfile, jobRole, province, municipality, barangay) VALUES (:account_id, :email, :imageProfile, :jobRole, :province, :municipality, :barangay)");
        $result = $query->execute([':account_id' => $account_id, ':email' => $email, ':imageProfile' => $image_link, ':jobRole' => $optionsString, ':province' => $province, ':municipality' => $municipality, ':barangay' => $barangay]);

        if ($result) {
            $query = $db->connect()->prepare("UPDATE account SET profileStatus = 1 WHERE email = :email");
            $query->execute([':email' => $email]);
            $output['success'] = "Profile Created. Redirecting...";
        }
    } else if ($profileImg == null) {
        $output['error'] = "Please upload your profile picture!";
    } else if ($selectedData == "") {
        $output['error'] = "Please select your job role!";
    } else if ($address == "") {
        $output['error'] = "Please provide your complete address!";
    } else if ($company == "") {
        $output['error'] = "Please provide your company name!";
    } else if ($workTitle == "") {
        $output['error'] = "Please provide your work title!";
    } else if ($jobDesc == "") {
        $output['error'] = "Please provide your job description!";
    } else {
        $output['error'] = "Incomplete Details!";
    }

    echo json_encode($output);
}

if (isset($_POST['edit_fprofile'])) {
    //declare account identifier
    $email_identifier = $_SESSION['email'];

    $query = $db->connect()->prepare("SELECT * FROM profile WHERE email = :email");
    $query->execute([':email' => $email_identifier]);
    $fetch = $query->fetch(PDO::FETCH_ASSOC);

    if (isset($_POST['editAddress'])) {
        $new_address = $_POST['editAddress'];
        $old_address = $fetch['address'];

        if ($new_address != $old_address) {
            $query = $db->connect()->prepare("UPDATE profile SET address = :address WHERE email = :email");
            $result = $query->execute([':address' => $new_address, ':email' => $email_identifier]);
        }
    }

    if (isset($_FILES['imageProfile']['tmp_name'])) {
        $profile_img = $_FILES['imageProfile']['tmp_name'];
        $image_link = $profile_img;
        if (!empty($profile_img)) {
            // $upload_image = new Image();
            $filename = new Account();
            $image_name = $filename->generate_imageName(6);
            // $data = $upload_image->upload_image($profile_img, $image_name, "egawa/freelancer/");
            // $image_link = "v" . $data['version'] . "/" . $data['public_id'];
            $image_directory = '../img/uploads/freelancer/' . $image_name  . basename($_FILES['imageProfile']['name']);
            $image_link = $image_name . basename($_FILES['imageProfile']['name']);
            move_uploaded_file($profile_img, $image_directory);

            $query = $db->connect()->prepare("UPDATE profile SET imageProfile = :imageProfile WHERE email = :email");
            $result = $query->execute([':imageProfile' => $image_link, ':email' => $email_identifier]);
        }
    }

    if (isset($_POST['jobRole'])) {
        $selectedData = $_POST['jobRole'];
        $jobRole = implode(',', $selectedData);

        if ($jobRole != $fetch['jobRole']) {
            $query = $db->connect()->prepare("UPDATE profile SET jobRole = :jobRole WHERE email = :email");
            $result = $query->execute([':jobRole' => $jobRole, ':email' => $email_identifier]);
        }
    }

    if ($result) {
        $output['success'] = "Profile Updated Successfully";
    } else {
        $output['error'] = "Something went wrong. Please try again.";
    }
    echo json_encode($output);
}
