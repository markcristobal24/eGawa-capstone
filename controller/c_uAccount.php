<?php
require_once dirname(__FILE__) . "/../php/classes/DbConnection.php";
require_once dirname(__FILE__) . "/../php/classes/Email.php";
require_once dirname(__FILE__) . "/../php/classes/Account.php";

$acc = new Account();

if (isset($_POST['change_email'])) {
    $user_id = $_SESSION['account_id'];
    $email_identifier = $_SESSION['email'];

    $old_email = $_POST['currentEmail'];
    $new_email = $_POST['newEmail'];

    $query = mysqli_query($con, "SELECT * FROM account WHERE account_id = '$user_id'");

    if ($old_email === "" && $new_email === "") {
        $output['error'] = "Incomplete Details!";
    } else if ($old_email !== $email_identifier) {
        $output['error'] = "Email address does not match!";
    } else if ($new_email === $email_identifier || $new_email === "") {
        $output['error'] = "Please provide new email address!";
    } else if ($query->num_rows > 0) {
        $stmt = $con->prepare("UPDATE account SET email = ? WHERE account_id = ?");
        $stmt->bind_param("ss", $new_email, $user_id);
        $stmt->execute();

        if ($stmt) {
            $_SESSION['email'] = $new_email;
            $output['success'] = "Email address updated successfully";
        }
    } else if ($query->num_rows < 0) {
        $output['error'] = "Email address does not match!";
    }

    echo json_encode($output);
}

if (isset($_POST['change_pass'])) {
    $user_id = $_SESSION['account_id'];

    $old_pass = $_POST['currentPass'];
    $new_pass = $_POST['newPass'];
    $reNew_pass = $_POST['newPass2'];
    $encrypted_password = $acc->encrypt_password($new_pass);

    $sql = mysqli_query($con, "SELECT * FROM account WHERE account_id = '$user_id'");
    $row = mysqli_fetch_assoc($sql);
    $old_hash = $row['password'];

    if ($sql->num_rows > 0) {
        if ($new_pass !== $reNew_pass) {
            $output['error'] = "Password was not matched!";
        } else if ($old_pass === "" && $new_pass === "" && $reNew_pass === "") {
            $output['error'] = "Incomplete Details!";
        } else {
            if (!password_verify($old_pass, $old_hash)) {
                $output['error'] = "Incorrect password! Please try again.";
            } else if (password_verify($old_pass, $old_hash)) {
                $stmt = $con->prepare("UPDATE account SET password = ? WHERE account_id = ?");
                $stmt->bind_param("ss", $encrypted_password, $user_id);
                $stmt->execute();

                if ($stmt) {
                    $output['success'] = "Password has been changed.";
                }
            }
        }
    }
    echo json_encode($output);
}
?>