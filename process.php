<!-- PROCESS PAGE VIA FORMS/POST ONLY, CHECK IF FUNCTION DO HIS JOB, NOT SURE ...... CHECK !!! -->
<?php

    $title = 'Processing - Stuliday';
    require 'includes/header.php';

    // DENIED ACCESS TO PROCESS.PHP METHOD POST, CHECK ...
    if ('POST' != $_SERVER['REQUEST_METHOD']) {
        echo "<div class='alert alert-danger'> The page you try to reach doesn't exists </div>";
    // ELSEIF HANDLE FORM & ADS CREATION ..
    } elseif (isset($_POST['advert_submit'])) {
        // CHECK BACK-END FILL FORM FROM PUBLISHER.PHP
        if (!empty($_POST['title']) && !empty($_POST['advert_content']) && !empty($_POST['advert_address']) && !empty($_POST['advert_price']) && !empty(['advert_author']) && !empty(['advert_category'])) {
            // DEFINE VARIABLE
            $title = strip_tags($_POST['advert_title']);
            $content = strip_tags($_POST['advert_content']);
            $price = intval(strip_tags($_POST['advert_price']));
            $address = strip_tags($_POST['advert_address']);
            $category = strip_tags($_POST['advert_category']);
            // ASSIGN VARIABLE USER_ID VIA TOKEN $_SESSION
            $author = $_SESSION['id'];
            // INIT FUNCTION ADD AD
            addAdverts($title, $content, $address, $price, $author, $category);
        }

        // ELSEIF FOR FORM EDITION ..
    } elseif (isset($_POST['advert_edit'])) {
        // VERIF BACK-END  FORM EDITION
        if (!empty($_POST['advert_title']) && !empty($_POST['advert_content']) && !empty($_POST['advert_price']) && !empty($_POST['advert_address']) && !empty(['advert_category'])) {
            // DEFINE VARIABLES
            $title = strip_tags($_POST['advert_title']);
            $content = strip_tags($_POST['advert_content']);
            $price = intval(strip_tags($_POST['advert_price']));
            $address = strip_tags($_POST['advert_address']);
            $category = strip_tags($_POST['advert_category']);
            // ASSIGN VARIABLE USER_ID VIA TOKEN $_SESSION
            $author = $_SESSION['id'];

            // EDIT AD FUNCTION
            editAds($name, $description, $price, $city, $category, $id, $user_id);
        }
    }

    require 'includes/footer.php';
