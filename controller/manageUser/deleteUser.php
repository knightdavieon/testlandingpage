<?php
// update_page.php
header('Content-Type: application/json');
include('../db/connection.php');

$id = $_POST['id'];


// Perform your database update logic here
// Example:
$update_query = "DELETE FROM users WHERE id = ?";
$stmt = $pdo->prepare($update_query);


if ($stmt->execute([$id])) {
    echo json_encode([
        'status' => 'success',
        'message' => 'User deleted successfully'
    ]);
  } else {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to delete fence']);
  }
// $response = [
//     'status' => 'success',
//     'message' => 'Page updated successfully'
// ];

//echo json_encode($response);
?>
