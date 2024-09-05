<script>
var deviceMarkers = {}; // Store markers for each device

// Function to send the current location to the server
function sendLocationUpdate(lat, lng) {
  var deviceId = 'unique-device-id'; // Replace with actual device ID or some unique identifier
  
  fetch('updateLocation.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({
      device_id: deviceId,
      latitude: lat,
      longitude: lng
    }),
  })
  .then(response => response.json())
  .then(data => {
    console.log('Location update response:', data);
  })
  .catch(error => console.error('Error:', error));
}

// Function to update the map with locations from multiple devices
function updateDeviceMarkers() {
  fetch('getLocations.php')
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

// Track location in real-time as soon as the page loads
function trackLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.watchPosition(function(position) {
      var lat = position.coords.latitude;
      var lng = position.coords.longitude;
      updateLocationMarker(lat, lng);
      sendLocationUpdate(lat, lng);
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

trackLocation(); // Start tracking when the page loads

</script>