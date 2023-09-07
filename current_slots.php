<?php

// Allow CORS
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

// Create a PDO connection to the MySQL database
$db_host = "localhost"; // Change this to your database host name
$db_name = "essencef_P8zITA5K"; // Change this to your database name
$db_user = "essencef_P8zITA5K"; // Change this to your database username
$db_pass = "hMuezQIefamF"; // Change this to your database password
$db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);

// Set the response content type to JSON
header('Content-Type: application/json');

// Check if the "date" parameter is present in the URL
if (!isset($_GET['date'])) {
    echo json_encode(['status' => false, 'message' => 'Date parameter is missing.']);
    exit;
}

// Get the "date" parameter from the URL
$date = $_GET['date'];

// Prepare an SQL query to select all appointment slots for the given date
$query = "SELECT appointment_slot FROM appointments WHERE appointment_date = :date";
$stmt = $db->prepare($query);
$stmt->bindParam(':date', $date);
$stmt->execute();

// Fetch all rows as an array of strings
$slots = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Return the array of slots as JSON
echo json_encode(['status' => true, 'slots' => $slots]);

?>