<?php
function send_mail(string $to, string $subject, string $message): bool {
    // Simple wrapper using PHP mail(). Configure sendmail/SMTP in php.ini for real delivery.
    $headers = "MIME-Version: 1.0\r\nContent-type:text/html;charset=UTF-8\r\n";
    $headers .= "From: noreply@meds.local\r\n";
    return @mail($to, $subject, $message, $headers);
}
