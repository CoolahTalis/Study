<!-- PROCESS PAGE VIA FORMS/POST ONLY, CHECK IF FUNCTION DO HIS JOB, NOT SURE ...... CHECK !!! -->
<?php

    require 'includes/header.php';

    // DENIED ACCESS TO PROCESS.PHP METHOD POST, CHECK ...
    if ('POST' != $_SERVER['REQUEST_METHOD']) {
        echo "<div class='alert alert-danger'> The page you try to reach doesn't exists </div>";
    // ELSEIF HANDLE FORM & ADS CREATION ..
    } elseif (isset($_POST['advert_submit'])) {
        // CHECK BACK-END FILL FORM FROM PUBLISHER.PHP
        if (!empty($_POST['ad_name']) && !empty($_POST['advert_content']) && !empty($_POST['advert_address']) && !empty($_POST['advert_price']) && !empty(['advert_category'])) {
            // DEFINE VARIABLE
            $ad_name = strip_tags($_POST['advert_ad_name']);
            $content = strip_tags($_POST['advert_content']);
            $address = strip_tags($_POST['advert_address']);
            $price = intval(strip_tags($_POST['advert_price']));
            $category = strip_tags($_POST['advert_category']);
            // ASSIGN VARIABLE USER_ID VIA TOKEN $_SESSION
            $author_id = $_SESSION['id'];
            // INIT FUNCTION ADD AD
            addAdverts($ad_name, $content, $address, $price, $category, $author_id);
        }

        // ELSEIF FOR FORM EDITION ..
    } elseif (isset($_POST['advert_edit'])) {
        // VERIF BACK-END  FORM EDITION
        if (!empty($_POST['ad_name']) && !empty($_POST['advert_content']) && !empty($_POST['advert_address']) && !empty($_POST['advert_price']) && !empty(['advert_category'])) {
            // DEFINE VARIABLES
            $ad_name = strip_tags($_POST['advert_ad_name']);
            $content = strip_tags($_POST['advert_content']);
            $address = strip_tags($_POST['advert_address']);
            $price = intval(strip_tags($_POST['advert_price']));
            $category = strip_tags($_POST['advert_category']);
            // ASSIGN VARIABLE USER_ID VIA TOKEN $_SESSION
            $id = strip_tags($_POST['advert_id']);
            $author_id = $_SESSION['id'];

            // EDIT AD FUNCTION
            editAds($ad_name, $description, $price, $city, $category, $id, $author_id);
        }
    }

    // require 'includes/footer.php';
