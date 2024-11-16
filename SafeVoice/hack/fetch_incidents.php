<?php
// Database connection settings
$host = "localhost"; // Your database host
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$database = "safvoice"; // Your database name

// Create a connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch incidents
$sql = "SELECT location, criticality, description FROM incidents"; // Adjust the table name as needed
$result = $conn->query($sql);

$incidents = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $incidents[] = $row;
    }
}

// Return response
header('Content-Type: application/json');
echo json_encode(['success' => true, 'incidents' => $incidents]);

$conn->close();
?>
