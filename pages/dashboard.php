<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Hello I'm Admin DashBoard</h1>
    <form action="">
        <button type="submit" name="logout">Log out</button>
    </form>

</body>

</html>

<?php
session_start();
if (isset($_POST["logout"])) {

    session_destroy();
    header("Location:/../login.php");
    die();
}
?>