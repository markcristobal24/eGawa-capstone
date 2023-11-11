<style>
    /* ===for nav bar====== */
    nav {
        background-image: linear-gradient(to right, #0073aa, #8000aa);
        box-shadow: 0px 0 10px 10px rgba(0, 0, 0, 0.5);
        color: #fff;
    }

    .white- {
        color: #fff;
    }

    .hov-:hover {
        color: coral;
    }
</style>


<nav class="navbar navbar-expand-lg bg-body-tertiary px-5 py-3 fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><span class="white-"><img src="../img/admin.png" alt="" style="height:40px;"></span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon "></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="dashboard.php"><span class="white- hov-">Dashboard</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="freelance_verification.php"><span class="white- hov-">Verification</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logs.php"><span class="white- hov-">Logs</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="reports.php"><span class="white- hov-">Reports</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="white- hov-">Manage Users</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="freelance-tab.php">Freelancer</a></li>
                        <li><a class="dropdown-item" href="company-tab.php">Company</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Banned Users</a></li>
                    </ul>
                </li>
            </ul>
            <div class="d-flex">
                <span class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="white- hov-">Hi, Admin <span></span></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#" id="logout1">Log out</a></li>
                    </ul>
                </span>
            </div>
        </div>
    </div>
</nav>
<!--Modal for log out-->
<div class="modal fade" id="modalLogOut" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Logging Out</h5>
            </div>
            <div class="modal-body" id="modalUser">Are you sure you want to log out?</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="logoutBtn" onclick="new Account().logout();">
                    Log Out
                </button>
                <button type="button" class="btn btn-secondary" id="cancelLogOutBtn">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>