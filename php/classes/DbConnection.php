<?php
$con = mysqli_connect("localhost", "root", "");

if (!mysqli_select_db($con, "egawa")) {
    die("connection error");
}
?>