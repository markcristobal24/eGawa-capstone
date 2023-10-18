<?php
//session_start();
require_once dirname(__FILE__) . "/../php/classes/Account.php";
// require_once dirname(__FILE__) . "/../php/classes/DbConnection.php";
require_once dirname(__FILE__) . "/../php/classes/DbClass.php";
// require_once dirname(__FILE__) . "/../php/classes/Image.php";

$db = new DbClass();

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
        // $upload_image = new Image();
        $generate_name = new Account();
        $image_filename = $generate_name->generate_imageName(6);
        // $data = $upload_image->upload_image($catalogImg, $image_filename, "egawa/freelancer/catalog/");
        // $image_link = "v" . $data['version'] . "/" . $data['public_id'];
        $image_directory = '../img/uploads/freelancer/catalog/' . $image_filename . basename($_FILES['catalogImg']['name']);
        $image_link = $image_filename . basename($_FILES['catalogImg']['name']);
        move_uploaded_file($catalogImg, $image_directory);


        $query = $db->connect()->prepare("SELECT * FROM account WHERE email = :email");
        $query->execute([':email' => $email]);

        if ($query->rowCount() > 0) {
            $query = $db->connect()->prepare("INSERT INTO catalog (account_id, email, catalogImage, catalogTitle, catalogDescription) VALUES (:account_id, :email, :catalogImage, :catalogTitle, :catalogDescription)");
            $result = $query->execute([':account_id' => $account_id, ':email' => $email, ':catalogImage' => $image_link, ':catalogTitle' => $catalogTitle, ':catalogDescription' => $catalogDesc]);

            if ($result) {
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

    $query = $db->connect()->prepare("SELECT * FROM catalog WHERE catalog_id = :catalog_id");
    $query->execute([':catalog_id' => $catalog_id]);
    if ($query->rowCount() > 0) {
        $result = "";
        if (isset($_FILES['catalogImg']['tmp_name'])) {
            $new_catalogImg = $_FILES['catalogImg']['tmp_name'];
            $image_link = $new_catalogImg;
            if (!empty($new_catalogImg)) {
                // $upload_image = new Image();
                $generate_name = new Account();
                $image_filename = $generate_name->generate_imageName(6);
                // $data = $upload_image->upload_image($new_catalogImg, $image_filename, "egawa/freelancer/catalog/");
                // $image_link = "v" . $data['version'] . "/" . $data['public_id'];
                $image_directory = '../img/uploads/freelancer/catalog/' . $image_filename . basename($_FILES['catalogImg']['name']);
                $image_link = $image_filename . basename($_FILES['catalogImg']['name']);
                move_uploaded_file($new_catalogImg, $image_directory);

                $query = $db->connect()->prepare("UPDATE catalog SET catalogImage = :catalogImage WHERE catalog_id = :catalog_id");
                $result = $query->execute([':catalogImage' => $image_link, ':catalog_id' => $catalog_id]);
            }
        }

        if (isset($_POST['catalogTitleEdit']) && $_POST['catalogTitleEdit'] !== "") {
            $new_catalogTitle = $_POST['catalogTitleEdit'];

            $query = $db->connect()->prepare("UPDATE catalog SET catalogTitle = :catalogTitle WHERE catalog_id = :catalog_id");
            $result = $query->execute([':catalogTitle' => $new_catalogTitle, ':catalog_id' => $catalog_id]);
        }

        if (isset($_POST['catalogEditDescription']) && $_POST['catalogEditDescription'] !== "") {
            $new_catalogDesc = $_POST['catalogEditDescription'];
            $new_catalogDesc = trim($new_catalogDesc);
            $new_catalogDesc = htmlspecialchars($new_catalogDesc);

            $query = $db->connect()->prepare("UPDATE catalog SET catalogDescription = :catalogDescription WHERE catalog_id = :catalog_id");
            $result = $query->execute([':catalogDescription' => $new_catalogDesc, ':catalog_id' => $catalog_id]);
        }
        if ($result) {
            $output['success'] = "Catalog Updated Successfully";
        } else if ($result === "") {
            $output['error'] = "Please provide the details you want to edit.";
        }
    }
    echo json_encode($output);
}

if (isset($_POST['view_catalog'])) {
    $catalog_id = $_POST['id'];

    $query = $db->connect()->prepare("SELECT * FROM catalog WHERE catalog_id = :id");
    $query->execute([':id' => $catalog_id]);
    $data = array();
    foreach ($query as $row) {
        $data['catalog_id'] = $row['catalog_id'];
        $data['catalogImage'] = $row['catalogImage'];
        $data['catalogTitle'] = $row['catalogTitle'];
        $data['catalogDescription'] = $row['catalogDescription'];
    }
    echo json_encode($data);
}
?>