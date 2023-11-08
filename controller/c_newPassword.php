<?php
// session_start();
require_once dirname(__FILE__) . "/../php/classes/DbClass.php";
require_once dirname(__FILE__) . "/../php/classes/Account.php";

$db= new DbClass();

$acc = new Account();
if (isset($_POST["new_password"])) {
    $psw = $_POST["password"];
    $repsw = $_POST["re-pass"];
    $encrypted_password = $acc->encrypt_password($psw);

    $token = $_SESSION['token'];
    $Email = $_SESSION['email'];

    $query = $db->connect()->prepare("SELECT * FROM account WHERE email = :email");
    $query->execute([':email' => $Email]);
    $fetch = $query->fetch(PDO::FETCH_ASSOC);

    if ($psw !== $repsw) {
        $output['error'] = "Password do not match!";
    } else {
        $query = $db->connect()->prepare("UPDATE account SET password = :password WHERE email = :email");
        $result = $query->execute([':password' => $encrypted_password, ':email' => $Email]);
        if($result) {
            $output['success'] = "Password Updated.";
            $query = $db->connect()->prepare("INSERT INTO activity_logs (account_id, event, user_type) VALUES (:account_id, :event, :user_type)");
            $query->execute([
                ':account_id' => $_SESSION['account_id'],
                ':event' => 'Update password',
                ':user_type' => $_SESSION['userType']
            ]);
        }
    }
    echo json_encode($output);
}
