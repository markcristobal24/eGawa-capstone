<?php
// Include configuration file 
include_once 'config.php';

// Include database connection file 
include_once 'dbConnect.php';

/* 
 * Read POST data 
 * reading posted data directly from $_POST causes serialization 
 * issues with array data in POST. 
 * Reading raw POST data from input stream instead. 
 */
$raw_post_data = file_get_contents('php://input');
$raw_post_array = explode('&', $raw_post_data);
$myPost = array();
foreach ($raw_post_array as $keyval) {
    $keyval = explode('=', $keyval);
    if (count($keyval) == 2)
        $myPost[$keyval[0]] = urldecode($keyval[1]);
}

// Read the post from PayPal system and add 'cmd' 
$req = 'cmd=_notify-validate';
foreach ($myPost as $key => $value) {
    $value = urlencode($value);
    $req .= "&$key=$value";
}

/* 
 * Post IPN data back to PayPal to validate the IPN data is genuine 
 * Without this step anyone can fake IPN data 
 */
$paypalURL = PAYPAL_URL;
$ch = curl_init($paypalURL);
if ($ch == FALSE) {
    return FALSE;
}
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSLVERSION, 6);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);

// Set TCP timeout to 30 seconds 
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close', 'User-Agent: company-name'));
$res = curl_exec($ch);

/* 
 * Inspect IPN validation result and act accordingly 
 * Split response headers and payload, a better way for strcmp 
 */
$tokens = explode("\r\n\r\n", trim($res));
$res = trim(end($tokens));
if (strcmp($res, "VERIFIED") == 0 || strcasecmp($res, "VERIFIED") == 0) {

    // Retrieve transaction data from PayPal 
    $paypalInfo = $_POST;
    $ipn_track_id = $paypalInfo['ipn_track_id'];
    $txn_type = $paypalInfo['txn_type']; //subscr_payment or subscr_signup 

    if (!empty($txn_type) && $txn_type == 'subscr_signup') {
        $subscr_id = $paypalInfo['subscr_id'];
        $payer_name = trim($paypalInfo['first_name'] . ' ' . $paypalInfo['last_name']);
        $payer_email = $paypalInfo['payer_email'];
        $item_name = $paypalInfo['item_name'];
        $item_number = $paypalInfo['item_number'];
        $custom = $paypalInfo['custom'];
        $paid_amount = $paypalInfo['mc_amount3'];
        $currency_code = $paypalInfo['mc_currency'];
        $payment_status = !empty($paypalInfo['payment_status']) ? $paypalInfo['payment_status'] : '';

        $period = $paypalInfo['period3'];
        $period_arr = explode(' ', $period);
        $interval = $period_arr[1];
        $interval_count = $period_arr[0];

        $subscr_date = $paypalInfo['subscr_date'];
        $dt = new DateTime($subscr_date);
        $subscr_date = $dt->format("Y-m-d H:i:s");

        $interval_unit_arr = array('D' => 'day', 'W' => 'week', 'M' => 'month', 'Y' => 'year');
        $interval_unit = $interval_unit_arr[$interval];
        $subscr_date_valid_to = date("Y-m-d H:i:s", strtotime(" + $interval_count $interval_unit", strtotime($subscr_date)));

        $txn_id = '';
    } else {
        $subscr_id = $paypalInfo['subscr_id'];
        $payer_name = trim($paypalInfo['first_name'] . ' ' . $paypalInfo['last_name']);
        $payer_email = $paypalInfo['payer_email'];
        $item_name = $paypalInfo['item_name'];
        $item_number = $paypalInfo['item_number'];
        $custom = $paypalInfo['custom'];
        $paid_amount = !empty($paypalInfo['mc_gross']) ? $paypalInfo['mc_gross'] : 0;
        $currency_code = $paypalInfo['mc_currency'];
        $payment_status = !empty($paypalInfo['payment_status']) ? $paypalInfo['payment_status'] : '';

        $txn_id = !empty($paypalInfo['txn_id']) ? $paypalInfo['txn_id'] : '';
        $subscr_date = !empty($paypalInfo['payment_date']) ? $paypalInfo['payment_date'] : date("Y-m-d H:i:s");
        $dt = new DateTime($subscr_date);
        $subscr_date = $dt->format("Y-m-d H:i:s");

        $interval = '';
        $interval_count = 0;
        $subscr_date_valid_to = '';
    }

    if (!empty($ipn_track_id)) {
        // Check if transaction data exists with the same TXN ID 
        $prevPayment = $db->query("SELECT id FROM user_subscriptions WHERE ipn_track_id = '" . $ipn_track_id . "'");

        if ($prevPayment->num_rows > 0) {
            if ($txn_type == 'subscr_signup') {
                $sql = "UPDATE user_subscriptions SET paypal_subscr_id = '" . $subscr_id . "', subscr_interval = '" . $interval . "', subscr_interval_count = '" . $interval_count . "', valid_from = '" . $subscr_date . "', valid_to = '" . $subscr_date_valid_to . "' WHERE ipn_track_id = '" . $ipn_track_id . "'";
                $update = $db->query($sql);
            } elseif ($txn_type == 'subscr_payment') {
                $sql = "UPDATE user_subscriptions SET txn_id = '" . $txn_id . "', payment_status = '" . $payment_status . "' WHERE ipn_track_id = '" . $ipn_track_id . "'";
                $update = $db->query($sql);
            }
        } else {
            if ($txn_type == 'subscr_payment' || $txn_type == 'subscr_signup') {
                // Insert transaction data into the database 
                $sql = "INSERT INTO user_subscriptions(user_id,plan_id,paypal_subscr_id,txn_id,subscr_interval,subscr_interval_count,valid_from,valid_to,paid_amount,currency_code,payer_name,payer_email,payment_status,ipn_track_id) VALUES('" . $custom . "','" . $item_number . "','" . $subscr_id . "','" . $txn_id . "','" . $interval . "','" . $interval_count . "','" . $subscr_date . "','" . $subscr_date_valid_to . "','" . $paid_amount . "','" . $currency_code . "','" . $payer_name . "','" . $payer_email . "','" . $payment_status . "','" . $ipn_track_id . "')";
                $insert = $db->query($sql);

                // Update subscription id in the users table 
                if ($insert && !empty($custom)) {
                    $subscription_id = $db->insert_id;
                    $update = $db->query("UPDATE users SET subscription_id = {$subscription_id} WHERE id = {$custom}");
                }
            }
        }
    }
}
die;