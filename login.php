<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Responder OPTIONS preflight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

$data = json_decode(file_get_contents("php://input"), true);

$email = $data["email"] ?? "";
$password = $data["password"] ?? "";

$USER_EMAIL = "julireyrey79@gmail.com";
$USER_PASS = "Pepe1543";

if ($email === $USER_EMAIL && $password === $USER_PASS) {
    echo json_encode([
        "success" => true,
        "message" => "Login OK",
        "token" => "token-falso-123",
        "user" => ["name" => "Admin"]
    ]);
} else {
    http_response_code(401);
    echo json_encode([
        "success" => false,
        "message" => "Credenciales incorrectas"
    ]);
}
?>
