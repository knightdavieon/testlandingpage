<?php
// updateLocation.php
include('../db/connection.php');

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);


if (!isset($data['device_id']) || !isset($data['latitude']) || !isset($data['longitude'])) {
  http_response_code(400);
  echo json_encode(['error' => 'Invalid input']);
  exit;
}

$device_id = $data['device_id'];
$latitude = $data['latitude'];
$longitude = $data['longitude'];




$stmt = $pdo->prepare('INSERT INTO device_locations (device_id, latitude, longitude) VALUES (?, ?, ?)');
// Bind parameters using bindValue
$stmt->bindValue(1, $device_id, PDO::PARAM_STR); // Bind device_id as a string
$stmt->bindValue(2, $latitude, PDO::PARAM_STR);  // Bind latitude as a string (or use PDO::PARAM_INT if it's an integer)
$stmt->bindValue(3, $longitude, PDO::PARAM_STR); // Bind longitude as a string (or use PDO::PARAM_INT if it's an integer)

if ($stmt->execute()) {
  echo json_encode(['success' => true]);
} else {
  http_response_code(500);
  echo json_encode(['error' => 'Failed to update location']);
}


?>
