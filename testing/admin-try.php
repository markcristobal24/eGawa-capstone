<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, 
    initial-scale=1.0">
  <title>eGAwa | Admin Page</title>
  <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
  <link rel="stylesheet" href="admin-try.css"/>
  <script defer src="main.js"></script>
</head>
<body>
  <nav>
    <button type="button" id="toggle-btn">
      <i class="fa fa-bars"></i>
    </button>
    <span>Egawa</span>
    <ul class="sidebar-menu">
      <li><a href="#"><i class="fa fa-home"></i>Dashboard</a></li>
      <li><a href="#"><i class="fa fa-suitcase"></i>Subscriptions</a></li>
      <li><a href="#"><i class="fa fa-user"></i>Manage Users</a></li>
      <li><a href="#"><i class="fa fa-gear"></i>Subscriptions</a></li>
      <li id="bgModeBtn"><a href="#"><i id="bgModeIcon" class="fa fa-sun-o"></i>Mode</a></li>
    </ul>
  </nav>
  <section>
    <h1>Welcome, 
      <span class="admin-name">Admin</span>
    </h1>
    <div class="content">
      <h2>Dashboard</h2>
        <div class="box-">
            <div class="box-1 boxes">
                <span>Total Users:</span>
                <span class="boxes-data">100</span>
            </div>
            <div class="box-2 boxes">
                <span>Revenue:</span>
                <span class="boxes-data">100,000.00</span>
            </div>
            <div class="box-3 boxes"></div>
            <div class="box-4 boxes"></div>
            <div class="box-5 boxes"></div>
            <!-- <div class="box-1 boxes"></div>
            <div class="box-2 boxes"></div>
            <div class="box-3 boxes"></div>
            <div class="box-4 boxes"></div>
            <div class="box-5 boxes"></div>
            <div class="box-1 boxes"></div>
            <div class="box-2 boxes"></div>
            <div class="box-3 boxes"></div>
            <div class="box-4 boxes"></div>
            <div class="box-5 boxes"></div>
            <div class="box-1 boxes"></div>
            <div class="box-2 boxes"></div>
            <div class="box-3 boxes"></div>
            <div class="box-4 boxes"></div>
            <div class="box-5 boxes"></div> -->
        </div>
    </div>
  </section>
</body>
</html>

<script>
  const nav = document.querySelector('nav');
const toggle_btn = document.getElementById('toggle-btn');
const content = document.querySelector('section');

toggle_btn.onclick = function() {
    nav.classList.toggle('hide');
    content.classList.toggle('expand');
};

const body = document.querySelector('body');
const bgModeBtn = document.getElementById('bgModeBtn');
const bgModeIcon = document.getElementById('bgModeIcon');
const sectionHeader = document.querySelector('section h1');

bgModeBtn.onclick = function(){
    body.classList.toggle("dark-mode");
    bgModeIcon.classList.toggle("fa-sun-o");
    bgModeIcon.classList.toggle("fa-moon-o");
    sectionHeader.classList.toggle("dark-mode");
}
</script>