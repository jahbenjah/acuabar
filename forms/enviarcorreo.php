<?php

require_once __DIR__ . '/_support.php';

try {
    $name = post_value('name');
    $email = filter_var(post_value('email'), FILTER_VALIDATE_EMAIL);
    $subject = post_value('subject');
    $message = post_value('message');

    if ($name === '' || $email === false || $subject === '' || $message === '') {
        respond('error', 'Please complete every field with a valid email address.', 400);
        exit;
    }

    if (!verify_recaptcha('contact')) {
        respond('error', 'The security check could not be verified. Please try again.', 400);
        exit;
    }

    $body = 'Name: ' . escape_mail($name)
        . '<br>Email: ' . escape_mail($email)
        . '<br>Subject: ' . escape_mail($subject)
        . '<br>Message:<br>' . nl2br(escape_mail($message));

    send_acuabar_email('Website contact request', $body, $email);
    respond('ok', 'Your message has been sent.', 200);
} catch (Throwable $error) {
    error_log('Contact form error: ' . $error->getMessage());
    respond('error', 'We could not send your message right now. Please call us or try again later.', 503);
}
