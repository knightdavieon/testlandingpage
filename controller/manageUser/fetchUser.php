<?php
header('Content-Type: application/json');

include('../db/connection.php');


// Create a new PDO instance
try {
    
    // Query to fetch data
    $stmt = $pdo->query('SELECT * FROM users');
    
    // Fetch data
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Output data as JSON
    echo json_encode([
        'data' => $data
    ]);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>