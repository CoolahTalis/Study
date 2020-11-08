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


<div class="container-fluid"
    style="padding: 165px ; background:url('assets/images/addadsbg.jpg'); background-size: cover">
    <div class="columns">

        <!-- ADD ADS FORM .. TEST BULMA COL AND SHIT AND UPDATE NAME FOR BDD AND FUNCTIONS, BETTER DESIGN & INPUT NAME !!! -->
        <div class="column is-10" style="background: rgba(255, 255, 255, 0.5); border-radius:10px">
            <form action="process.php" method="POST">
                <!-- USERNAME MIGHT INTERFER WITH BDD ??? CHECK THIS !!! -->
                <div class="field">
                    <label class="label"> Name</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input is-primary" type="text" placeholder="Type your name .. " value="" name=""
                            required>
                        <span class="icon is-small is-right">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                    </div>
                </div>
                <div class="field">
                    <label class="label"> First Name</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input is-primary" type="text" placeholder="Type your first name .. " value=""
                            name="" required>
                        <span class="icon is-small is-right">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                    </div>
                </div>
                <!-- CHECK THIS ONE !!! -->
                <div class="field">
                    <label class="label">Address</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input is-primary" type="text" placeholder="Type your Address .." value="" name=""
                            required>
                        <span class="icon is-small is-right">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                    </div>
                </div>
                <!-- TEXTAREA INSERTED PREVIOUS CLASSFIELD, NEED TO CHECK THIS !!! -->
                <div class="field">
                    <label class="label">About me</label>
                    <div class="control has-icons-left has-icons-right">
                        <div class="field">
                            <div class="control">
                                <textarea class="textarea is-primary"
                                    placeholder="Detail here what your Booking information and your rules"
                                    required></textarea>
                            </div>
                        </div>
                        <span class="icon is-small is-right">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                    </div>
                </div>
                <!-- IN PROCESS DONT FORGET PERSISTENCE !!!!! -->
                <div class="field is-grouped">
                    <div class="control">
                        <input type="submit" value="Save Changes" name="submit_signup" class="button is-primary">
                    </div>
                </div>
            </form>
        </div>
        <div class="col-2">
            <button type="button" class="button is-primary" id="btn-ads" data-toggle="modal"
                data-target="#exampleModal">
                Check My Ads
            </button>
        </div>
    </div>

    <!-- DISPLAY ADS FROM CURRENTUSER -->
    <div class="modal " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" style="background: rgba(255, 255, 255, 0.5)">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content has-background-grey">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel" style="font-weight:900; color:white">Your Published
                        Ads (You can Edit, Delete them)</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
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
                    <button type="button" class="button is-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
// require 'includes/footer.php';
