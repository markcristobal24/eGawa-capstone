<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Link for CSS -->
  <link rel="stylesheet" href="css/freelanceRegistration.css" />

  <!-- Link for Bootstrap 5 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />

  <!-- For social icons in the footer -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />


  <title>eGawa | Freelance Register</title>
</head>

<body>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#"><img src="img/eGAWAwhite.png" alt="Logo" id="logoImage" /></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a id="about" class="nav-link" href="aboutUs.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Login</a>
          </li>
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
          <button class="btn btn-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>

  <div class="containerLogin">
    <h1 class="regisTitle">How would you like to work?</h1>
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <div class="choice" onclick="freelanceChoice('freelanceBrowse')" id="freelanceBrowse">
              <h5 class="choice-label">Browse for possible work</h5>
              <img src="css/look4job.png" alt="Browse for possible work" />
              <p>Browse and apply for posted jobs on the marketplace</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <div class="choice" onclick="freelanceChoice('freelancePackage')" id="freelancePackage">
              <h5 class="choice-label">Package up work</h5>
              <img src="css/create.png" alt="Package up work" />
              <p>Customize service's prices and information for the clients to avail</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="d-grid mt-4 gap-2 d-md-flex justify-content-end">
      <button type="button" id="registerContinue" class="btn btn-primary" onclick="sendDataRegister();">
        Continue
      </button>
      <button type="button" id="registerClear" class="btn btn-secondary" onclick="clearFreelanceChoice();">
        Clear
      </button>
    </div>


  </div>

  <footer class="footer">
    <div class="containerFooter">
      <div class="socialIcons">
        <a href="https://www.facebook.com/"><i class="fa-brands fa-facebook"></i></a>
        <a href="https://www.twitter.com/"><i class="fa-brands fa-twitter"></i></a>
        <a href="https://www.gmail.com/"><i class="fa-brands fa-google"></i></a>
        <a href="https://www.instagram.com/"><i class="fa-brands fa-instagram"></i></a>
        <a href="https://www.whatsapp.com/"><i class="fa-brands fa-whatsapp"></i></a>
      </div>
      <p class="footerInfo">&copy; 2023 eGawa. All rights reserved.</p>
    </div>
  </footer>

  <!--Modal for Invalid Click of Button-->
  <div class="modal fade" id="myModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Warning!</h5>
        </div>
        <div class="modal-body">Please select one to proceed</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="yes">
            Understood
          </button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
    crossorigin="anonymous"></script>
  <script src="js/script.js"></script>
</body>

</html>