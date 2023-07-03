
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Link for Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Link for CSS -->
    <link rel="stylesheet" href="freelanceMessages.css">

    <!-- For social icons in the footer -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

        <style>
        .chatContainer {
            display: flex;
            justify-content: center;
            align-items: center;
            height: auto;
        }

        .chat-window {
            border: 1px solid #ccc;
            width: 400px;
            height: 500px;
            display: flex;
            flex-direction: column;
        }

        .chat-header {
            background-color: #f0f0f0;
            padding: 10px;
        }

        .chat-body {
            flex: 1;
            padding: 10px;
            overflow-y: scroll;
        }

        .message {
            margin-bottom: 10px;
        }

        .message-sender {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .message-content {
            padding: 5px;
            background-color: #f0f0f0;
        }

        .chat-footer {
            display: flex;
            align-items: center;
            padding: 10px;
            background-color: #f0f0f0;
        }

        .chat-footer input[type="text"] {
            flex: 1;
            padding: 5px;
        }

        .chat-footer button {
            margin-left: 10px;
            padding: 5px 10px;
        }
    </style>
 

    <title>eGawa | Freelance Messages</title>

</head>

<body>

    <nav class="navbar navbar-expand-md navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="img/eGAWAwhite.png" alt="Logo" id="logoImage"></a>
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
                        <a id="about1" id="about" class="nav-link" href="aboutUs.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a id="freeLanceInbox" class="nav-link" href="freeLanceInbox.php">Messages</a>
                    </li>
                    <li class="nav-item">
                        <a id="logout1" class="nav-link" href="#">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="containerFreelanceHome">


        <div class="div1"> </div>

        <div class="div2">
            
            <div class="chatContainer">
                <div class="chat-window">

                    <div class="chat-header">
                        <h2>Chat Title</h2>
                    </div>

                    <div class="chat-body" id="chatBody">

                        <div class="message">
                            <div class="message-sender">Sender</div>
                            <div class="message-content">Hello!</div>
                        </div>

                        <div class="message">
                            <div class="message-sender">Receiver</div>
                            <div class="message-content">Hi there!</div>
                        </div>
                    </div>

                    <div class="chat-footer">
                        <input type="text" placeholder="Type your message" id="messageInput">
                        <button id="sendButton">Send</button>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <div class="custom-shape-divider-bottom-1687514102">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path
                d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z"
                class="shape-fill"></path>
        </svg>
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


    <!--Modal for log out-->
    <div class="modal fade" id="modalLogOut" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Logging Out</h5>
                </div>
                <div class="modal-body" id="modalUser">Are you sure you want to log out?</div>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
    <script src="js/validate.js"></script>
    <script src="js/freelance.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const chatBody = document.getElementById('chatBody');
            const inputField = document.getElementById('messageInput');
            const sendButton = document.getElementById('sendButton');

            function sendMessage() {
                const message = inputField.value;
                if (message.trim() !== '') {
                    const messageContainer = document.createElement('div');
                    messageContainer.classList.add('message');
                    messageContainer.innerHTML = `
                        <div class="message-sender">Sender</div>
                        <div class="message-content">${message}</div>
                    `;
                    chatBody.appendChild(messageContainer);
                    inputField.value = '';

                    // Scroll to the bottom
                    chatBody.scrollTop = chatBody.scrollHeight;
                }
            }

            sendButton.addEventListener('click', sendMessage);

            inputField.addEventListener('keydown', function (event) {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    sendMessage();
                }
            });
        });
    </script>


</body>

</html>