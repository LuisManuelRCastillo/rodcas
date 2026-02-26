<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Catálogo — Ferretería RODCAS</title>
  <meta name="description" content="Catálogo completo de productos de Ferretería RODCAS. Materiales, herramientas y más.">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
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
      background: var(--bg-light);
      line-height: 1.6;
      -webkit-font-smoothing: antialiased;
    }

    a { text-decoration: none; color: inherit; }
    img { display: block; max-width: 100%; }

    .container {
      max-width: 1280px;
      margin: 0 auto;
      padding: 0 32px;
    }

    /* ══════════════════════════════
       NAVIGATION
    ══════════════════════════════ */
    .navbar {
      position: sticky;
      top: 0;
      z-index: 200;
      background: var(--white);
      border-bottom: 1px solid var(--border);
      transition: box-shadow 0.3s;
    }
    .navbar.elevated { box-shadow: 0 4px 20px rgba(0,0,0,0.08); }
    .navbar .container {
      display: flex;
      align-items: center;
      height: 68px;
    }
    .nav-logo img { height: 42px; }
    .nav-menu {
      display: flex;
      align-items: center;
      gap: 32px;
      margin-left: auto;
    }
    .nav-menu a {
      color: var(--mid);
      font-size: 0.8125rem;
      font-weight: 500;
      letter-spacing: 0.05em;
      text-transform: uppercase;
      transition: color 0.25s;
      padding-bottom: 2px;
      border-bottom: 2px solid transparent;
    }
    .nav-menu a:hover { color: var(--dark); }
    .nav-menu a.active {
      color: var(--brand);
      border-bottom-color: var(--brand);
    }
    .nav-menu .nav-cta {
      background: var(--brand);
      color: var(--white);
      padding: 9px 20px;
      border-bottom: none;
    }
    .nav-menu .nav-cta:hover {
      background: var(--brand-dark);
      color: var(--white);
    }
    .nav-toggle {
      display: none;
      flex-direction: column;
      justify-content: center;
      gap: 5px;
      cursor: pointer;
      padding: 6px;
      margin-left: auto;
    }
    .nav-toggle span {
      display: block;
      width: 22px;
      height: 2px;
      background: var(--dark);
    }

    /* Mobile overlay */
    .mobile-menu {
      display: none;
      position: fixed;
      inset: 0;
      background: var(--dark);
      z-index: 9999;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 40px;
    }
    .mobile-menu.open { display: flex; }
    .mobile-menu a {
      color: rgba(255,255,255,0.8);
      font-size: 1.6rem;
      font-weight: 700;
      text-transform: uppercase;
    }
    .mobile-menu a:hover,
    .mobile-menu a.active { color: var(--brand); }
    .mobile-close {
      position: absolute;
      top: 22px; right: 24px;
      background: none;
      border: none;
      color: rgba(255,255,255,0.4);
      font-size: 1.3rem;
      cursor: pointer;
    }

    /* ══════════════════════════════
       PAGE HEADER
    ══════════════════════════════ */
    .page-header {
      background: var(--dark);
      padding: 36px 0 30px;
      border-bottom: 3px solid var(--brand);
    }
    .page-header .container {
      display: flex;
      align-items: flex-end;
      justify-content: space-between;
      gap: 20px;
    }
    .page-header-left { }
    .breadcrumb {
      font-size: 0.75rem;
      color: rgba(255,255,255,0.35);
      letter-spacing: 0.08em;
      text-transform: uppercase;
      margin-bottom: 8px;
    }
    .breadcrumb a {
      color: rgba(255,255,255,0.35);
      transition: color 0.2s;
    }
    .breadcrumb a:hover { color: rgba(255,255,255,0.7); }
    .breadcrumb span { color: rgba(255,255,255,0.55); }
    .page-header h1 {
      font-size: 1.75rem;
      font-weight: 800;
      color: var(--white);
      letter-spacing: -0.025em;
    }
    .result-count {
      font-size: 0.8125rem;
      color: rgba(255,255,255,0.4);
      font-weight: 500;
    }
    .result-count strong {
      color: var(--brand);
      font-size: 1.125rem;
      font-weight: 700;
    }

    /* ══════════════════════════════
       SEARCH BAR
    ══════════════════════════════ */
    .search-section {
      background: var(--white);
      border-bottom: 1px solid var(--border);
      padding: 16px 0;
    }
    .search-bar {
      display: flex;
      align-items: center;
      gap: 0;
      max-width: 680px;
      position: relative;
    }
    .search-bar-icon {
      position: absolute;
      left: 18px;
      color: var(--muted);
      font-size: 0.9rem;
      pointer-events: none;
    }
    .search-input {
      flex: 1;
      height: 48px;
      padding: 0 48px 0 46px;
      font-family: inherit;
      font-size: 0.9375rem;
      font-weight: 400;
      color: var(--dark);
      background: var(--bg-light);
      border: 1px solid var(--border);
      border-right: none;
      outline: none;
      transition: border-color 0.25s, background 0.25s;
    }
    .search-input::placeholder { color: var(--muted); }
    .search-input:focus {
      background: var(--white);
      border-color: var(--brand);
    }
    .search-clear {
      position: absolute;
      right: 100px;
      background: none;
      border: none;
      color: var(--muted);
      font-size: 1.1rem;
      cursor: pointer;
      padding: 4px 8px;
      line-height: 1;
      transition: color 0.2s;
    }
    .search-clear:hover { color: var(--dark); }
    .search-btn {
      height: 48px;
      padding: 0 24px;
      background: var(--brand);
      color: var(--white);
      border: none;
      font-family: inherit;
      font-size: 0.8125rem;
      font-weight: 700;
      letter-spacing: 0.06em;
      text-transform: uppercase;
      cursor: pointer;
      transition: background 0.25s;
      white-space: nowrap;
    }
    .search-btn:hover { background: var(--brand-dark); }

    /* ══════════════════════════════
       CATALOG LAYOUT
    ══════════════════════════════ */
    .catalog-body {
      padding: 32px 0 64px;
    }
    .catalog-layout {
      display: grid;
      grid-template-columns: 240px 1fr;
      gap: 28px;
      align-items: start;
    }

    /* ══════════════════════════════
       SIDEBAR FILTERS
    ══════════════════════════════ */
    .sidebar {
      background: var(--white);
      border: 1px solid var(--border);
      position: sticky;
      top: 100px;
    }
    .sidebar-title {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 18px 20px;
      border-bottom: 1px solid var(--border);
    }
    .sidebar-title h2 {
      font-size: 0.8125rem;
      font-weight: 700;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      color: var(--dark);
    }
    .clear-all {
      font-size: 0.75rem;
      color: var(--brand);
      font-weight: 600;
      transition: opacity 0.2s;
    }
    .clear-all:hover { opacity: 0.7; }

    .sidebar-section {
      padding: 20px;
      border-bottom: 1px solid var(--border);
    }
    .sidebar-section:last-child { border-bottom: none; }
    .sidebar-section-label {
      font-size: 0.6875rem;
      font-weight: 700;
      letter-spacing: 0.15em;
      text-transform: uppercase;
      color: var(--muted);
      margin-bottom: 14px;
    }

    /* Department radio options */
    .filter-opts { display: flex; flex-direction: column; gap: 4px; }
    .filter-opt {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 8px 10px;
      cursor: pointer;
      transition: background 0.2s;
      border-radius: 0;
      font-size: 0.875rem;
      color: var(--mid);
      font-weight: 400;
    }
    .filter-opt:hover { background: var(--bg-light); color: var(--dark); }
    .filter-opt input[type="radio"],
    .filter-opt input[type="checkbox"] {
      accent-color: var(--brand);
      width: 15px;
      height: 15px;
      flex-shrink: 0;
    }
    .filter-opt.is-active {
      color: var(--brand);
      font-weight: 600;
    }

    /* Department scroll if many items */
    .dept-scroll {
      max-height: 280px;
      overflow-y: auto;
      scrollbar-width: thin;
      scrollbar-color: var(--border) transparent;
    }
    .dept-scroll::-webkit-scrollbar { width: 4px; }
    .dept-scroll::-webkit-scrollbar-thumb { background: var(--border); }

    /* Sort select */
    .filter-select {
      width: 100%;
      padding: 10px 12px;
      font-family: inherit;
      font-size: 0.875rem;
      color: var(--dark);
      background: var(--bg-light);
      border: 1px solid var(--border);
      outline: none;
      cursor: pointer;
      appearance: none;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%23888' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 12px center;
      padding-right: 32px;
    }
    .filter-select:focus { border-color: var(--brand); }

    /* Mobile filter btn */
    .mobile-filter-toggle {
      display: none;
      width: 100%;
      padding: 12px 16px;
      background: var(--white);
      border: 1px solid var(--border);
      font-family: inherit;
      font-size: 0.875rem;
      font-weight: 600;
      color: var(--dark);
      cursor: pointer;
      text-align: left;
      gap: 10px;
      align-items: center;
      margin-bottom: 16px;
    }
    .mobile-filter-toggle i { color: var(--brand); }

    /* ══════════════════════════════
       PRODUCTS AREA
    ══════════════════════════════ */
    .products-topbar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 16px;
    }
    .products-count {
      font-size: 0.8125rem;
      color: var(--muted);
      font-weight: 500;
    }
    .products-count strong { color: var(--dark); font-weight: 700; }

    /* Active filter tags */
    .active-filters {
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
      margin-bottom: 20px;
    }
    .filter-tag {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      background: rgba(220,99,54,0.08);
      color: var(--brand);
      border: 1px solid rgba(220,99,54,0.2);
      padding: 4px 10px 4px 12px;
      font-size: 0.8125rem;
      font-weight: 600;
    }
    .filter-tag-remove {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 18px;
      height: 18px;
      background: rgba(220,99,54,0.15);
      color: var(--brand);
      font-size: 0.75rem;
      font-weight: 700;
      border-radius: 50%;
      transition: background 0.2s;
      cursor: pointer;
    }
    .filter-tag-remove:hover { background: var(--brand); color: white; }

    /* Products Grid */
    .products-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 16px;
    }

    /* ══════════════════════════════
       PRODUCT CARD
    ══════════════════════════════ */
    .product-card {
      background: var(--white);
      border: 1px solid var(--border);
      display: flex;
      flex-direction: column;
      transition: border-color 0.25s, box-shadow 0.25s, transform 0.25s;
      position: relative;
      overflow: hidden;
    }
    .product-card:hover {
      border-color: rgba(220,99,54,0.3);
      box-shadow: 0 8px 32px rgba(0,0,0,0.08);
      transform: translateY(-2px);
    }
    .product-card::before {
      content: '';
      position: absolute;
      top: 0; left: 0; right: 0;
      height: 3px;
      background: var(--brand);
      transform: scaleX(0);
      transform-origin: left;
      transition: transform 0.3s ease;
    }
    .product-card:hover::before { transform: scaleX(1); }

    /* Card visual area (replaces image) */
    .card-visual {
      height: 110px;
      background: linear-gradient(135deg, #F5F4F2 0%, #ECEAE6 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      overflow: hidden;
      border-bottom: 1px solid var(--border);
    }
    .card-visual::before {
      content: '';
      position: absolute;
      right: -28px;
      bottom: -28px;
      width: 100px;
      height: 100px;
      border-radius: 50%;
      background: rgba(220,99,54,0.06);
    }
    .card-visual::after {
      content: '';
      position: absolute;
      left: -16px;
      top: -16px;
      width: 60px;
      height: 60px;
      border-radius: 50%;
      background: rgba(220,99,54,0.04);
    }
    .card-visual-icon {
      font-size: 2rem;
      color: rgba(220,99,54,0.22);
      position: relative;
      z-index: 1;
    }

    /* Stock dot on card visual */
    .stock-indicator {
      position: absolute;
      top: 12px;
      right: 12px;
      display: flex;
      align-items: center;
      gap: 5px;
      font-size: 0.6875rem;
      font-weight: 600;
      letter-spacing: 0.05em;
      padding: 3px 8px;
      background: var(--white);
      border: 1px solid var(--border);
    }
    .stock-indicator .dot {
      width: 6px;
      height: 6px;
      border-radius: 50%;
      flex-shrink: 0;
    }
    .stock-indicator.in  { color: #16a34a; border-color: rgba(22,163,74,0.2); }
    .stock-indicator.in  .dot { background: #16a34a; }
    .stock-indicator.out { color: var(--muted); border-color: var(--border); }
    .stock-indicator.out .dot { background: var(--muted); }

    /* Card content */
    .card-body {
      padding: 18px 18px 14px;
      display: flex;
      flex-direction: column;
      flex: 1;
    }
    .dept-pill {
      display: inline-block;
      font-size: 0.6375rem;
      font-weight: 700;
      letter-spacing: 0.14em;
      text-transform: uppercase;
      color: var(--brand);
      background: rgba(220,99,54,0.07);
      padding: 3px 8px;
      margin-bottom: 10px;
      align-self: flex-start;
    }
    .product-name {
      font-size: 0.9375rem;
      font-weight: 700;
      color: var(--dark);
      line-height: 1.35;
      letter-spacing: -0.01em;
      margin-bottom: 4px;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }
    .product-code {
      font-size: 0.7125rem;
      color: var(--muted);
      font-weight: 500;
      letter-spacing: 0.04em;
      margin-bottom: 14px;
    }

    /* Price grid */
    .price-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 0;
      border: 1px solid var(--border);
      margin-bottom: 14px;
    }
    .price-cell {
      padding: 10px 12px;
    }
    .price-cell:first-child {
      border-right: 1px solid var(--border);
    }
    .price-cell-label {
      font-size: 0.625rem;
      font-weight: 600;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      color: var(--muted);
      margin-bottom: 3px;
    }
    .price-cell-value {
      font-size: 1rem;
      font-weight: 800;
      color: var(--dark);
      letter-spacing: -0.02em;
      line-height: 1;
    }
    .price-cell-value.wholesale {
      color: var(--brand);
    }
    .price-consultar {
      font-size: 0.75rem;
      color: var(--muted);
      font-weight: 500;
    }

    /* Card footer */
    .card-footer {
      display: flex;
      align-items: center;
      justify-content: flex-end;
      gap: 8px;
      margin-top: auto;
      padding-top: 4px;
    }
    .wa-btn {
      display: inline-flex;
      align-items: center;
      gap: 7px;
      background: #25D366;
      color: var(--white);
      padding: 9px 14px;
      font-size: 0.75rem;
      font-weight: 700;
      letter-spacing: 0.04em;
      text-transform: uppercase;
      transition: background 0.25s, transform 0.2s;
      white-space: nowrap;
    }
    .wa-btn:hover {
      background: #1fb859;
      transform: translateY(-1px);
      color: var(--white);
    }
    .wa-btn i { font-size: 0.875rem; }

    /* ══════════════════════════════
       NO RESULTS
    ══════════════════════════════ */
    .no-results {
      grid-column: 1 / -1;
      text-align: center;
      padding: 80px 20px;
      background: var(--white);
      border: 1px solid var(--border);
    }
    .no-results-icon {
      font-size: 3rem;
      color: var(--border);
      margin-bottom: 20px;
    }
    .no-results h3 {
      font-size: 1.25rem;
      font-weight: 700;
      color: var(--dark);
      margin-bottom: 8px;
    }
    .no-results p {
      font-size: 0.9375rem;
      color: var(--muted);
      margin-bottom: 24px;
    }
    .no-results a {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: var(--brand);
      color: var(--white);
      padding: 12px 28px;
      font-size: 0.8125rem;
      font-weight: 700;
      letter-spacing: 0.06em;
      text-transform: uppercase;
      transition: background 0.25s;
    }
    .no-results a:hover { background: var(--brand-dark); }

    /* ══════════════════════════════
       PAGINATION
    ══════════════════════════════ */
    .pagination-wrap {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
      margin-top: 40px;
      flex-wrap: wrap;
    }
    .page-item {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 38px;
      height: 38px;
      font-size: 0.875rem;
      font-weight: 600;
      color: var(--mid);
      background: var(--white);
      border: 1px solid var(--border);
      transition: all 0.2s;
      cursor: pointer;
    }
    .page-item:hover { border-color: var(--brand); color: var(--brand); }
    .page-item.active {
      background: var(--brand);
      border-color: var(--brand);
      color: var(--white);
    }
    .page-item.disabled {
      opacity: 0.35;
      cursor: not-allowed;
      pointer-events: none;
    }
    .page-item.wide {
      width: auto;
      padding: 0 14px;
      gap: 6px;
      font-size: 0.8125rem;
    }

    /* ══════════════════════════════
       FOOTER
    ══════════════════════════════ */
    .footer {
      background: #0D0D0D;
      padding: 32px 0;
      border-top: 1px solid rgba(255,255,255,0.05);
    }
    .footer .container {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .footer-brand-name {
      font-size: 1rem;
      font-weight: 800;
      color: var(--white);
      letter-spacing: -0.02em;
    }
    .footer-brand-name span { color: var(--brand); }
    .footer-brand-sub {
      font-size: 0.625rem;
      color: rgba(255,255,255,0.2);
      letter-spacing: 0.12em;
      text-transform: uppercase;
      margin-top: 3px;
    }
    .footer-copy {
      font-size: 0.75rem;
      color: rgba(255,255,255,0.22);
    }

    /* WhatsApp float */
    .whatsapp-float {
      position: fixed;
      bottom: 24px; right: 24px;
      z-index: 998;
      width: 52px; height: 52px;
      background: #25D366;
      color: var(--white);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.4rem;
      box-shadow: 0 6px 24px rgba(37,211,102,0.4);
      transition: all 0.3s;
    }
    .whatsapp-float:hover {
      transform: scale(1.1) translateY(-2px);
      color: var(--white);
    }

    /* ══════════════════════════════
       RESPONSIVE
    ══════════════════════════════ */
    @media (max-width: 1100px) {
      .products-grid { grid-template-columns: repeat(2, 1fr); }
      .catalog-layout { grid-template-columns: 220px 1fr; gap: 20px; }
    }

    @media (max-width: 900px) {
      .catalog-layout { grid-template-columns: 1fr; }
      .sidebar { position: static; display: none; }
      .sidebar.open { display: block; }
      .mobile-filter-toggle { display: flex; }
      .products-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 640px) {
      .container { padding: 0 16px; }
      .products-grid { grid-template-columns: repeat(2, 1fr); gap: 10px; }
      .nav-menu { display: none; }
      .nav-toggle { display: flex; }
      .page-header .container { flex-direction: column; align-items: flex-start; }
      .search-bar { max-width: 100%; }
      .card-visual { height: 80px; }
      .card-visual-icon { font-size: 1.5rem; }
      .footer .container { flex-direction: column; gap: 12px; text-align: center; }
    }

    @media (max-width: 420px) {
      .products-grid { grid-template-columns: 1fr; }
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
        <img src="/assets/img/logoSF.png" alt="Ferretería RODCAS">
      </a>
      <div class="nav-menu">
        <a href="/">Inicio</a>
        <a href="{{ route('catalogo') }}" class="active">Catálogo</a>
        <a href="https://wa.me/527208293653" target="_blank">WhatsApp</a>
        <a href="{{ route('login') }}" class="nav-cta">Acceder</a>
      </div>
      <div class="nav-toggle" onclick="openMenu()">
        <span></span><span></span><span></span>
      </div>
    </div>
  </nav>

  <!-- Mobile overlay -->
  <div class="mobile-menu" id="mobileMenu">
    <button class="mobile-close" onclick="closeMenu()"><i class="fas fa-times"></i></button>
    <a href="/" onclick="closeMenu()">Inicio</a>
    <a href="{{ route('catalogo') }}" class="active" onclick="closeMenu()">Catálogo</a>
    <a href="https://wa.me/527208293653" target="_blank" onclick="closeMenu()">WhatsApp</a>
    <a href="{{ route('login') }}">Acceder</a>
  </div>


  <!-- ══════════════════════════════
       PAGE HEADER
  ══════════════════════════════ -->
  <div class="page-header">
    <div class="container">
      <div class="page-header-left">
        <div class="breadcrumb">
          <a href="/">Inicio</a>
          <span> &rsaquo; Catálogo</span>
        </div>
        <h1>Catálogo de Productos</h1>
      </div>
      <div class="result-count">
        <strong>{{ $productos->total() }}</strong> productos
      </div>
    </div>
  </div>


  <!-- ══════════════════════════════
       MAIN FORM (filtros vía GET)
  ══════════════════════════════ -->
  <form method="GET" action="{{ route('catalogo') }}" id="filterForm">

    <!-- Search Bar -->
    <div class="search-section">
      <div class="container">
        <div class="search-bar">
          <span class="search-bar-icon"><i class="fas fa-search"></i></span>
          <input
            type="text"
            name="buscar"
            id="searchInput"
            class="search-input"
            placeholder="Buscar por nombre o código..."
            value="{{ request('buscar') }}"
            autocomplete="off"
          >
          @if(request('buscar'))
            <button type="button" class="search-clear" onclick="clearSearch()" title="Limpiar búsqueda">
              &times;
            </button>
          @endif
          <!-- preserve other filters -->
          @if(request('dpto'))      <input type="hidden" name="dpto"       value="{{ request('dpto') }}">      @endif
          @if(request('disponible'))<input type="hidden" name="disponible" value="{{ request('disponible') }}">@endif
          @if(request('orden'))     <input type="hidden" name="orden"      value="{{ request('orden') }}">     @endif
          <button type="submit" class="search-btn">
            <i class="fas fa-search"></i>&nbsp; Buscar
          </button>
        </div>
      </div>
    </div>


    <!-- Catalog Body -->
    <div class="catalog-body">
      <div class="container">

        <!-- Mobile filter toggle -->
        <button type="button" class="mobile-filter-toggle" onclick="toggleSidebar()">
          <i class="fas fa-sliders-h"></i>
          Filtros y ordenamiento
          @if(request()->anyFilled(['dpto','disponible','orden']))
            <span style="background:var(--brand);color:white;padding:1px 7px;font-size:0.7rem;border-radius:20px;margin-left:4px;">
              Activos
            </span>
          @endif
          <i class="fas fa-chevron-down" id="filterChevron" style="margin-left:auto;font-size:0.75rem;color:var(--muted);"></i>
        </button>

        <div class="catalog-layout">

          <!-- ══ SIDEBAR ══ -->
          <aside class="sidebar" id="sidebar">
            <div class="sidebar-title">
              <h2><i class="fas fa-filter" style="color:var(--brand);margin-right:8px;font-size:0.75rem;"></i>Filtros</h2>
              @if(request()->anyFilled(['dpto','disponible']))
                <a href="{{ route('catalogo', array_filter(['buscar' => request('buscar'), 'orden' => request('orden')])) }}" class="clear-all">
                  Limpiar
                </a>
              @endif
            </div>

            <!-- Ordenar -->
            <div class="sidebar-section">
              <div class="sidebar-section-label">Ordenar por</div>
              <select name="orden" class="filter-select" onchange="this.form.submit()">
                <option value="nombre"      {{ request('orden','nombre') === 'nombre'      ? 'selected' : '' }}>Nombre A – Z</option>
                <option value="precio_asc"  {{ request('orden') === 'precio_asc'           ? 'selected' : '' }}>Precio: menor a mayor</option>
                <option value="precio_desc" {{ request('orden') === 'precio_desc'          ? 'selected' : '' }}>Precio: mayor a menor</option>
              </select>
            </div>

            <!-- Disponibilidad -->
            <div class="sidebar-section">
              <div class="sidebar-section-label">Disponibilidad</div>
              <div class="filter-opts">
                <label class="filter-opt {{ request('disponible') == '1' ? 'is-active' : '' }}">
                  <input
                    type="checkbox"
                    name="disponible"
                    value="1"
                    {{ request('disponible') == '1' ? 'checked' : '' }}
                    onchange="this.form.submit()"
                  >
                  Solo productos en stock
                </label>
              </div>
            </div>

            <!-- Departamento -->
            @if($departamentos->isNotEmpty())
            <div class="sidebar-section">
              <div class="sidebar-section-label">Departamento</div>
              <div class="filter-opts dept-scroll">
                <label class="filter-opt {{ !request('dpto') ? 'is-active' : '' }}">
                  <input
                    type="radio"
                    name="dpto"
                    value=""
                    {{ !request('dpto') ? 'checked' : '' }}
                    onchange="this.form.submit()"
                  >
                  Todos los departamentos
                </label>
                @foreach($departamentos as $dept)
                  <label class="filter-opt {{ request('dpto') === $dept ? 'is-active' : '' }}">
                    <input
                      type="radio"
                      name="dpto"
                      value="{{ $dept }}"
                      {{ request('dpto') === $dept ? 'checked' : '' }}
                      onchange="this.form.submit()"
                    >
                    {{ $dept }}
                  </label>
                @endforeach
              </div>
            </div>
            @endif

          </aside><!-- /sidebar -->


          <!-- ══ PRODUCTS AREA ══ -->
          <main>

            <!-- Topbar: count -->
            <div class="products-topbar">
              <span class="products-count">
                Mostrando <strong>{{ $productos->firstItem() ?? 0 }}–{{ $productos->lastItem() ?? 0 }}</strong>
                de <strong>{{ $productos->total() }}</strong> productos
              </span>
            </div>

            <!-- Active filter tags -->
            @if(request()->anyFilled(['buscar','dpto','disponible']))
              <div class="active-filters">
                @if(request('buscar'))
                  <span class="filter-tag">
                    <i class="fas fa-search" style="font-size:.6rem;"></i>
                    "{{ request('buscar') }}"
                    <a class="filter-tag-remove"
                       href="{{ request()->fullUrlWithoutQuery(['buscar','page']) }}"
                       title="Quitar filtro">×</a>
                  </span>
                @endif
                @if(request('dpto'))
                  <span class="filter-tag">
                    <i class="fas fa-tag" style="font-size:.6rem;"></i>
                    {{ request('dpto') }}
                    <a class="filter-tag-remove"
                       href="{{ request()->fullUrlWithoutQuery(['dpto','page']) }}"
                       title="Quitar filtro">×</a>
                  </span>
                @endif
                @if(request('disponible'))
                  <span class="filter-tag">
                    <i class="fas fa-check-circle" style="font-size:.6rem;"></i>
                    En stock
                    <a class="filter-tag-remove"
                       href="{{ request()->fullUrlWithoutQuery(['disponible','page']) }}"
                       title="Quitar filtro">×</a>
                  </span>
                @endif
              </div>
            @endif

            <!-- Products grid -->
            @if($productos->count() > 0)
              <div class="products-grid">
                @foreach($productos as $producto)
                  <div class="product-card">

                    <!-- Visual header -->
                    <div class="card-visual">
                      <i class="fas fa-tools card-visual-icon"></i>
                      {{-- Stock indicator --}}
                      @if($producto->existencia > 0)
                        <span class="stock-indicator in">
                          <span class="dot"></span> En stock
                        </span>
                      @else
                        <span class="stock-indicator out">
                          <span class="dot"></span> Sin stock
                        </span>
                      @endif
                    </div>

                    <!-- Body -->
                    <div class="card-body">
                      @if($producto->dpto)
                        <span class="dept-pill">{{ $producto->dpto }}</span>
                      @endif

                      <h3 class="product-name" title="{{ $producto->producto }}">
                        {{ $producto->producto }}
                      </h3>

                      @if($producto->codigo)
                        <p class="product-code">Cód. {{ $producto->codigo }}</p>
                      @endif

                      <!-- Prices -->
                      <div class="price-grid">
                        <div class="price-cell">
                          <div class="price-cell-label">Venta</div>
                          @if($producto->p_venta > 0)
                            <div class="price-cell-value">
                              ${{ number_format($producto->p_venta, 2) }}
                            </div>
                          @else
                            <div class="price-consultar">Consultar</div>
                          @endif
                        </div>
                        <div class="price-cell">
                          <div class="price-cell-label">Mayoreo</div>
                          @if($producto->p_mayoreo > 0)
                            <div class="price-cell-value wholesale">
                              ${{ number_format($producto->p_mayoreo, 2) }}
                            </div>
                          @else
                            <div class="price-consultar">Consultar</div>
                          @endif
                        </div>
                      </div>

                      <!-- Footer action -->
                      <div class="card-footer">
                        <a
                          href="https://wa.me/527208293653?text={{ urlencode('Hola, me interesa el producto: ' . $producto->producto . ' (Cód. ' . $producto->codigo . ')') }}"
                          target="_blank"
                          class="wa-btn"
                          title="Consultar por WhatsApp"
                        >
                          <i class="fab fa-whatsapp"></i> Consultar
                        </a>
                      </div>
                    </div>

                  </div><!-- /product-card -->
                @endforeach
              </div>

              <!-- Pagination -->
              @if($productos->hasPages())
                <div class="pagination-wrap">

                  {{-- Previous --}}
                  @if($productos->onFirstPage())
                    <span class="page-item wide disabled">
                      <i class="fas fa-chevron-left"></i> Anterior
                    </span>
                  @else
                    <a href="{{ $productos->previousPageUrl() }}" class="page-item wide">
                      <i class="fas fa-chevron-left"></i> Anterior
                    </a>
                  @endif

                  {{-- Page numbers --}}
                  @php
                    $start = max(1, $productos->currentPage() - 2);
                    $end   = min($productos->lastPage(), $productos->currentPage() + 2);
                  @endphp

                  @if($start > 1)
                    <a href="{{ $productos->url(1) }}" class="page-item">1</a>
                    @if($start > 2)
                      <span class="page-item disabled" style="width:auto;padding:0 6px;border:none;">…</span>
                    @endif
                  @endif

                  @for($p = $start; $p <= $end; $p++)
                    <a href="{{ $productos->url($p) }}"
                       class="page-item {{ $p == $productos->currentPage() ? 'active' : '' }}">
                      {{ $p }}
                    </a>
                  @endfor

                  @if($end < $productos->lastPage())
                    @if($end < $productos->lastPage() - 1)
                      <span class="page-item disabled" style="width:auto;padding:0 6px;border:none;">…</span>
                    @endif
                    <a href="{{ $productos->url($productos->lastPage()) }}" class="page-item">
                      {{ $productos->lastPage() }}
                    </a>
                  @endif

                  {{-- Next --}}
                  @if($productos->hasMorePages())
                    <a href="{{ $productos->nextPageUrl() }}" class="page-item wide">
                      Siguiente <i class="fas fa-chevron-right"></i>
                    </a>
                  @else
                    <span class="page-item wide disabled">
                      Siguiente <i class="fas fa-chevron-right"></i>
                    </span>
                  @endif

                </div>
              @endif

            @else
              <!-- No results -->
              <div class="no-results">
                <div class="no-results-icon"><i class="fas fa-search"></i></div>
                <h3>Sin resultados</h3>
                <p>No encontramos productos con los filtros seleccionados.</p>
                <a href="{{ route('catalogo') }}">
                  <i class="fas fa-redo"></i> Ver todos los productos
                </a>
              </div>
            @endif

          </main><!-- /products area -->
        </div><!-- /catalog-layout -->
      </div><!-- /container -->
    </div><!-- /catalog-body -->

  </form><!-- /filterForm -->


  <!-- ══════════════════════════════
       FOOTER
  ══════════════════════════════ -->
  <footer class="footer">
    <div class="container">
      <div>
        <div class="footer-brand-name">ROD<span>CAS</span></div>
        <div class="footer-brand-sub">Ferretería · Tlapalería · Construcción</div>
      </div>
      <div class="footer-copy">
        &copy; 2025 Ferretería RODCAS. Todos los derechos reservados.
      </div>
    </div>
  </footer>


  <!-- WhatsApp float -->
  <a href="https://wa.me/527208293653?text=Hola%20quiero%20más%20información"
     class="whatsapp-float" target="_blank" title="Contactar por WhatsApp">
    <i class="fab fa-whatsapp"></i>
  </a>


  <!-- ══════════════════════════════
       SCRIPTS
  ══════════════════════════════ -->
  <script>
    // Navbar shadow
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
      navbar.classList.toggle('elevated', window.scrollY > 10);
    }, { passive: true });

    // Mobile nav
    function openMenu()  { document.getElementById('mobileMenu').classList.add('open');    document.body.style.overflow = 'hidden'; }
    function closeMenu() { document.getElementById('mobileMenu').classList.remove('open'); document.body.style.overflow = ''; }
    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeMenu(); });

    // Mobile filters sidebar toggle
    function toggleSidebar() {
      const sidebar  = document.getElementById('sidebar');
      const chevron  = document.getElementById('filterChevron');
      const isOpen   = sidebar.classList.toggle('open');
      chevron.style.transform = isOpen ? 'rotate(180deg)' : '';
    }

    // Live search with debounce
    let searchTimer;
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
      searchInput.addEventListener('input', () => {
        clearTimeout(searchTimer);
        searchTimer = setTimeout(() => {
          document.getElementById('filterForm').submit();
        }, 450);
      });
    }

    // Clear search field and submit
    function clearSearch() {
      if (searchInput) searchInput.value = '';
      document.getElementById('filterForm').submit();
    }
  </script>

</body>
</html>
