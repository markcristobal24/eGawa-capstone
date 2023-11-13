<?php
require_once dirname(__FILE__) . '/vendor/autoload.php';
require_once dirname(__FILE__) . '/php/classes/DbClass.php';

$currentDate = date("Y-m-d");

$db = new DbClass();

$query = $db->connect()->prepare("SELECT t.*, CONCAT(a1.firstName, ' ', a1.lastName) AS freelancer_name, CONCAT(a2.firstName, ' ', a2.lastName) AS company_name
                            FROM job_application AS t
                            INNER JOIN account AS a1 ON a1.account_id = t.freelance_id
                            INNER JOIN account AS a2 ON a2.account_id = t.user_id
                            WHERE t.jobstatus = 'COMPLETED'");

$counter = 0;
$html = '';
$result = $query->execute();

if ($query->rowCount() > 0) {
    $delay = 100;

    $html .= '<body style="width:100%;">';
    $html .= '<div style="text-align: center;"><img src="/img/egawaicon4.png"></div>';
    $html .= '<div style="text-align: center;">Transaction Report</div>';
    $html .= '<br><br>';
    $html .= '<div style="text-align:left;">Date Generated: ' . date('F d, Y', strtotime($currentDate)) . '</div>';
    $html .= '<br>';

    $html .= '<table class="table" style="width:100%;">';
    $html .= '<tr><td>Transaction ID</td> <td>Freelancer Name</td> <td>Company/Employer Name</td> <td>Date of Transaction</td> </tr>';
    while ($row = $query->fetch(PDO::FETCH_BOTH)) {
        $counter++;
        $html .= '<tr><td>' . $row['application_id'] . '</td><td>' . $row['freelancer_name'] . '</td><td>' . $row['company_name'] . '</td><td>' . $row['timestamp'] . '</td></tr>';
    }

    $html .= '</table>';
    $html .= '<br><br>';
    $html .= '<div style="text-align:right;">Total Transaction: ' . $counter . '</div>';
    $html .= '</body>';
} else {
    $html = "No records found";
}

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHtml($html);
$file = 'media/' . time() . '.pdf';
$mpdf->output($file, 'I');
