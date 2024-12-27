<?php
$conn = new mysqli("localhost", "root", "Sunny@1812", "skill_vault");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
