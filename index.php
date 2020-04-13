<?php
session_start();

require_once 'Yelp.php';

$url = 'https://api.yelp.com/v3/businesses/search';
$api_key = 'yWHPoBGMrZDEzX8sVYy5O14ujPsRlJfrADx3p8QbTLlxGWWudCVggIlHOuRmW9AFlJNRG-hvDCFBLs8uTEXlxpCT6qBLCBdqnaJYMUiWQwwED7S9mDmWZFWElFeSXnYx';

$destinationsearch = "";
$destinationsearch = json_encode($_GET['pac-input']);


$parameters = array (
    'term' => 'restaurants',
    'location' => json_encode($_GET['pac-input']),
//    'radius' => 10000,
    'categories' => 'restaurants',
    'sort_by' => 'best_match',
    'limit' => '5'
//    'price' => '1,2,3',
//    'attributes' => 'hot_and_new'
);

print_r(json_encode($_GET['pac-input']));

$options = array ('http' =>
    array (
        'header' =>  'Authorization: Bearer ' . $api_key,
        'method' => 'GET'
        //'content' => json_encode($data)
    )
);

$str = stream_context_create($options);
$result = json_decode(file_get_contents($url, false, $str));
print_r($result);

$y = new Yelp();
$yelp = $y->yelpSearchResults($destinationsearch);


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

        <form method="Get" action="index.php">
            <input id="pac-input"  name="pac-input" type="text" placeholder="Where do you want to go?">
            <input type="submit" name="submit__destination" id="submit__destination" value="Take Me There"/>
        </form>



<!--            <input id="search__maps" class="controls" type="text"  size="55"  placeholder="Where do you want to go?">-->




    </div>
    <div class="row">

        <div class="col-12 col-md-8">

<!--            <input id="search__maps" class="controls" type="text" size="55" placeholder="Where do you want to go?">-->

            <div id="container__googlemaps">

            </div>
        </div>
        <!-- Included libraries=places for autocomplete search; Enabled places  -->
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCA51SWNimZff6jD0kPbF95HRXocqTE1k4&callback=initializeMapJQuery&libraries=places&callback=initAutocomplete">
        </script>


        <div id="container__pinterest"></div>

        <div id="container__yelp" class="col-6 col-md-4">
            <div class="yelp__result">
                <h4 class="yelp__title">Restaurant Name</h4>
                <div class="row">
                    <img class="col-4 yelp__images" src="images/pai.jpg">
                    <div class="col-8">
                        <div class="yelp__rating">Ratings</div>
                        <div class="yelp__price">Price</div>
                        <div class="yelp__description">Description</div>
                    </div>
                </div>
            </div>
            <div class="yelp__result">
                <h4 class="yelp__title">Restaurant Name</h4>
                <div class="row">
                    <img class="col-4 yelp__images" src="images/pai.jpg">
                    <div class="col-8">
                        <div class="yelp__rating">Ratings</div>
                        <div class="yelp__price">Price</div>
                        <div class="yelp__description">Description</div>
                    </div>
                </div>
            </div>
            <div class="yelp__result">
                <h4 class="yelp__title">Restaurant Name</h4>
                <div class="row">
                    <img class="col-4 yelp__images" src="images/pai.jpg">
                    <div class="col-8">
                        <div class="yelp__rating">Ratings</div>
                        <div class="yelp__price">Price</div>
                        <div class="yelp__description">Description</div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </body>
</html>

