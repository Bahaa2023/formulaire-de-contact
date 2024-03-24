<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Include Composer's autoloader

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    //  It creates a new instance of the PHPMailer class ,This instance will be used to send the email.
    
    $mail = new PHPMailer(true);
    // Here's why setting it to true is useful: Error Handling: Debugging:Throwing exceptions provides detailed 
    // error messages that can help you diagnose issues with email sending.  Clarity:

    try {
        // Server settings
        $mail->SMTPDebug = 0;     // Disabling Debug Output: Setting $mail->SMTPDebug = 0; disables this verbose debug 
                                 // This can be useful in production environments or when you don't need detailed debugging information.
        
        $mail->isSMTP();                            // Send using SMTP
        $mail->Host       = 'localhost';            // Set the SMTP server to localhost
        $mail->SMTPAuth   = false;                  // SMTP authentication is not required
        $mail->Port       = 1025;                   // Port to which MailDev is listening
       $mail->SMTPSecure = false;   // explicitly disables the use of SMTP encryption. This means that PHPMailer will not attempt to use 
                                    //  encryption when communicating with the SMTP server.
        
        // Recipients
        $mail->setFrom($email, $name);             // Set sender's email and name
        $mail->addAddress('bahaajaber@hotmail.com', 'Bahaa');     // Add a recipient

        // Content
        $mail->isHTML(true);                        // Set email format to HTML
        $mail->Subject = 'New message';
        $mail->Body    = $message;

        // Send email
        $mail->send();
        echo '<p>Your message has been sent, we will get back to you shortly</p>';

    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    // If the form is not submitted, redirect the user back to the form page
    header("Location: contact.html");
    exit;
}
?>
