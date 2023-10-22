<?php
require_once dirname(__FILE__) . "/../php/classes/DbClass.php";

$db = new DbClass();
if (isset($_POST['graph'])) {
    $query = $db->connect()->prepare("SELECT MONTH(dateCreated) AS registration_month, COUNT(*) AS user_count FROM account WHERE YEAR(dateCreated) = 2023 GROUP BY MONTH(dateCreated) ORDER BY registration_month");
    if ($query->execute()) {
        $data = array(); // Initialize an array to store the data

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row; // Append each row to the $data array
        }

        echo json_encode($data);
    } else {
        echo "Query execution failed.";
    }
}
