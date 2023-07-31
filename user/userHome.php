
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Link for Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Link for CSS -->
    <link rel="stylesheet" href="../css/userHome.css">

    <!-- For social icons in the footer -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <title>eGawa | User Home</title>

</head>

<body>

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
                        <a id="home1" class="nav-link" href="userHome.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a id="about1" id="about" class="nav-link" href="aboutUs.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a id="userInbox" class="nav-link" href="userInbox.php">Messages</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="userOption" class="nav-link" href="#">Welcome,
                            <span>

                            </span></a>
                        <div class="dropdown-content">
                            <a href="userChangeEmail.php">Change Email Address</a>
                            <a href="userChangePass.php">Change Password</a>
                            <a href="" data-bs-toggle="modal" data-bs-target="#staticBackdropYow">Edit Account</a>
                            <a id="logout1" href="#" >Log Out</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="containerUserHome">

        <div class="div2">

                <div class="containerPost">
                    <div class="row">
                        <div class="col-6"> <!-- 6 columns for the dropdown button -->
                            <div class="dropdown">
                                <button id="dropdownBTN" class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Website Development
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li><a class="dropdown-item" href="#" onclick="changeOption('Option 1')">Website Development</a></li>
                                    <li><a class="dropdown-item" href="#" onclick="changeOption('Option 2')">Mobile Development</a></li>
                                    <li><a class="dropdown-item" href="#" onclick="changeOption('Option 3')">Website Hosting</a></li>
                                    <li><a class="dropdown-item" href="#" onclick="changeOption('Option 4')">Multimedia</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-6 d-flex justify-content-end"> <!-- 6 columns for the search button -->
                            <form class="d-flex ">
                                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-success" type="submit">Search</button>
                            </form>
                        </div>
                    </div>
                </div>

            <div class="containerHistory">

                <div id="option1Div">
                    <div class="containerPost">
                        <span class="titlePost">Website Developer</span>
                        <div>
                            <span class="locationPost">Malolos, Bulacan</span>
                            <span class="datePost">Posted on July 03, 2023</span>
                        </div>
                        <span class="descPost">
                            I need a freelancer who can make a responsive website ASAP!
                        </span>
                    </div>

                    <div class="containerPost">
                        <span class="titlePost">Bootstrap Gods</span>
                        <div>
                            <span class="locationPost">Plaridel, Bulacan</span>
                            <span class="datePost">Posted on May 03, 2023</span>
                        </div>
                        <span class="descPost">
                            I have a work for freelancers who can do bootstrap
                        </span>
                    </div>
                    <div class="containerPost">
                        <span class="titlePost">Website Developer</span>
                        <div>
                            <span class="locationPost">Malolos, Bulacan</span>
                            <span class="datePost">Posted on July 03, 2023</span>
                        </div>
                        <span class="descPost">
                            I need a freelancer who can make a responsive website ASAP!
                        </span>
                    </div>
                    <div class="containerPost">
                        <span class="titlePost">Website Developer</span>
                        <div>
                            <span class="locationPost">Malolos, Bulacan</span>
                            <span class="datePost">Posted on July 03, 2023</span>
                        </div>
                        <span class="descPost">
                            I need a freelancer who can make a responsive website ASAP!
                        </span>
                    </div>
                    <div class="containerPost">
                        <span class="titlePost">Website Developer</span>
                        <div>
                            <span class="locationPost">Malolos, Bulacan</span>
                            <span class="datePost">Posted on July 03, 2023</span>
                        </div>
                        <span class="descPost">
                            I need a freelancer who can make a responsive website ASAP!
                        </span>
                    </div>
                    <div class="containerPost">
                        <span class="titlePost">Website Developer</span>
                        <div>
                            <span class="locationPost">Malolos, Bulacan</span>
                            <span class="datePost">Posted on July 03, 2023</span>
                        </div>
                        <span class="descPost">
                            I need a freelancer who can make a responsive website ASAP!
                        </span>
                    </div>
                    <div class="containerPost">
                        <span class="titlePost">Website Developer</span>
                        <div>
                            <span class="locationPost">Malolos, Bulacan</span>
                            <span class="datePost">Posted on July 03, 2023</span>
                        </div>
                        <span class="descPost">
                            I need a freelancer who can make a responsive website ASAP!
                        </span>
                    </div>



                </div>

                <div id="option2Div" style="display: none;">
                    <div class="containerPost">
                        <span class="titlePost">Mobile Developer</span>
                        <div>
                            <span class="locationPost">Malolos, Bulacan</span>
                            <span class="datePost">Posted on March 03, 2023</span>
                        </div>
                        <span class="descPost">
                            Need Android Apps developer
                        </span>
                    </div>
                    <div class="containerPost">
                        <span class="titlePost">Android Studio Gods</span>
                        <div>
                            <span class="locationPost">Paombong, Bulacan</span>
                            <span class="datePost">Posted on June 03, 2023</span>
                        </div>
                        <span class="descPost">
                            Need Android Apps developer
                        </span>
                    </div>
                </div>

                <div id="option3Div" style="display: none;">
                <div class="containerPost">
                        <span class="titlePost">Mobile Developer</span>
                        <div>
                            <span class="locationPost">Malolos, Bulacan</span>
                            <span class="datePost">Posted on March 03, 2023</span>
                        </div>
                        <span class="descPost">
                            Need Android Apps developer
                        </span>
                    </div>
                    <div class="containerPost">
                        <span class="titlePost">Android Studio Gods</span>
                        <div>
                            <span class="locationPost">Paombong, Bulacan</span>
                            <span class="datePost">Posted on June 03, 2023</span>
                        </div>
                        <span class="descPost">
                            Need Android Apps developer
                        </span>
                    </div>
                </div>

                <div id="option4Div" style="display: none;">
                <div class="containerPost">
                        <span class="titlePost">Mobile Developer</span>
                        <div>
                            <span class="locationPost">Malolos, Bulacan</span>
                            <span class="datePost">Posted on March 03, 2023</span>
                        </div>
                        <span class="descPost">
                            Need Android Apps developer
                        </span>
                    </div>
                    <div class="containerPost">
                        <span class="titlePost">Android Studio Gods</span>
                        <div>
                            <span class="locationPost">Paombong, Bulacan</span>
                            <span class="datePost">Posted on June 03, 2023</span>
                        </div>
                        <span class="descPost">
                            Need Android Apps developer
                        </span>
                    </div>
                </div>

		    </div>
        </div>

        <div class="div1">
            <img id="userPic" src="../img/profile.png" alt="user profile" title="user profile">
            <h2 id="userName">User Name</h2>

            <h4 class="">Post Something</h4>

            <div class="dropdown">
                <button id="dropdownBTNPost" class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Website Development
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="#" onclick="changeOptionPost('Option 1')">Website Development</a></li>
                    <li><a class="dropdown-item" href="#" onclick="changeOptionPost('Option 2')">Mobile Development</a></li>
                    <li><a class="dropdown-item" href="#" onclick="changeOptionPost('Option 3')">Website Hosting</a></li>
                    <li><a class="dropdown-item" href="#" onclick="changeOptionPost('Option 4')">Multimedia</a></li>
                </ul>
            </div>

            <form >

                <div class="form-floating col-10 gx-2 gy-2 justify-content-end">
                    <input type="text" id="title" name="title" class="form-control" placeholder="Enter Title">
                    <label id="addr" for="title">Enter Title</label>
                </div>
                <div class="form-floating col-10 gx-2 gy-2 justify-content-end">
                    <input type="text" id="desc" name="desc" class="form-control" placeholder="Enter Description">
                    <label id="addr" for="desc">Enter Description</label>
                </div>
                <div class="form-floating col-10 gx-2 gy-2 justify-content-end">
                    <input type="text" id="tags" name="tags" class="form-control" placeholder="Enter Tags">
                    <label id="addr" for="tags">Enter Tags</label>
                </div>
                <button type="submit" id="" class="btn btn-primary">
                    Submit
                </button>
        </form>

        </div>
    </div>


    <!--Modal for log out-->
    <div class="modal fade" id="modalLogOut" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Logging Out</h5>
                </div>
                <div class="modal-body" id="modalLogOutConfirmation"> <!-- Updated ID -->
                    <!-- ...modal content for log out confirmation -->
                    Are you sure you want to log out?
                    <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="logoutBtn">
                        Log Out
                    </button>
                    <button type="button" class="btn btn-secondary" id="cancelLogOutBtn">
                        Cancel
                    </button>
                </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function changeOption(option) {
        const btn = document.getElementById('dropdownBTN');
        const option1Div = document.getElementById('option1Div');
        const option2Div = document.getElementById('option2Div');
        const option3Div = document.getElementById('option3Div');
        const option4Div = document.getElementById('option4Div');

        if (option === 'Option 1') {
            option1Div.style.display = 'block';
            option2Div.style.display = 'none';
            option3Div.style.display = 'none';
            option4Div.style.display = 'none';
            btn.innerText = 'Website Development'; 

        } else if (option === 'Option 2') {
            option1Div.style.display = 'none';
            option2Div.style.display = 'block';
            option3Div.style.display = 'none';
            option4Div.style.display = 'none';
            btn.innerText = 'Mobile Development'; 

        } else if (option === 'Option 3') {
            option1Div.style.display = 'none';
            option2Div.style.display = 'none';
            option3Div.style.display = 'block';
            option4Div.style.display = 'none';
            btn.innerText = 'Website Hosting'; 

        } else if (option === 'Option 4') {
            option1Div.style.display = 'none';
            option2Div.style.display = 'none';
            option3Div.style.display = 'none';
            option4Div.style.display = 'block';
            btn.innerText = 'Multimedia'; 

        }
    }

    function changeOptionPost(optionPost) {
        const btnPost = document.getElementById('dropdownBTNPost');


        if (optionPost === 'Option 1') {

            btnPost.innerText = 'Website Development'; 

        } else if (optionPost === 'Option 2') {

            btnPost.innerText = 'Mobile Development'; 

        } else if (optionPost === 'Option 3') {

            btnPost.innerText = 'Website Hosting'; 

        } else if (optionPost === 'Option 4') {
 
            btnPost.innerText = 'Multimedia'; 

        }
    }
    </script>


    <script src="../js/script.js "></script>
    <script src="../js/user.js"></script>
    
    <script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   
    


</body>


</html>