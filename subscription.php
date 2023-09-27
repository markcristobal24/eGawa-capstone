<?php
// Include configuration file  
require_once 'testpayment/config.php';

// Include the database connection file 
include_once 'testpayment/dbConnect.php';

// Fetch plans from the database 
$sqlQ = "SELECT * FROM plans";
$stmt = $db->prepare($sqlQ);
$stmt->execute();
$result = $stmt->get_result();

// Get logged-in user ID from sesion 
// Session name need to be changed as per your system 
$loggedInUserID = !empty($_SESSION['userID']) ? $_SESSION['userID'] : 1;
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>eGawa | Subscription</title>

    <!-- start -- links for fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- end --links for fonts -->


    <!-- Link for Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Link for CSS -->
    <link rel="stylesheet" href="../css/notification.css">
    <link rel="stylesheet" href="subscription.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>


</head>

<body>

    <div class="container">
        <p class="subsc-title white-">Subscription</p>
        <hr>
        <div class="form-group mt-4">
            <label><p class="white-">Subscription Plan:</p></label>
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

        <div class="form-group margin- mb-4">
            <span class="white-">Payable Amount:</span>
            <span id="subPrice" class="green-">
                    <?php echo '$' . $item_price . ' ' . CURRENCY; ?>
            </span>
        </div>

        <!-- PayPal Sunscription payment button -->
        <form class="form-" action="<?php echo PAYPAL_URL; ?>" method="post">
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
            <div class="button-cont">
                <button class="btn btn-primary buy-btn" type="submit" value="">Buy Subscription</button>
                <button type="button" class="btn btn-secondary">Back</button>
            </div>
            
        </form>
    </div>
    
</body>



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