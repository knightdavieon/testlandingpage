<?php

// Set header for JSON output
header('Content-Type: application/json');

// Function to fetch active devices from the database
function getActiveDevices($pdo) {
    $query = "SELECT device_id, latitude, longitude FROM devices WHERE status = 'active'"; // Adjust query based on your schema
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

try {
    // Create a new PDO instance
    $pdo = new PDO($dsn, $user, $pass, $options);

    // Fetch active devices
    $activeDevices = getActiveDevices($pdo);

    // Output the data in JSON format
    echo json_encode($activeDevices);
} catch (\PDOException $e) {
    // Handle any errors
    http_response_code(500);
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
?>