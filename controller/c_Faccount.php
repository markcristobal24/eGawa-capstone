<?php
session_start();
require_once dirname(__FILE__) . "/../php/classes/DbConnection.php";
require_once dirname(__FILE__) . "/../php/classes/Email.php";

if (isset($_POST['btnFchangeEmail'])) {
    $email_identifier = $_SESSION['email'];

    $old_email = $_POST['currentEmail'];
    $new_email = $_POST['newEmail'];

    $sql = mysqli_query($con, "SELECT * FROM account WHERE email = '$email_identifier'");

    if ($sql->num_rows > 0) {
        $stmt = $con->prepare("UPDATE account SET email = ? WHERE email = ?");
        $stmt->bind_param("ss", $new_email, $old_email);
        $stmt->execute();

        if ($stmt) {
            $stmt1 = $con->prepare("UPDATE profile SET email = ? WHERE email = ?");
            $stmt1->bind_param("ss", $new_email, $old_email);
            $stmt1->execute();

            if ($stmt1) {
                $stmt2 = $con->prepare("UPDATE catalog SET email = ? WHERE email = ?");
                $stmt2->bind_param("ss", $new_email, $old_email);
                $stmt2->execute();

                if ($stmt2) {
                    $_SESSION['email'] = $new_email;
                    ?>
                    <script>
                        window.location.replace('../freelanceHomePage.php');
                        alert('Email address updated successfully');
                    </script>
                    <?php
                }
            }
        }
    } else if ($sql->num_rows < 0) {
        ?>
            <script>
                alert('Email address does not match!');
                window.location.replace('../freelanceChangeEmail.php');
            </script>
<?php
    }
}

if (isset($_POST['btnFchangePass'])) {
    $email_identifier = $_SESSION['email'];

    $old_pass = $_POST['currentPass'];
    $new_pass = $_POST['newPass'];
    $reNew_pass = $_POST['newPass2'];

    $sql = mysqli_query($con, "SELECT * FROM account WHERE email = '$email_identifier'");
    if ($sql->num_rows > 0) {
        if ($new_pass !== $reNew_pass) {
            ?>
    <script>
        alert('Password was not matched!');
        window.location.replace('../freelanceChangePass.php');
    </script>
    <?php
        } else {
            $row = $sql->fetch_assoc();
            if ($old_pass !== $row['password']) {
                ?>
            <script>
                alert('Incorrect password! Please try again.');
                window.location.replace('../freelanceChangePass.php');
            </script>
            <?php
            } else {
                $stmt = $con->prepare("UPDATE account SET password = ? WHERE email = ?");
                $stmt->bind_param("ss", $new_pass, $email_identifier);
                $stmt->execute();

                if ($stmt) {
                    ?>
                    <script>
                        window.location.replace('../freelanceHomePage.php');
                        alert('Password has been changed.');
                    </script>
                    <?php
                }
            }
        }
    }
}
?>