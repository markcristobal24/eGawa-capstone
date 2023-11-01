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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <title>eGawa | Admin Dashboard</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary px-5 py-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><span class="white-"><img src="img/eGAWAwhite.png" alt="" style="height:40px;"></span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon "></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#"><span class="white- hov-">Dashboard</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><span class="white- hov-">Reports</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="white- hov-">Manage</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Freelancer</a></li>
                            <li><a class="dropdown-item" href="#">Company</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Banned Users</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex">
                    <span class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="white- hov-">Hi, Admin <span>Sulit</span></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Log out</a></li>
                        </ul>
                    </span>
                </form>
            </div>
        </div>
    </nav>

    <!-- <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#side-menu" aria-controls="offcanvasExample">
        Menu
    </button> -->

    <div class="container- mt-5 pt-5">

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

                <div class="box-4 boxes"></div>
                <div class="box-5 boxes"></div>
            </div>
        </div>
    </div>

    <!-- <div class="offcanvas offcanvas-start" tabindex="-1" id="side-menu" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Admin Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <li><a href="#"><i class="fa fa-home"></i><span>Dashboard</span></a></li>
            <li><a href="#"><i class="fa fa-suitcase"></i><span>Subscriptions</span></a></li>
            <li><a href="#"><i class="fa fa-user"></i><span>Manage Users</span></a></li>
        </div>
    </div> -->

    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>