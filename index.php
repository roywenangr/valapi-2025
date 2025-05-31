<?php

header('Content-Type: application/json');

$res = [
    'code' => 200,
    'msg' => 'ok',
];

echo json_encode($res, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
