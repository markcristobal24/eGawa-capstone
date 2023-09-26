<?php
// Include the configuration file  
require_once 'config.php';

// Include the database connection file  
require_once 'dbConnect.php';

$payment_id = $statusMsg = '';
$status = 'error';

if (!empty($_GET['item_number']) && !empty($_GET['tx']) && !empty($_GET['amt'])) { //$_GET['st'] == 'Completed' 
    // Get transaction information from URL  
    $item_number = $_GET['item_number'];
    $txn_id = $_GET['tx'];
    $payment_gross = $_GET['amt'];
    $currency_code = $_GET['cc'];
    $payment_status = $_GET['st'];
    $custom = $_GET['cm'];

    // Fetch transaction and subscription info from the database 
    $sqlQ = "SELECT S.*, P.name as plan_name, P.price as plan_amount FROM user_subscriptions as S LEFT JOIN plans as P On P.id = S.plan_id WHERE S.txn_id = ?";
    $stmt = $db->prepare($sqlQ);
    $stmt->bind_param("i", $db_txn_id);
    $db_txn_id = $txn_id;
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Subscription and transaction details 
        $subscrData = $result->fetch_assoc();

        $ref_id = $subscrData['id'];
        $paypal_subscr_id = $subscrData['paypal_subscr_id'];
        $txn_id = $subscrData['txn_id'];
        $paid_amount = $subscrData['paid_amount'];
        $currency_code = $subscrData['currency_code'];
        $interval = $subscrData['subscr_interval'];
        $interval_count = $subscrData['subscr_interval_count'];
        $valid_from = $subscrData['valid_from'];
        $valid_to = $subscrData['valid_to'];
        $payment_status = $subscrData['payment_status'];

        $payer_name = $subscrData['payer_name'];
        $payer_email = $subscrData['payer_email'];

        $plan_name = $subscrData['plan_name'];
        $plan_amount = $subscrData['plan_amount'];

        $status = 'success';
        $statusMsg = 'Your Subscription Payment has been Successful!';
    } else {
        $statusMsg = "Transaction has been failed! If you got success response from PayPal, please refresh this page after sometime.";
    }
} else {
    header("Location: index.php");
    exit;
}
?>

<?php if (!empty($subscrData)) { ?>
    <h1 class="<?php echo $status; ?>">
        <?php echo $statusMsg; ?>
    </h1>

    <h4>Payment Information</h4>
    <p><b>Reference Number:</b> #
        <?php echo $ref_id; ?>
    </p>
    <p><b>Subscription ID:</b>
        <?php echo $paypal_subscr_id; ?>
    </p>
    <p><b>TXN ID:</b>
        <?php echo $txn_id; ?>
    </p>
    <p><b>Paid Amount:</b>
        <?php echo $paid_amount . ' ' . $currency_code; ?>
    </p>
    <p><b>Status:</b>
        <?php echo $payment_status; ?>
    </p>

    <h4>Subscription Information</h4>
    <p><b>Plan Name:</b>
        <?php echo $plan_name; ?>
    </p>
    <p><b>Amount:</b>
        <?php echo $plan_amount . ' ' . CURRENCY; ?>
    </p>
    <p><b>Plan Interval:</b>
        <?php echo $interval_count . $interval; ?>
    </p>
    <p><b>Period Start:</b>
        <?php echo $valid_from; ?>
    </p>
    <p><b>Period End:</b>
        <?php echo $valid_to; ?>
    </p>

    <h4>Payer Information</h4>
    <p><b>Name:</b>
        <?php echo $payer_name; ?>
    </p>
    <p><b>Email:</b>
        <?php echo $payer_email; ?>
    </p>
<?php } else { ?>
    <h1 class="error">Subscription Payment Failed!</h1>
    <p class="error">
        <?php echo $statusMsg; ?>
    </p>
<?php } ?>