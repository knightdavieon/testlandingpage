var lastInsideGeofence = false;
var currentGeofencesInside = []; // Array to keep track of geofences currently inside

var geofenceLayers = []; // Array to hold geofence layers and their names

// Initialize the map; use the device's width to determine zoom level
function initializeMap() {
  var map = L.map('map').setView([14.5780, 121.0410], getInitialZoom());

  // Add a tile layer
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxNativeZoom: 25,
    maxZoom: 24
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
//map.addControl(drawControl); // Uncomment to add the draw control to the map

// Function to load geofences from the server
function loadGeofences() {
  fetch('../controller/manageGeofence.php', {
    method: 'GET'
  })
    .then(response => response.json())
    .then(data => {
      geofenceLayers = []; // Clear existing layers
      data.forEach(function (geofence) {
        var geoJsonLayer = L.geoJSON(JSON.parse(geofence.geojson));
        geoJsonLayer.bindPopup(
          `<b>${geofence.name} ${geofence.high_risk}</b><br><button onclick="deleteGeofence(${geofence.id})">Delete</button>`
        );
        drawnItems.addLayer(geoJsonLayer);

        // Store geofence ID, name, and layer
        geofenceLayers.push({ id: geofence.id, name: geofence.name, page: geofence.page, layer: geoJsonLayer, highRisk: geofence.high_risk });
      });
    })
    .catch(error => console.error('Error:', error));
}

// Load geofences on map load
map.on('load', loadGeofences());

// Event listener for when a shape is drawn
map.on(L.Draw.Event.CREATED, function (event) {
  var layer = event.layer;
  drawnItems.addLayer(layer);

  var geoJson = layer.toGeoJSON();

  // Use SweetAlert2 to get the name of the geofence
  Swal.fire({
    title: 'Enter a name for the geofence',
    input: 'text',
    inputLabel: 'Geofence Name',
    inputPlaceholder: 'Enter the geofence name here...',
    showCancelButton: true,
    confirmButtonText: 'Save',
    cancelButtonText: 'Cancel',
    inputValidator: (value) => {
      if (!value) {
        return 'You need to enter a name!';
      }
    }
  }).then((result) => {
    if (result.isConfirmed) {
      var geofenceName = result.value;

      // Show the GeoJSON data
      Swal.fire({
        title: 'Geofence JSON',
        text: JSON.stringify(geoJson),
        icon: 'info',
        confirmButtonText: 'OK'
      });

      // Save the geofence
      saveGeofence(geofenceName, geoJson);
    }
  });
});

// Function to save a geofence to the server
function saveGeofence(name, geoJson) {
  fetch('../controller/manageGeofence.php', {
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
      loadGeofences(); // Reload geofences after saving
    })
    .catch(error => console.error('Error:', error));
}

// Function to update a geofence
function updateGeofence(id, updatedGeoJson) {
  fetch('../controller/manageGeofence.php', {
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
      loadGeofences(); // Reload geofences after updating
    })
    .catch(error => console.error('Error:', error));
}

// Function to delete a geofence
function deleteGeofence(id) {
  fetch(`../controller/manageGeofence.php?id=${id}`, {
    method: 'DELETE'
  })
    .then(response => response.json())
    .then(data => {
      console.log('Geofence deleted:', data);

      // Find and remove the corresponding layer from the map
      drawnItems.eachLayer(function (layer) {
        var geoJson = layer.toGeoJSON();

        // Assuming the ID is stored in the GeoJSON properties or you can match with the server response
        if (geoJson.properties && geoJson.properties.id === id) {
          drawnItems.removeLayer(layer);
        }
      });

      // Refresh the list of geofences
      loadGeofences();
    })
    .catch(error => console.error('Error:', error));
}

// Function to display all geofences in a list format using SweetAlert
function displayGeofences() {
  var geofenceNames = geofenceLayers.map(g => g.name);
  Swal.fire({
    title: 'Geofences',
    text: geofenceNames.join("\n"),
    icon: 'info',
    confirmButtonText: 'OK'
  });
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
    navigator.geolocation.watchPosition(function (position) {
      var lat = position.coords.latitude;
      var lng = position.coords.longitude;
      updateLocationMarker(lat, lng);
      checkGeofence(lat, lng);
    }, function (error) {
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



// Function to check if the current location is within any of the defined geofences
function checkGeofence(lat, lng) {
  var point = turf.point([lng, lat]); // Current location as a Turf point
  var insideAnyGeofence = false; // Flag to track if inside at least one geofence
  var geofencesInside = []; // Array to track which geofences the user is inside

  // Iterate over each geofence layer
  drawnItems.eachLayer(function (layer) {
    var geoJson = layer.toGeoJSON();
    let coordinates = geoJson.features[0].geometry.coordinates;
    let poly = { type: 'Polygon', coordinates: coordinates };

    // Check if the current location is within the current geofence
    if (turf.booleanPointInPolygon(point, poly)) {
      insideAnyGeofence = true;

      // Get the ID and name of the geofence
      let geofence = geofenceLayers.find(g => g.layer === layer);
      if (geofence) {
        geofencesInside.push({ id: geofence.id, name: geofence.name, page: geofence.page, highRisk: geofence.highRisk });
      }
    }
  });

  // Notify user if inside at least one geofence, or if outside all geofences
  if (insideAnyGeofence && !lastInsideGeofence) {

    let gname = geofencesInside.map(g => `${g.name}`);
    let page = geofencesInside.map(g => `${g.page}`);
    let risk = geofencesInside.map(g => `${g.highRisk}`);
    let message = '';
    console.log(gname)
    console.log(page)
    console.log(risk);
    if(sessionUserType == 'admin' || sessionUserType == 'sme'){
      if(risk == 'Y'){
        message = 'You are entering a high risk environment. Would you like to view informations about this room and all the tools and process for this room';
      }else{
        message = 'Would you like to view informations about this room and all the tools and process for this room';
      }
    }else{
      if(risk == 'Y'){
        message = 'You are entering a high risk environment, Please be informed that an SME will be contacting you shortly. for the meantime Would you like to view informations about this room and all the tools and process for this room';
      }else{
        message = 'Would you like to view informations about this room and all the tools and process for this room';
      }
      
    }

    // Swal.fire({
    //   title: 'You have entered ' + gname,
    //   text: message,
    //   icon: 'info',
    //   confirmButtonText: 'OK'
    // });

    Swal.fire({
      title: 'You have entered ' + gname,
      text: message,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes',
      cancelButtonText: 'No'
    }).then((result) => {
      if (result.isConfirmed) {
        // Countdown duration in milliseconds (e.g., 5 seconds)
        const countdownDuration = 5000; // 5000 ms = 5 seconds

        // Show countdown message
        Swal.fire({
          title: 'Redirecting in 5 seconds...',
          text: 'Please wait.',
          icon: 'info',
          timer: countdownDuration,
          timerProgressBar: true,
          didOpen: () => {
            Swal.showLoading();
          }
        });

        // Redirect after the countdown
        setTimeout(() => {
          window.location.href = '../pages/' + page + '.php'; // Replace with your URL
        }, countdownDuration);
      }
    });



  } else if (!insideAnyGeofence && lastInsideGeofence) {
    Swal.fire({
      title: 'Geofence Alert',
      text: 'You have exited all geofences',
      icon: 'info',
      confirmButtonText: 'OK'
    });
  }

  lastInsideGeofence = insideAnyGeofence;
}

// Track location in real-time as soon as the page loads
trackLocation();

// Update the map height on window resize
window.addEventListener('resize', function () {
  map.invalidateSize();
});
