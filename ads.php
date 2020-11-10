<?php require 'includes/header.php';

$sql = 'SELECT * FROM categories';
$res = $conn->query($sql);
$categories = $res->fetchAll();

if (isset($_POST['search_form'])) {
    $category = intval(strip_tags($_POST['advert_category']));
    $search_text = strip_tags($_POST['search_text']);

    $sql2 = "SELECT * FROM adverts WHERE category_id LIKE '%{$category}%' AND ad_name LIKE '%{$search_text}%'";
    $res2 = $conn->query($sql2);
    $search = $res2->fetchAll();
}
?>

<section style="background: url('assets/images/adsbg.jpg'); background-size: cover">
    <div class='columns'>
        <div class='container profile'>

            <!-- MAYBE USE THIS BLOCK TO GIVE CURRENTUSER THE RIGHT TO GOOGLE SPECIFIK ADS !!! -->
            <div class="box has-background-primary" style="border-radius: 5px">
                <div class='row'>
                    <div class='column is-2-tablet user-property-count has-text-centered'>
                        <p class='subtitle is-5' style="color:green">
                            Find Place To Stay
                        </p>
                    </div>
                    <div class='column is-8'>
                        <p class='control has-addons'>
                            <select class="form-control  mb-2 mx-2" id="InputCategory" name="advert_category">
                                <option value="" selected> Filter Search </option>
                                <?php foreach ($categories as $category) { ?>
                                <option
                                    value="<?php echo $category['categories_id']; ?>">
                                    <?php echo $category['categories_name']; ?>
                                </option>
                                <?php } ?>
                            </select>

                            <?php if (isset($search)) {
    echo '<a href="products.php" class="btn btn-danger mx-2 mb-2">Reset</a>';
} ?>
                            <!-- AJUST BTN POSITION -->
                            <button class='button'>
                                Search
                            </button>
                        </p>
                    </div>
                </div>
            </div>

            <!-- CARD CONTAINER WACK CODE TO CHECK !!! -->
            <div class="columns is-mutltiline is-centered" style="margin-bottom:100p; flex-wrap: wrap;">
                <?php
                        if (isset($search)) {
                            foreach ($search as $advert) {?>
                <br>
                <?php  }
                        } else {
                            displayAds();
                        } ?>
            </div>
        </div>
    </div>
</section>

<?php

require 'includes/footer.php';
