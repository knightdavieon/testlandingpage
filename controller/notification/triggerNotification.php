<?php
include('../db/connection.php');

//http://localhost:88//controller/notification/triggerNotification.php?notifto=testname&notiffrom=1212&&message=I will be there in a few minutes

// Check if 'name' and 'age' parameters exist in the URL
if (isset($_GET['notifto']) && isset($_GET['notiffrom']) && isset($_GET['message']) ) {
    // Get the values from the URL
    $notifto = htmlspecialchars($_GET['notifto']); 
    $notiffrom = htmlspecialchars($_GET['notiffrom']); 
    $message = htmlspecialchars($_GET['message']); 
    $dateTime = date('Y-m-d H:i:s'); 
} else {
    echo "No parameters found in the URL.";
}


try {
    // Prepare the SQL statement
    $stmt = $pdo->prepare("INSERT INTO notifications (notif_to, notif_from, message, timestamp) VALUES (:notifto, :notiffrom, :message, :datetime)");
    
    // Bind parameters
    $stmt->bindParam(':notifto', $notifto);
    $stmt->bindParam(':notiffrom', $notiffrom);
    $stmt->bindParam(':message', $message);
    $stmt->bindParam(':datetime', $dateTime);
    
    // Execute the statement
    $stmt->execute();
    
    echo json_encode(['status' => 'success', 'message' => 'User created successfully']);
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Failed to insert data']);
}
?>
