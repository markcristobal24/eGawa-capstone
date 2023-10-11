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
    <link rel="stylesheet" href="subs2.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>


</head>

<body>
    <h1>SELECT THE PLAN THAT SUITS YOU</h1>
    <section class="pricing">

        <div class="card-wrapper">
            <div class="card-header">
                <img class="img-" src="img/week.png" alt="">
                <h2>WEEKLY</h2>
            </div>
            <div class="card-detail">
                <p>Some information here</p>
            </div>
            <div class="card-price">
                <p><sup>$</sup>25 <sub>/weekly</sub></p>
            </div>
            <form action="">
                <button class="card-button">Subscribe</button>
            </form>
        </div>


        <div class="card-wrapper">
            <div class="card-header">
                <img class="img-" src="img/month.png" alt="">
                <h2>MONTHLY</h2>
            </div>
            <div class="card-detail">
                <p>Some information here</p>
            </div>
            <div class="card-price">
                <p><sup>$</sup>75 <sub>/monthly</sub></p>
            </div>
            <button class="card-button">Subscribe</button>
        </div>


        <div class="card-wrapper">
            <div class="card-header">
                <img class="img-" src="img/year.png" alt="">
                <h2>YEARLY</h2>
            </div>
            <div class="card-detail">
                <p>Some information here</p>
            </div>
            <div class="card-price">
                <p><sup>$</sup>399 <sub>/yearly</sub></p>
            </div>
            <button class="card-button">Subscribe</button>
        </div>


    </section>
    <div class="back-to-home">
        <button class="back-home">Home</button>
    </div>


    <div class="custom-shape-divider-bottom-1690684253">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path
                d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z"
                opacity=".25" class="shape-fill"></path>
            <path
                d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z"
                opacity=".5" class="shape-fill"></path>
            <path
                d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z"
                class="shape-fill"></path>
        </svg>
    </div>

</body>

</html>