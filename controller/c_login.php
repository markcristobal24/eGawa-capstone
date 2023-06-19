<?php
session_start();
require_once dirname(__FILE__) . "/../php/classes/DbConnection.php";

$email = $_REQUEST["email"];
$pass = $_REQUEST["pass"];

$query = "SELECT * FROM account WHERE email='$email' and password='$pass' and userType='super_admin'";
$result = mysqli_query($con, $query);
$count = mysqli_num_rows($result);

if ($count == 1) {
    $row = $result->fetch_assoc();
    $_SESSION["username"] = $row['username'];
    echo json_encode(array('success' => 1));
} else {
    echo json_encode(array('success' => 0));
    header("refresh: 0; url=login.php");
}

mysqli_close($con);
?>