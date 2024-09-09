<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Real-Time Location Tracking</title>
  <!-- Leaflet CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <style>
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }
    #map {
      height: 100%; /* Fill the available height */
      width: 100%;  /* Fill the available width */
    }
  </style>
</head>
<body>
  <h1>Real-Time Location Tracking for All Devices</h1>
  <div id="map"></div>
  <button onclick="showActiveDevices()">Show Active Devices</button>
  
  <!-- Leaflet JS -->
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <!-- SweetAlert2 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <!-- SweetAlert2 JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

  <script>
    var map = L.map('map').setView([14.5780, 121.0410], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    var deviceMarkers = {}; // Store markers for each device

    // Function to fetch and display active devices
    function showActiveDevices() {
      fetch('controller/location/getActiveDevices.php') // Ensure this endpoint returns active devices
        .then(response => response.json())
        .then(data => {
          // Clear existing markers
          Object.values(deviceMarkers).forEach(marker => map.removeLayer(marker));
          deviceMarkers = {}; // Reset deviceMarkers

          data.forEach(device => {
            var deviceId = device.device_id;
            var lat = device.latitude;
            var lng = device.longitude;

            var marker = L.marker([lat, lng]).addTo(map)
              .bindPopup(`Device ID: ${deviceId}`)
              .openPopup();

            deviceMarkers[deviceId] = marker;
          });
        })
        .catch(error => console.error('Error:', error));
    }

    // Function to update device locations in real-time
    function updateDeviceMarkers() {
      fetch('controller/location/getLocations.php') // Fetch all device locations
        .then(response => response.json())
        .then(data => {
          // Clear existing markers
          Object.values(deviceMarkers).forEach(marker => map.removeLayer(marker));
          deviceMarkers = {}; // Reset deviceMarkers

          data.forEach(location => {
            var deviceId = location.device_id;
            var lat = location.latitude;
            var lng = location.longitude;

            var marker = L.marker([lat, lng]).addTo(map)
              .bindPopup(`Device ID: ${deviceId}`)
              .openPopup();

            deviceMarkers[deviceId] = marker;
          });
        })
        .catch(error => console.error('Error:', error));
    }

    // Function to track location in real-time
    function trackLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.watchPosition(function(position) {
          var lat = position.coords.latitude;
          var lng = position.coords.longitude;
          // Update your own location marker here if needed
          updateDeviceMarkers(); // Update markers for all devices
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

    trackLocation(); // Start tracking location
    setInterval(updateDeviceMarkers, 5000); // Update device markers every 5 seconds

    window.addEventListener('resize', function() {
      map.invalidateSize(); // Adjust map size on window resize
    });
  </script>
</body>
</html>
