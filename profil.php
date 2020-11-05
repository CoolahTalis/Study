<!-- DON'T FORGET TITTLE AND REMOVE ALL BAD STYLE HERE TO MAKE IT IN SCSS !!! -->
<?php require 'includes/header.php'; ?>

<div class="container-fluid" style="padding: 50px 0; background:url('images/addadsbg.jpg'); background-size: cover">
    <div class="columns">
        <!-- ADD ADS FORM .. TEST BULMA COL AND SHIT AND UPDATE NAME FOR BDD AND FUNCTIONS, BETTER DESIGN & INPUT NAME !!! -->
        <div class="is-offset-1 column is-6" style="background: rgba(255, 255, 255, 0.5); border-radius:10px">
            <form
                action="<?php $_SERVER['REQUEST_URI']; ?>"
                method="POST">
                <!-- USERNAME... -->
                <div class="field">
                    <label class="label">Your name</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input is-primary" type="text" placeholder="Type your name .. " value=""
                            name="fullname" required>
                        <span class="icon is-small is-left">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <span class="icon is-small is-right">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                    </div>
                </div>
                <!-- WHERE THE BOOKING IS LOCATED, CHANGE FOR BETTER LABEL !!! -->
                <div class="field">
                    <label class="label">Address</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input is-primary" type="text" placeholder="Type your Address .." value=""
                            name="address" required>
                        <span class="icon is-small is-left">
                            <i class="fas fa-envelope"></i>
                        </span>
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
                                    placeholder="Detail here what you 'propose' and your rules" required></textarea>
                            </div>
                        </div>
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
                        <input type="submit" value="Publish !" name="submit_signup" class="button is-primary">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require 'includes/footer.php';
