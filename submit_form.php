<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $age = intval(trim($_POST["age"]));
    $gender = strip_tags(trim($_POST["gender"]));
    $message = strip_tags(trim($_POST["message"]));

    // Check that data was sent to the mailer.
    if (empty($name) OR empty($email) OR empty($age) OR empty($gender) OR empty($message)) {
        http_response_code(400);
        echo "Please fill out all fields.";
        exit;
    }

    // Set the recipient email address.
    $recipient = "ahmed.khamis15@yahoo.com";

    // Set the email subject.
    $subject = "New contact from $name";

    // Build the email content.
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Age: $age\n";
    $email_content .= "Gender: $gender\n";
    $email_content .= "Message:\n$message\n";

    // Build the email headers.
    $email_headers = "From: $name <$email>";

    // Send the email.
    if (mail($recipient, $subject, $email_content, $email_headers)) {
        http_response_code(200);
        echo "Thank you! Your message has been sent.";
    } else {
        http_response_code(500);
        echo "Oops! Something went wrong and we couldn't send your message.";
    }
} else {
    http_response_code(405);
    echo "Method Not Allowed";
}
?>