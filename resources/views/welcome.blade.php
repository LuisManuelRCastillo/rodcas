<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ferretería RODCAS</title>

  <!-- FontAwesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <!-- Swiper CSS -->
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
  <!-- AOS CSS -->
  <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">

  <style>
    :root {
      --primary-color: #dc6336;
      --dark-color: #333;
      --light-color: #fff;
      --bg-gray: #f4f4f4;
    }

    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
      font-family: 'Poppins', sans-serif;
      background-color: var(--bg-gray);
      color: var(--dark-color);
      line-height: 1.6;
      background: #f2f2f2;
    }

    header, section, footer {
      padding: 40px 20px;
      text-align: center;
    }

    .container {
      max-width: 1200px;
      margin: auto;
      padding: 0 20px;
    }

    nav {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: #F2F2F2;
      padding: 20px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    nav img {
      height: 60px;
    }

    .nav-links {
      display: flex;
      gap: 20px;
    }

    .nav-links a {
      color: var(--dark-color);
      text-decoration: none;
      font-weight: 600;
      transition: color 0.3s;
    }

    .nav-links a:hover { color: var(--primary-color); }

    .showcase { padding: 50px 20px; }
    .showcase h1 { font-size: 3rem; margin-bottom: 20px; }

    .info {
      background: #dc6336;
      color: var(--light-color);
      font-weight: bolder;
      margin-top: 20px;
      border-radius: 10px;
      padding: 40px 20px;
    }

    .since-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
      margin-top: 30px;
      text-align: center;
    }
    .since-container h2 { color: var(--primary-color); }
    .since-container > div {
      background: #fff;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    .imagenes-container {
      display: flex;
      justify-content: center;
      gap: 40px;
      margin-top: 30px;
      flex-wrap: wrap;
    }
    .imagenes-container img {
      max-width: 200px;
      height: auto;
    }

    .ubicacion {
      background-color: #444;
      color: white;
      border-radius: 10px;
    }
    .ubicacion iframe {
      width: 100%;
      height: 300px;
      border: none;
      border-radius: 10px;
      margin-top: 20px;
    }

    .social { background-color: var(--light-color); }
    .links a {
      color: var(--primary-color);
      font-size: 2rem;
      margin: 0 10px;
    }

    footer {
      background-color: var(--dark-color);
      color: var(--light-color);
      padding: 20px;
    }

    #menu-toggle { display: none; }
    .menu-icon {
      display: none;
      font-size: 28px;
      cursor: pointer;
    }

    /* 🔹 Responsive */
    @media (max-width: 992px) {
      .since-container { grid-template-columns: 1fr 1fr; }
    }

    @media (max-width: 768px) {
      nav {
        flex-direction: column;
        align-items: center;
        position: relative;
      }
      .menu-icon {
        display: block;
        position: absolute;
        top: 20px;
        right: 20px;
        color: var(--dark-color);
        z-index: 2;
      }
      .nav-links {
        display: none;
        flex-direction: column;
        align-items: center;
        width: 100%;
        gap: 15px;
        margin-top: 10px;
      }
      #menu-toggle:checked + .menu-icon + .nav-links { display: flex; }
      .nav-links a {
        padding: 10px;
        width: 100%;
        text-align: center;
      }
      .since-container { grid-template-columns: 1fr !important; }
      header, section, footer { padding: 20px 10px; }
      .showcase h1 { font-size: 1.8rem; }
      .info { font-size: 0.9rem; padding: 20px 15px; }
      nav img { height: 45px; }
      .imagenes-container img { max-width: 150px; }
    }

    /* 🔹 Botón WhatsApp */
    .whatsapp-button {
      position: fixed;
      bottom: 20px;
      right: 20px;
      background-color: #25d366;
      color: #fff;
      font-size: 28px;
      width: 55px;
      height: 55px;
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
      box-shadow: 0 4px 6px rgba(0,0,0,0.3);
      z-index: 1000;
      transition: transform 0.3s ease;
    }
    .whatsapp-button:hover {
      transform: scale(1.1);
      background-color: #20b955;
    }
  </style>
</head>

<body>

  <!-- NAV -->
  <nav class="container" style="margin-bottom: 50px;">
    <img src="assets/img/logoRC.png" alt="Logo Ferretería RODCAS" />
    <input type="checkbox" id="menu-toggle">
    <label for="menu-toggle" class="menu-icon">
      <i class="fas fa-bars"></i>
    </label>
    <div class="nav-links">
      <a href="{{ route('catalogo') }}">Catálogo</a>
      <a href="{{ route('login') }}">Inciar Sesión</a>
    </div>
  </nav>

  <!-- SWIPER -->
  <section class="container">
    
    <div class="swiper mySwiper">
      <div class="swiper-wrapper">
        <div class="swiper-slide"><img style="width:80%" src="assets/img/roadmap.png" alt="Producto 1"></div>
        <div class="swiper-slide"><img style="width:80%" src="assets/img/roadmap (2).png" alt="Producto 2"></div>
        <div class="swiper-slide"><img style="width:80%" src="assets/img/roadmap (3).png" alt="Producto 3"></div>
      </div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-pagination"></div>
    </div>
  </section>

  <!-- INFO -->
  <section class="info container" id="info" data-aos="fade-up">
    <p>Estamos comprometidos con la satisfacción de nuestros clientes, brindando atención personalizada y soluciones a
      tus necesidades. ¡Tu proyecto es nuestro proyecto!.</p>
  </section>

  <!-- SINCE -->
  <section class="since container" data-aos="zoom-in" style="margin-top: 50px;">
    <div style="text-align: left; font-size: 30px;">
      <h1>Contamos con...</h1>
    </div>
    <div class="since-container">
      <div>
        <h2>+10 Años</h2>
        <p>Gracias a tu confianza, seguimos creciendo y brindando atención experta en cada proyecto.</p>
      </div>
      <div>
        <h2>Asesoría gratuita</h2>
        <p>Ofrecemos asesoría gratuita y personalizada para ayudarte a encontrar las mejores soluciones.</p>
      </div>
      <div>
        <h2>Servicio a Domicilio</h2>
        <p>¡Haz tu pedido vía WhatsApp y recíbelo en tu domicilio!.</p>
      </div>
    </div>
  </section>

  <!-- UBICACION -->
  <section class="ubicacion container" id="ubicacion" style="margin-top: 50px;">
    <h2>Visítanos</h2>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3766.2141671446207!2d-99.60632023414108!3d19.27305052320629!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85cd8a4c245f819f%3A0xdebb19905b3958ab!2sFerreter%C3%ADa%20Rodcas!5e0!3m2!1ses-419!2smx!4v1629762035258!5m2!1ses-419!2smx" width="700" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    <p>Tel: (722) 706 0685</p>
  </section>

  <!-- SOCIAL -->
  <section class="social container">
    <p>Síguenos en redes sociales</p>
    <div class="links">
      <a href="https://www.facebook.com/Ferreteria-Rodcas-176411319201953" target="_blank"><i class="fab fa-facebook-f"></i></a>
    </div>
  </section>

  <!-- FOOTER -->
  <footer style="font-size: smaller;">
    <p>&copy; LuraDev 2025 | <a href="https://facebook.com/Bud3D" target="_blank"
        style="color: var(--primary-color)">Facebook</a></p>
  </footer>

  <!-- BOTÓN WHATSAPP -->
  <a href="https://wa.me/527208293653?text=Hola%20quiero%20más%20información" 
     class="whatsapp-button" target="_blank">
     <i class="fab fa-whatsapp"></i>
  </a>

  <!-- JS -->
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
  <script>
    new Swiper(".mySwiper", {
      loop: true,
      autoplay: { delay: 3000 },
      pagination: { el: ".swiper-pagination", clickable: true },
      navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" }
    });
    AOS.init({ duration: 1000, once: true });
  </script>

</body>
</html>
