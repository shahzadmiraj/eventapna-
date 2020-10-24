var x = document.getElementById("demo");
///////////////check location is block or not
function getLocation()
{
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(showPosition);
	} else {
		//	x.innerHTML = "Geolocation is not supported by this browser.";
	}
}
function showPosition(position)
{
	// x.innerHTML = "Latitude: " + position.coords.latitude +
	// 	"<br>Longitude: " + position.coords.longitude;
	//latitude=position.coords.latitude;
	//longitude=position.coords.longitude;
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
	infoWindow.setPosition(pos);
	infoWindow.setContent(browserHasGeolocation ? 'Error: The Geolocation service failed.' : 'Error: Your browser doesnt support geolocation.');
	infoWindow.open(map);
}
function initialize()
{
	var geocoder;
	var mapOptions, map, marker, searchBox, city,motherland,
		infoWindow = '',
		addressEl = document.querySelector( '#map-search' ),
		latEl = document.querySelector( '.latitude' ),
		longEl = document.querySelector( '.longitude' ),
		element = document.getElementById( 'map-canvas' );
	city = document.querySelector( '.reg-input-city' );
	motherland = document.getElementById( 'reg-input-country' );
	geocoder = new google.maps.Geocoder;
	mapOptions =
		{
			// How far the maps zooms in.
			zoom: 8,
			// Current Lat and Long position of the pin/

			center: new google.maps.LatLng(-28.643387,153.612224),
			//	center: {lat: -28.643387, lng: 153.612224},
			// center : {
			// 	lat: -34.397,
			// 	lng: 150.644
			// },
			disableDefaultUI: false, // Disables the controls like zoom control on the map if set to true
			scrollWheel: true, // If set to false disables the scrolling on the map.
			draggable: true, // If set to false , you cannot move the map around.
			// mapTypeId: google.maps.MapTypeId.HYBRID, // If set to HYBRID its between sat and ROADMAP, Can be set to SATELLITE as well.
			// maxZoom: 11, // Wont allow you to zoom more than this
			// minZoom: 9  // Wont allow you to go more up.


		};

	/**
	 * Creates the map using google function google.maps.Map() by passing the id of canvas and
	 * mapOptions object that we just created above as its parameters.
	 *
	 */
	// Create an object map with the constructor function Map()
	map = new google.maps.Map( element, mapOptions ); // Till this like of code it loads up the map.
	/**
	 * Creates the marker on the map
	 *
	 */
	marker = new google.maps.Marker({
		position: mapOptions.center,
		map: map,
		// icon: 'http://pngimages.net/sites/default/files/google-maps-png-image-70164.png',
		draggable: true
	});







	//map.setCenter(marker.getPosition());

	/**
	 * Creates a search box
	 */
	searchBox = new google.maps.places.SearchBox( addressEl );

	/**
	 * When the place is changed on search box, it takes the marker to the searched location.
	 */
	google.maps.event.addListener( searchBox, 'places_changed', function () {
		var places = searchBox.getPlaces(),
			bounds = new google.maps.LatLngBounds(),
			i, place, lat, long, resultArray,
			addresss = places[0].formatted_address;

		for( i = 0; place = places[i]; i++ ) {
			bounds.extend( place.geometry.location );
			marker.setPosition( place.geometry.location );  // Set marker position new.
		}

		map.fitBounds( bounds );  // Fit to the bound
		map.setZoom( 15 ); // This function sets the zoom to 15, meaning zooms to level 15.
		// console.log( map.getZoom() );

		lat = marker.getPosition().lat();
		long = marker.getPosition().lng();
		latEl.value = lat;
		longEl.value = long;

		resultArray =  places[0].address_components;

		// Get the city and set the city input value to the one selected
		for( var i = 0; i < resultArray.length; i++ ) {
			if ( resultArray[ i ].types[0] && 'administrative_area_level_2' === resultArray[ i ].types[0] ) {
				citi = resultArray[ i ].long_name;
				city.value = citi;
			}

			if ( resultArray[ i ].types[0] && 'country' === resultArray[ i ].types[0] ) {
				country = resultArray[ i ].long_name;
				motherland.value = country;
			}


		}

		// Closes the previous info window if it already exists
		if ( infoWindow ) {
			infoWindow.close();
		}
		/**
		 * Creates the info Window at the top of the marker
		 */
		infoWindow = new google.maps.InfoWindow({
			content: addresss
		});

		infoWindow.open( map, marker );
	} );


	/**
	 * Finds the new position of the marker when the marker is dragged.
	 */
	google.maps.event.addListener( marker, "dragend", function ( event ) {
		var lat, long, address, resultArray, citi,country;

		console.log( 'i am dragged' );
		lat = marker.getPosition().lat();
		long = marker.getPosition().lng();

		var geocoder = new google.maps.Geocoder();
		geocoder.geocode( { latLng: marker.getPosition() }, function ( result, status )
		{
			if ( 'OK' === status ) {  // This line can also be written like if ( status == google.maps.GeocoderStatus.OK ) {
				address = result[0].formatted_address;
				console.log(address);
				resultArray =  result[0].address_components;

				// Get the city and set the city input value to the one selected
				for( var i = 0; i < resultArray.length; i++ )
				{
					//1 for state 2 for city
					if ( resultArray[ i ].types[0] && 'administrative_area_level_2' === resultArray[ i ].types[0] ) {
						citi = resultArray[ i ].long_name;
						console.log( citi );
						city.value = citi;
					}
					if ( resultArray[ i ].types[0] && 'country' === resultArray[ i ].types[0] ) {
						country = resultArray[ i ].long_name;
						console.log( country );
						motherland.value = country;
					}

				}
				motherland.value=country;
				addressEl.value = address;
				latEl.value = lat;
				longEl.value = long;

			} else {
				console.log( 'Geocode was not successful for the following reason: ' + status );
			}

			// Closes the previous info window if it already exists
			if ( infoWindow ) {
				infoWindow.close();
			}

			/**
			 * Creates the info Window at the top of the marker
			 */
			infoWindow = new google.maps.InfoWindow({
				content: address
			});

			infoWindow.open( map, marker );
		} );
	});
	function geocodeLatLng(pos)
	{
		var latlng = {lat: pos.lat, lng: pos.lng};
		geocoder.geocode({'location': latlng}, function(results, status) {
			if (status === 'OK') {
				if (results[0])
				{
					$("#latitude").val(pos.lat);
					$("#longitude").val(pos.lng);
					$("#map-search").val(results[0].formatted_address);

					//console.log(results[0].formatted_address);
					//console.log(results[0].address_components);
					var resultArray =  results[0].address_components;

					// Get the city and set the city input value to the one selected
					for( var i = 0; i < resultArray.length; i++ )
					{
						if ( resultArray[ i ].types[0] && 'administrative_area_level_2' === resultArray[ i ].types[0] ) {
							// console.log(resultArray[ i ].long_name);
							$("#reg-input-city").val(resultArray[ i ].long_name);
							//city
						}
						if ( resultArray[ i ].types[0] && 'country' === resultArray[ i ].types[0] ) {
							// console.log(resultArray[ i ].long_name);

							$("#reg-input-country").val(resultArray[ i ].long_name);
							//county
						}
					}

				} else {
					window.alert('No results found');
				}
			} else {
				window.alert('Geocoder failed due to: ' + status);
			}
		});
	}

	// Try HTML5 geolocation.
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(function(position) {
			var pos = {
				lat: position.coords.latitude,
				lng: position.coords.longitude
			};

			marker.setPosition(pos);
			map.setCenter(pos);

			geocodeLatLng(pos);

		}, function() {
			handleLocationError(true, marker, map.getCenter());
		});
	} else {
		// Browser doesn't support Geolocation
		handleLocationError(false, marker, map.getCenter());
	}


}


