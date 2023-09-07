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
$db_name = "essencef_P8zITA5K"; // Change this to your database name
$db_user = "essencef_P8zITA5K"; // Change this to your database username
$db_pass = "hMuezQIefamF"; // Change this to your database password
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



// Use PHPMailer library to send email
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/Exception.php';
require './PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host = 'smtp.hostinger.com';
$mail->SMTPAuth = true;
$mail->Username = 'dev.kamal@algominds.tech';
$mail->Password = 'Kamal@05963';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;

$mail->setFrom('dev.kamal@algominds.tech', 'Kamal Joshi');
$mail->addAddress($email);
$mail->Subject = 'Test Email';
$mail->Body = 'This is a test email sent using PHPMailer.';

try{
    // Execute the SQL query to insert the appointment details into the "appointments" table
    $stmt->execute();

    // Send the email using PHPMailer
   if($mail->send()) {
        echo json_encode(['status' =>true ,'message' => 'Email sent successfully.']);
    } else {
        echo json_encode(['status' =>false ,'message' => $mail->ErrorInfo]);
    }
}
catch(\Exception $e)
{
    echo json_encode(['status' =>false ,'message' => $e->getMessage()]);
}

?>