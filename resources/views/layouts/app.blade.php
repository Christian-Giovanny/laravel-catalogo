<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'Winters Salon - Tu lugar favorito')">
    <title>@yield('title', 'Inicio') — Winters Salon</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --cafe-dark:    #1a0f0a;
            --cafe-brown:   #6b3f2a;
            --cafe-warm:    #c8956c;
            --cafe-cream:   #f5ede4;
            --cafe-light:   #faf7f4;
            --cafe-gold:    #d4a853;
            --cafe-gray:    #8a7d76;
            --transition:   0.2s ease;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--cafe-light);
            color: var(--cafe-dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── NAVBAR ── */
        .main-nav {
            background: var(--cafe-dark);
            padding: 1rem 0;
        }

        .navbar-brand-logo {
            font-size: 1.2rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            color: var(--cafe-cream) !important;
            text-decoration: none;
        }
        .navbar-brand-logo span {
            color: var(--cafe-gold);
        }

        .main-nav .nav-link {
            color: rgba(245,237,228,.65) !important;
            font-size: 0.82rem;
            font-weight: 500;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 0.4rem 0.9rem !important;
            transition: color var(--transition);
        }
        .main-nav .nav-link:hover,
        .main-nav .nav-link.active {
            color: var(--cafe-gold) !important;
        }

        .navbar-toggler { border-color: rgba(212,168,83,.4); }
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='%23d4a853' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* ── PAGE HERO ── */
        .page-hero {
            background: var(--cafe-dark);
            color: var(--cafe-cream);
            padding: 3rem 0 2rem;
        }
        .page-hero h1 {
            font-size: clamp(1.8rem, 4vw, 2.8rem);
            font-weight: 300;
            letter-spacing: 0.02em;
        }
        .page-hero h1 em {
            color: var(--cafe-gold);
            font-style: normal;
            font-weight: 600;
        }
        .page-hero p { color: rgba(245,237,228,.55); }

        .breadcrumb-item + .breadcrumb-item::before { color: rgba(245,237,228,.3); }
        .breadcrumb-item a { color: var(--cafe-gold); text-decoration: none; }
        .breadcrumb-item.active { color: rgba(245,237,228,.45); font-size:.875rem; }

        /* ── BUTTONS ── */
        .btn-cafe {
            background: var(--cafe-brown);
            color: var(--cafe-cream);
            font-size: 0.78rem;
            font-weight: 500;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            border: none;
            border-radius: 3px;
            padding: 0.65rem 1.6rem;
            transition: background var(--transition);
            text-decoration: none;
            display: inline-block;
            cursor: pointer;
        }
        .btn-cafe:hover {
            background: var(--cafe-dark);
            color: var(--cafe-gold);
        }
        .btn-outline-cafe {
            border: 1px solid var(--cafe-brown);
            color: var(--cafe-brown);
            font-size: 0.78rem;
            font-weight: 500;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            border-radius: 3px;
            padding: 0.63rem 1.58rem;
            background: transparent;
            transition: all var(--transition);
            text-decoration: none;
            display: inline-block;
        }
        .btn-outline-cafe:hover {
            background: var(--cafe-brown);
            color: var(--cafe-cream);
        }

        /* ── CARDS ── */
        .card {
            border: 1px solid rgba(107,63,42,.12);
            border-radius: 4px;
            background: #fff;
            transition: box-shadow var(--transition);
        }
        .card:hover {
            box-shadow: 0 8px 24px rgba(26,15,10,.08);
        }

        /* ── PRECIO ── */
        .precio-badge {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--cafe-brown);
        }

        /* ── PRODUCT IMG ── */
        .product-img {
            height: 200px;
            object-fit: contain;
            padding: 1.2rem;
            background: var(--cafe-cream);
            border-bottom: 1px solid rgba(107,63,42,.08);
            width: 100%;
        }

        /* ── DETAIL IMG ── */
        .img-detail {
            max-height: 400px;
            object-fit: contain;
            border: 1px solid rgba(107,63,42,.12);
            border-radius: 4px;
            background: var(--cafe-cream);
            padding: 1.5rem;
            width: 100%;
        }
        .img-thumb {
            height: 100px;
            object-fit: contain;
            border: 1px solid rgba(107,63,42,.12);
            border-radius: 4px;
            background: var(--cafe-cream);
            padding: 0.5rem;
            width: 100%;
            cursor: pointer;
            transition: border-color var(--transition);
        }
        .img-thumb:hover { border-color: var(--cafe-gold); }

        /* ── MISC ── */
        main { flex: 1; }
        .section-pad { padding: 4rem 0; }
        .section-label {
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--cafe-gold);
        }
        .divider-cafe {
            width: 36px;
            height: 2px;
            background: var(--cafe-gold);
            margin: 0.8rem 0;
        }
        .stock-in  { color: #2d7a4f; font-weight: 500; }
        .stock-out { color: #c0392b; font-weight: 500; }

        /* ── FOOTER ── */
        footer {
            background: var(--cafe-dark);
            color: rgba(245,237,228,.5);
        }
        footer a { color: var(--cafe-gold); text-decoration: none; }
        footer a:hover { color: var(--cafe-cream); }
        .footer-brand {
            font-size: 1.2rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            color: var(--cafe-cream);
        }
        .footer-brand span { color: var(--cafe-gold); }

        @media (max-width: 576px) {
            .product-img { height: 160px; }
        }
    </style>

    @stack('styles')
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg main-nav">
    <div class="container">
        <a class="navbar-brand-logo" href="{{ route('inicio') }}">
            Winters <span>Salon</span>
        </a>
        <button class="navbar-toggler ms-auto" type="button"
                data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto gap-1">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('inicio') ? 'active' : '' }}"
                       href="{{ route('inicio') }}">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('nosotros') ? 'active' : '' }}"
                       href="{{ route('nosotros') }}">Nosotros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('catalogo*') ? 'active' : '' }}"
                       href="{{ route('catalogo') }}">Catálogo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('contacto') ? 'active' : '' }}"
                       href="{{ route('contacto') }}">Contacto</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- CONTENIDO -->
<main>
    @yield('content')
</main>

<!-- FOOTER -->
<footer class="py-4 mt-auto">
    <div class="container">
        <div class="row gy-3 align-items-center">
            <div class="col-md-4">
                <div class="footer-brand mb-1">Winters <span>Salon</span></div>
                <p style="font-size:.8rem;margin:0;color:rgba(245,237,228,.5);">
                    Jalisco, México — hola@winterssalon.mx
                </p>
            </div>
            <div class="col-md-4 text-md-center">
                <div class="d-flex justify-content-md-center gap-3" style="font-size:.82rem;">
                    <a href="{{ route('inicio') }}">Inicio</a>
                    <a href="{{ route('nosotros') }}">Nosotros</a>
                    <a href="{{ route('catalogo') }}">Catálogo</a>
                    <a href="{{ route('contacto') }}">Contacto</a>
                </div>
            </div>
            <div class="col-md-4 text-md-end" style="font-size:.78rem;">
                <span>&copy; {{ date('Y') }} Winters Salon</span>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>