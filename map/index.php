<!--<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Google Maps JavaScript API</title>
    <script src="jquery-min.js"></script>
	<link rel="stylesheet" href="style.css">
</head>
<body>-->
<label for="">Address: <input id="map-search" class="controls" type="text" placeholder="Search Box" size="19"></label><br>
<div>
    <label  for="">Lat: <input type="text" class="latitude"></label>
    <label  for="">Long: <input type="text" class="longitude"></label>
    <label  for="">City <input type="text" class="reg-input-city" placeholder="City"></label>
    <label  for="">country <input type="text" class="reg-input-country" placeholder="country"></label>

</div>

<div id="map-canvas"></div>

<script src="javascript.js"></script>
<script>


    $(document).ready(function() {
        getLocation();
        $.ajax({
            url: "https://maps.googleapis.com/maps/api/js?key=AIzaSyDRXK_VS0xJAkaZAPrjSjrkIbMxgpC6M2k&libraries=places&callback=initialize",
            dataType: "script",
            cache: false
        });
    });

</script>


<!--<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDRXK_VS0xJAkaZAPrjSjrkIbMxgpC6M2k&libraries=places&callback=initialize"></script>-->



<!--
</body>
</html>
-->