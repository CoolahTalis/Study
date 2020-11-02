<?php

require 'includes/header.php';
require 'includes/navbar.php';

var_dump($_SESSION);

if (!empty($_POST['submit_signup']) && !empty($_POST['email_signup']) && !empty($_POST['password1_signup'])) {
    $pass_su = htmlspecialchars($_POST['password1_signup']);
    $repass_su = htmlspecialchars($_POST['password2_signup']);
    $email_su = htmlspecialchars($_POST['email_signup']);

    $sql = "SELECT *FROM users WHERE email = '{$email_su}'";
    $res = $conn->query($sql);
    $count = $res->fetchColumn();
    // fetchColumn recup le nbre de lignes

    if (!$count) {
        if ($pass_su === $repass_su) {
            try {
                $pass_su = password_hash($pass_su, PASSWORD_DEFAULT);
                // :email : password pour specifier une valeur ????
                // $sth -> Statement Handler, Prepare une query des infos ...
                $sth = $conn->prepare('INSERT INTO users (email, password) VALUES(:email, :password)');
                $sth->bindValue('email', $email_su);
                $sth->bindValue('password', $pass_su);
                $sth->execute();
                echo 'User registered !';
            } catch (PDOException $e) {
                echo 'Error'.$e->getMessage;
            }
        } else {
            echo '<div class="notification is-danger is-light";
            <button class="delete"></button>
            Les mots de passe ne concordent pas !
            </div>';
        }
    } elseif ($count > 0) {
        echo '<div class="notification is-danger is-light";
            <button class="delete"></button>
            Cette adresse existe déjà !
            </div>';
    }
}
if (!empty($_POST['submit_login']) && !empty($_POST['email_login']) && !empty($_POST['password_login'])) {
    $pass_login = htmlspecialchars($_POST['password_login']);
    $email_login = htmlspecialchars($_POST['email_login']);

    $sql = "SELECT * FROM users WHERE email = '{$email_login}'";
    $res = $conn->query($sql);
    // fetch toutes les données de l'user ..
    $user = $res->fetch(PDO::FETCH_ASSOC);
    // if user exist, check pass ..
    if ($user) {
        $db_pass = $user['password'];
        if (password_verify($pass_login, $db_pass)) {
            $_SESSION['email'] = $user['email'];
            $_SESSION['id'] = $user['id'];
            header('Location: index.php');
        } else {
            echo '<div class="notification is-danger is-light";
            <button class="delete"></button>
            Mot de passe erroné !
            </div>';
        }
    } else {
        echo '<div class="notification is-danger is-light";
            <button class="delete"></button>
            Cet user n\'existe pas !
            </div>';
    }
}
?>

<div class="container">
    <div class="columns">
        <!-- SIGNIN FORM -->
        <div class="column">
            <form
                action="<?php $_SERVER['REQUEST_URI']; ?>"
                method="post">
                <div class="field">
                    <label class="label">Email</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input is-danger" type="email" placeholder="Type your email" value=""
                            name="email_signup" required>
                        <span class="icon is-small is-left">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <span class="icon is-small is-right">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Password</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input is-danger" type="password" placeholder="Choose a password" value=""
                            name="password1_signup" required>
                        <span class="icon is-small is-left">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <span class="icon is-small is-right">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Re-enter your password</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input is-danger" type="password" placeholder="Re-enter your password" value=""
                            name="password2_signup" required>
                        <span class="icon is-small is-left">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <span class="icon is-small is-right">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <label class="checkbox">
                            <input type="checkbox" required>
                            I agree to the <a href="#">terms and conditions</a>
                        </label>
                    </div>
                </div>

                <div class="field is-grouped">
                    <div class="control">
                        <input type="submit" value="Register !" name="submit_signup" class="button is-primary">
                    </div>
                </div>
            </form>
        </div>

        <!-- REGISTER FORM -->
        <div class="column">
            <form
                action="<?php $_SERVER['REQUEST_URI']; ?>"
                method="post">
                <div class="field">
                    <label class="label">Email</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input is-danger" type="email" placeholder="Type your email" value=""
                            name="email_login" required>
                        <span class="icon is-small is-left">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <span class="icon is-small is-right">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Password</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input is-danger" type="password" placeholder="Choose a password" value=""
                            name="password_login" required>
                        <span class="icon is-small is-left">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <span class="icon is-small is-right">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                    </div>
                </div>

                <div class="field is-grouped">
                    <div class="control">
                        <input type="submit" value="Sign in !" name="submit_login" class="button is-primary">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php

require 'includes/footer.php';
