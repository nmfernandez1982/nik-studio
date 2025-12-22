<?php
// db.php
$dbhost = 'localhost';
$dbuser = 'c2701652_frases';
$dbpass = 'riSU07fuwa';
$dbname = 'c2701652_frases';

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$conn) {
    header("Content-Type: application/json");
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "message" => "DB connect error: " . mysqli_connect_error()
    ]);
    exit;
}

mysqli_set_charset($conn, "utf8mb4");
