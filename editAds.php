<?php require 'includes/header.php';

// ISSUE FIXED W/ BASIC QUERY, TRY TO FIX LATER !!!
$sql1 = 'SELECT * FROM adverts';
$sql2 = 'SELECT * FROM categories';
$res1 = $conn->query($sql1);
$advert = $res1->fetch(PDO::FETCH_ASSOC);
$res2 = $conn->query($sql2);
$categories = $res2->fetchAll();
?>

<!-- DON'T FORGET TITTLE AND REMOVE ALL BAD STYLE HERE TO MAKE IT IN SCSS !!! -->

<div class="container-fluid"
    style="padding: 50px 0; background:url('assets/images/addadsbg.jpg'); background-size: cover">
    <div class="columns">
        <!-- ADD ADS FORM .. TEST BULMA COL AND SHIT AND UPDATE NAME FOR BDD AND FUNCTIONS !!! -->
        <div class="is-offset-1 column is-6 mb-5">
            <form action="process.php" method="POST" style="background: rgba(255, 255, 255, 0.5); border-radius:10px">
                <div class="form-group">
                    <label class="label" for=InputName> Your Booking Title</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input is-danger" type="text" placeholder="Type your booking title"
                            name="advert_ad_name" id="InputName"
                            value="<?php echo $advert['ad_name']; ?>"
                            required>
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
                                <textarea class="textarea is-danger" id="InputContent" name="advert_content"
                                    id="InputDescription"
                                    value="<?php echo $advert['content']; ?>"
                                    required></textarea>
                            </div>
                        </div>
                        <span class=" icon is-small is-right">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                    </div>
                </div>

                <!-- TYPE OF BOOKING -> FLAT, HOUSE, EVEN BOAT .. -->
                <div class="form-group">
                    <label class="label" for="InputBooking">Type of booking</label>
                    <div class="control has-icons-left has-icons-right">
                        <select class="input is-danger" name="advert_category" id="InputBooking" required>
                            <!-- DISPLAY PREVIOUS SELECTED CATEGORY W/ <option selected> .. -->
                            <option
                                value="<?php echo $advert['category_id']; ?>"
                                selected>
                                <?php echo $advert['categories_name']; ?>

                            </option>
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
                        <input class="input is-danger" type="text" name="advert_address" id="InputAddress"
                            value="<?php echo $advert['address']; ?>"
                            required>
                        <span class="icon is-small is-right">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                    </div>
                </div>
                <!-- PRICE -->
                <div class="form-group">
                    <label class="label" for="InputPrice">Price</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input is-danger" type="number" name="advert_price" id="InputPrice" max="999999"
                            value="<?php echo $advert['price']; ?>"
                            required>
                        <span class="icon is-small is-right">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                    </div>
                </div>

                <!-- DON'T FORGET THE UPLOAD IMAGE FIELD !!! -->
                <label class="label" for="InputImg">Your Booking Pictures</label>
                <!-- FIX LANG UPLOAD BTN !!! -->
                <input type="file" value="Choose an image" name="advert_images" id="InputImg"
                    value="<?php echo $advert['images']; ?>">
                <!-- SUBMIT FORM BTN -->
                <div class="field is-grouped">
                    <div class="control mt-3">
                        <input type="submit" value="Save changes" name="advert_edit" class="button is-primary">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
// require 'includes/footer.php';
