<?php
session_start();
require_once dirname(__FILE__) . "/../php/classes/DbConnection.php";
require_once dirname(__FILE__) . "/../php/classes/Image.php";

if (isset($_POST['btnAddCatalog'])) {
    $email = $_SESSION['email'];
    $account_id = $_SESSION['account_id'];
    $catalogImg = $_FILES['catalogImg']['tmp_name'];

    $image_link = $catalogImg;
    if ($catalogImg != $_SESSION['current_imgCatalog']) {
        $upload_image = new Image();
        $data = $upload_image->upload_image($catalogImg, $email, "egawa/freelancer/catalog/");
        $image_link = "v" . $data['version'] . "/" . $data['public_id'];
    }

    $catalogTitle = $_POST['catalogTitle'];
    $catalogDesc = $_POST['catalogDesc'];
    $catalogDesc = trim($catalogDesc);
    $catalogDesc = htmlspecialchars($catalogDesc);



    $sql = mysqli_query($con, "SELECT * FROM account WHERE email = '$email' ");
    $check_rows = mysqli_num_rows($sql);

    if ($check_rows > 0) {
        $stmt = $con->prepare("INSERT INTO catalog (account_id, email, catalogImage, catalogTitle, catalogDescription) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $account_id, $email, $image_link, $catalogTitle, $catalogDesc);
        $stmt->execute();

        ?>
        <script>
            window.location.replace('../freelanceHomePage.php');
        </script>
        <?php
    }
}
?>