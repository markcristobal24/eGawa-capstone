<nav class="navbar navbar-expand-md navbar-dark">
    <div class="container">
        <?php
        if (isset($_SESSION['email']) && isset($_SESSION['userType']) && $_SESSION['userType'] == "freelancer") {
            ?>
        <a class="navbar-brand" href="../freelance/freelanceHome.php"><img src="../img/eGAWAwhite.png" alt="Logo"
                id="logoImage"></a>
        <?php
        } else if (isset($_SESSION['email']) && isset($_SESSION['userType']) && $_SESSION['userType'] == "user") {
            ?>
        <a class="navbar-brand" href="../user/userHome.php"><img src="../img/eGAWAwhite.png" alt="Logo"
                id="logoImage"></a>
        <?php
        }
        ?>
        <!-- <a class="navbar-brand" href="../user/userHome.php"><img src="../img/eGAWAwhite.png" alt="Logo" -->
        <!-- id="logoImage"></a> -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <?php if (isset($_SESSION['email']) && isset($_SESSION['userType']) && $_SESSION['userType'] == "freelancer"): ?>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a id="home1" class="nav-link" href="../freelance/freelanceHome.php">Home</a>
                </li>
                <li class="nav-item">
                    <a id="about1" id="about" class="nav-link" href="../other/aboutUs.php">About</a>
                </li>
                <li class="nav-item">
                    <a id="freeLanceInbox" class="nav-link" href="freeLanceInbox.php">Messages <span
                            class="badge text-bg-secondary bg-danger">0</span></a>
                </li>
                <li class="nav-item dropdown">

                    <a id="freelanceOption" class="nav-link" href="#">Welcome,
                        <span id="welcomeName">
                            <?php echo $_SESSION['firstName']; ?>
                        </span></a>
                    <div class="dropdown-content">
                        <a href="../freelance/freelanceHomePage.php">My Profile</a>
                        <a href="../freelance/freelanceChangeEmail.php">Change Email Address</a>
                        <a href="../freelance/freelanceChangePass.php">Change Password</a>
                        <a id="logout1" href="#">Log Out</a>
                    </div>

                </li>
            </ul>
            <?php elseif (isset($_SESSION['email']) && isset($_SESSION['userType']) && $_SESSION['userType'] == "user"): ?>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a id="home1" class="nav-link" href="../user/userHome.php">Home</a>
                </li>
                <li class="nav-item">
                    <a id="about1" id="about" class="nav-link" href="../other/aboutUs.php">About</a>
                </li>
                <li class="nav-item">
                    <a id="freeLanceInbox" class="nav-link" href="freeLanceInbox.php">Messages <span
                            class="badge text-bg-secondary bg-danger">0</span></a>
                </li>
                <li class="nav-item dropdown">

                    <a id="freelanceOption" class="nav-link" href="#">Welcome,
                        <span id="welcomeName">
                            <?php echo $_SESSION['firstName']; ?>
                        </span></a>
                    <div class="dropdown-content">
                        <a href="../user/userHomePage.php">My Profile</a>
                        <a href="../user/userEditProfile.php">Edit Profile</a>
                        <a href="../user/userChangeEmail.php">Change Email Address</a>
                        <a href="../user/userChangePass.php">Change Password</a>
                        <a id="logout1" href="#">Log Out</a>
                    </div>
                </li>
            </ul>
            <?php endif; ?>
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