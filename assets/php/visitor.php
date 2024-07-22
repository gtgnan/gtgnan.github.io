<?php
// Database connection details
$servername = "localhost";
$username = "gtgnan";
$password = "Gnan@gatech_centergy#";
$dbname = "gnan_count";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the visitor's IP address
$ip_address = $_SERVER['REMOTE_ADDR'];
// Get the current date
$visit_date = date('Y-m-d');

// Check if the visitor has already visited today
$sql = "SELECT * FROM visitor_logs WHERE ip_address = ? AND visit_date = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $ip_address, $visit_date);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Visitor has already visited today, update the visit count
    $sql = "UPDATE visitor_logs SET visit_count = visit_count + 1 WHERE ip_address = ? AND visit_date = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $ip_address, $visit_date);
    $stmt->execute();
} else {
    // New visit, insert a new record
    $sql = "INSERT INTO visitor_logs (ip_address, visit_date) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $ip_address, $visit_date);
    $stmt->execute();
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
