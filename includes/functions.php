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

    $sth = $conn->prepare('SELECT a.*,c.categories_name,u.fullname FROM adverts AS a LEFT JOIN categories AS c ON a.category_id = c.categories_id LEFT JOIN users AS u ON a.author = u.id');
    $sth->execute();

    $adverts = $sth->fetchAll(PDO::FETCH_ASSOC);
    foreach ($adverts as $advert) {
        ?>
<tr>
    <th scope="row"><?php echo $advert['adverts_id']; ?>
    </th>
    <td><?php echo $advert['adverts_name']; ?>
    </td>
    <td><?php echo $advert['description']; ?>
    </td>
    <td><?php echo $advert['city']; ?>
    </td>
    <td><?php echo $advert['price']; ?> €
    </td>
    <td><?php echo $advert['categories_name']; ?>
    </td>
    <td><?php echo $advert['fullname']; ?>
    </td>
    <td> <a
            href="ads.php?id=<?php echo $advert['adverts_id']; ?>">Dislpay
            Places to Stay</a>
    </td>
</tr>
<?php
    }
}

// ADD ADVERTS FUNCTION ..  AFTER BETTER UNDERSTANDING INSERT IMG .......
function addAdverts($title, $content, $address, $price, $author, $category)
{
    global $conn;
    // CHECK PRICE (MUST BE INT & BELOW 1m €/$) ..
    if (is_int($price) && $price > 0 && $price < 1000000) {
        // USE OF TRY/CATCH TO CAPTURE SQL/PDO ERRORS ..
        try {
            // CREATE QUERY W/ ALL FORMS FIELDS SPECIFIED .. NOT SURE ........
            $sth = $conn->prepare('INSERT INTO adverts (title, content, address, price, author, category_id) VALUES (:title, :content, :address, :price, :author,:category_id)');
            $sth->bindValue(':title', $title, PDO::PARAM_STR);
            $sth->bindValue(':content', $content, PDO::PARAM_STR);
            $sth->bindValue(':adress', $address, PDO::PARAM_STR);
            $sth->bindValue(':price', $price, PDO::PARAM_INT);
            $sth->bindValue(':author', $author, PDO::PARAM_INT);
            $sth->bindValue(':category_id', $category, PDO::PARAM_INT);

            // DISPLAY MSG IF SUCCESS ..
            if ($sth->execute()) {
                // FIND BETTER SPEECH !!!
                echo "<div class='alert alert-success'> You have Published your Ads ! </div>";
                // REDIRECT TO LAST AD ADDED W/ LASTINSERTID WHICH IS PDO FONCTION
                header('Location: ad.php?id='.$conn->lastInsertId());
            }
        } catch (PDOException $e) {
            echo 'Error: '.$e->getMessage();
        }
    }
}

// EDIT AD FUNCTION ..
function editAds($title, $content, $address, $price, $author, $category, $id)
{
    global $conn;
    // CHECK PRICE (MUST BE INT & BELOW 1m €/$) ..
    if (is_int($price) && $price > 0 && $price < 1000000) {
        // USE OF TRY/CATCH TO CAPTURE SQL/PDO ERRORS ..
        try {
            // CREATE QUERY W/ ALL FORMS FIELDS SPECIFIED .. NOT SURE ........
            $sth = $conn->prepare('UPDATE adverts SET title = :title, content = :content, address = :address , price = :price, category_id=:category_id WHERE author = :author AND ad_id = :ad_id');
            $sth->bindValue(':title', $title);
            $sth->bindValue(':content', $content);
            $sth->bindValue(':price', $price, );
            $sth->bindValue(':address', $address);
            $sth->bindValue(':author', $author);
            $sth->bindValue(':category_id', $category);
            $sth->bindValue(':ad_id', $id);

            // DISPLAY MSG IF SUCCESS ..
            if ($sth->execute()) {
                // FIND BETTER SPEECH !!!
                echo "<div class='alert alert-success'> You have successfully Edited your Ad ! </div>";
                header('Location: ad.php?id={id}');
            }
        } catch (PDOException $e) {
            echo 'Error: '.$e->getMessage();
        }
    }
}
