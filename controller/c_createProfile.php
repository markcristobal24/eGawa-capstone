<?php
//session_start();
require_once dirname(__FILE__) . "/../php/classes/DbConnection.php";
require_once dirname(__FILE__) . "/../php/classes/Image.php";
require_once dirname(__FILE__) . "/../php/classes/Account.php";

if (isset($_POST['btnCreateFreelanceProfile']) && is_array($_POST['jobRole'])) {
    $email = $_SESSION['email'];
    $profileImg = $_FILES['imageProfile']['tmp_name'];
    //$imageData = file_get_contents($profileImg);

    $image_link = $profileImg;
    if ($profileImg != $_SESSION['imageProfile']) {
        $upload_image = new Image();
        $data = $upload_image->upload_image($profileImg, $email, "egawa/freelancer/");
        $image_link = "v" . $data['version'] . "/" . $data['public_id'];
    }

    $selectedData = $_POST['jobRole'];


    $optionsString = implode(',', $selectedData);

    $address = $_POST['address'];
    $company = $_POST['companyName'];
    $workTitle = $_POST['workTitle'];

    $startDate = $_POST['dateStarted'];
    $endDate = $_POST['dateEnded'];

    $jobDesc = $_POST['jobDesc'];
    $jobDesc = trim($jobDesc);
    $jobDesc = htmlspecialchars($jobDesc);


    $sql = mysqli_query($con, "SELECT * FROM account WHERE email = '$email' ");
    $check_rows = mysqli_num_rows($sql);
    $fetch = mysqli_fetch_assoc($sql);

    $account_id = $fetch['account_id'];


    if ($check_rows > 0) {
        //$result = mysqli_query($con, "INSERT INTO profile (account_id, email, imageProfile, jobRole, address, companyName, workTitle, startDate, endDate, jobDescription) VALUES ('$account_id', '$email', '$imageData', '$optionsString', '$address', '$company', '$workTitle', '$startDate', '$endDate', '$jobDesc')");

        $stmt = $con->prepare("INSERT INTO profile (account_id, email, imageProfile, jobRole, address, companyName, workTitle, startDate, endDate, jobDescription) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssss", $account_id, $email, $image_link, $optionsString, $address, $company, $workTitle, $startDate, $endDate, $jobDesc);
        $stmt->execute();


        $result = mysqli_query($con, "UPDATE account SET profileStatus = 1 WHERE email = '$email'");
        if ($result) {
            header('location: ../freelance/freelanceHomePage.php');
        }
    }
}

if (isset($_POST['btnEditFreelanceProfile']) && is_array($_POST['jobRole'])) {
    //declare account identifier
    $email_identifier = $_SESSION['email'];

    //get the content of the image and upload it to cloud storage
    $profile_img = $_FILES['imageProfile']['tmp_name'];
    $image_link = $profile_img;
    if ($profile_img != $_SESSION['imageProfile']) {
        $upload_image = new Image();
        $filename = new Account();
        $image_name = $filename->generate_imageName(6);
        $data = $upload_image->upload_image($profile_img, $image_name, "egawa/freelancer/");
        $image_link = "v" . $data['version'] . "/" . $data['public_id'];
    }

    $new_address = $_POST['editAddress'];

    //get all the selected checkbox in job role section
    $selectedData = $_POST['jobRole'];
    $jobRole = implode(',', $selectedData);

    $stmt = mysqli_query($con, "SELECT * FROM profile WHERE email = '$email_identifier'");

    if ($stmt->num_rows > 0) {
        $sql = $con->prepare("UPDATE profile SET imageProfile = ?, address = ?, jobRole = ? WHERE email = ?");
        $sql->bind_param("ssss", $image_link, $new_address, $jobRole, $email_identifier);
        $sql->execute();

        if ($sql) {
            ?>
<script>
alert('Profile Updated Successfully');
</script>
<?php
            header('location: ../freelance/freelanceHomePage.php');
        }
    }
}
?>