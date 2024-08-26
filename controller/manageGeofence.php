<?php
$host = '3.26.76.229';
$db = 'geofencing_db';
$user = 'localphp';
$pass = 'password';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        // Read geofences
        $stmt = $pdo->query('SELECT * FROM geofences');
        $geofences = $stmt->fetchAll();
        echo json_encode($geofences);
        break;

    case 'POST':
        // Create a new geofence
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $pdo->prepare('INSERT INTO geofences (name, geojson) VALUES (:name, :geojson)');
        $stmt->execute(['name' => $data['name'], 'geojson' => json_encode($data['geojson'])]);
        echo json_encode(['id' => $pdo->lastInsertId()]);
        break;

    case 'PUT':
        // Update a geofence
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $pdo->prepare('UPDATE geofences SET name = :name, geojson = :geojson WHERE id = :id');
        $stmt->execute(['name' => $data['name'], 'geojson' => json_encode($data['geojson']), 'id' => $data['id']]);
        echo json_encode(['status' => 'success']);
        break;

    case 'DELETE':
        // Delete a geofence
        $id = $_GET['id'];
        $stmt = $pdo->prepare('DELETE FROM geofences WHERE id = :id');
        $stmt->execute(['id' => $id]);
        echo json_encode(['status' => 'success']);
        break;
}
