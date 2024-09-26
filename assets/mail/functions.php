<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php'; // Assuming you're using Composer to manage PHPMailer

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $fullName = $_POST['FullName'];
    $age = $_POST['Age'];
    $emailAddress = $_POST['EmailAddress'];
    $contactNumber = $_POST['ContactNumber'];
    $attendClass = $_POST['AttendClass'];
    $aboutUs = $_POST['AboutUs'];

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();                                        // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                   // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                               // Enable SMTP authentication
        $mail->Username   = 'barefootraipur@gmail.com';             // SMTP username (your email address)
        $mail->Password   = 'achwxqozfxhvghdm';              // SMTP password (your email password)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;     // Enable TLS encryption
        $mail->Port       = 587;                                // TCP port to connect to

        // Recipients
        $mail->setFrom('barefootraipur@gmail.com', 'Barefoot');    // From email and name
        $mail->addAddress('barefootraipur@gmail.com');             // Add the recipient's email address

        // Content
        $mail->isHTML(true);                                    // Set email format to HTML
        $mail->Subject = 'Register Form from Barefoot Website';
        $mail->Body    = "
            <h2>Participate Register Form Details</h2>
            <p><strong>Full Name:</strong> $fullName</p>
            <p><strong>Age:</strong> $age</p>
            <p><strong>Email Address:</strong> $emailAddress</p>
            <p><strong>Contact Number:</strong> $contactNumber</p>
            <p><strong>Attended Self-Defense Classes:</strong> $attendClass</p>
            <p><strong>How did you hear about us?:</strong> $aboutUs</p>
        ";

        // Send email
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo 'Invalid request method.';
}
