/*global google, Clipboard*/

"use strict";




var latitude=$("#latitude").val();
var longitude=$("#longitude").val();

var Radius = $("#radius").val();
Radius*=1000;
(function() {


    var circle, polygon, map;
    var currentGeometry = "circle";
    var DEFAULT_RADIUS = Radius;

    function initMap() {
        var startLoc = new google.maps.LatLng(latitude, longitude);

        map = new google.maps.Map(document.getElementById("map"), {
            center: startLoc,
            zoom: 10,
            mapTypeControl: false,


        });

        var input = document.getElementById("pac-input");
        var output = document.getElementById("output-container");
        var shapeInput = document.getElementById("shape-input");

        // setup geometry shapes
        google.maps.event.addListenerOnce(map, "idle", function() {
            circle = new google.maps.Circle({
                strokeColor: "#3DC371",
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: "#3DC371",
                fillOpacity: 0.35,
                map: map,
                center: startLoc,
                radius: DEFAULT_RADIUS,
                editable: false
            });

            google.maps.event.addListener(circle, "radius_changed", outputGeometry);
            google.maps.event.addListener(circle, "center_changed", outputGeometry);

            polygon = new google.maps.Polygon({
                strokeColor: "#3DC371",
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: "#3DC371",
                fillOpacity: 0.35,
                map: map,
                editable: false,
                paths: getDefaultPolygon(startLoc),
                visible: false
            });
            polygonListeners();

            outputGeometry();
        });

        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(output);
        map.controls[google.maps.ControlPosition.LEFT_TOP].push(shapeInput);

        var autocomplete = new google.maps.places.Autocomplete(input, { types: ["geocode"] });
        autocomplete.bindTo("bounds", map);
        autocomplete.addListener("place_changed", function() {
            autocompletePlaceChanged(autocomplete.getPlace());
        });

        google.maps.event.addDomListener(shapeInput, "click", shapeInputClick);

        new Clipboard(".copybtn"); // eslint-disable-line no-new
    }


    // have script loading invoke initMap
    window.initMap = initMap;
    function polygonListeners() {
        google.maps.event.addListener(polygon.getPath(), "insert_at", outputGeometry);
        google.maps.event.addListener(polygon.getPath(), "remove_at", outputGeometry);
        google.maps.event.addListener(polygon.getPath(), "set_at", outputGeometry);
        //console.log(google.maps);
    }
    function outputGeometry() {
        var geo;
        if (currentGeometry === "circle") {
            var center = circle.getCenter();

            geo = {
                lat: center.lat(),
                lng: center.lng(),
                radius_km: Math.round(circle.getRadius() / 1000),
            };
        } else if (currentGeometry === "polygon") {
            geo = polygon.getPath().getArray();
        }


        document.getElementById("pos-output").innerHTML = `"geo": ${JSON.stringify(geo, 0, 2)}`;
    }

    function getDefaultPolygon(center) {
        var span = map.getBounds().toSpan();

        return [
            { lat: center.lat() - span.lat() / 3, lng: center.lng() - span.lng() / 3 },
            { lat: center.lat() - span.lat() / 3, lng: center.lng() + span.lng() / 3 },
            { lat: center.lat() + span.lat() / 3, lng: center.lng() + span.lng() / 3 },
            { lat: center.lat() + span.lat() / 3, lng: center.lng() - span.lng() / 3 }
        ];
    }

    function autocompletePlaceChanged(place) {
        if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry"); // eslint-disable-line no-alert
            return;
        }

        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(10);
        }

        circle.setCenter(place.geometry.location);
        circle.setRadius(DEFAULT_RADIUS);

        polygon.setPath(getDefaultPolygon(place.geometry.location));
        polygonListeners();

        outputGeometry();
    }

    function shapeInputClick(mouseEvent) {
        var clickedOption = mouseEvent.target;
        if (clickedOption.className.indexOf("selected") !== -1) {
            // option already selected
            return;
        }

        // unselect all
        var shapeOptions = document.getElementsByClassName("shape-option");
        for (var i = 0; i < shapeOptions.length; i++) {
            shapeOptions[i].className = shapeOptions[i].className.replace("selected", "").trim();
        }

        // select
        clickedOption.className += " selected";

        currentGeometry = mouseEvent.target.getAttribute("data-geo-type");

        if (currentGeometry === "circle") {
            circle.setVisible(true);
            polygon.setVisible(false);
        } else if (currentGeometry === "polygon") {
            polygon.setVisible(true);
            circle.setVisible(false);
        }

        outputGeometry();
    }

})();
