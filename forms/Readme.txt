The site forms are handled by enviarcorreo.php and reservaciones.php.

Set these variables in the PHP hosting environment before enabling the forms:

- ACUABAR_SMTP_HOST
- ACUABAR_SMTP_PORT (usually 465)
- ACUABAR_SMTP_USERNAME
- ACUABAR_SMTP_PASSWORD
- ACUABAR_RECAPTCHA_SECRET

Use .env.example as a names-only reference; never commit production values.
Rotate any credentials that were previously stored in source code.
