<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>HTTP5203B - Assignment 3 - Susan Boratynska</title>
        <link rel="stylesheet" type="text/css" href="styles/styles.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="scripts/scripts.js"></script>
    </head>
    <body>
    <h1>Travel Destination Trends</h1>

    <input id="search__maps" class="controls" type="text" size="55" placeholder="Where do you want to go?">

    <div id="container__googlemaps">


    </div>

    <!-- Included libraries=places for autocomplete search; Enabled places  -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCA51SWNimZff6jD0kPbF95HRXocqTE1k4&callback=initializeMapJQuery&libraries=places&callback=initAutocomplete">
    </script>

    <div id="container__pinterest"></div>

    <div id="container__yelp"></div>


    </body>
</html>

