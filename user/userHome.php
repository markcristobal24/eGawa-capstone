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


    <?php include "../other/navbar.php"; ?>

    <div class="containerUserHome">
        <div class="containerLeft">
            <div class="containerLeft-Nav">
                <div class="left-nav-dropdown">
                    <div class="dropdownOption">
                        <form action="">
                            <select id="filterOption" name="filterOption" onchange="updateDivContent()">
                                <option value="webdev">Website Development</option>
                                <option value="mobiledev">Mobile Development</option>
                                <option value="webhost">Website Hosting</option>
                                <option value="multi">Multimedia</option>
                            </select>
                        </form>
                    </div>
                </div>
                <div class="left-nav-search">
                    <form class="d-flex">
                        <input class="form-control me-2 search" type="search" placeholder="Search a tag"
                            aria-label="Search">
                        <button class="btn btn-success" type="submit">Search</button>
                    </form>
                </div>
            </div>

            <div class="containerLeft-Feed">

                <div class="containerPost">
                    <span class="titlePost">Website Developer</span>
                    <div>
                        <span class="author">
                            Author:
                        </span>
                        <span class="userPost">
                            John Paulo Sulit
                        </span>
                    </div>
                    <div>
                        <span class="locationPost">Malolos, Bulacan</span>
                        <span>&#8226;</span>
                        <span class="datePost">Posted on July 03, 2023</span>
                    </div>

                    <p class="descPost">
                        I need a freelancer who can make a responsive website ASAP! kjsdhkasjhdkjashdjkashdkjh
                        «Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                        laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto
                        beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur
                        aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi
                        nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur,
                        adipisci velit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam
                        aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis
                        suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure
                        reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui
                        dolorem eum fugiat, quo
                    </p>
                    <div>
                        <button id="viewPostBTN">View post</button>
                    </div>
                </div>

                <div class="containerPost">
                    <span class="titlePost">Website Developer</span>
                    <div>
                        <span class="author">
                            Author:
                        </span>
                        <span class="userPost">
                            John Paulo Sulit
                        </span>
                    </div>
                    <div>
                        <span class="locationPost">Malolos, Bulacan</span>
                        <span>&#8226;</span>
                        <span class="datePost">Posted on July 03, 2023</span>
                    </div>

                    <p class="descPost">
                        I need a freelancer who can make a responsive website ASAP! kjsdhkasjhdkjashdjkashdkjh
                        «Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                        laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto
                        beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur
                        aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi
                        nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur,
                        adipisci velit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam
                        aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis
                        suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure
                        reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui
                        dolorem eum fugiat, quo
                    </p>
                    <div>
                        <button id="viewPostBTN">View post</button>
                    </div>
                </div>

                <div class="containerPost">
                    <span class="titlePost">Website Developer</span>
                    <div>
                        <span class="author">
                            Author:
                        </span>
                        <span class="userPost">
                            John Paulo Sulit
                        </span>
                    </div>
                    <div>
                        <span class="locationPost">Malolos, Bulacan</span>
                        <span>&#8226;</span>
                        <span class="datePost">Posted on July 03, 2023</span>
                    </div>

                    <p class="descPost">
                        I need a freelancer who can make a responsive website ASAP! kjsdhkasjhdkjashdjkashdkjh
                        «Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                        laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto
                        beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur
                        aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi
                        nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur,
                        adipisci velit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam
                        aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis
                        suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure
                        reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui
                        dolorem eum fugiat, quo
                    </p>
                    <div>
                        <button id="viewPostBTN">View post</button>
                    </div>
                </div>

                <div class="containerPost">
                    <span class="titlePost">Website Developer</span>
                    <div>
                        <span class="author">
                            Author:
                        </span>
                        <span class="userPost">
                            John Paulo Sulit
                        </span>
                    </div>
                    <div>
                        <span class="locationPost">Malolos, Bulacan</span>
                        <span>&#8226;</span>
                        <span class="datePost">Posted on July 03, 2023</span>
                    </div>

                    <p class="descPost">
                        I need a freelancer who can make a responsive website ASAP! kjsdhkasjhdkjashdjkashdkjh
                        «Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                        laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto
                        beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur
                        aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi
                        nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur,
                        adipisci velit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam
                        aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis
                        suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure
                        reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui
                        dolorem eum fugiat, quo
                    </p>
                    <div>
                        <button id="viewPostBTN">View post</button>
                    </div>
                </div>

                <div class="containerPost">
                    <span class="titlePost">Website Developer</span>
                    <div>
                        <span class="author">
                            Author:
                        </span>
                        <span class="userPost">
                            John Paulo Sulit
                        </span>
                    </div>
                    <div>
                        <span class="locationPost">Malolos, Bulacan</span>
                        <span>&#8226;</span>
                        <span class="datePost">Posted on July 03, 2023</span>
                    </div>

                    <p class="descPost">
                        I need a freelancer who can make a responsive website ASAP! kjsdhkasjhdkjashdjkashdkjh
                        «Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                        laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto
                        beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur
                        aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi
                        nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur,
                        adipisci velit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam
                        aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis
                        suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure
                        reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui
                        dolorem eum fugiat, quo
                    </p>
                    <div>
                        <button id="viewPostBTN">View post</button>
                    </div>
                </div>

            </div>

        </div>

        <div class="containerRight">
            <!-- <div class="containerRight-Nav">

            </div> -->
            <div class="userProfile">
                <div class="userProfileChild">
                    <img id="userPic" src="../img/profile.png" alt="user profile" title="user profile">
                    <p id="userName">John Paulo Sulit</p>
                    <p id="userName">other info</p>
                </div>
            </div>
            <div class="userPost">
                <div class="userPostChild">
                    <div class="toFlex">
                        <p class="postTitle">Post a Job</p>
                    </div>

                    <form id="formPost" action="/submit" method="post">
                        <div class="toFlex">
                            <div class="dropdownOptionPost">

                                <select id="filterOptionPost" name="filterOption" onchange="updateDivContent()">
                                    <option value="webdev">Website Development</option>
                                    <option value="mobiledev">Mobile Development</option>
                                    <option value="webhost">Website Hosting</option>
                                    <option value="multi">Multimedia</option>
                                </select>

                            </div>
                        </div>
                        <label for="title">Title:</label>
                        <input type="text" id="title" name="title" required>

                        <label for="description">Description:</label>
                        <!-- <input type="text" id="description" name="description" required><br> -->
                        <textarea id="description" name="description" rows="3" required></textarea>

                        <label for="tags">Tags:</label>
                        <input type="text" id="tags" name="tags">

                        <input id="submitPost" type="submit" value="Submit">
                        <input id="clearPost" type="button" value="Clear">
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!--Modal for log out-->
    <div class="modal fade" id="modalLogOut" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Logging Out</h5>
                </div>
                <div class="modal-body" id="modalLogOutConfirmation">
                    <!-- Updated ID -->
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
    window.onload = function() {
        updateDivContent();
    };

    function updateDivContent() {
        var selectedOption = document.getElementById("filterOption").value;

        if (selectedOption === 'webdev') {
            option1Div.style.display = 'block';
            option2Div.style.display = 'none';
            option3Div.style.display = 'none';
            option4Div.style.display = 'none';



        } else if (selectedOption === 'mobiledev') {
            option1Div.style.display = 'none';
            option2Div.style.display = 'block';
            option3Div.style.display = 'none';
            option4Div.style.display = 'none';


        } else if (selectedOption === 'webhost') {
            option1Div.style.display = 'none';
            option2Div.style.display = 'none';
            option3Div.style.display = 'block';
            option4Div.style.display = 'none';


        } else if (selectedOption === 'multi') {
            option1Div.style.display = 'none';
            option2Div.style.display = 'none';
            option3Div.style.display = 'none';
            option4Div.style.display = 'block';
            btn.innerText = 'Multimedia';

        }
    }

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