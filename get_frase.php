<?php
// frase-get.php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

require "db.php";

// Opcional: validar token simple (si querés proteger)
$token = $_SERVER['HTTP_AUTHORIZATION'] ?? null;
// Si querés que sea público, comentá la validación siguiente
// if ($token !== "token-falso-123") {
//     http_response_code(401);
//     echo json_encode(["success" => false, "message" => "No autorizado"]);
//     exit;
// }

$sql = "SELECT id, frase, foto_base64,consejo FROM frases ORDER BY RAND() LIMIT 1";
$result = $conn->query($sql);

if ($row = $result->fetch_assoc()) {
    echo json_encode([
        "success" => true,
        "id" => (int)$row["id"],
        "frase" => $row["frase"],
        "foto_base64" => $row["foto_base64"],
        "consejo" => $row["consejo"]
    ]);
} else {
    echo json_encode(["success" => false, "message" => "No hay frases"]);
}
?>
