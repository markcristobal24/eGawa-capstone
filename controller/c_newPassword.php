<?php
// session_start();
require_once dirname(__FILE__) . "/../php/classes/DbConnection.php";
require_once dirname(__FILE__) . "/../php/classes/Account.php";

$acc = new Account();
if (isset($_POST["new_password"])) {
    $psw = $_POST["password"];
    $repsw = $_POST["re-pass"];

    $encrypted_password = $acc->encrypt_password($psw);

    $token = $_SESSION['token'];
    $Email = $_SESSION['email'];

    $sql = mysqli_query($con, "SELECT * FROM account WHERE email='$Email'");
    $query = mysqli_num_rows($sql);
    $fetch = mysqli_fetch_assoc($sql);

    // if ($Email) {
    //     mysqli_query($con, "UPDATE account SET password='$psw' WHERE email='$Email'");
    //     $output['success'] = "Password Updated.";
    // } else if ($psw !== $repsw) {
    //     $output['error'] = "Password do not match!";
    // } else {
    //     $output['error'] = "Please try again";
    // }

    if ($psw !== $repsw) {
        $output['error'] = "Password do not match!";
    } else {
        mysqli_query($con, "UPDATE account SET password='$encrypted_password' WHERE email='$Email'");
        $output['success'] = "Password Updated.";
    }

    echo json_encode($output);
}
?>