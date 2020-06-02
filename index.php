<?php

session_start();

require_once 'vendor/autoload.php';


$options = array(
    'apiHost' => 'api.yelp.com',
    'apiKey' => 'yWHPoBGMrZDEzX8sVYy5O14ujPsRlJfrADx3p8QbTLlxGWWudCVggIlHOuRmW9AFlJNRG-hvDCFBLs8uTEXlxpCT6qBLCBdqnaJYMUiWQwwED7S9mDmWZFWElFeSXnYx'
);

$client = \Stevenmaguire\Yelp\ClientFactory::makeWith(
    $options,
    \Stevenmaguire\Yelp\Version::THREE
);


$destinationsearch = "";

if (isset($_GET['pac-input'])){
    $destinationsearch = json_encode($_GET['pac-input']);
    // print_r($destinationsearch);
}



$parameters = array (
    'term' => 'restaurants',
    'location' => $destinationsearch,
    'radius' => 10000,
    'categories' => 'restaurants',
    'sort_by' => 'best_match',
    'limit' => '5',
    'price' => '1,2,3',
    'attributes' => 'restaurant'
);

if (isset($_GET['pac-input'])) {
    $results = $client->getBusinessesSearchResults($parameters);
}
// print_r($results);
// print_r(json_encode($_GET['pac-input']));


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>HTTP5203B - Assignment 3 - Susan Boratynska</title>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="scripts/scripts.js"></script>

        <link rel="stylesheet" type="text/css" href="styles/styles.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <link rel="icon" type="image/png" href="http://susanboratynska.com/wp-content/uploads/destinationinspiration-favicon.png">

        <title>Destination Inspiration</title>
    </head>
    <body>

        <header>
            <div class="page-wrapper">
                <div id="header__div">
                    <h1 id="header__nav">Destination Inspiration</h1>
                </div>
            </div>
        </header>

        <div id="banner"></div>

        <div id="banner__text">
            <div class="page-wrapper">
                <p>
                    As we're confined to our homes amidst a global pandemic, we're left to explore the world through the internet.
                    For some of us, this mean travel plans are put on hold but we can still explore the world online.
                </p>
                <p>
                    Enter a destination that you want to learn more about. We'll show you on a map where that is, recommend some restaurants, and show you some pictures of nearby tourist attractions.
                </p>
            </div>
        </div>


    <div class="page-wrapper">
        <div class="form__destination" id="form__destination">
            <form method="GET" action="index.php#form__destination">
                <input id="pac-input"  name="pac-input" type="text" placeholder="Where do you want to go?" value="<?php if(isset($_GET['pac-input'])){echo $_GET['pac-input'];} ?>">
                <input id="autocompletevalue_placeid"  name="location_placeid" type="hidden" >
                <input id="submit__destination" name="submit__destination" type="submit" value="Take Me There"/>
            </form>
        </div>

        <div class="row" id="container__map_yelp">

            <div class="col-12 col-md-8" id="container__google">
                <h2>Map</h2>
                <div id="container__googlemaps"></div>
            </div>
            <!-- Included libraries=places for autocomplete search; Enabled places  -->
            <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmWqyRsPhX5MvyF8R1vG_RV-CuAVNRg98&libraries=places&callback=initAutocomplete">
            </script>

            <div id="container__yelp" class="col-6 col-md-4">

            <?php
            // print_r($results);
            for ($i = 0; $i <4; $i++ ){
                
            }
            if (isset($_GET['pac-input'])){
                echo "<h2>Restaurants</h2>";
                foreach ($results->businesses as $result) {
                    ?>

                    <div class="yelp__result">
                        <div class="row">
                            <div class="yelp__image_container">
                                <img class="yelp__images" src="<?= $result->image_url; ?>">
                            </div>
                            <div class="col-8 yelp__contentbox">
                                <div class="yelp__title"><a href="<?= $result->url; ?>"
                                                            target="_blank"><?= $result->name; ?></a></div>
                                <div class="yelp__rating font_11">
                                    <?php
                                    $i = 0;


                                    // Print out star ratings based on the 5 star rating provided by YELP:
                                    for ($i = 0; $i < 5; ++$i) {
                                        if ($result->rating > 0.5) {
                                            echo "<span class='rating star'></span>";
                                            // echo "value i = " . $i . "</br> value result = " . $result->rating . "</br>" ;
                                        } else if ($result->rating == 0.5) {
                                            echo "<span class='rating half-star'></span>";
                                            // echo "value i = " . $i . "</br> value result = " . $result->rating . "</br>" ;
                                        } else if ($result->rating < -1) {
                                            echo "<span class='rating unstar'></span>";
                                            // echo "value i = " . $i . "</br> value result = " . $result->rating . "</br>" ;
                                        } else {
                                            echo "<span class='rating unstar'></span>";
                                        }
                                        $result->rating = $result->rating - 1;
                                    }

                                    ?>

                                </div>

                                <div class="yelp__price font_11"><?= $result->price; ?></div>
                                <div class="yelp__address1 font_11"><?= $result->location->display_address[0]; ?></div>
                                <div class="yelp__address2 font_11"><?= $result->location->display_address[1]; ?></div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
            </div>
        </div>
        <div class="row">
            <?php
            if (isset($_GET['pac-input'])){
            ?>
                <h2>Nearby Attractions</h2>
                <div id="google__places_photo"></div>
            <?php
            }
            ?>

        </div>
    </div>

    <footer id="footer">
        <nav id="footer-nav" class="page-wrapper">
            <p>&#169;SusanBoratynska</p>
        </nav>
    </footer>
    </body>
</html>

