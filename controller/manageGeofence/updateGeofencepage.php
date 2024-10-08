<?php
// update_page.php
header('Content-Type: application/json');
include('../db/connection.php');

$id = $_POST['id'];
$page = $_POST['page'];
$high_risk = $_POST['high_risk'];

// Perform your database update logic here
// Example:
$update_query = "UPDATE geofences SET page = ?, high_risk = ? WHERE id = ?";
$stmt = $pdo->prepare($update_query);
//$stmt->execute([$page, $id]);

if ($stmt->execute([$page, $high_risk, $id])) {
    echo json_encode([
        'status' => 'success',
        'message' => 'Page set successfully'
    ]);
  } else {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to set page']);
  }

// $response = [
//     'status' => 'success',
//     'message' => 'Page updated successfully'
// ];

// echo json_encode($response);
?>
