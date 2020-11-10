<!-- PROCESS PAGE VIA FORMS/POST ONLY, CHECK IF FUNCTION DO HIS JOB, NOT SURE ...... CHECK !!! -->
<?php

    require 'includes/header.php';

    // DENIED ACCESS TO PROCESS.PHP METHOD POST, CHECK ...
    if ('POST' != $_SERVER['REQUEST_METHOD']) {
        echo "<div class='alert alert-danger'> The page you try to reach doesn't exists </div>";
    }

    // ELSEIF HANDLE FORM & ADS CREATION ..
    if (isset($_POST['advert_submit'])) {
        // CHECK BACK-END FILL FORM FROM PUBLISHER.PHP
        if (!empty($_POST['advert_ad_name']) && !empty($_POST['advert_content']) && !empty($_POST['advert_address']) && !empty($_POST['advert_price']) && !empty($_FILES['advert_images']) && !empty($_POST['advert_category'])) {
            // DEFINE VARIABLE
            $name = strip_tags($_POST['advert_ad_name']);
            $content = strip_tags($_POST['advert_content']);
            $address = strip_tags($_POST['advert_address']);
            $price = intval(strip_tags($_POST['advert_price']));
            $img = $_FILES['advert_images'];
            // ASSIGN VARIABLE USER_ID VIA TOKEN $_SESSION
            $author = $_SESSION['id'];
            $category = strip_tags($_POST['advert_category']);
            // INIT FUNCTION ADD AD
            addAds($name, $content, $address, $price, $img, $author, $category);
        }

        // ELSEIF FOR FORM EDITION ..
    } elseif (isset($_POST['advert_edit'])) {
        // VERIF BACK-END  FORM EDITION
        if (!empty($_POST['advert_ad_name']) && !empty($_POST['advert_content']) && !empty($_POST['advert_address']) && !empty($_POST['advert_price']) && !empty($_FILES['advert_images']) && !empty($_POST['advert_category'])) {
            // DEFINE VARIABLES
            $name = strip_tags($_POST['advert_ad_name']);
            $content = strip_tags($_POST['advert_content']);
            $address = strip_tags($_POST['advert_address']);
            $price = intval(strip_tags($_POST['advert_price']));
            $img = $_FILES['advert_images'];
            $category = strip_tags($_POST['advert_category']);
            $id = strip_tags($_POST['advert_id']);
            // ASSIGN VARIABLE USER_ID VIA TOKEN $_SESSION
            $author = $_SESSION['id'];

            // EDIT AD FUNCTION
            editAds($name, $content, $address, $price, $img, $author, $category, $id);
        }
    } elseif (isset($_POST['advert_delete'])) {
        $ad = $_POST['advert_id'];
        $author = $_SESSION['id'];

        deleteAds($ad, $author);
    }
