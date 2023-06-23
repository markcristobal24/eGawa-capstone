<?php
session_start();
require_once dirname(__FILE__) . "/../php/classes/DbConnection.php";

if (isset($_POST["btnNewPassword"])) {
    $psw = $_POST["password"];

    $token = $_SESSION['token'];
    $Email = $_SESSION['email'];

    $sql = mysqli_query($con, "SELECT * FROM account WHERE email='$Email'");
    $query = mysqli_num_rows($sql);
    $fetch = mysqli_fetch_assoc($sql);

    if ($Email) {
        mysqli_query($con, "UPDATE account SET password='$psw' WHERE email='$Email'");
        ?>
<script>
window.location.replace("../login.php");
alert("Your password has been successfully reset");
</script>
<?php
    } else {
        ?>
<script>
alert("Please try again");
</script>
<?php
    }
}
?>