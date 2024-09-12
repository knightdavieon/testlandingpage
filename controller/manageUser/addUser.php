<?php
include('../db/connection.php');

// Get the form data
$firstName = isset($_POST['firstName']) ? $_POST['firstName'] : '';
$lastName = isset($_POST['lastName']) ? $_POST['lastName'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$type = isset($_POST['type']) ? $_POST['type'] : '';

// $firstName = 'test';
// $lastName = 'test';
// $email = 'test@test';
// $password = 'test';
// $type = 'test';

//echo $firstName . ' ' . $lastName . ' ' . $email . ' ' . $password . ' ' . $type . ' ';

// Validate the form data
if (empty($firstName) || empty($lastName) || empty($email) || empty($password) || empty($type)) {
    echo json_encode(['status' => 'error', 'message' => 'All fields are required']);
    exit;
}

// Hash the password for storage
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

try {
    // Prepare the SQL statement
    $stmt = $pdo->prepare("INSERT INTO users (firstname, lastname, email, password, usertype) VALUES (:first_name, :last_name, :email, :password, :type)");
    
    // Bind parameters
    $stmt->bindParam(':first_name', $firstName);
    $stmt->bindParam(':last_name', $lastName);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hashedPassword);
    $stmt->bindParam(':type', $type);
    
    // Execute the statement
    $stmt->execute();
    
    echo json_encode(['status' => 'success', 'message' => 'User created successfully']);
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Failed to insert data']);
}
?>
