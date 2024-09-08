<?php session_start(); ?>

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
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }
    #map {
      height: 100%;
      width: 100%;
    }
  </style>
</head>
<body>
  <h1>Geofencing Example with Drawing and Real-time Location Tracking</h1>
  <div id="map"></div>
  <button onclick="checkGeofence()">Check Geofence</button>
  <button onclick="displayGeofences()">Display Geofences</button>
  <button onclick="showActiveDevices()">Show Active Devices</button>
  
  <!-- Leaflet JS -->
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <!-- Leaflet Draw JS -->
  <script src="https://unpkg.com/leaflet-draw/dist/leaflet.draw.js"></script>
  <!-- Turf.js JS -->
  <script src="https://unpkg.com/@turf/turf/turf.min.js"></script>
  <!-- SweetAlert2 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <!-- SweetAlert2 JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

  <script>
    var deviceId = <?php echo json_encode($_SESSION['email'] ?? ''); ?>;
    if (!deviceId) {
      Swal.fire({
        title: 'Session Expired',
        text: 'You need to log in again.',
        icon: 'warning',
        timer: 5000,
        timerProgressBar: true,
        willClose: () => {
          window.location.href = '/';
        }
      });
    }

    var lastInsideGeofence = false;
    var geofenceLayers = [];
    var deviceMarkers = {};

    function initializeMap() {
      var map = L.map('map').setView([14.5780, 121.0410], getInitialZoom());
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
      }).addTo(map);
      return map;
    }

    function getInitialZoom() {
      var width = window.innerWidth;
      if (width <= 480) return 11;
      if (width <= 768) return 12;
      return 13;
    }

    var map = initializeMap();

    var drawnItems = L.featureGroup().addTo(map);
    var drawControl = new L.Control.Draw({
      edit: { featureGroup: drawnItems }
    });
    //map.addControl(drawControl);

    function loadGeofences() {
      fetch('controller/manageGeofence.php', { method: 'GET' })
      .then(response => response.json())
      .then(data => {
        data.forEach(function(geofence) {
          var geoJsonLayer = L.geoJSON(JSON.parse(geofence.geojson));
          geoJsonLayer.bindPopup(
            `<b>${geofence.name}</b><br><button onclick="deleteGeofence(${geofence.id})">Delete</button>`
          );
          drawnItems.addLayer(geoJsonLayer);
          geofenceLayers.push({ name: geofence.name, layer: geoJsonLayer });
        });
      })
      .catch(error => console.error('Error:', error));
    }

    map.whenReady(loadGeofences);

    map.on(L.Draw.Event.CREATED, function(event) {
      var layer = event.layer;
      drawnItems.addLayer(layer);
      var geoJson = layer.toGeoJSON();
      Swal.fire({
        title: 'Enter a name for the geofence',
        input: 'text',
        inputLabel: 'Geofence Name',
        inputPlaceholder: 'Enter the geofence name here...',
        showCancelButton: true,
        confirmButtonText: 'Save',
        cancelButtonText: 'Cancel',
        inputValidator: (value) => {
          if (!value) return 'You need to enter a name!';
        }
      }).then((result) => {
        if (result.isConfirmed) {
          var geofenceName = result.value;
          Swal.fire({
            title: 'Geofence JSON',
            text: JSON.stringify(geoJson),
            icon: 'info',
            confirmButtonText: 'OK'
          });
          saveGeofence(geofenceName, geoJson);
        }
      });
    });

    function saveGeofence(name, geoJson) {
      fetch('controller/manageGeofence.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ name: name, geojson: geoJson }),
      })
      .then(response => response.json())
      .then(data => {
        console.log('Geofence saved:', data);
      })
      .catch(error => console.error('Error:', error));
    }

    function updateGeofence(id, updatedGeoJson) {
      fetch('controller/manageGeofence.php', {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id: id, name: "Updated Name", geojson: updatedGeoJson }),
      })
      .then(response => response.json())
      .then(data => {
        console.log('Geofence updated:', data);
      })
      .catch(error => console.error('Error:', error));
    }

    function deleteGeofence(id) {
      fetch(`controller/manageGeofence.php?id=${id}`, { method: 'DELETE' })
      .then(response => response.json())
      .then(data => {
        console.log('Geofence deleted:', data);
        drawnItems.eachLayer(function(layer) {
          var geoJson = layer.toGeoJSON();
          if (geoJson.properties && geoJson.properties.id === id) {
            drawnItems.removeLayer(layer);
          }
        });
      })
      .catch(error => console.error('Error:', error));
    }

    function displayGeofences() {
      var geofenceNames = geofenceLayers.map(g => g.name);
      Swal.fire({
        title: 'Geofences',
        text: geofenceNames.join("\n"),
        icon: 'info',
        confirmButtonText: 'OK'
      });
    }

    function updateLocationMarker(lat, lng) {
      if (locationMarker) {
        map.removeLayer(locationMarker);
      }
      locationMarker = L.marker([lat, lng]).addTo(map)
        .bindPopup('Your location')
        .openPopup();
      map.setView([lat, lng], map.getZoom());
    }

    function sendLocationUpdate(lat, lng) {
      if (!deviceId) return;
      fetch('controller/location/updateLocation.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ device_id: deviceId, latitude: lat, longitude: lng }),
      })
      .then(response => response.json())
      .then(data => {
        console.log('Location update response:', data);
      })
      .catch(error => console.error('Error:', error));
    }

    function updateDeviceMarkers() {
      fetch('controller/location/getLocations.php')
        .then(response => response.json())
        .then(data => {
          data.forEach(location => {
            if (!deviceMarkers[location.device_id]) {
              deviceMarkers[location.device_id] = L.marker([location.latitude, location.longitude]).addTo(map)
                .bindPopup(`Device ID: ${location.device_id}`)
                .openPopup();
            } else {
              deviceMarkers[location.device_id].setLatLng([location.latitude, location.longitude]);
            }
          });
        })
        .catch(error => console.error('Error:', error));
    }

    function showActiveDevices() {
      fetch('controller/location/getActiveDevices.php')
        .then(response => response.json())
        .then(data => {
          Object.values(deviceMarkers).forEach(marker => map.removeLayer(marker)); // Clear existing markers
          data.forEach(device => {
            var deviceId = device.id; // Replace with actual device ID field from your API
            var latitude = device.latitude;
            var longitude = device.longitude;

            var marker = L.marker([latitude, longitude]).addTo(map)
              .bindPopup(`Device ID: ${deviceId}`)
              .openPopup();

            deviceMarkers[deviceId] = marker;
          });
        })
        .catch(error => console.error('Error:', error));
    }

    function trackLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.watchPosition(function(position) {
          var lat = position.coords.latitude;
          var lng = position.coords.longitude;
          updateLocationMarker(lat, lng);
          sendLocationUpdate(lat, lng);
          checkGeofence(lat, lng);
          updateDeviceMarkers();
        }, function(error) {
          Swal.fire({
            title: 'Location Error',
            text: 'Error getting location: ' + error.message,
            icon: 'error',
            confirmButtonText: 'OK'
          });
        }, {
          enableHighAccuracy: true,
          maximumAge: 1000,
          timeout: 5000
        });
      } else {
        Swal.fire({
          title: 'Geolocation Error',
          text: 'Geolocation is not supported by this browser.',
          icon: 'error',
          confirmButtonText: 'OK'
        });
      }
    }

    function checkGeofence(lat, lng) {
      var point = turf.point([lng, lat]);
      var insideAnyGeofence = false;

      drawnItems.eachLayer(function(layer) {
        var geoJson = layer.toGeoJSON();
        let coordinates = geoJson.features[0].geometry.coordinates;
        let poly = { type: 'Polygon', coordinates: coordinates }
        if (turf.booleanPointInPolygon(point, poly)) {
          insideAnyGeofence = true;
          return;
        }
      });

      if (insideAnyGeofence && !lastInsideGeofence) {
        Swal.fire({
          title: 'Geofence Alert',
          text: 'You have entered a geofence',
          icon: 'info',
          confirmButtonText: 'OK'
        });
      } else if (!insideAnyGeofence && lastInsideGeofence) {
        Swal.fire({
          title: 'Geofence Alert',
          text: 'You have exited the geofence',
          icon: 'info',
          confirmButtonText: 'OK'
        });
      }

      lastInsideGeofence = insideAnyGeofence;
    }

    trackLocation();

    window.addEventListener('resize', function() {
      map.invalidateSize();
    });
  </script>
</body>
</html>
