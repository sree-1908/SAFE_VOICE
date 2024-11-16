<?php
header('Content-Type: application/json');

// Database connection settings
$host = 'localhost'; // Your database host
$db = 'safvoice'; // Your database name
$user = 'root'; // Your database username
$pass = ''; // Your database password

// Create a database connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Database connection failed: ' . $conn->connect_error]));
}

// Get the JSON data from the request
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['location']) && isset($data['criticality'])) {
    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO reports (location, criticality, description) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $data['location'], $data['criticality'], $data['description']);

    // Execute the statement
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Report submitted successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error executing query: ' . $stmt->error]);
    }

    // Close the statement
    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid input data.']);
}

// Close the database connection
$conn->close();
?>
