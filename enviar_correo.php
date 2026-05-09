<?php
require("class.phpmailer.php");
require("class.smtp.php");

if (!isset($_POST["nombre"]) || !isset($_POST["email"]) || !isset($_POST["mensaje"])) {
    die("Es necesario completar todos los datos del formulario");
}
$nombre  = $_POST["nombre"];
$email   = $_POST["email"];
$mensaje = $_POST["mensaje"];

$smtpHost     = "c2701652.ferozo.com";
$smtpUsuario  = "comercial@nik-studio.com.ar";
$smtpClave    = "Mi Clave";
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

$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer'       => false,
        'verify_peer_name'  => false,
        'allow_self_signed' => true
    )
);

$mail->From     = $smtpUsuario;
$mail->FromName = "Web - " . $nombre;
$mail->AddAddress($emailDestino);
$mail->AddReplyTo($email, $nombre);

$mail->Subject = "Consulta enviada desde la WEB";
$mensajeHtml   = nl2br(htmlspecialchars($mensaje));
$mail->Body    = "<b>Nombre:</b> {$nombre}<br><b>Email:</b> {$email}<br><br>{$mensajeHtml}";
$mail->AltBody = "Nombre: {$nombre}\nEmail: {$email}\n\n{$mensaje}";

if ($mail->Send()) {
    header("Location: index.html?enviado=1#contacto");
    exit;
} else {
    header("Location: index.html?enviado=0#contacto");
    exit;
}