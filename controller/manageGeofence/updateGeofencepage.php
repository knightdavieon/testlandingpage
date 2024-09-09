<?php
// update_page.php
header('Content-Type: application/json');
include('../db/connection.php');

$id = $_POST['id'];
$page = $_POST['page'];

// Perform your database update logic here
// Example:
$update_query = "UPDATE geofences SET page = ? WHERE id = ?";
$stmt = $pdo->prepare($update_query);
//$stmt->execute([$page, $id]);

if ($stmt->execute([$page, $id])) {
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
