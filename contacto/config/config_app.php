<?php
// Protección contra acceso directo (aunque el .htaccess ya lo protege)
defined('ACCESO_SEGURO') or die('Acceso denegado');

return [
    // 1. Configuración SMTP (Datos de Donweb)
    'smtp' => [
        'host'       => 'c2701652.ferozo.com',
        'auth'       => true,
        'username'   => 'comercial@nik-studio.com.ar',
        'password'   => 'XeBh7l*0',
        'secure'     => 'ssl',
        'port'       => 465,
        'debug'      => 0, // 0 para producción, 2 mientras probás
        'from_name'  => 'Web Nik-Studio - Formulario',
        'recipient'  => 'comercial@nik-studio.com.ar'
    ],

    // 2. Google reCAPTCHA (desactivado por ahora)
    'recaptcha' => [
        'activo'     => false,
        'site_key'   => '',
        'secret_key' => ''
    ],

    // 3. Activación de Campos (solo los que usa tu form actual)
    'campos' => [
        'nombre'    => ['activo' => true,  'requerido' => true],
        'apellido'  => ['activo' => false, 'requerido' => false],
        'email'     => ['activo' => true,  'requerido' => true],
        'telefono'  => ['activo' => false, 'requerido' => false],
        'direccion' => ['activo' => false, 'requerido' => false],
        'pais'      => ['activo' => false, 'requerido' => false],
        'mensaje'   => ['activo' => true,  'requerido' => true],
        'adjuntos'  => ['activo' => false, 'requerido' => false]
    ],

    // 4. Seguridad Interna (WAF + Honeypot + TimeTrap)
    'seguridad' => [
        'permitir_adjuntos' => false,
        'tipos_permitidos'  => ['jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx'],
        'max_size_mb'       => 5,
        'tiempo_minimo'     => 3,
        'honey_pot_field'   => 'website_check'
    ]
];