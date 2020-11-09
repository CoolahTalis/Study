<!-- DON'T FORGET TITTLE AND REMOVE ALL BAD STYLE HERE TO MAKE IT IN SCSS !!! -->
<?php require 'includes/header.php';

$author_id = $_SESSION['id'];
$sql = "SELECT * FROM users WHERE id = '{$author_id}'";
$res = $conn->query($sql);
$user = $res->fetch(PDO::FETCH_ASSOC);

if (isset($_GET['s'])) {
    echo '<div class="alert alert-warning"> Your Ad has been Deleted ! </div>';
}

?>

<!-- FAIL SCRIPT GO BACK TO LESSONS .................... -->



<div class="container-fluid" style="padding: 165px ; background:url('assets/images/appt1.jpg'); background-size: cover">
    <div class="columns">

        <!-- ADD ADS FORM .. TEST BULMA COL AND SHIT AND UPDATE NAME FOR BDD AND FUNCTIONS, BETTER DESIGN & INPUT NAME !!! -->
        <div class="column is-10" style="background: rgba(255, 255, 255, 0.5); border-radius:10px">
            <form action="process.php" method="POST">
                <!-- USERNAME MIGHT INTERFER WITH BDD ??? CHECK THIS !!! -->
                <div class="field">
                    <label class="label">Full Name</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input is-primary" type="text" placeholder="Type your last and first name .. "
                            value="<?php echo $user['fullname']; ?>"
                            name="fullname" required>
                        <span class="icon is-small is-right">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Contact Me</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input is-primary" type="mail" placeholder=""
                            value="<?php echo $user['email']; ?>"
                            name="email" required>
                        <span class="icon is-small is-right">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                    </div>
                </div>
                <!-- TRY TO ADD, "ABOUT ME" ETC !!!!! -->
                <div class="field is-grouped">
                    <div class="control">
                        <button type="submit" name="submit_signup" class="button is-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-2">
            <button type="button" class="button is-primary" id="openModal">
                Check My Ads
            </button>
        </div>
    </div>

    <!-- DISPLAY ADS FROM CURRENTUSER -->
    <div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" style="background: rgba(255, 255, 255, 0.5)">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content has-background-grey">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel" style="font-weight:900; color:white">Your
                        Published
                        Ads (You can Edit, Delete them)</h2>
                    <button type="button" class="button is-primary close" data-dismiss="modal">Close</button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <?php
                                    displayAdsByUser($author_id);
                                ?>
                    </div>
                </div>
                <!-- PUT A PAGE UP BTN NEXT TO CLOSE BTN IF PLENTY ADS (JQUERY) !!! -->
                <div class="modal-footer">
                    <!-- <button type="button" class="button is-primary close mx-3" data-dismiss="modal">Close</button> -->
                    <a href="#exampleModalLabel"><i class="fas fa-chevron-circle-up" style="font-size:1.8rem"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php

require 'includes/footer.php';
