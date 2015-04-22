<?php $this->extend($extendDir.'layout'); ?>
<?php $this->set('title', 'Find a Brake Hose Manufacturer') ?>
<?php $this->set('metaDescription', 'Brake Hose Manufacturers in Australia') ?>

<!-- css -->				
<link href="/assets/css/locator.css" rel="stylesheet" type="text/css" />


<h2>Find a Manufacturer</h2>

    <div id="store-locator-container">
      <div id="form-container">
        <form id="user-location" method="post" action="#">
            <div id="form-input">
              <label for="address">Enter your address:</label>
              </div>
            <input type="text" id="address" name="address" />
            <input id="submit" class="submit" type="submit" value="Search" style="padding: 9px 10px;">
        </form>
      </div>

      <div id="map-container">
        <div id="map"></div>
        <div id="loc-list">
            <ul id="list"></ul>
        </div>
      </div>
    </div>


    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <script src="/assets/js/handlebars-1.0.0.min.js"></script>
    <script src="http://maps.google.com/maps/api/js?sensor=false&libraries=places&region=AU"></script>
    <script src="/assets/js/jquery.storelocator.min.js"></script>
      <script>
          
$(function() {
  $('#user-location').on('submit', function(e){
    //Stop the form submission
    e.preventDefault();
    //Get the user input and use it
    var userinput = $('form #address').val();

    if (userinput == "")
      {
        alert("The input box was blank.");
        return false;
      }

  });
});

        $(function() {
          $('#map-container').storeLocator({
              dataType: 'json',
              dataLocation: '/locations',
              infowindowTemplatePath: 'infowindow-description.html',
              listTemplatePath: 'location-list-description.html',
              lengthUnit: 'km',
              listColor2: 'ffffff',
              storeLimit: 10,
              originMarker: true
          });
          
            var input = /** @type {HTMLInputElement} */
            (document.getElementById('address'));
            var autocomplete = new google.maps.places.Autocomplete(input);
        });
      </script>
