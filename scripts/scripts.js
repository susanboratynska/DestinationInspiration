
// SRC: https://developers.google.com/maps/documentation/javascript/examples/places-searchbox

function initAutocomplete(listener) {


    var input = document.getElementById('pac-input');

    var autocomplete = new google.maps.places.Autocomplete(input);



    var toronto = new google.maps.LatLng(43.640, -79.394);

    // var infowindow = new google.maps.InfoWindow();

    var map = new google.maps.Map(document.getElementById('container__googlemaps'), {center: toronto, zoom: 15});

    // console.log(findGetParameter('pac-input'));
    var request = {
        query: findGetParameter('pac-input'),
        fields: ['name', 'geometry', 'photos'],
    };





// Obtain placeid value based on autocomplete event listener and store it in hidden fields of the form:
    google.maps.event.addListener(autocomplete, 'place_changed', function() {
        var place = autocomplete.getPlace();
        document.getElementById('autocompletevalue_placeid').value = place.place_id;
        // document.getElementById('autocompletevalue_lat').value = place.geometry.location.lat();
        // document.getElementById('autocompletevalue_long').value = place.geometry.location.lng();
        console.log(place.place_id);
    });


// Retrieve lat/long values from get parameter:
    // var locationlatlong = new google.maps.LatLng(findGetParameter('location__lat'), findGetParameter('location__long') );

// Retrieve place_id from parameter:
    var autocomplete_placeid = findGetParameter('location_placeid');
    console.log(autocomplete_placeid);

// Put the placeiD value in the request object:
    var photorequest = {
        placeId: autocomplete_placeid,
        // radius: '1000',
       fields: ['name', 'photos']
    };

// Create a new instance of PlacesService:
    var service2 = new google.maps.places.PlacesService(map);


// Find nearby results:
    service2.getDetails(photorequest, callback);


var google__places_photo = document.getElementById('google__places_photo');
// Iterate through the results:
    function callback(results, status) {
        if (status == google.maps.places.PlacesServiceStatus.OK) {
            console.log(results);

            console.log(results.photos);

            // Places details returns 10 photos max:
            for (var i = 0; i <= results.photos.length ; i++) {

                console.log(results.photos[i].getUrl());

                google__places_photo.innerHTML += '<img class="google__photos" src=' + results.photos[i].getUrl() +'>';

            }
        }
    }




// // Get photos from place.geometry:
// var placesarray = place.photos;
// // console.log(placesarray[0].getUrl());
//
// console.log(placesarray.length);
//
// for(var i = 0 ; i <= placesarray.length; i++){
//     console.log(placesarray[i].getUrl());
//     document.getElementById('google__results_image').setAttribute('src', placesarray[i].getUrl());
// }
//
//








    var service = new google.maps.places.PlacesService(map);

    // Emptry array for markers:
    var markers = [];

    // For each place, get the icon, name and location.
    var bounds = new google.maps.LatLngBounds();

    service.findPlaceFromQuery(request, function(results, status) {
        console.log(results);
        if (status === google.maps.places.PlacesServiceStatus.OK) {
            results.forEach(function(place) {
                if (!place.geometry) {
                    console.log("Returned place contains no geometry");
                   // return;
                }
                var icon = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25)
                };

                // Create a marker for each place.
                markers.push(new google.maps.Marker({
                    map: map,
                    icon: icon,
                    title: place.name,
                    position: place.geometry.location
                }));

                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }

                //
                // console.log(place);
                //
                // // Get photos from place.geometry:
                // var photoplacesarray = place.photos;
                // // console.log(photoplacesarray[0].getUrl());
                //
                // console.log(photoplacesarray.length);
                //
                // for(var i = 0 ; i <= photoplacesarray.length; i++){
                //     console.log(photoplacesarray[i].getUrl());
                //     document.getElementById('google__results_image').setAttribute('src', photoplacesarray[i].getUrl());
                // }

            });

            map.setCenter(results[0].geometry.location);
        }
    });



}









// PURPOSE: Get variables
// SRC: https://stackoverflow.com/questions/5448545/how-to-retrieve-get-parameters-from-javascript
function findGetParameter(parameterName) {
    var result = null,
        tmp = [];
    location.search
        .substr(1)
        .split("&")
        .forEach(function (item) {
            tmp = item.split("=");
            if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
        });
    return result;
}

















