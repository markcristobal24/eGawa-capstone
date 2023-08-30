<?php
// session_start();
require_once dirname(__FILE__) . "/../php/classes/DbClass.php";
require_once dirname(__FILE__) . "/../php/classes/Account.php";

$db = new DbClass();
$account = new Account();
$account->fetch_account($_SESSION['email']);
$account->fetch_profile($_SESSION['email']);

if (!isset($_SESSION['email'])) {
    header('location: ../login.php');
    die();
}

$email = $_SESSION['email'];
$query = $db->connect()->prepare("SELECT * FROM account INNER JOIN profile ON account.account_id = profile.account_id WHERE account.email = :email");
$query->execute([':email' => $email]);
$fetch = $query->fetch(PDO::FETCH_ASSOC);

$fullname = $fetch['firstName'] . ' ' . $fetch['lastName'];
?>

<!DOCTYPE html>
<html>

  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Link for Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Link for CSS -->
    <link rel="stylesheet" href="freelance_message.css">
    <link rel="stylesheet" href="../css/notification.css">

    <!-- For social icons in the footer -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <title>eGawa | Messages</title>

    <style>

    </style>

</head>

	<body>
		
    <?php //print_r($_SESSION); ?>
    <?php include "../other/navbar.php"; ?>
    <div class="toast_notif" id="toast_notif"></div>

		<div id="container2">

			<!-- Menu Tab -->
			<div class="menu_container">
                <ul class="tab_navigation">
                    <li>Messages</li>
                    <li>Job Application</li>
                </ul>
            </div>

			<!-- First Tab -->
			<div class="tab_container_area">
                <div class="tab_container">
                    Lorem1 ipsum dolor sit amet, consectetur adipisicing elit. Quas, nam.
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores placeat dicta, 
                    est animi itaque sequi harum suscipit error accusantium soluta.
                </div>
                <div class="tab_container">
                    Lorem2 ipsum dolor sit amet, consectetur adipisicing elit. Quas, nam.
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reprehenderit, 
                    ullam nam esse est harum repellendus tempora velit quod suscipit quibusdam culpa, veritatis ab hic sapiente iste quisquam mollitia. Consectetur, fugit!
                </div>
            </div>

		</div>
	</body>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="testing.js"></script>

  <script>
    
    $(document).ready(function () {
        $('.tab_container:first').show();
        $('.tab_navigation li:first').addClass('active');

        $('.tab_navigation li').click(function(event){
            index = $(this).index();
            $('.tab_navigation li').removeClass('active');
            $(this).addClass('active');
            $('.tab_container').hide();
            $('.tab_container').eq(index).show();
        });

    });

  </script>

</html>