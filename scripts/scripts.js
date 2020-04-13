
// SRC: https://developers.google.com/maps/documentation/javascript/examples/places-searchbox

function initAutocomplete(listener) {
    // var map = new google.maps.Map(document.getElementById('container__googlemaps'), {
    //     center: {lat: -33.8688, lng: 151.2195},
    //     zoom: 13,
    //     mapTypeId: 'roadmap'
    // });



    var input = document.getElementById('pac-input');

    var autocomplete = new google.maps.places.Autocomplete(input);





    var toronto = new google.maps.LatLng(43.640, -79.394);

    var infowindow = new google.maps.InfoWindow();

    var map = new google.maps.Map(
        document.getElementById('container__googlemaps'), {center: toronto, zoom: 15});

    // console.log(findGetParameter('pac-input'));
    var request = {
        query: findGetParameter('pac-input'),
        fields: ['name', 'geometry'],
    };

    var service = new google.maps.places.PlacesService(map);

    var markers = [];

    // For each place, get the icon, name and location.
    var bounds = new google.maps.LatLngBounds();

    service.findPlaceFromQuery(request, function(results, status) {
        console.log(results);
        if (status === google.maps.places.PlacesServiceStatus.OK) {
            // for (var i = 0; i < results.length; i++) {
            //     createMarker(results[i]);
            // }
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

















