<?php
// session_start();
// require_once dirname(__FILE__) . "/../php/classes/DbClass.php";
// require_once dirname(__FILE__) . "/../php/classes/Account.php";

// $db = new DbClass();
// $account = new Account();
// $account->fetch_account($_SESSION['email']);
// $account->fetch_profile($_SESSION['email']);

// if (!isset($_SESSION['email'])) {
//     header('location: ../login.php');
//     die();
// }

// $email = $_SESSION['email'];
// $query = $db->connect()->prepare("SELECT * FROM account INNER JOIN profile ON account.account_id = profile.account_id WHERE account.email = :email");
// $query->execute([':email' => $email]);
// $fetch = $query->fetch(PDO::FETCH_ASSOC);

// $fullname = $fetch['firstName'] . ' ' . $fetch['lastName'];
?>

<?php
// session_start();
require_once dirname(__FILE__) . "/../php/classes/DbClass.php";

$db = new DbClass();

$user_id = $_SESSION['account_id'];
$query = $db->connect()->prepare("SELECT * FROM account WHERE account_id = :account_id");
$query->execute([':account_id' => $user_id]);
$fetch = $query->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Link for Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Link for CSS -->
    <link rel="stylesheet" href="../css/user_message.css">
    <link rel="stylesheet" href="../css/notification.css">

    <!-- For social icons in the footer -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <title>eGawa | Messages</title>

    <style>

    </style>

</head>

<body>

    <?php //print_r($_SESSION); ?>
    <?php include "../other/navbar.php"; ?>
    <div class="toast_notif" id="toast_notif"></div>

    <div id="container2">

        <!-- Menu Tab -->
        <div class="menu_container">
            <ul class="tab_navigation">
                <li>Messages</li>
                <li>Job Application</li>
            </ul>
        </div>

        <!-- First Tab -->
        <div class="tab_container_area">
            <div class="tab_container">

                <div class="chat-container">

                    <div class="left-chat-cont chats">
                        <?php
                        $query = $db->connect()->prepare("SELECT * FROM convo 
                        INNER JOIN account on account.account_id = convo.freelance_id
                        INNER JOIN profile on profile.account_id = convo.freelance_id
                        WHERE convo.user_id = :account_id OR convo.freelance_id = :account_id");
                        $query->execute([
                            ':account_id' => $user_id
                        ]);
                        foreach ($query as $row) {
                            $convo_id = $row['convo_id'];
                            echo '
                            <div class="user-post" onclick="clickConvo(' . $convo_id . ')">
                                <div class="user-image">
                                    <img src="https://res.cloudinary.com/dm6aymlzm/image/upload/c_fill,g_face,h_300,w_300/f_png/r_max/' . $row['imageProfile'] . '" alt="" class="user-chat-img">
                                </div>
                                <div class="user-info">
                                    <span class="fname-">' . $row['firstName'] . '</span>
                                    <span class="mname-"></span>
                                    <span class="lname-">' . $row['lastName'] . '</span>
                                </div>
                            </div>
                            ';
                        }
                        ?>

                        <!-- <div class="user-post">
                            <div class="user-image">
                                <img src="../img/profile.png" alt="" class="user-chat-img">
                            </div>
                            <div class="user-info">
                                <span class="fname-">Mark Josh</span>
                                <span class="mname-"></span>
                                <span class="lname-">Cristobal</span>
                            </div>
                        </div>

                        <div class="user-post">
                            <div class="user-image">
                                <img src="../img/profile.png" alt="" class="user-chat-img">
                            </div>
                            <div class="user-info">
                                <span class="fname-">Arvin</span>
                                <span class="mname-">Candelaria</span>
                                <span class="lname-">Bok</span>
                            </div>
                        </div>

                        <div class="user-post">
                            <div class="user-image">
                                <img src="../img/profile.png" alt="" class="user-chat-img">
                            </div>
                            <div class="user-info">
                                <span class="fname-">Joel</span>
                                <span class="mname-"></span>
                                <span class="lname-">Leonor</span>
                            </div>
                        </div> -->

                    </div>

                    <div class="middle-chat-cont chats">

                        <div class="middle-chat-nav">
                            <img src="../img/profile.png" id="chat_image" alt="" class="user-chat-img chat-box-img">
                            <span id="fullname"></span>
                        </div>

                        <div class="middle-chat-box" id="chatbox">
                            <!-- <div class="user-chat">
                                <span>
                                    Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out
                                    print, graphic
                                    or web designs. The passage is attributed to an unknown typesetter in the 15th
                                    century
                                </span>
                            </div>
                            <div class="freelance-chat">
                                <span>
                                    Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out
                                    print, graphic
                                    or web designs. The passage is attributed to an unknown typesetter in the 15th
                                    century who is
                                    thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in
                                    a type
                                    specimen book. It usually begins wit
                                </span>
                            </div>
                            <div class="user-chat">
                                <span>
                                    Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out
                                    print, graphic
                                    or web designs. The passage is attributed to an unknown typesetter in the 15th
                                    century who is
                                    thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in
                                    a type
                                    specimen book. It usually begins wit
                                </span>
                            </div>
                            <div class="freelance-chat">
                                <span>
                                    Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out
                                    print, graphic
                                    or web designs.
                                </span>
                            </div> -->
                        </div>

                        <div class="middle-chat-send">

                            <div id="inputDiv">
                                <form id="message_box">
                                    <textarea id="inputTextarea" name="messageInput" rows="3" cols="50"
                                        placeholder="Enter your message here..."></textarea>
                                    <div class="button-container">
                                        <button type="button" id="btn_sendMessage" onclick="send_message(this.value)"
                                            class="btn btn-primary">Send</button>
                                    </div>
                                </form>
                            </div>

                        </div>

                    </div>

                    <div class="right-chat-cont">
                        <div class="profile-pic">
                            <img src="../img/profile.png" id="profile_image" alt="" class="user-chat-img right-pic">
                        </div>
                        <div class="profile-info block">
                            <span class="block" id="profile_name"></span>
                            <div>
                                <img src="../img/address.png" alt="" class="addressImg" height="20px">
                                <span class="block" id="profile_address"></span>
                            </div>

                            <div>
                                <img src="../img/email.png" alt="" class="emailImg" height="20px">
                                <span class="block" id="profile_email"></span>
                            </div>

                        </div>
                    </div>

                </div>


            </div>

            <div class="tab_container">

                <div class="col-names">

                    <div class="col-name">
                        <span>Pending</span>
                    </div>

                    <div class="col-name">
                        <span>Accepted</span>
                    </div>

                    <div class="col-name">
                        <span>Completed</span>
                    </div>

                </div>

                <div class="col-container">

                    <div class="col-one col-all">
                        <?php
                        $query = $db->connect()->prepare(
                            "SELECT * FROM job_application
                                INNER JOIN jobposts ON job_application.post_id = jobposts.post_id
                                INNER JOIN account ON job_application.freelance_id = account.account_id
                                WHERE job_application.user_id = :account_id AND job_application.jobstatus = 'PENDING' ORDER BY timestamp DESC"
                        );
                        $query->execute([
                            ':account_id' => $_SESSION['account_id']
                        ]);
                        foreach ($query as $row) {
                            echo '
                                <div class="parent" data-bs-toggle="modal" data-bs-target="#modal-view-job-app" onclick="new Job().view_job(' . $row['application_id'] . ')">
                                    <div class="child left">
                                        <span class="name-info">' . $row['firstName'] . " " . $row['lastName'] . '</span>
                                        <span class="job_type">' . strtoupper($row['post_title']) . '</span>
                                    </div>
                                    <div class="child right">
                                        <span class="status">
                                        ' . $row['jobstatus'] . '
                                        </span>
                                    </div>
                                </div>
                                ';
                        }
                        ?>
                        <!-- <div class="child left">
                                <span class="name-info">
                                    Arvin Candelaria Bok
                                </span>
                                <span class="job-type">
                                    Web Development
                                </span>
                            </div>
                            <div class="child right">
                                <span class="status">
                                    Pending
                                </span>
                            </div> -->

                    </div>


                    <div class="col-two col-all">
                        <?php
                        $query = $db->connect()->prepare(
                            "SELECT * FROM job_application
                                INNER JOIN jobposts ON job_application.post_id = jobposts.post_id
                                INNER JOIN account ON job_application.freelance_id = account.account_id
                                WHERE job_application.user_id = :account_id AND job_application.jobstatus = 'ONGOING' ORDER BY timestamp DESC"
                        );
                        $query->execute([
                            ':account_id' => $_SESSION['account_id']
                        ]);
                        foreach ($query as $row) {
                            echo '
                                <div class="parent" data-bs-toggle="modal" data-bs-target="#modal-view-job-app" onclick="new Job().view_job(' . $row['application_id'] . ')">
                                    <div class="child left">
                                        <span class="name-info">' . $row['firstName'] . " " . $row['lastName'] . '</span>
                                        <span class="job_type">' . strtoupper($row['post_title']) . '</span>
                                    </div>
                                    <div class="child right">
                                        <span class="status">
                                        ' . $row['jobstatus'] . '
                                        </span>
                                    </div>
                                </div>
                                ';
                        }
                        ?>
                    </div>

                    <div class="col-three col-all">
                        <div class="parent">
                            <div class="child left">
                                <span class="name-info">
                                    Ralpu Garcia
                                </span>
                                <span class="job-type">
                                    Web Hosting
                                </span>
                            </div>
                            <div class="child right">
                                <span class="status">
                                    Completed
                                </span>
                            </div>
                        </div>

                        <div class="parent">
                            <div class="child left">
                                <span class="name-info">
                                    John Daniel Edaddy
                                </span>
                                <span class="job-type">
                                    Video Editor
                                </span>
                            </div>
                            <div class="child right">
                                <span class="status">
                                    Completed
                                </span>
                            </div>
                        </div>

                        <div class="parent">
                            <div class="child left">
                                <span class="name-info">
                                    Boss Charles Pillos
                                </span>
                                <span class="job-type">
                                    Network Administrator
                                </span>
                            </div>
                            <div class="child right">
                                <span class="status">
                                    Completed
                                </span>
                            </div>
                        </div>

                        <div class="parent">
                            <div class="child left">
                                <span class="name-info">
                                    Boss Charles Pillos
                                </span>
                                <span class="job-type">
                                    Network Administrator
                                </span>
                            </div>
                            <div class="child right">
                                <span class="status">
                                    Completed
                                </span>
                            </div>
                        </div>

                        <div class="parent">
                            <div class="child left">
                                <span class="name-info">
                                    Boss Charles Pillos
                                </span>
                                <span class="job-type">
                                    Network Administrator
                                </span>
                            </div>
                            <div class="child right">
                                <span class="status">
                                    Completed
                                </span>
                            </div>
                        </div>

                        <div class="parent">
                            <div class="child left">
                                <span class="name-info">
                                    Boss Charles Pillos
                                </span>
                                <span class="job-type">
                                    Network Administrator
                                </span>
                            </div>
                            <div class="child right">
                                <span class="status">
                                    Completed
                                </span>
                            </div>
                        </div>

                        <div class="parent">
                            <div class="child left">
                                <span class="name-info">
                                    Boss Charles Pillos
                                </span>
                                <span class="job-type">
                                    Network Administrator
                                </span>
                            </div>
                            <div class="child right">
                                <span class="status">
                                    Completed
                                </span>
                            </div>
                        </div>

                        <div class="parent">
                            <div class="child left">
                                <span class="name-info">
                                    Boss Charles Pillos
                                </span>
                                <span class="job-type">
                                    Network Administrator
                                </span>
                            </div>
                            <div class="child right">
                                <span class="status">
                                    Completed
                                </span>
                            </div>
                        </div>

                        <div class="parent">
                            <div class="child left">
                                <span class="name-info">
                                    Boss Charles Pillos
                                </span>
                                <span class="job-type">
                                    Network Administrator
                                </span>
                            </div>
                            <div class="child right">
                                <span class="status">
                                    Completed
                                </span>
                            </div>
                        </div>

                        <div class="parent">
                            <div class="child left">
                                <span class="name-info">
                                    Boss Charles Pillos
                                </span>
                                <span class="job-type">
                                    Network Administrator
                                </span>
                            </div>
                            <div class="child right">
                                <span class="status">
                                    Completed
                                </span>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>

    </div>
    <script>
        window.onload = function () {
            var chatbox = document.getElementById('chatbox');
            chatbox.scrollTop = chatbox.scrollHeight;
        };
    </script>
</body>

<!-- MODAL FOR CHAT -->
<div class="modal" tabindex="-1" id="modal-chat">
    <!-- <div class="modal-dialog"> -->
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <img src="../img/profile.png" alt="" class="user-chat-img-header">
                <h5 class="modal-title">Arvin Candelaria Bok</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="user-chat">
                    <span>
                        Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic
                        or web designs. The passage is attributed to an unknown typesetter in the 15th century
                    </span>
                </div>
                <div class="freelance-chat">
                    <span>
                        Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic
                        or web designs. The passage is attributed to an unknown typesetter in the 15th century who is
                        thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type
                        specimen book. It usually begins wit
                    </span>
                </div>
                <div class="user-chat">
                    <span>
                        Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic
                        or web designs. The passage is attributed to an unknown typesetter in the 15th century who is
                        thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type
                        specimen book. It usually begins wit
                    </span>
                </div>
                <div class="freelance-chat">
                    <span>
                        Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic
                        or web designs.
                    </span>
                </div>
            </div>



            <div class="modal-footer chat">
                <!-- <input type="textarea"> -->
                <!-- <textarea id="myTextarea" name="comments" rows="4" cols="0"> -->
                <textarea rows="4" cols="40"></textarea>

                </textarea>

                <button type="button" class="btn btn-primary">Send</button>
            </div>
        </div>
    </div>
</div>




<!-- MODAL FOR ViEW JOB APPLICATION -->
<div class="modal fade" id="modal-view-job-app" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <!-- <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"> -->
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Job Application</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body apply">
                <form action="">

                    <div class="title mb-3">
                        <span class="label">Job Title:</span>
                        <span class="content" id="post_title">
                            Web Dev
                        </span>
                    </div>

                    <div class="title mb-3">
                        <span class="label">From:</span>
                        <!-- <span class="content">@</span> -->
                        <span class="content" id="from">
                            Arvin Candelaria Bok
                        </span>
                    </div>

                    <div class="title mb-3">
                        <span class="label">Status:</span>
                        <span class="content" id="jobstatus">
                            Pending
                        </span>
                    </div>

                    <div class="title mb-3">
                        <span class="label">Message:</span>
                        <p class="" id="from_message">
                            The Lorem ipum filling text is used by graphic designers, programmers and printers with the
                            aim
                            of occupying the spaces of a website, an advertising product or an editorial production
                            whose
                            final text is not yet ready.

                            This expedient serves to get an idea of the finished product that will soon be printed or
                            disseminated via digital channels.


                            In order to have a result that is more in keeping with the final result, the graphic
                            designers,
                            designers or typographers report the Lorem ipsum text in respect of two fundamental aspects,
                            namely readability and editorial requirements.

                            The choice of font and font size with which Lorem ipsum is reproduced answers to specific
                            needs
                            that go beyond the simple and simple filling of spaces dedicated to accepting real texts and
                            allowing to have hands an advertising/publishing product, both web and paper, true to
                            reality.

                            Its nonsense allows the eye to focus only on the graphic layout objectively evaluating the
                            stylistic choices of a project, so it is installed on many graphic programs on many software
                            platforms of personal publishing and content management system.
                        </p>
                    </div>

                    <!-- <div class="rate">
                        <span class="label">Rate:</span>
                        <span class="content" id="rate">
                            P 169,00.00
                        </span>
                    </div> -->

                    <div class="mb-3">
                        <!-- <label for="formFileSm" class="form-label label">Upload file</label>
                        <input class="form-control form-control-sm" id="formFileSm" type="file"> -->
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="btn_declineJob"
                            onclick="new Job().decline_job(this.value)">Decline</button>
                        <button type="button" class="btn btn-primary" id="btn_acceptJob"
                            onclick="new Job().accept_job(this.value)">Accept</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
    crossorigin="anonymous"></script>
<script src="../classJS/Job.js"></script>
<script src="../classJS/Message.js"></script>
<script src="../classJS/Account.js"></script>
<script src="../classJS/Notification.js"></script>

<script>

    $(document).ready(function () {
        $('.tab_container:first').show();
        $('.tab_navigation li:first').addClass('active');

        $('.tab_navigation li').click(function (event) {
            index = $(this).index();
            $('.tab_navigation li').removeClass('active');
            $(this).addClass('active');
            $('.tab_container').hide();
            $('.tab_container').eq(index).show();
        });

    });
</script>

</html>