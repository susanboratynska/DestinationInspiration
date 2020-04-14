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



$url = 'https://api.yelp.com/v3/businesses/search';
$api_key = 'yWHPoBGMrZDEzX8sVYy5O14ujPsRlJfrADx3p8QbTLlxGWWudCVggIlHOuRmW9AFlJNRG-hvDCFBLs8uTEXlxpCT6qBLCBdqnaJYMUiWQwwED7S9mDmWZFWElFeSXnYx';

$destinationsearch = "";
$destinationsearch = json_encode($_GET['pac-input']);
// print_r($destinationsearch);


$parameters = array (
    'term' => 'restaurants',
    'location' => json_encode($_GET['pac-input']),
    'radius' => 10000,
    'categories' => 'restaurants',
    'sort_by' => 'best_match',
    'limit' => '5',
    'price' => '1,2,3',
    'attributes' => 'hot_and_new'
);

$results = $client->getBusinessesSearchResults($parameters);
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
    </head>
    <body>
    <h1>Travel Destination Trends</h1>


    <div class="form__destination">
        <form method="GET" action="index.php">
            <input id="pac-input"  name="pac-input" type="text" placeholder="Where do you want to go?">
            <input id="submit__destination" name="submit__destination" type="submit" value="Take Me There"/>
        </form>
    </div>

    <div class="row">

        <div class="col-12 col-md-8" id="container__google">
            <div id="container__googlemaps"></div>
        </div>
        <!-- Included libraries=places for autocomplete search; Enabled places  -->
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCA51SWNimZff6jD0kPbF95HRXocqTE1k4&callback=initializeMapJQuery&libraries=places&callback=initAutocomplete">
        </script>

        <div id="container__yelp" class="col-6 col-md-4">
        <?php
        foreach ($results->businesses as $result){
        ?>
            <div class="yelp__result">
                <div class="row">
                    <div class="yelp__image_container">
                        <img class="yelp__images" src="<?= $result->image_url; ?>">
                    </div>
                    <div class="col-8 yelp__contentbox">
                        <div class="yelp__title"><a href="<?= $result->url ; ?>" target="_blank"><?= $result->name ; ?></a></div>
                        <div class="yelp__rating font_12">Rating: <?= $result->rating ; ?></div>
                        <div class="yelp__price font_12"><?= $result->price ; ?></div>
                        <div class="yelp__address1 font_12"><?= $result->location->display_address[0] ; ?></div>
                        <div class="yelp__address2 font_12"><?= $result->location->display_address[1] ; ?></div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
        </div>
    </div>
    <div class="row">
        <div id="google__places_photo"></div>
        <img id="google__results_image" >
<!--        <script async defer src="https://maps.googleapis.com/maps/api/place/photo?maxwidth=400&photoreference=CnRtAAAATLZNl354RwP_9UKbQ_5Psy40texXePv4oAlgP4qNEkdIrkyse7rPXYGd9D_Uj1rVsQdWT4oRz4QrYAJNpFX7rzqqMlZw2h2E2y5IKMUZ7ouD_SlcHxYq1yL4KbKUv3qtWgTK0A6QbGh87GB3sscrHRIQiG2RrmU_jF4tENr9wGS_YxoUSSDrYjWmrNfeEHSGSc3FyhNLlBU&key=--><?//=$api_key?><!--"></script>-->
        <script async defer src="https://maps.googleapis.com/maps/api/place/details/json?placeid=ChIJN1t_tDeuEmsRUsoyG83frY4&fields=photo,name,rating,formatted_phone_number&key=<?=$api_key?>"></script>
    </div>
    <div id="googleplace">
        https://maps.googleapis.com/maps/api/place/findplacefromtext/json?input=Museum%20of%20Contemporary%20Art%20Australia&inputtype=textquery&fields=photos,formatted_address,name,rating,opening_hours,geometry&key=yWHPoBGMrZDEzX8sVYy5O14ujPsRlJfrADx3p8QbTLlxGWWudCVggIlHOuRmW9AFlJNRG-hvDCFBLs8uTEXlxpCT6qBLCBdqnaJYMUiWQwwED7S9mDmWZFWElFeSXnYx
    </div>

    </body>
</html>

