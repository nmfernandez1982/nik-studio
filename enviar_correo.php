<?php
require("class.phpmailer.php");
require("class.smtp.php");

if (!isset($_POST["nombre"]) || !isset($_POST["email"]) || !isset($_POST["mensaje"])) {
    die("Es necesario completar todos los datos del formulario");
}
$nombre  = $_POST["nombre"];
$email   = $_POST["email"];
$mensaje = $_POST["mensaje"];

$smtpHost    = "c2701652.ferozo.com";
$smtpUsuario = "comercial@nik-studio.com.ar";
$smtpClave   = "XeBh7l*0"; // ← cambiala
$emailDestino = "comercial@nik-studio.com.ar";

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth   = true;
$mail->Host       = $smtpHost;
$mail->Username   = $smtpUsuario;
$mail->Password   = $smtpClave;
$mail->Port       = 465;
$mail->SMTPSecure = 'ssl';
$mail->CharSet    = "utf-8";
$mail->IsHTML(true);

// Por si el certificado da problemas en hosting compartido
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer'       => false,
        'verify_peer_name'  => false,
        'allow_self_signed' => true
    )
);

// 🔑 EL FIX CLAVE: From tiene que ser tu casilla autenticada
$mail->From     = $smtpUsuario;          // NO el email del visitante
$mail->FromName = "Web - " . $nombre;    // Aclarás de quién viene
$mail->AddAddress($emailDestino);
$mail->AddReplyTo($email, $nombre);      // Si respondés, va al visitante

$mail->Subject = "Consulta enviada desde la WEB";
$mensajeHtml   = nl2br(htmlspecialchars($mensaje));
$mail->Body    = "<b>Nombre:</b> {$nombre}<br><b>Email:</b> {$email}<br><br>{$mensajeHtml}";
$mail->AltBody = "Nombre: {$nombre}\nEmail: {$email}\n\n{$mensaje}";

// 🔍 PARA DEBUGGEAR: descomentá estas dos líneas mientras probás
// $mail->SMTPDebug = 2;
// $mail->Debugoutput = 'html';

if ($mail->Send()) {
    header("Location: index.html");
    exit;
} else {
    // En vez de redirigir a error.html ciego, mostrá el error real:
    echo "Error: " . $mail->ErrorInfo;
    exit;
}