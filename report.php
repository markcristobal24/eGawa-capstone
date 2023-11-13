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
    $html .= '<div style="text-align: center;"><img src="img/icon.jpg" width="50" height="50"></div>';
    $html .= '<div style="text-align: center;"><span style="font-size: 19px; font-weight: bold;">eGAWA</span></div>';
    $html .= '<div style="text-align: center;"><span style="font-size: 17px; font-weight: bold;">Online Freelance Services Platform</span></div>';
    $html .= '<div style="text-align: center;">Transaction Report</div>';
    $html .= '<br><br>';
    $html .= '<div style="text-align:left;"><span style="font-weight: bold;">Date Generated:</span> ' . date('F d, Y', strtotime($currentDate)) . '</div>';
    $html .= '<br>';

    $html .= '<table class="table" style="width:100%;">';
    $html .= '<tr><td style="font-weight: bold;">Transaction ID</td> <td style="font-weight: bold;">Freelancer Name</td> <td style="font-weight: bold;">Company/Employer Name</td> <td style="font-weight: bold;">Date of Transaction</td> </tr>';
    while ($row = $query->fetch(PDO::FETCH_BOTH)) {
        $counter++;
        $html .= '<tr><td style="text-align: center;"><span>' . $row['application_id'] . '</span></td><td style="text-align: center;">' . $row['freelancer_name'] . '</td><td style="text-align: center;">' . $row['company_name'] . '</td><td style="text-align: center;"><span>' . $row['timestamp'] . '</span></td></tr>';
    }

    $html .= '</table>';
    $html .= '<br><br>';
    $html .= '<div style="text-align:right;"><span style="font-weight: bold;">Total Transaction:</span> ' . $counter . '</div>';
    $html .= '</body>';
} else {
    $html = "No records found";
}

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHtml($html);
$file = 'media/' . time() . '.pdf';
$mpdf->output($file, 'I');
