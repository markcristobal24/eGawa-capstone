<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- start -- links for fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- end --links for fonts -->

    <!-- For social icons in the footer -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        body{
            background-image: linear-gradient(to right, #0073aa, #8000aa);
            font-family: 'Inter', sans-serif;
        }

        .container{
            display: flex;
            margin: 100px auto;
            padding: 30px;
        }

        .toFlex{
            display: flex;
        }

        #myModal{
            display: none;
            background-color: white;
            width: 300px;
            margin: 50px auto;
        }

        p{
            color: white;
        }
        i{
            color: white;
            font-size: 13px;
            padding: 0 4px;
        }
        i:hover{
            color: #b616eb;
        }
        .socialIcons{
            margin-left: 5px;
        }

        #imgWork{
            height: 350px;
            margin: 0 auto;
        }

        .left{
            width: 50%;
            padding-left: 50px;
        }
        .title1{
            font-weight: 700;
            font-size: 200px;
            position: fixed;
            top: 0;
            margin-top: 60px;
            padding-left: 50px;
            color: rgba(255, 255, 255, 0.3); /* White with 50% opacity */
        }
        .title2{
            color: white;
            font-size: 40px;
            font-weight: 500;
            margin-top: 90px;
            padding-left: 20px;
            margin-bottom: 10px;
        }
        .aboutInfo{
            text-align: justify;
            margin-top: 0;
            font-weight: 300;
            font-size: 13px;
            line-height: 1.5;
        }

        .right{
            width: 50%;
            display: flex;
        }
        .imgContainer{
            margin: 0 auto;
        }

        .custom-shape-divider-bottom-1690684253 {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
            transform: rotate(180deg);
        }

        .custom-shape-divider-bottom-1690684253 svg {
            position: relative;
            display: block;
            width: calc(236% + 1.3px);
            height: 251px;
            transform: rotateY(180deg);
        }

        .custom-shape-divider-bottom-1690684253 .shape-fill {
            fill: #FFFFFF;
        }

        .btn {
        width: 140px;
        height: 50px;
        background-image: linear-gradient(to right, #0073aa, #8000aa);
        color: #fff;
        border-radius: 50px;
        border: none;
        outline: none;
        cursor: pointer;
        position: relative;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.5);
        overflow: hidden;
        }

        .btn span {
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: top 0.5s;
        }

        .btn-text-one {
        position: absolute;
        width: 100%;
        top: 50%;
        left: 0;
        transform: translateY(-50%);
        }

        .btn-text-two {
        position: absolute;
        width: 100%;
        top: 150%;
        left: 0;
        transform: translateY(-50%);
        }

        .btn:hover .btn-text-one {
        top: -100%;
        }

        .btn:hover .btn-text-two {
        top: 50%;
        }

        /* for egawa animation */
        .title1 {
        white-space: nowrap; /* Prevent the text from wrapping to the next line */
        overflow: hidden; /* Hide any text that overflows the container */
        animation: scrollLeftToRight .69s linear ; /* Adjust the animation duration as needed */
        }

        @keyframes scrollLeftToRight {
        from {
            transform: translateX(-100%); /* Start position, 100% to the right */
        }
        to {
            transform: translateX(1%); /* End position, 100% to the left */
        }
        }

        /* for image animation */
        .imgContainer {
        width: 350px; /* Adjust container size as needed */
        overflow: hidden; /* Hide any overflow from the image */
        }

        #imgWork{
        animation: zoomOutAnimation 1.1s ease; /* Adjust the animation duration as needed */
        }

        @keyframes zoomOutAnimation {
        from {
            transform: scale(1.5); /* Start with normal size (1) */
        }
        to {
            transform: scale(1); /* End with 80% size (0.8) */
        }
        }


            
        



    </style>
</head>
<body>
    <?php include "test.php" ?>

    <p class="title1">eGawa</p>
    <div class="container">
        <div class="left">
            <p class="title2">eGawa</p>
            <p class="aboutInfo"> Online Freelance Services Platform that aims to be a space for freelancers to
            connect,
            share and sell their crafts to the client. The freelancers are given wider customization and
            information for their products or services package which may vary according to the price,
            quality or difficulty of the work to lessen the hassle in communicating. </p>

            <span class="toFlex">
                <p class="aboutInfo">contact us here - 
                    <div class="containerFooter">
                        <div class="socialIcons">
                            <a href="https://www.facebook.com/"><i class="fa-brands fa-facebook"></i></a>
                            <a href="https://www.twitter.com/"><i class="fa-brands fa-twitter"></i></a>
                            <a href="https://www.gmail.com/"><i class="fa-brands fa-google"></i></a>
                            <a href="https://www.instagram.com/"><i class="fa-brands fa-instagram"></i></a>
                            <a href="https://www.whatsapp.com/"><i class="fa-brands fa-whatsapp"></i></a>
                        </div>
                    </div>
                </p>
            </span>

            <button class="btn">
            <span class="btn-text-one">Join Us</span>
            <span class="btn-text-two">Let's go!</span>
            </button>
            
        </div>

        <div class="right">
            <div class="imgContainer">
                <img id="imgWork" src="../img/work2.png" alt="">
            </div>
        </div>
    </div>

    <div class="custom-shape-divider-bottom-1690684253">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="shape-fill"></path>
            <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="shape-fill"></path>
            <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="shape-fill"></path>
        </svg>
    </div>
</div>

</div>
</div>
</body>
    <script>
    </script>
</html>