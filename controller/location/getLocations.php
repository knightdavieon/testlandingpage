<?php
// getLocations.php
include('../db/connection.php');

header('Content-Type: application/json');



$result = $pdo->query('SELECT device_id, latitude, longitude FROM device_locations ORDER BY timestamp DESC');

if ($result->rowCount() > 0) {
  $locations = [];
  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $locations[] = $row;
  }
  echo json_encode($locations);
} else {
  echo json_encode([]);
}


?>
