<!-- <?php session_start(); ?> -->
<nav class="navbar navbar-expand-md navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="#"><img src="../img/eGAWAwhite.png" alt="Logo" id="logoImage"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a id="home1" class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a id="about1" id="about" class="nav-link" href="../other/aboutUs.php">About</a>
                </li>
                <li class="nav-item">
                    <a id="freeLanceInbox" class="nav-link" href="freeLanceInbox.php">Messages</a>
                </li>
                <li class="nav-item dropdown">
                    <?php if (isset($_SESSION['email']) && isset($_SESSION['userType']) && $_SESSION['userType'] == "freelancer"): ?>
                    <a id="freelanceOption" class="nav-link" href="#">Welcome,
                        <span>
                            <?php echo $_SESSION['firstName']; ?>
                        </span></a>
                    <div class="dropdown-content">
                        <a href="../freelance/freelanceHomePage.php">My Profile</a>
                        <a href="../freelance/freelanceChangeEmail.php">Change Email Address</a>
                        <a href="../freelance/freelanceChangePass.php">Change Password</a>
                        <a id="logout1" href="#">Log Out</a>
                    </div>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </div>
</nav>

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