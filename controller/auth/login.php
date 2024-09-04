<?php
// login.php

// Start the session
session_start();
include('../db/connection.php');
// Database connection parameters
// $host = 'localhost';
// $dbname = 'your_database';
// $username = 'your_db_username';
// $password = 'your_db_password';

// // Connect to the database
// try {
//     $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
//     echo 'Connection failed: ' . $e->getMessage();
//     exit;
// }



// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form input
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute SQL query
    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verify password
    if ($user && password_verify($password, $user['password'])) {
        // Set session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];

        // Success response
        echo json_encode(['status' => 'success', 'message' => 'Login successful']);
    } else {
        // Error response
        echo json_encode(['status' => 'error', 'message' => 'Invalid email or password']);
    }
}
?>
