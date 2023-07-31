<?php
session_start();

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();

    $output['success'] = "Logging out...";
    echo json_encode($output);
}



?>