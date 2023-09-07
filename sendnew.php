<?php

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$color = $_POST['color'];
$appointment_date = $_POST['appointment_date'];
$appointment_slot= $_POST['appointment_slot'];
$model_name= $_POST['model_name'];

// Create a PDO connection to the MySQL database
$db_host = "localhost"; // Change this to your database host name
$db_name = "u696302193_Form"; // Change this to your database name
$db_user = "u696302193_Form"; // Change this to your database username
$db_pass = "Form@05963"; // Change this to your database password
$db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);

// Prepare an SQL query to insert the appointment details into the "appointments" table
$query = "INSERT INTO appointments (first_name, last_name, email, color, appointment_date,appointment_slot, model_name) VALUES (:first_name, :last_name, :email, :color, :appointment_date,:appointment_slot, :model_name)";
$stmt = $db->prepare($query);
$stmt->bindParam(':first_name', $first_name);
$stmt->bindParam(':last_name', $last_name);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':color', $color);
$stmt->bindParam(':appointment_date', $appointment_date);
$stmt->bindParam(':appointment_slot', $appointment_slot);
$stmt->bindParam(':model_name', $model_name);

try{
    // Execute the SQL query to insert the appointment details into the "appointments" table
    $stmt->execute();
}
catch(\Exception $e)
{
    echo json_encode(['status' =>false ,'message' => $e->getMessage()]);
}

?>