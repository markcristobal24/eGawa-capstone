<?php
//session_start();
require_once dirname(__FILE__) . "/../php/classes/Account.php";
require_once dirname(__FILE__) . "/../php/classes/DbConnection.php";
require_once dirname(__FILE__) . "/../php/classes/Image.php";

if (isset($_POST['add_catalog'])) {
    $email = $_SESSION['email'];
    $account_id = $_SESSION['account_id'];
    $catalogImg = $_FILES['catalogImg']['tmp_name'];

    $image_link = $catalogImg;
    $catalogTitle = $_POST['catalogTitle'];
    $catalogDesc = $_POST['catalogDesc'];
    $catalogDesc = trim($catalogDesc);
    $catalogDesc = htmlspecialchars($catalogDesc);

    if ($catalogImg === "") {
        $output['error'] = "Please provide an image for your catalog!";
    } else if ($catalogTitle === "") {
        $output['error'] = "Please provide a title for your catalog!";
    } else if ($catalogDesc === "") {
        $output['error'] = "Please provide a description for your catalog!";
    } else if ($catalogImg === null && $catalogTitle === null && $catalogDesc === null) {
        $output['error'] = "Incomplete Details!";
    } else {
        $upload_image = new Image();
        $generate_name = new Account();
        $image_filename = $generate_name->generate_imageName(6);
        $data = $upload_image->upload_image($catalogImg, $image_filename, "egawa/freelancer/catalog/");
        $image_link = "v" . $data['version'] . "/" . $data['public_id'];

        $sql = mysqli_query($con, "SELECT * FROM account WHERE email = '$email' ");
        $check_rows = mysqli_num_rows($sql);

        if ($check_rows > 0) {
            $stmt = $con->prepare("INSERT INTO catalog (account_id, email, catalogImage, catalogTitle, catalogDescription) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $account_id, $email, $image_link, $catalogTitle, $catalogDesc);
            $stmt->execute();

            if ($stmt) {
                $output['success'] = "Catalog Added Successfully.";
            } else {
                $output['error'] = "Something went wrong. Please try again later.";
            }
        }
    }
    echo json_encode($output);
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
}

if (isset($_POST['edit_catalog'])) {
    $catalog_id = $_POST['catalog_id'];
    $stmt = null;
    $sql = mysqli_query($con, "SELECT * FROM catalog WHERE catalog_id = '$catalog_id'");
    if ($sql->num_rows > 0) {
        if (isset($_FILES['catalogImg']['tmp_name'])) {
            $new_catalogImg = $_FILES['catalogImg']['tmp_name'];
            $image_link = $new_catalogImg;
            if (!empty($new_catalogImg)) {
                $upload_image = new Image();
                $generate_name = new Account();
                $image_filename = $generate_name->generate_imageName(6);
                $data = $upload_image->upload_image($new_catalogImg, $image_filename, "egawa/freelancer/catalog/");
                $image_link = "v" . $data['version'] . "/" . $data['public_id'];

                $stmt = $con->prepare("UPDATE catalog SET catalogImage = ? WHERE catalog_id = ?");
                $stmt->bind_param("ss", $image_link, $catalog_id);
                $stmt->execute();
            }
        }

        if (isset($_POST['catalogTitleEdit']) && $_POST['catalogTitleEdit'] !== "") {
            $new_catalogTitle = $_POST['catalogTitleEdit'];

            $stmt = $con->prepare("UPDATE catalog SET catalogTitle = ? WHERE catalog_id = ?");
            $stmt->bind_param("ss", $new_catalogTitle, $catalog_id);
            $stmt->execute();
        }

        if (isset($_POST['catalogEditDescription']) && $_POST['catalogEditDescription'] !== "") {
            $new_catalogDesc = $_POST['catalogEditDescription'];
            $new_catalogDesc = trim($new_catalogDesc);
            $new_catalogDesc = htmlspecialchars($new_catalogDesc);

            $stmt = $con->prepare("UPDATE catalog SET catalogDescription = ? WHERE catalog_id = ?");
            $stmt->bind_param("ss", $new_catalogDesc, $catalog_id);
            $stmt->execute();
        }
        if ($stmt) {
            $output['success'] = "Catalog Updated Successfully";
        } else {
            $output['error'] = "Please provide the details you want to edit.";
        }
    }
    echo json_encode($output);
}
?>