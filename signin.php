<?php

require 'includes/header.php';

if (isset($_POST['submit_signup']) && !empty($_POST['email_signup']) && !empty($_POST['password1_signup']) && !empty($_POST['fullname'])) {
    $pass_su = htmlspecialchars($_POST['password1_signup']);
    $repass_su = htmlspecialchars($_POST['password2_signup']);
    $email_su = htmlspecialchars($_POST['email_signup']);
    $fullname = htmlspecialchars($_POST['fullname']);

    // REGISTER FUNCTION FROM FUNCTIONS.PHP ..
    signUp($email_su, $pass_su, $repass_su, $fullname);
//-------------------------------------------------------------------------
} elseif (!empty($_POST['email_login']) && !empty($_POST['password_login']) && isset($_POST['submit_login'])) {
    // SWITCH TO STRIP_TAGS ???
    $email_login = htmlspecialchars($_POST['email_login']);
    $pass_login = htmlspecialchars($_POST['password_login']);

    // LOGIN FUNCTION FROM FUNCTION.PHP ..
    connexion($email_login, $pass_login);
//------------------------------------------------------------------------
} else {
    if (isset($_POST)) {
        unset($_POST);
    }
}
?>
<!-- SWITCH W/ CONTAINER-FLUID, TEMPORARY !!! ... -->
<div class="container-fluid"
    style="padding: 160px 0; background:url('assets/images/signbg.jpg'); background-size: cover">
    <div class="columns">
        <!-- REGISTER FORM, FIND WAY FOR BETTER DISPLAY OF BOTH !!! -->
        <div class="is-offset-1 column is-5"
            style="background: rgba(255, 255, 255, 0.5); border-radius:10px; border-right: 5px solid black">
            <form
                action="<?php $_SERVER['REQUEST_URI']; ?>"
                method="POST">
                <div class="field">
                    <label class="label">Email</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input is-danger" type="email" placeholder="Type your email ..."
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
                        <input class="input is-danger" type="password" placeholder="Choose a password ..."
                            name="password1_signup" required>
                        <span class="icon is-small is-right">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Re-enter your password</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input is-danger" type="password" placeholder="Re-enter your password ..."
                            name="password2_signup" required>
                        <span class="icon is-small is-right">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Full Name</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input is-danger" type="text" placeholder="Enter your Full Name ..."
                            name="fullname" required>
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

        <!-- 'SEPARATE THE FORMS' NEEDED!!! -->

        <!-- SIGNIN FORM WITH NOOB SOLUTION TO SEPARATE FORMS, TEMP... -->
        <div class="is-offset column is-5"
            style="background: rgba(255, 255, 255, 0.5); border-radius:10px; border-left: 5px solid black">
            <form
                action="<?php $_SERVER['REQUEST_URI']; ?>"
                method="POST">
                <div class="field">
                    <label class="label">Email</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input is-danger" type="email" placeholder="Type your email ..." name="email_login"
                            required>
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
                        <input class="input is-danger" type="password" placeholder="Choose a password ..."
                            name="password_login" required>
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
</div>

<?php
// require 'includes/footer.php';
