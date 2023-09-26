<?php

define('PAYPAL_ID', 'sb-8fq5x27373804@business.example.com');
define('PAYPAL_SANDBOX', TRUE);

define('PAYPAL_RETURN_URL', 'https://localhost/egawa-capstone/testpayment/success.php');
define('PAYPAL_CANCEL_URL', 'https://localhost/egawa-capstone/testpayment/cancel.php');
define('PAYPAL_NOTIFY_URL', 'https://localhost/egawa-capstone/testpayment/paypal_ipn.php');
define('CURRENCY', 'USD');

define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'testpayment');

define('PAYPAL_URL', (PAYPAL_SANDBOX == true) ? "https://www.sandbox.paypal.com/cgi-bin/webscr" : "https://www.paypal.com/cgi-bin/webscr");

if (!session_id())
    session_start();
?>