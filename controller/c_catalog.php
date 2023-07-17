<?php
//session_start();
require_once dirname(__FILE__) . "/../php/classes/Account.php";
require_once dirname(__FILE__) . "/../php/classes/DbConnection.php";
require_once dirname(__FILE__) . "/../php/classes/Image.php";

if (isset($_POST['btnAddCatalog'])) {
    $email = $_SESSION['email'];
    $account_id = $_SESSION['account_id'];
    $catalogImg = $_FILES['catalogImg']['tmp_name'];

    $image_link = $catalogImg;

    $upload_image = new Image();
    $generate_name = new Account();
    $image_filename = $generate_name->generate_imageName(6);
    $data = $upload_image->upload_image($catalogImg, $image_filename, "egawa/freelancer/catalog/");
    $image_link = "v" . $data['version'] . "/" . $data['public_id'];


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

if (isset($_POST['delete_catalog'])) {
    $catalog_id = $_POST['catalog_id'];
    $catalog = new Account();
    $catalog->delete_catalog($catalog_id);
}

if (isset($_POST['sessionValue'])) {
    $_SESSION['catalogId'] = $_POST['sessionValue'];

    $response = 'Success';
    echo json_encode($response);
} else {
    // echo "Error";
}

if (isset($_POST['edit_catalog'])) {
    $catalog_id = $_POST['catalog_id'];

    $new_catalogImg = $_FILES['catalogImg']['tmp_name'];
    $image_link = $new_catalogImg;
    $upload_image = new Image();
    $generate_name = new Account();
    $image_filename = $generate_name->generate_imageName(6);
    $data = $upload_image->upload_image($new_catalogImg, $image_filename, "egawa/freelancer/catalog/");
    $image_link = "v" . $data['version'] . "/" . $data['public_id'];

    $new_catalogTitle = $_POST['catalogTitleEdit'];

    $new_catalogDesc = $_POST['catalogEditDescription'];
    $new_catalogDesc = trim($new_catalogDesc);
    $new_catalogDesc = htmlspecialchars($new_catalogDesc);

    $sql = mysqli_query($con, "SELECT * FROM catalog WHERE catalog_id = '$catalog_id'");
    if ($sql->num_rows > 0) {
        $result = $con->prepare("UPDATE catalog SET catalogImage = ?, catalogTitle = ?, catalogDescription = ? WHERE catalog_id = ?");
        $result->bind_param("ssss", $image_link, $new_catalogTitle, $new_catalogDesc, $catalog_id);
        $result->execute();
        if ($result) {
            $response = array('success' => true, 'message' => 'Catalog updated successfully.');

        } else {
            $response = array('success' => false, 'message' => 'Error updating catalog.');

        }

        echo json_encode($response);
    }
}
?>