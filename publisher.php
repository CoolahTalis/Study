<?php require 'includes/header.php';

$sql = 'SELECT * FROM categories';
$res = $conn->query($sql);
$categories = $res->fetchAll();

?>

<!-- DON'T FORGET TITTLE AND REMOVE ALL BAD STYLE HERE TO MAKE IT IN SCSS !!! -->

<div class="container-fluid"
    style="padding: 50px 0; background:url('assets/images/addadsbg.jpg'); background-size: cover">
    <div class="columns">
        <!-- ADD ADS FORM .. TEST BULMA COL AND SHIT AND UPDATE NAME FOR BDD AND FUNCTIONS !!! -->
        <div class="is-offset-1 column is-6 mb-5" style="background: rgba(255, 255, 255, 0.5); border-radius:10px">
            <form action="process.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="label" for=InputName> Your Booking Title</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input is-danger" type="text" placeholder="Type your booking title"
                            name="advert_ad_name" id="InputName" required>
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
                        <span class="icon is-small is-right">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                    </div>
                </div>

                <!-- TYPE OF BOOKING -> FLAT, HOUSE, EVEN BOAT .. -->
                <div class="form-group">
                    <label class="label" for="InputBooking">Type of booking</label>
                    <div class="control has-icons-left has-icons-right">
                        <select class="input is-danger" placeholder="Specify the type of your Booking .."
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

                <!-- WHERE THE BOOKING IS LOCATED, CHECK FOR BETTER LABEL !!! -->
                <div class="form-group">
                    <label class="label" for="InputAddress">Localization</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input is-danger" type="text"
                            placeholder="Type Booking Address (eg. '34 Beat Street, Apt. 2A, 3904 NomansLand, UK')"
                            name="advert_address" id="InputAddress" required>
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
                            name="advert_price" id="InputPrice" max="999999" required>
                        <span class="icon is-small is-right">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                    </div>
                </div>

                <!-- DON'T FORGET THE UPLOAD IMAGE FIELD !!! -->
                <label class="label" for="InputImg">Your Booking Pictures</label>
                <!-- FIX LANG UPLOAD BTN !!! -->
                <input type="file" value="Choose an image" name="advert_images" id="InputImg" class="">
                <!-- SUBMIT FORM BTN -->
                <div class="field is-grouped">
                    <div class="control mt-3">
                        <input type="submit" value="Publish !" name="advert_submit" class="button is-primary">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php

require 'includes/footer.php';
