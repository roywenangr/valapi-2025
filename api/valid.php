<?php
define('ENVIRONMENT', 'production');

include "../core/disposable.php";

$validmail = new VerifyEmail();
$validmail->setStreamTimeoutWait(20);
$validmail->setEmailFrom('wardoves@tourvest.co.za');

header('Content-Type: application/json');


if (isset($_GET['email'])) {
    $email = $_GET['email'];
    $email = strtolower($email);
    $email = trim($email);
    $emailfilter = filter_var($email, FILTER_VALIDATE_EMAIL);
    if ($emailfilter == true) {
        if (is_disposable($email)) {
            if ($validmail->check($email)) {
                $res = [
                    'code' => 200,
                    'status' => 'ok',
                    'email' => $email,
                    'email_status' => 'Valid'
                ];
            } else {
                $res = [
                    'code' => 200,
                    'status' => 'ok',
                    'email' => $email,
                    'email_status' => 'Bounce'
                ];
            }
        } else {
            $res = [
                'code' => 200,
                'status' => 'ok',
                'email' => $email,
                'email_status' => 'Disposable'
            ];
        }
    } else {
        $res = [
            'code' => 400,
            'status' => 'error',
            'email' => $email,
            'email_status' => 'Invalid',
        ];
    }
} else {
    $res = [
        'code' => 400,
        'status' => 'error',
        'email_status' => 'Required',
    ];
}



echo json_encode($res, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
