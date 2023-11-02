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


<nav class="navbar navbar-expand-lg bg-body-tertiary px-5 py-3">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><span class="white-"><img src="../img/admin.png" alt="" style="height:40px;"></span></a>
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
                        <span class="white- hov-">Manage Users</span>
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
            <div class="d-flex">
                <span class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="white- hov-">Hi, Admin <span>Sulit</span></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Log out</a></li>
                    </ul>
                </span>
            </div>
        </div>
    </div>
</nav>