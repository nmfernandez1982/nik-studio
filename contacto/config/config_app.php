<?php
// Protección contra acceso directo (aunque el .htaccess ya lo protege)
defined('ACCESO_SEGURO') or die('Acceso denegado');

return [
    // 1. Configuración SMTP (Tus datos de DonWeb/Dattaweb)
    'smtp' => [
        'host'       => 'vps-3454342-x.dattaweb.com', // Ejemplo
        'auth'       => true,
        'username'   => 'support@entregabilidad.com.ar',
        'password'   => '********',
        'secure'     => 'ssl', // opciones: 'ssl', 'tls', null
        'port'       => 465,
        'debug'      => 2, // 0 para producción, 2 para desarrollo
        'from_name'  => 'Entregabilidad - Formulario Web',
        'recipient'  => 'aentregabilidad@gmail.com' // Dónde llega el email
    ],

    // 2. Google reCAPTCHA (NUEVO)
    'recaptcha' => [
        'activo'     => true, // true = Activado, false = Desactivado
        'site_key'   => '*******************************',   // Clave pública (HTML)
        'secret_key' => '*******************************'     // Clave privada (Servidor)
    ],

    // 3. Activación de Campos
    'campos' => [
        'nombre'    => ['activo' => true,  'requerido' => true],
        'apellido'  => ['activo' => true,  'requerido' => true],
        'email'     => ['activo' => true,  'requerido' => true], // Email siempre es vital
        'telefono'  => ['activo' => true,  'requerido' => false],
        'direccion' => ['activo' => false, 'requerido' => false],
        'pais'      => ['activo' => false, 'requerido' => false],
        'mensaje'   => ['activo' => true,  'requerido' => true],
        'adjuntos'  => ['activo' => true,  'requerido' => false] 
    ],

    // 4. Seguridad Interna (WAF + Honeypot + TimeTrap)
    'seguridad' => [
        'permitir_adjuntos' => true,
        'tipos_permitidos'  => ['jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx'],
        'max_size_mb'       => 5,
        'tiempo_minimo'     => 3, 
        'honey_pot_field'   => 'website_check' 
    ]
];
