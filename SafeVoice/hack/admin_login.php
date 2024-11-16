<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "safvoice";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the data from the POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $admin_id = $_POST['admin_id'];
    $admin_code = $_POST['admin_code'];

    // Validate admin credentials
    $stmt = $conn->prepare("SELECT * FROM admin_users WHERE admin_id = ? AND admin_code = ?");
    $stmt->bind_param("ss", $admin_id, $admin_code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Admin authenticated successfully
        echo json_encode(['status' => 'success', 'message' => 'Login successful.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid credentials.']);
    }

    $stmt->close();
}
$conn->close();
?>
