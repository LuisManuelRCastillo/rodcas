<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ferretería RODCAS — Expertos en Construcción y Herramienta</title>
  <meta name="description" content="Ferretería RODCAS — Más de 10 años en materiales, herramientas y asesoría profesional. Estado de México.">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    /* ── RESET & VARIABLES ── */
    *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

    :root {
      --brand:      #DC6336;
      --brand-dark: #b84e24;
      --dark:       #111111;
      --mid:        #444444;
      --muted:      #888888;
      --border:     #E8E8E8;
      --bg-light:   #F5F5F5;
      --white:      #FFFFFF;
    }

    html { scroll-behavior: smooth; }

    body {
      font-family: 'Inter', system-ui, -apple-system, sans-serif;
      color: var(--dark);
      background: var(--white);
      line-height: 1.6;
      -webkit-font-smoothing: antialiased;
    }

    a { text-decoration: none; color: inherit; }
    img { display: block; max-width: 100%; }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 40px;
    }

    /* ── SHARED TYPOGRAPHY ── */
    .section-tag {
      display: inline-block;
      font-size: 0.6875rem;
      font-weight: 700;
      letter-spacing: 0.22em;
      text-transform: uppercase;
      color: var(--brand);
      margin-bottom: 14px;
    }
    .section-title {
      font-size: clamp(1.75rem, 3.5vw, 2.5rem);
      font-weight: 800;
      letter-spacing: -0.025em;
      color: var(--dark);
      line-height: 1.1;
      margin-bottom: 16px;
    }
    .section-subtitle {
      font-size: 1rem;
      color: var(--muted);
      line-height: 1.75;
      max-width: 480px;
    }

    /* ── BUTTONS ── */
    .btn {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      font-weight: 700;
      font-size: 0.8125rem;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      padding: 15px 36px;
      border: 2px solid transparent;
      transition: all 0.3s ease;
      cursor: pointer;
    }
    .btn-brand {
      background: var(--brand);
      color: var(--white);
      border-color: var(--brand);
    }
    .btn-brand:hover {
      background: var(--brand-dark);
      border-color: var(--brand-dark);
      transform: translateY(-2px);
      color: var(--white);
    }
    .btn-ghost {
      background: transparent;
      color: var(--white);
      border-color: rgba(255,255,255,0.35);
    }
    .btn-ghost:hover {
      border-color: var(--white);
      background: rgba(255,255,255,0.08);
    }
    .btn-outline-dark {
      background: transparent;
      color: var(--dark);
      border-color: var(--dark);
    }
    .btn-outline-dark:hover {
      background: var(--dark);
      color: var(--white);
    }

    /* ══════════════════════════════
       NAVIGATION — fondo blanco
    ══════════════════════════════ */
    .navbar {
      position: fixed;
      top: 0; left: 0; right: 0;
      z-index: 1000;
      background: var(--white);
      border-bottom: 1px solid var(--border);
      padding: 0;
      transition: box-shadow 0.3s ease;
    }
    .navbar.elevated {
      box-shadow: 0 4px 24px rgba(0,0,0,0.09);
    }
    .navbar .container {
      display: flex;
      align-items: stretch;
      height: 70px;
    }
    .nav-logo {
      display: flex;
      align-items: center;
      margin-right: auto;
    }
    .nav-logo img {
      height: 44px;
    }
    .nav-menu {
      display: flex;
      align-items: center;
      gap: 36px;
      margin-left: 48px;
    }
    .nav-menu a {
      color: var(--mid);
      font-size: 0.8125rem;
      font-weight: 500;
      letter-spacing: 0.05em;
      text-transform: uppercase;
      transition: color 0.25s;
      padding: 4px 0;
      border-bottom: 2px solid transparent;
    }
    .nav-menu a:hover {
      color: var(--dark);
      border-bottom-color: var(--brand);
    }
    .nav-menu .nav-cta {
      background: var(--brand);
      color: var(--white);
      padding: 10px 22px;
      border: none;
      font-weight: 600;
      transition: background 0.25s;
    }
    .nav-menu .nav-cta:hover {
      background: var(--brand-dark);
      color: var(--white);
      border-bottom-color: transparent;
    }

    /* Mobile hamburger */
    .nav-toggle {
      display: none;
      flex-direction: column;
      justify-content: center;
      gap: 5px;
      cursor: pointer;
      padding: 8px;
      margin-left: auto;
    }
    .nav-toggle span {
      display: block;
      width: 22px;
      height: 2px;
      background: var(--dark);
      transition: all 0.3s;
    }

    /* Mobile full-screen overlay */
    .mobile-menu {
      display: none;
      position: fixed;
      inset: 0;
      background: var(--dark);
      z-index: 9999;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 44px;
    }
    .mobile-menu.open { display: flex; }
    .mobile-menu a {
      color: rgba(255,255,255,0.85);
      font-size: 1.75rem;
      font-weight: 700;
      letter-spacing: 0.03em;
      text-transform: uppercase;
      transition: color 0.25s;
    }
    .mobile-menu a:hover,
    .mobile-menu a.cta { color: var(--brand); }
    .mobile-close {
      position: absolute;
      top: 24px; right: 28px;
      background: none;
      border: none;
      color: rgba(255,255,255,0.4);
      font-size: 1.4rem;
      cursor: pointer;
      transition: color 0.25s;
    }
    .mobile-close:hover { color: var(--white); }

    /* ══════════════════════════════
       HERO — ferre.jpg como fondo
    ══════════════════════════════ */
    .hero {
      height: 100vh;
      min-height: 640px;
      position: relative;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      margin-top: 70px; /* offset fixed nav */
    }
    .hero-bg {
      position: absolute;
      inset: 0;
      background-image: url('/assets/img/ferre.jpg');
      background-size: cover;
      background-position: center;
      transform: scale(1.04);
      transition: transform 10s ease;
    }
    .hero-bg.loaded { transform: scale(1); }
    .hero-overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(
        150deg,
        rgba(10,10,10,0.88) 0%,
        rgba(10,10,10,0.65) 55%,
        rgba(10,10,10,0.80) 100%
      );
    }
    .hero-content {
      position: relative;
      z-index: 1;
      text-align: center;
      max-width: 900px;
      padding: 0 32px;
    }
    .hero-eyebrow {
      display: inline-flex;
      align-items: center;
      gap: 14px;
      color: var(--brand);
      font-size: 0.6875rem;
      font-weight: 700;
      letter-spacing: 0.24em;
      text-transform: uppercase;
      margin-bottom: 30px;
    }
    .hero-eyebrow::before,
    .hero-eyebrow::after {
      content: '';
      display: block;
      width: 48px;
      height: 1px;
      background: var(--brand);
      opacity: 0.65;
    }
    .hero h1 {
      font-size: clamp(2.75rem, 7vw, 5.5rem);
      font-weight: 900;
      color: var(--white);
      line-height: 0.96;
      letter-spacing: -0.035em;
      margin-bottom: 28px;
    }
    .hero h1 em {
      font-style: normal;
      color: var(--brand);
    }
    .hero-desc {
      font-size: 1.0625rem;
      color: rgba(255,255,255,0.6);
      max-width: 500px;
      margin: 0 auto 48px;
      line-height: 1.78;
      font-weight: 400;
    }
    .hero-actions {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 14px;
      flex-wrap: wrap;
    }
    .hero-scroll {
      position: absolute;
      bottom: 36px; left: 50%;
      transform: translateX(-50%);
      z-index: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 8px;
      color: rgba(255,255,255,0.28);
      font-size: 0.625rem;
      letter-spacing: 0.2em;
      text-transform: uppercase;
      animation: bounce 2.4s ease-in-out infinite;
    }
    @keyframes bounce {
      0%,100% { transform: translateX(-50%) translateY(0);   opacity: 0.28; }
      50%      { transform: translateX(-50%) translateY(8px); opacity: 0.65; }
    }

    /* ══════════════════════════════
       STATS BAR
    ══════════════════════════════ */
    .stats-bar {
      background: var(--dark);
      padding: 56px 0;
    }
    .stats-bar .container {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
    }
    .stat-item {
      text-align: center;
      padding: 0 20px;
      border-right: 1px solid rgba(255,255,255,0.07);
    }
    .stat-item:last-child { border-right: none; }
    .stat-number {
      font-size: 3.5rem;
      font-weight: 900;
      color: var(--brand);
      line-height: 1;
      letter-spacing: -0.04em;
      margin-bottom: 10px;
    }
    .stat-label {
      font-size: 0.75rem;
      color: rgba(255,255,255,0.38);
      font-weight: 500;
      letter-spacing: 0.14em;
      text-transform: uppercase;
    }

    /* ══════════════════════════════
       SERVICES
    ══════════════════════════════ */
    .services {
      padding: 100px 0;
      background: var(--white);
    }
    .section-header { margin-bottom: 56px; }

    .services-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 2px;
      background: var(--border);
    }
    .service-card {
      background: var(--white);
      padding: 52px 44px;
      position: relative;
      transition: background 0.3s;
    }
    .service-card::after {
      content: '';
      position: absolute;
      bottom: 0; left: 0; right: 0;
      height: 3px;
      background: var(--brand);
      transform: scaleX(0);
      transform-origin: left;
      transition: transform 0.35s ease;
    }
    .service-card:hover { background: #FAFAFA; }
    .service-card:hover::after { transform: scaleX(1); }

    .service-icon {
      width: 52px; height: 52px;
      display: flex;
      align-items: center;
      justify-content: center;
      background: rgba(220,99,54,0.09);
      color: var(--brand);
      font-size: 1.2rem;
      margin-bottom: 24px;
    }
    .service-card h3 {
      font-size: 1.0625rem;
      font-weight: 700;
      color: var(--dark);
      margin-bottom: 12px;
      letter-spacing: -0.015em;
    }
    .service-card p {
      font-size: 0.9375rem;
      color: var(--muted);
      line-height: 1.75;
    }

    /* ══════════════════════════════
       BRANDS — Marcas que distribuimos
    ══════════════════════════════ */
    .brands {
      padding: 72px 0;
      background: var(--bg-light);
      border-top: 1px solid var(--border);
      border-bottom: 1px solid var(--border);
    }
    .brands-header {
      text-align: center;
      margin-bottom: 48px;
    }
    .brands-header p {
      font-size: 0.75rem;
      font-weight: 700;
      letter-spacing: 0.22em;
      text-transform: uppercase;
      color: var(--muted);
    }
    .brands-grid {
      display: grid;
      grid-template-columns: repeat(6, 1fr);
      gap: 2px;
      background: var(--border);
    }
    .brand-item {
      background: var(--white);
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 28px 20px;
      transition: background 0.3s;
    }
    .brand-item:hover { background: #FAFAFA; }
    .brand-item img {
      max-height: 38px;
      width: auto;
      max-width: 100%;
      object-fit: contain;
      filter: grayscale(100%) opacity(0.55);
      transition: filter 0.35s ease;
    }
    .brand-item:hover img {
      filter: grayscale(0%) opacity(1);
    }

    /* ══════════════════════════════
       LOCATION
    ══════════════════════════════ */
    .location {
      padding: 100px 0;
      background: var(--white);
    }
    .location .container {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 80px;
      align-items: center;
    }
    .location-details {
      display: flex;
      flex-direction: column;
      gap: 22px;
      margin-top: 40px;
      margin-bottom: 40px;
    }
    .location-detail-item {
      display: flex;
      align-items: flex-start;
      gap: 16px;
    }
    .detail-icon {
      width: 42px; height: 42px; min-width: 42px;
      background: var(--brand);
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--white);
      font-size: 0.875rem;
      flex-shrink: 0;
    }
    .detail-text strong {
      display: block;
      font-size: 0.6875rem;
      font-weight: 700;
      letter-spacing: 0.14em;
      text-transform: uppercase;
      color: var(--muted);
      margin-bottom: 4px;
    }
    .detail-text span {
      font-size: 0.9375rem;
      color: var(--dark);
      font-weight: 500;
    }
    .location-map {
      aspect-ratio: 4/3;
      overflow: hidden;
    }
    .location-map iframe {
      width: 100%;
      height: 100%;
      border: none;
      display: block;
    }

    /* ══════════════════════════════
       CTA BANNER
    ══════════════════════════════ */
    .cta-banner {
      background: var(--dark);
      padding: 92px 0;
      text-align: center;
      position: relative;
      overflow: hidden;
    }
    .cta-banner::before {
      content: '';
      position: absolute;
      top: 0; left: 0; right: 0;
      height: 3px;
      background: var(--brand);
    }
    .cta-banner::after {
      content: 'RODCAS';
      position: absolute;
      top: 50%; left: 50%;
      transform: translate(-50%, -50%);
      font-size: 14rem;
      font-weight: 900;
      letter-spacing: -0.05em;
      color: rgba(255,255,255,0.025);
      pointer-events: none;
      white-space: nowrap;
    }
    .cta-banner h2 {
      font-size: clamp(1.75rem, 4vw, 2.625rem);
      font-weight: 800;
      color: var(--white);
      letter-spacing: -0.025em;
      margin-bottom: 16px;
      position: relative;
    }
    .cta-banner p {
      font-size: 1rem;
      color: rgba(255,255,255,0.5);
      margin-bottom: 40px;
      max-width: 420px;
      margin-left: auto;
      margin-right: auto;
      line-height: 1.75;
      position: relative;
    }
    .cta-banner .btn {
      position: relative;
      font-size: 0.875rem;
      padding: 18px 56px;
    }

    /* ══════════════════════════════
       FOOTER
    ══════════════════════════════ */
    .footer {
      background: #0D0D0D;
      padding: 40px 0;
      border-top: 1px solid rgba(255,255,255,0.06);
    }
    .footer .container {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .footer-brand {
      display: flex;
      flex-direction: column;
      gap: 4px;
    }
    .footer-brand-name {
      font-size: 1.125rem;
      font-weight: 800;
      color: var(--white);
      letter-spacing: -0.02em;
    }
    .footer-brand-name span { color: var(--brand); }
    .footer-brand-sub {
      font-size: 0.6875rem;
      color: rgba(255,255,255,0.25);
      letter-spacing: 0.12em;
      text-transform: uppercase;
    }
    .footer-copy {
      font-size: 0.75rem;
      color: rgba(255,255,255,0.25);
      text-align: center;
    }
    .footer-social {
      display: flex;
      align-items: center;
      gap: 12px;
    }
    .footer-social-link {
      width: 36px; height: 36px;
      display: flex;
      align-items: center;
      justify-content: center;
      border: 1px solid rgba(255,255,255,0.1);
      color: rgba(255,255,255,0.35);
      font-size: 0.8rem;
      transition: all 0.3s;
    }
    .footer-social-link:hover {
      background: var(--brand);
      border-color: var(--brand);
      color: var(--white);
    }
    .footer-dev {
      font-size: 0.6875rem;
      color: rgba(255,255,255,0.18);
      margin-top: 6px;
      text-align: right;
    }
    .footer-dev a {
      color: var(--brand);
      opacity: 0.7;
      transition: opacity 0.25s;
    }
    .footer-dev a:hover { opacity: 1; }

    /* ══════════════════════════════
       WHATSAPP FLOAT
    ══════════════════════════════ */
    .whatsapp-float {
      position: fixed;
      bottom: 28px; right: 28px;
      z-index: 998;
      width: 56px; height: 56px;
      background: #25D366;
      color: var(--white);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
      box-shadow: 0 8px 28px rgba(37,211,102,0.4);
      transition: all 0.3s ease;
    }
    .whatsapp-float:hover {
      transform: scale(1.1) translateY(-3px);
      box-shadow: 0 14px 36px rgba(37,211,102,0.55);
      color: var(--white);
    }

    /* ══════════════════════════════
       RESPONSIVE
    ══════════════════════════════ */
    @media (max-width: 1024px) {
      .services-grid { grid-template-columns: 1fr 1fr; }
      .brands-grid { grid-template-columns: repeat(3, 1fr); }
      .location .container { grid-template-columns: 1fr; gap: 52px; }
      .location-map { aspect-ratio: 16/9; }
    }

    @media (max-width: 768px) {
      .container { padding: 0 20px; }
      .nav-menu { display: none; }
      .nav-toggle { display: flex; }
      .hero { margin-top: 70px; min-height: 580px; }
      .services-grid { grid-template-columns: 1fr; }
      .brands-grid { grid-template-columns: repeat(2, 1fr); }
      .stats-bar .container { grid-template-columns: 1fr; }
      .stat-item {
        border-right: none;
        border-bottom: 1px solid rgba(255,255,255,0.07);
        padding: 28px 0;
      }
      .stat-item:last-child { border-bottom: none; }
      .footer .container {
        flex-direction: column;
        gap: 20px;
        text-align: center;
      }
      .footer-brand { align-items: center; }
      .footer-dev { text-align: center; }
    }

    @media (max-width: 480px) {
      .hero-actions { flex-direction: column; align-items: stretch; }
      .btn { justify-content: center; }
      .brands-grid { grid-template-columns: repeat(2, 1fr); }
    }
  </style>
</head>

<body>

  <!-- ══════════════════════════════
       NAVIGATION
  ══════════════════════════════ -->
  <nav class="navbar" id="navbar">
    <div class="container">
      <a href="/" class="nav-logo">
        <img src="assets/img/logoSF.png" alt="Ferretería RODCAS">
      </a>
      <div class="nav-menu">
        <a href="{{ route('catalogo') }}">Catálogo</a>
        <a href="#ubicacion">Ubicación</a>
        <a href="https://wa.me/527208293653?text=Hola%20quiero%20más%20información" target="_blank">WhatsApp</a>
        <a href="{{ route('login') }}" class="nav-cta">Acceder</a>
      </div>
      <div class="nav-toggle" id="navToggle" onclick="openMenu()">
        <span></span><span></span><span></span>
      </div>
    </div>
  </nav>

  <!-- Mobile overlay menu -->
  <div class="mobile-menu" id="mobileMenu">
    <button class="mobile-close" onclick="closeMenu()">
      <i class="fas fa-times"></i>
    </button>
    <a href="{{ route('catalogo') }}" onclick="closeMenu()">Catálogo</a>
    <a href="#ubicacion" onclick="closeMenu()">Ubicación</a>
    <a href="https://wa.me/527208293653" target="_blank" onclick="closeMenu()">WhatsApp</a>
    <a href="{{ route('login') }}" class="cta">Acceder</a>
  </div>


  <!-- ══════════════════════════════
       HERO
  ══════════════════════════════ -->
  <section class="hero">
    <div class="hero-bg" id="heroBg"></div>
    <div class="hero-overlay"></div>

    <div class="hero-content">
      <div class="hero-eyebrow">Desde 2014 · Estado de México</div>
      <h1>Tu aliado en<br><em>ferretería</em> y<br>construcción</h1>
      <p class="hero-desc">
        Materiales, herramientas y asesoría experta para cada etapa
        de tu proyecto. Más de 10 años respaldando a constructores y familias.
      </p>
      <div class="hero-actions">
        <a href="{{ route('catalogo') }}" class="btn btn-brand">
          Ver catálogo <i class="fas fa-arrow-right"></i>
        </a>
        <a href="#servicios" class="btn btn-ghost">
          Conocer más
        </a>
      </div>
    </div>

    <div class="hero-scroll">
      <i class="fas fa-chevron-down"></i>
      Scroll
    </div>
  </section>


  <!-- ══════════════════════════════
       STATS BAR
  ══════════════════════════════ -->
  <div class="stats-bar">
    <div class="container">
      <div class="stat-item">
        <div class="stat-number">+10</div>
        <div class="stat-label">Años de experiencia</div>
      </div>
      <div class="stat-item">
        <div class="stat-number">5★</div>
        <div class="stat-label">Calidad garantizada</div>
      </div>
      <div class="stat-item">
        <div class="stat-number">100%</div>
        <div class="stat-label">Compromiso con el cliente</div>
      </div>
    </div>
  </div>


  <!-- ══════════════════════════════
       SERVICES
  ══════════════════════════════ -->
  <section class="services" id="servicios">
    <div class="container">
      <div class="section-header">
        <span class="section-tag">Por qué elegirnos</span>
        <h2 class="section-title">Tu proyecto merece<br>lo mejor</h2>
        <p class="section-subtitle">
          Más que productos — soluciones completas para cada etapa
          de tu obra o remodelación.
        </p>
      </div>

      <div class="services-grid">
        <div class="service-card">
          <div class="service-icon"><i class="fas fa-user-tie"></i></div>
          <h3>Asesoría personalizada</h3>
          <p>Nuestro equipo te orienta para encontrar exactamente lo que necesitas, sin rodeos y sin costo adicional.</p>
        </div>
        <div class="service-card">
          <div class="service-icon"><i class="fas fa-truck"></i></div>
          <h3>Entrega a domicilio</h3>
          <p>Solicita tu pedido por WhatsApp y lo llevamos directo a tu obra o domicilio. Rápido y sin complicaciones.</p>
        </div>
        <div class="service-card">
          <div class="service-icon"><i class="fas fa-shield-alt"></i></div>
          <h3>Calidad garantizada</h3>
          <p>Trabajamos únicamente con marcas reconocidas. Más de 10 años de reputación lo respaldan.</p>
        </div>
      </div>
    </div>
  </section>


  <!-- ══════════════════════════════
       BRANDS — Marcas que distribuimos
  ══════════════════════════════ -->
  <section class="brands">
    <div class="container">
      <div class="brands-header">
        <p>Marcas que distribuimos</p>
      </div>
      <div class="brands-grid">
        <div class="brand-item">
          <img src="assets/img/Pretul (1).jpg" alt="Pretul">
        </div>
        <div class="brand-item">
          <img src="assets/img/Truper (1).jpg" alt="Truper">
        </div>
        <div class="brand-item">
          <img src="assets/img/Rotoplas.jpg" alt="Rotoplas">
        </div>
        <div class="brand-item">
          <img src="assets/img/surtek.png" alt="Surtek">
        </div>
        <div class="brand-item">
          <img src="assets/img/volteck.png" alt="Volteck">
        </div>
        <div class="brand-item">
          <img src="assets/img/cn.jpg" alt="Grupo CN">
        </div>
      </div>
    </div>
  </section>


  <!-- ══════════════════════════════
       LOCATION
  ══════════════════════════════ -->
  <section class="location" id="ubicacion">
    <div class="container">
      <div class="location-info">
        <span class="section-tag">Dónde encontrarnos</span>
        <h2 class="section-title">Visítanos en<br>nuestra sucursal</h2>

        <div class="location-details">
          <div class="location-detail-item">
            <div class="detail-icon"><i class="fas fa-map-marker-alt"></i></div>
            <div class="detail-text">
              <strong>Dirección</strong>
              <span>Estado de México, México</span>
            </div>
          </div>
          <div class="location-detail-item">
            <div class="detail-icon"><i class="fas fa-phone-alt"></i></div>
            <div class="detail-text">
              <strong>Teléfono</strong>
              <span>(722) 706 0685</span>
            </div>
          </div>
          <div class="location-detail-item">
            <div class="detail-icon"><i class="fab fa-whatsapp"></i></div>
            <div class="detail-text">
              <strong>WhatsApp</strong>
              <span>+52 720 829 3653</span>
            </div>
          </div>
        </div>

        <a href="https://wa.me/527208293653?text=Hola%20quiero%20más%20información"
           target="_blank" class="btn btn-brand">
          Escribir por WhatsApp <i class="fab fa-whatsapp"></i>
        </a>
      </div>

      <div class="location-map">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3766.2141671446207!2d-99.60632023414108!3d19.27305052320629!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85cd8a4c245f819f%3A0xdebb19905b3958ab!2sFerreter%C3%ADa%20Rodcas!5e0!3m2!1ses-419!2smx!4v1629762035258!5m2!1ses-419!2smx"
          allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
        </iframe>
      </div>
    </div>
  </section>


  <!-- ══════════════════════════════
       CTA BANNER
  ══════════════════════════════ -->
  <section class="cta-banner">
    <div class="container">
      <h2>¿Listo para empezar tu proyecto?</h2>
      <p>Contáctanos hoy y recibe asesoría gratuita de nuestros especialistas.</p>
      <a href="https://wa.me/527208293653?text=Hola%20quiero%20más%20información"
         target="_blank" class="btn btn-brand">
        Hablar con un especialista <i class="fab fa-whatsapp"></i>
      </a>
    </div>
  </section>


  <!-- ══════════════════════════════
       FOOTER
  ══════════════════════════════ -->
  <footer class="footer">
    <div class="container">
      <div class="footer-brand">
        <div class="footer-brand-name">ROD<span>CAS</span></div>
        <div class="footer-brand-sub">Ferretería · Tlapalería · Construcción</div>
      </div>

      <div>
        <div class="footer-copy">&copy; 2025 Ferretería RODCAS. Todos los derechos reservados.</div>
      </div>

      <div>
        <div class="footer-social">
          <a href="https://www.facebook.com/Ferreteria-Rodcas-176411319201953"
             target="_blank" class="footer-social-link" title="Facebook">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="https://wa.me/527208293653"
             target="_blank" class="footer-social-link" title="WhatsApp">
            <i class="fab fa-whatsapp"></i>
          </a>
        </div>
        <div class="footer-dev">
          Desarrollado por <a href="https://facebook.com/Bud3D" target="_blank">LuraDev</a>
        </div>
      </div>
    </div>
  </footer>


  <!-- WhatsApp floating button -->
  <a href="https://wa.me/527208293653?text=Hola%20quiero%20más%20información"
     class="whatsapp-float" target="_blank" title="Contactar por WhatsApp">
    <i class="fab fa-whatsapp"></i>
  </a>


  <!-- ══════════════════════════════
       SCRIPTS
  ══════════════════════════════ -->
  <script>
    // Navbar shadow on scroll
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
      navbar.classList.toggle('elevated', window.scrollY > 10);
    }, { passive: true });

    // Hero bg subtle dezoom on load
    window.addEventListener('load', () => {
      document.getElementById('heroBg').classList.add('loaded');
    });

    // Mobile menu
    function openMenu() {
      document.getElementById('mobileMenu').classList.add('open');
      document.body.style.overflow = 'hidden';
    }
    function closeMenu() {
      document.getElementById('mobileMenu').classList.remove('open');
      document.body.style.overflow = '';
    }
    document.addEventListener('keydown', e => {
      if (e.key === 'Escape') closeMenu();
    });
  </script>

</body>
</html>
