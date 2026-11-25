<?php

require_once __DIR__ . '/../lib/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../lib/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;

function required_env(string $name): string
{
    $value = getenv($name);
    if ($value === false || $value === '') {
        throw new RuntimeException("Required server configuration is missing: {$name}");
    }

    return $value;
}

function post_value(string $name): string
{
    $value = $_POST[$name] ?? '';
    return is_string($value) ? trim($value) : '';
}

function verify_recaptcha(string $expectedAction): bool
{
    $token = post_value('token');
    if ($token === '') {
        return false;
    }

    $context = stream_context_create([
        'http' => [
            'method' => 'POST',
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
            'content' => http_build_query([
                'secret' => required_env('ACUABAR_RECAPTCHA_SECRET'),
                'response' => $token,
            ]),
            'timeout' => 8,
            'ignore_errors' => true,
        ],
    ]);

    $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context);
    if ($response === false) {
        throw new RuntimeException('Unable to verify reCAPTCHA with Google.');
    }

    $result = json_decode($response, true);
    if (!is_array($result)) {
        throw new RuntimeException('Google returned an invalid reCAPTCHA response.');
    }

    return ($result['success'] ?? false) === true
        && ($result['action'] ?? '') === $expectedAction
        && (float) ($result['score'] ?? 0) >= 0.5;
}

function send_acuabar_email(string $subject, string $htmlBody, string $replyTo = ''): void
{
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = required_env('ACUABAR_SMTP_HOST');
    $mail->Port = (int) required_env('ACUABAR_SMTP_PORT');
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Username = required_env('ACUABAR_SMTP_USERNAME');
    $mail->Password = required_env('ACUABAR_SMTP_PASSWORD');
    $mail->CharSet = 'UTF-8';
    $mail->isHTML(true);
    $mail->setFrom($mail->Username, 'Acua Baja Bar & Mar');
    $mail->addAddress('contacto@acuabar.com');

    if ($replyTo !== '') {
        $mail->addReplyTo($replyTo);
    }

    $mail->Subject = $subject;
    $mail->Body = $htmlBody;
    $mail->AltBody = trim(strip_tags(str_replace(['<br>', '<br/>', '<br />'], "\n", $htmlBody)));
    $mail->send();
}

function respond(string $status, string $message, int $httpStatus): void
{
    http_response_code($httpStatus);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['status' => $status, 'message' => $message]);
}

function escape_mail(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
