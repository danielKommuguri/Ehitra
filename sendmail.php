<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form data
   $name = strip_tags(trim($_POST["name"] ?? ""));
$email = filter_var(trim($_POST["email"] ?? ""), FILTER_SANITIZE_EMAIL);
$phone = strip_tags(trim($_POST["phone"] ?? ""));
$subject = strip_tags(trim($_POST["subject"] ?? ""));
$message = strip_tags(trim($_POST["message"] ?? ""));

    // Validate required fields
   if (
    empty($name) ||
    empty($email) ||
    empty($phone) ||
    empty($subject) ||
    empty($message) ||
    !filter_var($email, FILTER_VALIDATE_EMAIL)
) {
    echo "Please enter valid details.";
    exit;
}

    // Admin Email
    $recipient = "info@ehitratechnologies.com";

    // Mail Subject
    $mail_subject = "New Contact Form Submission from $name";

    // Mail Body
    $email_content  = "Name: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Phone: $phone\n";
    $email_content .= "Subject: $subject\n\n";
    $email_content .= "Message:\n$message\n";

    // Headers
    $headers = "From: EHITRA Technologies <no-reply@ehitratechnologies.com>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Send Mail
    $mail_sent = mail(
        $recipient,
        $mail_subject,
        $email_content,
        $headers
    );

    if ($mail_sent) {

        // Success response for AJAX
        echo "success";

    } else {

        // Failure response for AJAX
        echo "Failed to send email.";

    }

} else {

    echo "Invalid request.";

}

?>