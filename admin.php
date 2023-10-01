
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Link for Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />

    <!-- Link for CSS -->
    <link rel="stylesheet" href="admin.css" />
    <link rel="stylesheet" href="css/notification.css">

    <!-- For social icons in the footer -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />

    <title>eGawa | Admin</title>
</head>
<body>
    <header>
        <h1>eGawa</h1>
    </header>
    <?php 
        //include "other/navbar.php"; 
    ?>
    
    <div class="container-">
        <nav class="sidebar">
            <ul>
                <li><a href="#"><i class="fa fa-home"></i><span>Dashboard</span></a></li>
                <li><a href="#"><i class="fa fa-suitcase"></i><span>Subscriptions</span></a></li>
                <li><a href="#"><i class="fa fa-user"></i><span>Manage Users</span></a></li>
                <!-- <li><a href="#"><i class="fa fa-gear"></i>Subscriptions</a></li> -->
                <!-- <li><a href="#" class="list-">Manage Users</a></li>
                <li><a href="#" class="list-">Subscriptions</a></li>
                <li><a href="#" class="list-">Sample</a></li> -->
            </ul>
        </nav>

        <div class="content">
            <h1>Dashboard</h1>
            <span class="row-title titles">Users:</span>
            <div class="box-">
                <div class="box-1 boxes">
                    <span>Total Users:</span>
                    <span class="boxes-data">100</span>
                </div>
                <div class="box-2 boxes">
                    <span>Subscribed:</span>
                    <span class="boxes-data">60</span>
                </div>
                <div class="box-3 boxes">
                    <span>Lesbian:</span>
                    <span class="boxes-data">10</span>
                </div>
                <div class="box-4 boxes">
                    <span>Queer:</span>
                    <span class="boxes-data">90</span>
                </div>
                <div class="box-5 boxes"></div>
            </div>

            <span class="row-title titles">Freelancers:</span>
            <div class="box-">
                <div class="box-1 boxes">
                    <span>Total Freelancers:</span>
                    <span class="boxes-data">100</span>
                </div>
                <div class="box-2 boxes">
                    <span>Subscribed:</span>
                    <span class="boxes-data">60</span>
                </div>
                <div class="box-3 boxes">
                    <span>Gays:</span>
                    <span class="boxes-data">40</span>
                </div>
                <div class="box-4 boxes"></div>
                <div class="box-5 boxes"></div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>
