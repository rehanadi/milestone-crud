<?php
$servername = "localhost";
$username = "root";
$password = "perumnas3";
$dbname = "milestone";

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>