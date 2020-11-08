<!-- PROCESS PAGE VIA FORMS/POST ONLY, CHECK IF FUNCTION DO HIS JOB, NOT SURE ...... CHECK !!! -->
<?php

    require 'includes/header.php';

    // DENIED ACCESS TO PROCESS.PHP METHOD POST, CHECK ...
    if ('POST' != $_SERVER['REQUEST_METHOD']) {
        echo "<div class='alert alert-danger'> The page you try to reach doesn't exists </div>";
    }
    // HANDLE IMG UPLOAD .. DONT FORGET TO ADD SIZE LIMIT, EXTENSION ETC.. !!!
    // if (!empty($_FILES['advert_images']['size'] <= 10000000)) {
    //     $uploadImg = pathinfo($_FILES['advert_images']);
    //     $extensionImg = $uploadImg['extension'];
    //     $extensionAllowed = ['jpg', 'jpeg', 'png'];

    //     if (in_array($extensionImg, $extensionAllowed)) {
    //         uploadImg($_FILES['advert_images']);
    //         echo '<div class="alert alert-success mt-2" role="alert" > You have Succesfully Upload your Image !</div>';
    //     } else {
    //         // TEMP SPEECH FIND BETTER !!!
    //         echo '<div class="alert alert-success mt-2" role="alert" > Upload Image Fail, please check the extension / size !</div>';
    //     }
    // }

//     $target_dir = 'imgupload/';
//     $target_file = $target_dir.basename($_FILES['images']);
//     $extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
//     // CHECK IMG INTEGRITY
//     if (isset($_POST['submit'])) {
//         echo 'Upload Success'.$check['mime'].'.';
//     } else {
//         echo 'Upload Fail.';
//     }
// }

    // ELSEIF HANDLE FORM & ADS CREATION ..
    if (isset($_POST['advert_submit'])) {
        // CHECK BACK-END FILL FORM FROM PUBLISHER.PHP
        if (!empty($_POST['advert_ad_name']) && !empty($_POST['advert_content']) && !empty($_POST['advert_address']) && !empty($_POST['advert_price']) && !empty($_POST['advert_images']) && !empty(['advert_category'])) {
            // DEFINE VARIABLE
            $name = strip_tags($_POST['advert_ad_name']);
            $content = strip_tags($_POST['advert_content']);
            $address = strip_tags($_POST['advert_address']);
            $price = intval(strip_tags($_POST['advert_price']));
            $img = strip_tags($_POST['advert_images']);
            // ASSIGN VARIABLE USER_ID VIA TOKEN $_SESSION
            $author = $_SESSION['id'];
            $category = strip_tags($_POST['advert_category']);
            // INIT FUNCTION ADD AD
            addAds($name, $content, $address, $price, $img, $author, $category);
        }

        // ELSEIF FOR FORM EDITION ..
    } elseif (isset($_POST['advert_edit'])) {
        // VERIF BACK-END  FORM EDITION
        if (!empty($_POST['advert_ad_name']) && !empty($_POST['advert_content']) && !empty($_POST['advert_address']) && !empty($_POST['advert_price']) && !empty($_POST['advert_images']) && !empty(['advert_category'])) {
            // DEFINE VARIABLES
            $name = strip_tags($_POST['advert_ad_name']);
            $content = strip_tags($_POST['advert_content']);
            $address = strip_tags($_POST['advert_address']);
            $price = intval(strip_tags($_POST['advert_price']));
            $img = strip_tags($_POST['advert_images']);
            $category = strip_tags($_POST['advert_category']);
            $id = strip_tags($_POST['advert_id']);
            // ASSIGN VARIABLE USER_ID VIA TOKEN $_SESSION
            $author = $_SESSION['id'];

            // EDIT AD FUNCTION
            editAds($name, $content, $address, $price, $img, $id, $category, $author);
        }
    } elseif (isset($_POST['advert_delete'])) {
        $ad = $_POST['advert_id'];
        $author = $_SESSION['id'];

        deleteAds($ad, $author);
    }

    // require 'includes/footer.php';
