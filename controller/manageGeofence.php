<?php
include('../db/connection.php');

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
