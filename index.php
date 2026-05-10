<?php
// >>> FIX SESIONES FORZADO + DEBUG <
$session_path = '/home/c2701652/public_html/tmp_sessions';

// Diagnóstico temporal (lo sacamos después)
echo "<!-- DEBUG SESIONES:\n";
echo "Ruta: $session_path\n";
echo "Existe carpeta: " . (is_dir($session_path) ? 'SI' : 'NO') . "\n";
echo "Es escribible: " . (is_writable($session_path) ? 'SI' : 'NO') . "\n";
echo "Permisos: " . (is_dir($session_path) ? substr(sprintf('%o', fileperms($session_path)), -4) : 'N/A') . "\n";
echo "Save path actual ANTES: " . session_save_path() . "\n";

// Crear carpeta si no existe
if (!is_dir($session_path)) {
    @mkdir($session_path, 0755, true);
}

// Forzar la ruta SIEMPRE, sin condicional
session_save_path($session_path);

echo "Save path actual DESPUES: " . session_save_path() . "\n";
echo "-->\n";

// Forzar cookie de sesión válida para todo el dominio
if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/',
        'domain'   => '',
        'secure'   => !empty($_SERVER['HTTPS']),
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    session_start();
}

// Headers anti-caché para que el token no quede cacheado
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');

// Generar token CSRF si no existe
if (empty($_SESSION['form_token'])) {
    $_SESSION['form_token'] = bin2hex(random_bytes(32));
}

// Marcar momento de carga (para el TimeTrap del procesar.php)
$_SESSION['form_time'] = time();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NIK | STUDIO</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <link href="css/style20.css" rel="stylesheet">
    <link rel="icon" href="Favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand logo" href="#">NIK<span>|</span>STUDIO</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#section-title">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#servicios">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tecnologias">Tecnologías</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#productos">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contacto">Contacto</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
 
    <section class="hero text-center">
        <div class="container">
            <h1 class="display-4">Soluciones Tecnológicas</h1>
        </div>
    </section>
 
    <section class="py-5 bg-servicios text-white" id="servicios">
        <div class="container" style="max-width: 1100px;">
            <h2 class="section-title text-center">Nuestros Servicios</h2>
 
            <div class="row mt-4 justify-content-center">
                <div class="col-md-4 d-flex justify-content-center">
                    <div class="card p-4 text-center w-100" style="max-width: 350px;">
                        <h5>Desarrollos a Medida</h5>
                        <p>
                            Brindamos soluciones de Software a medida de las necesidades de su empresa. 
                            Evaluamos cuál es la solución tecnológica más adecuada para la resolución del problema, 
                            diseñando e implementando la misma como producto de un análisis previo tendiente a 
                            arribar a la mejor solución.
                        </p>
                    </div>
                </div>
 
                <div class="col-md-4 d-flex justify-content-center">
                    <div class="card p-4 text-center w-100" style="max-width: 350px;">
                        <h5>Consultoría Tecnológica</h5>
                        <p>
                            Actuamos como socios tecnológicos de su empresa, brindando asesoramiento y apoyo 
                            en las decisiones estratégicas relacionadas con tecnología y procesos.
                        </p>
                    </div>
                </div>
 
                <div class="col-md-4 d-flex justify-content-center">
                    <div class="card p-4 text-center w-100" style="max-width: 350px;">
                        <h5>Formación</h5>
                        <p>
                            Somos un equipo de personas que buscamos la mejor experiencia de aprendizaje en tecnología. 
                            Te acompañamos en tu formación de manera personalizada, con grupos reducidos para ayudarte 
                            a desarrollar todo tu potencial.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
 
    <section class="py-5" id="tecnologias">       
        <section class="technologies">
            <h2 class="section-title text-center">Tecnologías</h2>
            <br>
            <div class="icons-wrapper">
                <div class="icons">
                    <i class="fab fa-java"></i>
                    <i class="fab fa-php"></i>
                    <i class="fab fa-python"></i>
                    <i class="fab fa-js"></i>
                    <i class="fab fa-html5"></i>
                    <i class="fab fa-css3-alt"></i>
                    <i class="fab fa-node-js"></i>
                    <i class="fab fa-golang"></i>
                    <i class="fab fa-laravel"></i>
                    <i class="fab fa-react"></i>
                    <i class="fab fa-vuejs"></i>
                    <i class="fab fa-angular"></i>
                    <i class="fab fa-bootstrap"></i>
                    <i class="fab fa-symfony"></i>
                    <i class="fab fa-sass"></i>
                    <i class="fab fa-docker"></i>
                    <i class="fab fa-java"></i>
                    <i class="fab fa-php"></i>
                    <i class="fab fa-python"></i>
                    <i class="fab fa-js"></i>
                    <i class="fab fa-html5"></i>
                    <i class="fab fa-css3-alt"></i>
                    <i class="fab fa-node-js"></i>
                    <i class="fab fa-golang"></i>
                    <i class="fab fa-laravel"></i>
                    <i class="fab fa-react"></i>
                    <i class="fab fa-vuejs"></i>
                    <i class="fab fa-angular"></i>
                    <i class="fab fa-bootstrap"></i>
                    <i class="fab fa-symfony"></i>
                    <i class="fab fa-sass"></i>
                    <i class="fab fa-docker"></i>
                </div>
            </div>
        </section>
    </section> 
    
    <section class="py-5" id="productos">       
      <section class="products">
        <h2 class="section-title text-center">Nuestros Productos</h2>
 
        <div class="container mt-5">
          <div class="products-grid">
 
            <div class="card">
              <div class="card-img-container">
                <img src="img/powergym.jpeg" class="card-img-top img-fluid" alt="Producto 1">
                <h5>PowerGym</h5>
              </div>
              <div class="card-body text-center">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal1">Ver Descripción</button>
              </div>
            </div>
 
            <div class="card">
              <div class="card-img-container">
                <img src="img/liberia.jpg" class="card-img-top img-fluid" alt="Producto 2">
                <h5>Pampero</h5>
              </div>
              <div class="card-body text-center">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal2">Ver Descripción</button>
              </div>
            </div>
 
            <div class="card">
              <div class="card-img-container">
                <img src="img/pdv.jpg" class="card-img-top img-fluid" alt="Producto 3">
                <h5>Punto de Venta</h5>
              </div>
              <div class="card-body text-center">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal3">Ver Descripción</button>
              </div>
            </div>
 
            <div class="card">
              <div class="card-img-container">
                <img src="img/codigo.jpg" class="card-img-top img-fluid" alt="Producto 4">
                <h5>Publicaciones</h5>
              </div>
              <div class="card-body text-center">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal4">Ver Descripción</button>
              </div>
            </div>
 
            <div class="card">
              <div class="card-img-container">
                <img src="img/test.jpg" class="card-img-top img-fluid" alt="Producto 5">
                <h5>TestTrack</h5>
              </div>
              <div class="card-body text-center">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal5">Ver Descripción</button>
              </div>
            </div>
 
          </div>
        </div>
 
        <!-- ================= MODALES PRODUCTOS ================= -->
        <div class="modal fade" id="modal1" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header"><h5 class="modal-title">PowerGym</h5></div>
              <div class="modal-body">
                <p>Plataforma integral diseñada para la administración de gimnasios, que centraliza la gestión de socios, actividades y operaciones diarias. El sistema permite organizar la información de manera estructurada y mantener un control eficiente del funcionamiento del gimnasio.</p>
                <p>Complementariamente, incluye una aplicación móvil orientada a los usuarios, que facilita el acceso a información relevante desde el celular, mejorando la comunicación y la experiencia del socio.</p>
                <p>Esta solución optimiza los procesos administrativos, fortalece la relación con los usuarios y aporta una experiencia moderna e integrada entre la gestión interna y el uso móvil.</p>
              </div>
              <div class="modal-footer"><button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button></div>
            </div>
          </div>
        </div>
 
        <div class="modal fade" id="modal2" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header"><h5 class="modal-title">Pampero</h5></div>
              <div class="modal-body">
                <p>Plataforma orientada a la venta de libros, diseñada para administrar el catálogo editorial y registrar las operaciones de venta de manera organizada y eficiente. Permite gestionar información detallada de cada libro, como autores, editoriales, formatos y precios.</p>
                <p>El sistema centraliza el control de ventas y productos, facilitando el seguimiento del stock y el análisis del movimiento comercial.</p>
                <p>Esta solución aporta orden, trazabilidad y control en la gestión de librerías, optimizando los procesos de venta y la administración del inventario.</p>
              </div>
              <div class="modal-footer"><button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button></div>
            </div>
          </div>
        </div>
 
        <div class="modal fade" id="modal3" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header"><h5 class="modal-title">Punto de Venta</h5></div>
              <div class="modal-body">
                <p>Aplicación orientada a la gestión de ventas de productos, diseñada para registrar operaciones de manera ágil y organizada. Permite administrar productos, controlar precios y procesar ventas en tiempo real.</p>
                <p>El sistema centraliza la información comercial, facilitando el seguimiento de las transacciones y brindando una visión clara del movimiento de productos.</p>
                <p>Esta solución contribuye a optimizar los procesos de venta, mejorar el control operativo y reducir errores en la gestión diaria del negocio.</p>
              </div>
              <div class="modal-footer"><button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button></div>
            </div>
          </div>
        </div>
 
        <div class="modal fade" id="modal4" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header"><h5 class="modal-title">Publicaciones</h5></div>
              <div class="modal-body">
                <p>Plataforma diseñada para centralizar y administrar toda la información relacionada con los sistemas de una empresa. Permite registrar datos clave de cada sistema y realizar un seguimiento detallado de las publicaciones y actualizaciones asociadas.</p>
                <p>El sistema ofrece trazabilidad histórica de los cambios, facilitando el control de versiones, la auditoría y la comprensión de la evolución de cada sistema a lo largo del tiempo.</p>
                <p>Esta solución mejora la organización de la información, optimiza la comunicación entre equipos y aporta mayor control y transparencia sobre el ecosistema tecnológico de la organización.</p>
              </div>
              <div class="modal-footer"><button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button></div>
            </div>
          </div>
        </div>
 
        <div class="modal fade" id="modal5" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header"><h5 class="modal-title">TestTrack</h5></div>
              <div class="modal-body">
                <p>Plataforma diseñada para la gestión y seguimiento de pruebas funcionales dentro del proceso de desarrollo de software. El sistema permite registrar, organizar y asignar distintos casos de prueba que los usuarios deben ejecutar para validar el correcto funcionamiento de las aplicaciones.</p>
                <p>La herramienta facilita el control del estado de cada prueba, permitiendo visualizar cuáles han sido aprobadas, rechazadas o se encuentran pendientes, brindando así un seguimiento claro del avance del proceso de validación.</p>
                <p>Esta solución contribuye a mejorar la calidad del software, optimizar la comunicación entre los equipos de desarrollo y testing, y garantizar que cada funcionalidad sea evaluada antes de su implementación final.</p>
              </div>
              <div class="modal-footer"><button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button></div>
            </div>
          </div>
        </div>
 
      </section>
    </section>
 
    <section class="py-5" id="nuestrosCursos">
      <h2 class="section-title text-center">Nuestros Cursos</h2>
      <br>
      <div class="container">
 
        <div class="rectangle">
          <div class="half left">
            <div class="tech-item">
              <i class="fab fa-html5"></i>
              <span class="plus">+</span>
              <i class="fa-brands fa-css3-alt"></i>
              <span>HTML + CSS</span>
            </div>
          </div>
          <div class="half right">
            <div class="top"><i class="fa-solid fa-chalkboard-user"></i><div style="padding-left: 10px">12 Clases</div></div>
            <div class="bottom"><i class="fa-regular fa-clock"></i><div style="padding-left: 10px">2 horas</div></div>
          </div>
        </div>
 
        <div class="rectangle">
          <div class="half left"><div class="tech-item"><i class="fab fa-php"></i><span>PHP</span></div></div>
          <div class="half right">
            <div class="top"><i class="fa-solid fa-chalkboard-user"></i><div style="padding-left: 10px">10 Clases</div></div>
            <div class="bottom"><i class="fa-regular fa-clock"></i><div style="padding-left: 10px">2 horas</div></div>
          </div>
        </div>
 
        <div class="rectangle">
          <div class="half left"><div class="tech-item"><i class="fa-solid fa-database"></i><span>Base de Datos</span></div></div>
          <div class="half right">
            <div class="top"><i class="fa-solid fa-chalkboard-user"></i><div style="padding-left: 10px">8 Clases</div></div>
            <div class="bottom"><i class="fa-regular fa-clock"></i><div style="padding-left: 10px">2 horas</div></div>
          </div>
        </div>
 
        <div class="rectangle">
          <div class="half left"><div class="tech-item"><i class="fab fa-bootstrap"></i><span>Bootstrap</span></div></div>
          <div class="half right">
            <div class="top"><i class="fa-solid fa-chalkboard-user"></i><div style="padding-left: 10px">4 Clases</div></div>
            <div class="bottom"><i class="fa-regular fa-clock"></i><div style="padding-left: 10px">2 horas</div></div>
          </div>
        </div>
 
        <div class="rectangle">
          <div class="half left"><div class="tech-item"><i class="fab fa-laravel"></i><span>Laravel</span></div></div>
          <div class="half right">
            <div class="top"><i class="fa-solid fa-chalkboard-user"></i><div style="padding-left: 10px">8 Clases</div></div>
            <div class="bottom"><i class="fa-regular fa-clock"></i><div style="padding-left: 10px">2 horas</div></div>
          </div>
        </div>
 
        <div class="rectangle">
          <div class="half left"><div class="tech-item"><i class="fa-brands fa-java"></i><span>Java</span></div></div>
          <div class="half right">
            <div class="top"><i class="fa-solid fa-chalkboard-user"></i><div style="padding-left: 10px">10 Clases</div></div>
            <div class="bottom"><i class="fa-regular fa-clock"></i><div style="padding-left: 10px">2 horas</div></div>
          </div>
        </div>
 
        <div class="rectangle">
          <div class="half left"><div class="tech-item"><i class="fa-brands fa-js"></i><span>JavaScript</span></div></div>
          <div class="half right">
            <div class="top"><i class="fa-solid fa-chalkboard-user"></i><div style="padding-left: 10px">10 Clases</div></div>
            <div class="bottom"><i class="fa-regular fa-clock"></i><div style="padding-left: 10px">2 horas</div></div>
          </div>
        </div>
 
      </div>
    </section>
 
    <section class="py-5" id="contacto">
        <div class="container contacto">
            <h2 class="section-title text-center" style="color: white;">Contactanos</h2>
            <div id="formResponsive"></div>                             
            <form id="contact" method="post" novalidate>
                <!-- CSRF Token (requerido por procesar.php) -->
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['form_token']) ?>">
 
                <!-- Honeypot anti-bots (debe quedar vacío) -->
                <div style="position: absolute; left: -9999px; top: -9999px;" aria-hidden="true">
                    <label for="website_check">No completar</label>
                    <input type="text" name="website_check" id="website_check" tabindex="-1" autocomplete="off">
                </div>
 
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="mail@dominio.com" required>
                </div>
                <div class="mb-3">
                    <label for="consulta" class="form-label">Tu consulta</label>
                    <textarea class="form-control" id="consulta" name="mensaje" rows="3" required></textarea>
                </div>                     
                <button class="btn btn-primary color-boton" type="submit" id="contact-submit">Enviar</button>
            </form>
        </div>    
    </section> 
 
    <footer class="py-4" id="footer">
        <div class="container text-center">
            <div class="row">
                <div class="col-md-4">
                    <h5>Sobre Nosotros</h5>
                    <p>Nik-Studio es una empresa dedicada al desarrollo de software y educación en programación. Ofrecemos soluciones tecnológicas adaptadas a las necesidades de nuestros clientes.</p>
                </div>
                <div class="col-md-4">
                    <h5>Enlaces Rápidos</h5>
                    <ul class="list-unstyled">
                        <li><a href="#servicios" class="text-white">Servicios</a></li>
                        <li><a href="#tecnologias" class="text-white">Tecnologías</a></li>
                        <li><a href="#contacto" class="text-white">Contacto</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Redes Sociales</h5>
                    <div class="social-icons">
                        <a href="https://www.facebook.com/" target="_blank" class="text-white mx-2"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.twitter.com/" target="_blank" class="text-white mx-2"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.instagram.com/" target="_blank" class="text-white mx-2"><i class="fab fa-instagram"></i></a>
                        <a href="https://www.linkedin.com/" target="_blank" class="text-white mx-2"><i class="fab fa-linkedin-in"></i></a>
                        <a href="https://www.github.com/" target="_blank" class="text-white mx-2"><i class="fab fa-github"></i></a>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <p class="text-white">© 2026 Nik-Studio. Todos los derechos reservados.</p>
            <p>V. 1.0.22</p>
        </div>
    </footer>
 
    <!-- ================= MODAL DE CONFIRMACIÓN DE ENVÍO ================= -->
    <div class="modal fade" id="modalEnvio" tabindex="-1" role="dialog" aria-labelledby="modalEnvioLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalEnvioLabel">Mensaje enviado</h5>
          </div>
          <div class="modal-body text-center">
            <i id="modalEnvioIcon" class="fa-solid fa-circle-check" style="font-size: 4rem; color: #28a745; margin-bottom: 1rem;"></i>
            <p id="modalEnvioTexto">¡Tu consulta fue enviada con éxito! Te responderemos a la brevedad.</p>
          </div>
          <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-primary color-boton" data-bs-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
 
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
 
    <!-- Envío del formulario por AJAX al procesar.php de Donweb -->
    <script>
      (function () {
        const form = document.getElementById('contact');
        const btn  = document.getElementById('contact-submit');
 
        if (!form) return;
 
        form.addEventListener('submit', async function (e) {
          e.preventDefault();
 
          const textoOriginal = btn.textContent;
          btn.disabled    = true;
          btn.textContent = 'Enviando...';
 
          try {
            const formData = new FormData(form);
            const res  = await fetch('contacto/procesar.php', {
              method: 'POST',
              body: formData
            });
            const data = await res.json();
 
            mostrarModal(!!data.success, data.message || (data.success ? 'Mensaje enviado.' : 'No se pudo enviar.'));
 
            if (data.success) {
              form.reset();
            }
          } catch (err) {
            mostrarModal(false, 'No se pudo conectar con el servidor. Intentá nuevamente en unos minutos.');
          } finally {
            btn.disabled    = false;
            btn.textContent = textoOriginal;
          }
        });
 
        function mostrarModal(exito, mensaje) {
          const titulo = document.getElementById('modalEnvioLabel');
          const icono  = document.getElementById('modalEnvioIcon');
          const texto  = document.getElementById('modalEnvioTexto');
 
          if (exito) {
            titulo.textContent = 'Mensaje enviado';
            icono.className    = 'fa-solid fa-circle-check';
            icono.style.color  = '#28a745';
          } else {
            titulo.textContent = 'No se pudo enviar';
            icono.className    = 'fa-solid fa-circle-xmark';
            icono.style.color  = '#dc3545';
          }
 
          texto.textContent = mensaje;
 
          const modal = new bootstrap.Modal(document.getElementById('modalEnvio'));
          modal.show();
        }
      })();
    </script>
</body>
</html>