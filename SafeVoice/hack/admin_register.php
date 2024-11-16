<?php
// Database connection
$servername = "localhost"; // Your database server
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "safvoice"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the data from the POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $admin_id = $_POST['admin_id'];
    $admin_code = $_POST['admin_code'];

    // Insert into admin_users table
    $stmt = $conn->prepare("INSERT INTO admin_users (admin_id, admin_code, created_at) VALUES (?, ?, NOW())");
    $stmt->bind_param("ss", $admin_id, $admin_code);
    
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Admin registered successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error: ' . $stmt->error]);
    }

    $stmt->close();
}
$conn->close();
?>
