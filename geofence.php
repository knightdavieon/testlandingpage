<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Geofencing Example with Drawing and Real-time Location Tracking</title>
  <!-- Leaflet CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <!-- Leaflet Draw CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet-draw/dist/leaflet.draw.css" />
  <style>
    /* Responsive map container */
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }
    
    #map {
      height: 50%; /* Fill the available height */
      width: 50%;  /* Fill the available width */
    }
  </style>
</head>
<body>
  <h1>Geofencing Example with Drawing and Real-time Location Tracking</h1>
  <div id="map"></div>
  <button onclick="checkGeofence()">Check Geofence</button>
  <button onclick="displayGeofences()">Display Geofences</button>
  
  <!-- Leaflet JS -->
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <!-- Leaflet Draw JS -->
  <script src="https://unpkg.com/leaflet-draw/dist/leaflet.draw.js"></script>
  <!-- Turf.js JS -->
  <script src="https://unpkg.com/@turf/turf/turf.min.js"></script>
  <script>
    var lastInsideGeofence = false;
    var geofenceLayers = []; // Array to hold geofence layers and their names

    // Initialize the map; use the device's width to determine zoom level
    function initializeMap() {
      var map = L.map('map').setView([14.5780, 121.0410], getInitialZoom());

      // Add a tile layer
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
      }).addTo(map);

      return map;
    }

    // Function to determine initial zoom level based on device width
    function getInitialZoom() {
      var width = window.innerWidth;
      if (width <= 480) return 11; // Mobile devices
      if (width <= 768) return 12; // Tablets
      return 13; // Desktops
    }

    var map = initializeMap();

    // Initialize Leaflet Draw control
    var drawnItems = L.featureGroup().addTo(map);
    var drawControl = new L.Control.Draw({
      edit: {
        featureGroup: drawnItems
      }
    });
    map.addControl(drawControl);

    // Function to load geofences from the server
    function loadGeofences() {
      fetch('controller/manageGeofence.php', {
          method: 'GET'
      })
      .then(response => response.json())
      .then(data => {
          data.forEach(function(geofence) {
              var geoJsonLayer = L.geoJSON(JSON.parse(geofence.geojson));
              geoJsonLayer.bindPopup(
                `<b>${geofence.name}</b><br><button onclick="deleteGeofence(${geofence.id})">Delete</button>`
              );
              drawnItems.addLayer(geoJsonLayer);

              // Store geofence name and layer
              geofenceLayers.push({ name: geofence.name, layer: geoJsonLayer });
          });
      })
      .catch(error => console.error('Error:', error));
    }

    // Load geofences on map load
    map.on('load', loadGeofences());

    // Event listener for when a shape is drawn
    map.on(L.Draw.Event.CREATED, function(event) {
      var layer = event.layer;
      drawnItems.addLayer(layer);

      var geoJson = layer.toGeoJSON();
      var geofenceName = prompt("Enter a name for the geofence:");

      if (geofenceName) {
        alert(JSON.stringify(geoJson));
        saveGeofence(geofenceName, geoJson);
      }
    });

    // Function to save a geofence to the server
    function saveGeofence(name, geoJson) {
      fetch('controller/manageGeofence.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          name: name,
          geojson: geoJson
        }),
      })
      .then(response => response.json())
      .then(data => {
        console.log('Geofence saved:', data);
      })
      .catch(error => console.error('Error:', error));
    }

    // Function to update a geofence
    function updateGeofence(id, updatedGeoJson) {
      fetch('controller/manageGeofence.php', {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          id: id,
          name: "Updated Name", // Optionally prompt for a new name
          geojson: updatedGeoJson
        }),
      })
      .then(response => response.json())
      .then(data => {
        console.log('Geofence updated:', data);
      })
      .catch(error => console.error('Error:', error));
    }

    // Function to delete a geofence
    function deleteGeofence(id) {
      fetch(`controller/manageGeofence.php?id=${id}`, {
        method: 'DELETE'
      })
      .then(response => response.json())
      .then(data => {
        console.log('Geofence deleted:', data);

        // Find and remove the corresponding layer from the map
        drawnItems.eachLayer(function(layer) {
          var geoJson = layer.toGeoJSON();
          
          // Assuming the ID is stored in the GeoJSON properties or you can match with the server response
          if (geoJson.properties && geoJson.properties.id === id) {
            drawnItems.removeLayer(layer);
          }
        });
      })
      .catch(error => console.error('Error:', error));
    }

    // Function to display all geofences in a list format in an alert
    function displayGeofences() {
      var geofenceNames = geofenceLayers.map(g => g.name);
      alert("Geofences:\n" + geofenceNames.join("\n"));
    }

    // Add a marker for the user's location
    var locationMarker;

    // Function to update the user's location marker
    function updateLocationMarker(lat, lng) {
      if (locationMarker) {
        map.removeLayer(locationMarker);
      }
      locationMarker = L.marker([lat, lng]).addTo(map)
        .bindPopup('Your location')
        .openPopup();
      map.setView([lat, lng], map.getZoom());  // Recenter the map on the user's location without changing the zoom level
    }

    // Track location in real-time
    function trackLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.watchPosition(function(position) {
          var lat = position.coords.latitude;
          var lng = position.coords.longitude;
          updateLocationMarker(lat, lng);
          checkGeofence(lat, lng);
        }, function(error) {
          alert('Error getting location: ' + error.message);
        }, {
          enableHighAccuracy: true,
          maximumAge: 1000,
          timeout: 5000
        });
      } else {
        alert('Geolocation is not supported by this browser.');
      }
    }

    // Function to check if the current location is within any of the defined geofences
    function checkGeofence(lat, lng) {
      var point = turf.point([lng, lat]); // Current location as a Turf point
      var insideAnyGeofence = false; // Flag to track if inside at least one geofence

      // Iterate over each geofence layer
      drawnItems.eachLayer(function(layer) {
        var geoJson = layer.toGeoJSON();
        console.log("Point: " + point);
        console.log("Point: " + JSON.stringify(geoJson));
        // Check if the current location is within the current geofence
        if (turf.booleanPointInPolygon(point, JSON.stringify(geoJson))) {
          insideAnyGeofence = true;
          return; // Exit the loop once we find that the location is inside at least one geofence
        }
      });

      // Alert user if inside at least one geofence, or if outside all geofences
      if (insideAnyGeofence && !lastInsideGeofence) {
        alert('You have entered a geofence');
      } else if (!insideAnyGeofence && lastInsideGeofence) {
        alert('You have exited the geofence');
      }

      lastInsideGeofence = insideAnyGeofence;
    }

    // Track location in real-time as soon as the page loads
    trackLocation();

    // Update the map height on window resize
    window.addEventListener('resize', function() {
      map.invalidateSize();
    });
  </script>
</body>
</html>
