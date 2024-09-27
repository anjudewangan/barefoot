<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $fullName = ucwords(strtolower($_POST['FullName']));
    $dateofBirth = $_POST['DateofBirth'];
    $emailAddress = strtolower($_POST['EmailAddress']);
    $contactNumber = $_POST['ContactNumber'];
    $attendClass = ucwords(strtolower($_POST['AttendClass']));
    $aboutUs = ucwords(strtolower($_POST['AboutUs']));

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'barefootraipur@gmail.com';
        $mail->Password   = 'achwxqozfxhvghdm';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('barefootraipur@gmail.com', 'Barefoot');
        $mail->addAddress('barefootraipur@gmail.com');

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Register Form from Barefoot Website';
        $mail->Body    = "
            <h2>Participate Register Form Details</h2>
            <p><strong>Full Name:</strong> $fullName</p>
            <p><strong>Date of Birth:</strong> $dateofBirth</p>
            <p><strong>Email Address:</strong> $emailAddress</p>
            <p><strong>Contact Number:</strong> $contactNumber</p>
            <p><strong>Attended Self-Defense Classes:</strong> $attendClass</p>
            <p><strong>How did you hear about us?:</strong> $aboutUs</p>
        ";

        // Send email
        $mail->send();

        // Return success message
        echo json_encode(['status' => 'success', 'message' => 'Form submitted successfully!']);
    } catch (Exception $e) {
        // Return error message
        echo json_encode(['status' => 'error', 'message' => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
