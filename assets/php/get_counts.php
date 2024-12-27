<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

// Database connection
$servername = "localhost";
$username = "root";
$password = "Sunny@1812";
$dbname = "skill_vault";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $conn->query("SELECT COUNT(*) as count FROM students");
    $studentCount = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    
    $response = [
        'userCount' => intval($studentCount),
        'placedCount' => 50
    ];
    
    echo json_encode($response);
    exit;
    
} catch(PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
    exit;
}
?>
