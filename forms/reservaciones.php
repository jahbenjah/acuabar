<?php

require_once __DIR__ . '/_support.php';

try {
    $name = post_value('name');
    $email = filter_var(post_value('email'), FILTER_VALIDATE_EMAIL);
    $phone = post_value('phone');
    $date = post_value('date');
    $time = post_value('time');
    $people = filter_var(post_value('people'), FILTER_VALIDATE_INT, [
        'options' => ['min_range' => 1],
    ]);
    $message = post_value('message');

    $reservationDate = DateTimeImmutable::createFromFormat('!Y-m-d', $date);
    $validDate = $reservationDate !== false
        && $reservationDate->format('Y-m-d') === $date
        && $reservationDate >= new DateTimeImmutable('today');
    $validTime = preg_match('/^(?:[01]\d|2[0-3]):[0-5]\d$/', $time) === 1;
    $hour = $validTime ? (int) substr($time, 0, 2) : -1;
    $withinBusinessHours = $hour >= 8 || $hour < 2;

    if (
        $name === ''
        || $email === false
        || $phone === ''
        || !$validDate
        || !$validTime
        || !$withinBusinessHours
        || $people === false
    ) {
        respond('error', 'Please check the required fields, contact details, and reservation time.', 400);
        exit;
    }

    if (!verify_recaptcha('reservation')) {
        respond('error', 'The security check could not be verified. Please try again.', 400);
        exit;
    }

    $body = 'Name: ' . escape_mail($name)
        . '<br>Email: ' . escape_mail($email)
        . '<br>Phone: ' . escape_mail($phone)
        . '<br>Date: ' . escape_mail($date)
        . '<br>Time: ' . escape_mail($time)
        . '<br>People: ' . escape_mail((string) $people)
        . '<br>Message:<br>' . nl2br(escape_mail($message));

    send_acuabar_email('Website table request', $body, $email);
    respond('ok', 'Your request was sent. We will contact you to confirm.', 200);
} catch (Throwable $error) {
    error_log('Reservation form error: ' . $error->getMessage());
    respond('error', 'We could not send your request right now. Please call us or try again later.', 503);
}
