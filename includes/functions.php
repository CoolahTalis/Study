<?php

require 'includes/config.php';
// REGISTER FUNCTION DISPLAYED IN signin.php !!!
function signUp($email_su, $pass_su, $repass_su)
{
    global $conn;

    try {
        $sql = "SELECT *FROM users WHERE email = '{$email_su}'";
        $res = $conn->query($sql);
        $count_email_su = $res->fetchColumn();
        // fetchColumn recup le nbre de lignes
        if (!$count_email_su) {
            if ($pass_su === $repass_su) {
                $pass_su = password_hash($pass_su, PASSWORD_DEFAULT);
                // :email : password pour specifier une valeur ????
                // $sth -> Statement Handler, Prepare une query des infos ...
                $sth = $conn->prepare('INSERT INTO users (email, password) VALUES(:email, :password)');
                $sth->bindValue(':email', $email_su);
                $sth->bindValue(':password', $pass_su);
                $sth->execute();
                echo '<div class="alert alert-success mt-2" role="alert" > User registered ! </div>';
                unset($_POST);
            } else {
                echo '<div class="notification is-danger is-light";
                    <button class="delete"></button>
                    Passwords do not match, try again !
                    </div>';
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

function connexion($conn, $email_login, $pass_login)
{
    global $conn;

    try {
        $sql = "SELECT * FROM users WHERE email = '{$email_login}'";
        $res = $conn->query($sql);
        // fetch toutes les données de l'user ..
        $user = $res->fetch(PDO::FETCH_ASSOC);
        // if user exist, check pwd ..
        if ($user) {
            $db_pass = $user['password'];
            if (password_verify($pass_login, $db_pass)) {
                $_SESSION['email'] = $user['email'];
                $_SESSION['id'] = $user['id'];
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
