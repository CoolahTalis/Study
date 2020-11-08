<?php

require 'includes/config.php';
// REGISTER FUNCTION DISPLAYED IN SIGNIN.PHP ..
function signUp($email_su, $pass_su, $repass_su, $fullname)
{
    global $conn;

    try {
        $sql1 = "SELECT * FROM users WHERE email = '{$email_su}'";
        $sql2 = "SELECT * FROM users WHERE fullname = '{$fullname}'";
        $res1 = $conn->query($sql1);
        $count_email_su = $res1->fetchColumn();
        // FETCHCOLUMN TO GET NUMBER OF LINES ..
        if (!$count_email_su) {
            $res2 = $conn->query($sql2);
            $count_user = $res2->fetchColumn();
            if (!$count_user) {
                if ($pass_su === $repass_su) {
                    $pass_su = password_hash($pass_su, PASSWORD_DEFAULT);
                    // :EMAIL ... TO SPECIFY VALUES FROM DB TO BE BIND .. NOT SURE .....
                    // $STH-> STATEMENT HANDLER, PREPARE QUERY OF INFOS ... NOT SURE ...
                    $sth = $conn->prepare('INSERT INTO users (email, password, fullname) VALUES(:email, :password, :fullname)');
                    $sth->bindValue(':email', $email_su);
                    $sth->bindValue(':password', $pass_su);
                    $sth->bindValue(':fullname', $fullname);
                    $sth->execute();
                    echo '<div class="alert alert-success mt-2" role="alert"> User Successfuly registered ! </div>';
                    unset($_POST);
                } else {
                    echo '<div class="notification is-danger is-light";
                    <button class="delete"></button>
                    Passwords do not match, try again !
                    </div>';
                }
            } elseif ($count_user > 0) {
                echo '<div class="notification is-danger is-light";
                <button class="delete"></button>
                This username already exists !
                </div>';
                unset($_POST);
            }
        } elseif ($count_email_su > 0) {
            echo '<div class="notification is-danger is-light";
                <button class="delete"></button>
                This email address already exists !
                </div>';
            unset($_POST);
        }
    } catch (PDOException $e) {
        echo 'Error'.$e->getMessage();
    }
}

function connexion($email_login, $pass_login)
{
    global $conn;

    try {
        $sql = "SELECT * FROM users WHERE email = '{$email_login}'";
        $res = $conn->query($sql);
        // FETCH ALL DATAS FROM USER ..
        $user = $res->fetch(PDO::FETCH_ASSOC);
        // IF USER EXISTS CHECK PWD ..
        if ($user) {
            $db_pass = $user['password'];
            if (password_verify($pass_login, $db_pass)) {
                $_SESSION['email'] = $user['email'];
                $_SESSION['id'] = $user['id'];
                $_SESSION['fullname'] = $user['fullname'];
                echo '<div class="alert alert-success mt-2" role="alert" > You\'re Logged In! </div>';
                header('Location: index.php');
            } else {
                echo '<div class="notification is-danger is-light";
                <button class="delete"></button> Wrong password ! </div>';
            }
        } else {
            echo '<div class="notification is-danger is-light";
            <button class="delete"></button> This account doesn\'t exist ! </div>';
        }
    } catch (PDOException $e) {
        echo 'Error'.$e->getMessage();
    }
}

// DISPLAY ADS FUNCTION ..
function displayAds()
{
    global $conn;

    $sth = $conn->prepare('SELECT a.*,c.categories_name,u.fullname FROM adverts AS a LEFT JOIN categories AS c ON a.category_id = c.categories_id LEFT JOIN users AS u ON a.author_id = u.id');
    $sth->execute();

    $adverts = $sth->fetchAll(PDO::FETCH_ASSOC);
    foreach ($adverts as $advert) {
        ?>
<!-- DOTN FORGET TO ADD CONTENT AND IMG FIELD  AND DESIGN ADS CARD LIKE CURRENTUSER'S !!! -->
<div class='card column is-3 mx-4 mt-4 has-background-grey'>
    <div class=" has-background-primary">
        <h2 class="card-title mx-2 mt-2 has-text-centered" style="font-weight:900"> <?php echo $advert['ad_name']; ?>
        </h2>
    </div>
    <!-- DONT FORGET IMG, INCOMING IN DATABASE!!! -->
    <div class='card-image'>
        <figure class='image is-4by3'>
            <img alt=''
                src='<?php echo $advert['images']; ?>'>
        </figure>
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item"><span style="font-weight:700">Category : </span> <?php echo $advert['categories_name']; ?>
        </li>
        <li class="list-group-item"><span style="font-weight:700">Description : </span> <?php echo $advert['content']; ?>
        </li>
        <li class="list-group-item"><span style="font-weight:700">Price : </span> <?php echo $advert['price']; ?>
            €</li>
        <li class="list-group-item"><span style="font-weight:700">Localization : </span> <?php echo $advert['address']; ?>
        </li>
    </ul>
    <!-- CUSTOMER BTN MODE  -->
    <footer class='card-footer'>
        <a href="ad.php?id=<?php echo $advert['ad_id']; ?>"
            class="card-link tag is-dark subtitle mt-3" style="font-size: 1.1rem">Check this ad</a>

        <a href="profil.php" class="card-link tag is-dark subtitle mt-3" style="font-size: 1.1rem">Contact</a>
    </footer>
</div>

<?php
    }
}

// ADD ADVERTS FUNCTION ..  AFTER BETTER UNDERSTANDING INSERT IMG .......
function addAds($name, $content, $address, $price, $img, $author, $category)
{
    global $conn;
    // CHECK PRICE (MUST BE INT & BELOW 1m €/$) ..
    if (is_int($price) && $price > 0 && $price < 1000000) {
        // USE OF TRY/CATCH TO CAPTURE SQL/PDO ERRORS ..
        try {
            // CREATE QUERY W/ ALL FORMS FIELDS SPECIFIED .. NOT SURE ........
            $sth = $conn->prepare('INSERT INTO adverts (ad_name, content, address, price, images, author_id, category_id) VALUES (:ad_name, :content, :address, :price, :images, :author_id,:category_id)');
            $sth->bindValue(':ad_name', $name, PDO::PARAM_STR);
            $sth->bindValue(':content', $content, PDO::PARAM_STR);
            $sth->bindValue(':address', $address, PDO::PARAM_STR);
            $sth->bindValue(':price', $price, PDO::PARAM_INT);
            $sth->bindValue(':images', $img, PDO::PARAM_STR);
            $sth->bindValue(':author_id', $author, PDO::PARAM_INT);
            $sth->bindValue(':category_id', $category, PDO::PARAM_INT);

            // DISPLAY MSG IF SUCCESS ..
            if ($sth->execute()) {
                // FIND BETTER SPEECH !!!
                echo "<div class='alert alert-success'> You have Succesfully Published your Ad ! </div>";
                // REDIRECT TO LAST AD ADDED W/ LASTINSERTID WHICH IS PDO FONCTION
                header('Location: ad.php?id='.$conn->lastInsertId());
            }
        } catch (PDOException $e) {
            echo 'Error: '.$e->getMessage();
        }
    }
}

// EDIT AD FUNCTION ..
function editAds($name, $content, $address, $price, $author, $category, $id)
{
    global $conn;
    // CHECK PRICE (MUST BE INT & BELOW 1m €/$) ..
    if (is_int($price) && $price > 0 && $price < 1000000) {
        // USE OF TRY/CATCH TO CAPTURE SQL/PDO ERRORS ..
        try {
            // CREATE QUERY W/ ALL FORMS FIELDS SPECIFIED .. NOT SURE ........
            $sth = $conn->prepare('UPDATE adverts SET ad_name = :ad_name, content = :content, address = :address , price = :price, category_id=:category_id WHERE author_id = :author_id AND ad_id = :ad_id');
            $sth->bindValue(':ad_name', $name);
            $sth->bindValue(':content', $content);
            $sth->bindValue(':price', $price, );
            $sth->bindValue(':address', $address);
            $sth->bindValue(':author_id', $author);
            $sth->bindValue(':category_id', $category);
            $sth->bindValue(':ad_id', $id);

            // DISPLAY MSG IF SUCCESS ..
            if ($sth->execute()) {
                // FIND BETTER SPEECH !!!
                echo "<div class='alert alert-success'> You have successfully Edited your Ad ! </div>";
                header("Location: ad.php?id={$id}");
            }
        } catch (PDOException $e) {
            echo 'Error: '.$e->getMessage();
        }
    }
}

function displayAd($id)
{
    global $conn;

    $sth = $conn->prepare("SELECT a.*,c.categories_name,u.fullname FROM adverts AS a LEFT JOIN categories AS c ON a.category_id = c.categories_id LEFT JOIN users AS u ON a.author_id = u.id WHERE a.ad_id = {$id}");
    $sth->execute();

    $advert = $sth->fetch(PDO::FETCH_ASSOC); ?>

<div class='card mx-5 mt-5'>
    <div class=" has-background-primary">
        <h2 class="card-title mx-2 mt-2 has-text-centered" style="font-weight:900"> <?php echo $advert['ad_name']; ?>
        </h2>
    </div>
    <!-- DONT FORGET IMG, INCOMING IN DATABASE!!! -->
    <div class='card-image'>
        <figure class='image is-4by3'>
            <img alt=''
                src='<?php echo $advert['images']; ?>'>
        </figure>
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item"><?php echo $advert['content']; ?>
        </li>

        <li class="list-group-item"><?php echo $advert['price']; ?>
            €</li>
        <li class="list-group-item"><?php echo $advert['address']; ?>
        </li>
    </ul>
    <!-- CUSTOMER BTN MODE  -->
    <footer class='card-footer'>
        <a href="profil.php" class='card-footer-item'>Contact</a>
    </footer>
</div>

<?php
}

function displayAdsByUser($author_id)
{
    global $conn;

    $sth = $conn->prepare("SELECT a.*,c.categories_name FROM adverts AS a LEFT JOIN categories AS c ON a.category_id = c.categories_id WHERE a.author_id = {$author_id}");
    $sth->execute();

    $adverts = $sth->fetchAll(PDO::FETCH_ASSOC);
    foreach ($adverts as $advert) {
        ?>

<div class="card mx-5 mt-5">
    <div class=" has-background-primary">
        <h2 class="card-title mx-2 mt-2 has-text-centered" style="font-weight:900"> <?php echo $advert['ad_name']; ?>
        </h2>
    </div>
    <!-- DONT FORGET IMG, INCOMING IN DATABASE!!! -->
    <div class='card-image'>
        <figure class='image is-4by3'>
            <img alt=''
                src='<?php echo $advert['images']; ?>'>
        </figure>
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item"><span style="font-weight:700">Category : </span> <?php echo $advert['categories_name']; ?>
        </li>
        <li class="list-group-item"><span style="font-weight:700">Description : </span> <?php echo $advert['content']; ?>
        </li>
        <li class="list-group-item"><span style="font-weight:700">Price : </span> <?php echo $advert['price']; ?>
            €</li>
        <li class="list-group-item"><span style="font-weight:700">Localization : </span> <?php echo $advert['address']; ?>
        </li>
    </ul>
    <!-- CURRENTUSER BTN MODE W/ CSS TEST, PUT IT IN SCSS LATER !!! -->
    <footer class="card-footer has-background-primary">
        <a href="ad.php?id=<?php echo $advert['ad_id']; ?>"
            class="card-link tag is-dark subtitle mt-3" style="font-size: 1.1rem">Check this ad</a>
        <a href="editAds.php?id=" class="card-link tag is-dark subtitle mt-3" style="font-size: 1.1rem">Edit this
            ad</a>
        <form action="process.php" method="post" class="mx-5 mt-3">
            <input type="submit" name="advert_delete" class="fa btn btn-outline-danger" value="&#xf2ed;"></input>
        </form>
    </footer>
</div>

<?php
    }
}

// REMOVE ADS FUNCTION ..
function deleteAds($ad, $author)
{
    global $conn;

    try {
        $sth = $conn->prepare('DELETE FROM adverts WHERE ad_id = :ad_id AND author_id =:author_id');
        $sth->bindValue(':ad_id', $ad);
        $sth->bindValue(':author_id', $author);
        if ($sth->execute()) {
            header('Location: profil.php?s');
        }
    } catch (PDOException $e) {
        echo 'Error: '.$e->getMessage();
    }
}
// function uploadImg()
// {
//     global $conn;

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
    //         echo '<div class="alert alert-success mt-2" role="alert" > Upload Image Fail, please check the exntesion / size !</div>';
    //     }
    // }

    // $target_dir = 'imgupload/';
    // $target_file = $target_dir.basename($_FILES['images']);
    // $extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // // CHECK IMG INTEGRITY
    // if (isset($_POST['submit'])) {
    //     echo 'Upload Success'.$check['mime'].'.';
    // } else {
    //     echo 'Upload Fail.';
    // }
// }
