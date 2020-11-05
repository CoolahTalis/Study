<?php require 'includes/header.php';
$title = 'Publish your AD';

$sql = 'SELECT * FROM adverts';
$res = $conn->query($sql);
$categories = $res->fetchAll();

?>

<!-- DON'T FORGET TITTLE AND REMOVE ALL BAD STYLE HERE TO MAKE IT IN SCSS !!! -->

<div class="container-fluid" style="padding: 50px 0; background:url('images/addadsbg.jpg'); background-size: cover">
    <div class="columns">
        <!-- ADD ADS FORM .. TEST BULMA COL AND SHIT AND UPDATE NAME FOR BDD AND FUNCTIONS !!! -->
        <div class="is-offset-1 column is-6" style="background: rgba(255, 255, 255, 0.5); border-radius:10px">
            <form action="process.php" method="POST">
                <div class="form-group">
                    <label class="label" for=InputTitle> Your Booking Title</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input is-danger" type="text" placeholder="Type your booking title"
                            name="advert_title" id="InputTitle" required>
                        <span class="icon is-small is-left">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <span class="icon is-small is-right">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                    </div>
                </div>

                <!-- TEXTAREA INSERTED PREVIOUS CLASSFIELD, NEED TO CHECK THIS !!! -->
                <div class="form-group">
                    <label class="label" for="InputContent">Description</label>
                    <div class="control has-icons-left has-icons-right">
                        <div class="field">
                            <div class="control">
                                <textarea class="textarea is-danger"
                                    placeholder="Tell us more about your 'Booking and your Rules" id="InputContent"
                                    name="advert_content" id="InputDescription" required></textarea>
                            </div>
                        </div>
                        <!-- <input class="input is-primary" type="textarea" placeholder="Detail here what you 'propose'"
                            value="" name="password2_signup" required> -->
                        <span class="icon is-small is-left">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <span class="icon is-small is-right">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                    </div>
                </div>

                <!-- TYPE OF BOOKING -> FLAT, HOUSE, EVEN BOAT .. -->
                <div class="form-group">
                    <label class="label" for="InputBooking">Type of booking</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input is-danger" type="text" placeholder="Specify the type of your Booking .."
                            name="advert_category" id="InputBooking" required>
                        <?php foreach ($categories as $category) { ?>
                        <option
                            value="<?php echo $category['categories_id']; ?>">
                            <?php echo $category['categories_name']; ?>
                        </option>
                        <?php } ?>
                        </select>
                    </div>
                </div>

                <!-- WHERE THE BOOKING IS LOCATED, CHANGE FOR BETTER LABEL !!! -->
                <div class="form-group">
                    <label class="label" for="InputAddress">"Localization"</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input is-danger" type="text" placeholder="Type your Booking location"
                            name="advert_address" id="InputAddress" required>
                        <span class="icon is-small is-left">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <span class="icon is-small is-right">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                    </div>
                </div>
                <!-- PRICE -->
                <div class="form-group">
                    <label class="label" for="InputPrice">Price</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input is-danger" type="number" placeholder="Enter your Price" value=""
                            name="advert_price" id="InputPrice" required>
                        <span class="icon is-small is-left">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <span class="icon is-small is-right">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                    </div>
                </div>

                <!-- DON'T FORGET THE UPLOAD IMAGE FIELD !!! -->

                <!-- SUBMIT FORM BTN -->
                <div class="field is-grouped">
                    <div class="control">
                        <input type="submit" value="Publish !" name="advert_submit" class="button is-primary">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require 'includes/footer.php';
