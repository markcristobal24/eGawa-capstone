<?php
// Include configuration file  
require_once 'config.php';

// Include the database connection file 
include_once 'dbConnect.php';

// Fetch plans from the database 
$sqlQ = "SELECT * FROM plans";
$stmt = $db->prepare($sqlQ);
$stmt->execute();
$result = $stmt->get_result();

// Get logged-in user ID from sesion 
// Session name need to be changed as per your system 
$loggedInUserID = !empty($_SESSION['userID']) ? $_SESSION['userID'] : 1;
?>
<div class="form-group">
    <label>Subscription Plan:</label>
    <select onchange="getSubscrPrice(this);">
        <?php
        if ($result->num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $i++;
                $row_json_data = json_encode($row);

                if ($i == 1) {
                    $item_name = $row['name'];
                    $item_number = $row['id'];
                    $item_price = $row['price'];
                    $interval = $row['interval'];
                    $interval_count = $row['interval_count'];
                }
                ?>
                <option value="<?php echo $row['id']; ?>" rowData='<?php echo $row_json_data; ?>'>
                    <?php echo $row['name'] . ' [$' . $row['price'] . '/' . $row['interval_count'] . $row['interval'] . ']'; ?>
                </option>
                <?php
            }
        }
        ?>
    </select>
</div>
<div class="form-group">
    <p><b>Payable Amount:</b> <span id="subPrice">
            <?php echo '$' . $item_price . ' ' . CURRENCY; ?>
        </span></p>
</div>

<!-- PayPal Sunscription payment button -->
<form action="<?php echo PAYPAL_URL; ?>" method="post">
    <!-- Identify your business so that you can collect the payments -->
    <input type="hidden" name="business" value="<?php echo PAYPAL_ID; ?>">
    <!-- Specify a subscriptions button. -->
    <input type="hidden" name="cmd" value="_xclick-subscriptions">
    <!-- Specify details about the subscription that buyers will purchase -->
    <input type="hidden" name="item_name" id="item_name" value="<?php echo $item_name; ?>">
    <input type="hidden" name="item_number" id="item_number" value="<?php echo $item_number; ?>">
    <input type="hidden" name="currency_code" value="<?php echo CURRENCY; ?>">
    <input type="hidden" name="a3" id="item_price" value="<?php echo $item_price; ?>">
    <input type="hidden" name="p3" id="interval_count" value="<?php echo $interval_count; ?>">
    <input type="hidden" name="t3" id="interval" value="<?php echo $interval; ?>">
    <input type="hidden" name="src" value="1">
    <input type="hidden" name="srt" value="52">
    <!-- Custom variable user ID -->
    <input type="hidden" name="custom" value="<?php echo $loggedInUserID; ?>">
    <!-- Specify urls -->
    <input type="hidden" name="cancel_return" value="<?php echo PAYPAL_CANCEL_URL; ?>">
    <input type="hidden" name="return" value="<?php echo PAYPAL_RETURN_URL; ?>">
    <input type="hidden" name="notify_url" value="<?php echo PAYPAL_NOTIFY_URL; ?>">
    <!-- Display the payment button -->
    <input class="buy-btn" type="submit" value="Buy Subscription">
</form>

<script>
    function getSubscrPrice(obj) {
        var rowData = obj.options[obj.selectedIndex].getAttribute('rowData');
        rowData = JSON.parse(rowData);

        document.getElementById('subPrice').innerHTML = '$' + rowData.price + ' <?php echo CURRENCY; ?>';
        document.getElementById('item_name').value = rowData.name;
        document.getElementById('item_number').value = rowData.id;
        document.getElementById('item_price').value = rowData.price;
        document.getElementById('interval').value = rowData.interval;
        document.getElementById('interval_count').value = rowData.interval_count;
    }
</script>