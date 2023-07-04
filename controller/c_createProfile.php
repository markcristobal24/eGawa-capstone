<?php
session_start();
require_once dirname(__FILE__) . "/../php/classes/DbConnection.php";

if (isset($_POST['jobRole']) && is_array($_POST['jobRole'])) {
    $profileImg = $_FILES['imageProfile']['tmp_name'];
    $imageData = file_get_contents($profileImg);

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
    $email = $_SESSION['email'];

    $sql = mysqli_query($con, "SELECT * FROM account WHERE email = '$email' ");
    $check_rows = mysqli_num_rows($sql);
    $fetch = mysqli_fetch_assoc($sql);

    $account_id = $fetch['account_id'];


    if ($check_rows > 0) {
        //$result = mysqli_query($con, "INSERT INTO profile (account_id, email, imageProfile, jobRole, address, companyName, workTitle, startDate, endDate, jobDescription) VALUES ('$account_id', '$email', '$imageData', '$optionsString', '$address', '$company', '$workTitle', '$startDate', '$endDate', '$jobDesc')");

        $stmt = $con->prepare("INSERT INTO profile (account_id, email, imageProfile, jobRole, address, companyName, workTitle, startDate, endDate, jobDescription) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssss", $account_id, $email, $imageData, $optionsString, $address, $company, $workTitle, $startDate, $endDate, $jobDesc);
        $stmt->execute();


        $result = mysqli_query($con, "UPDATE account SET profileStatus = 1 WHERE email = '$email'");
        if ($result) {
            header('location: ../freelanceHomePage.php');
        }



    }

}
?>