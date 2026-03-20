@extends('layouts.app')

@section('title', 'Inicio')

@section('content')

{{-- HERO --}}
<section style="background: var(--cafe-dark); padding: 6rem 0;">
    <div class="container">
        <div class="row align-items-center gy-4">
            <div class="col-lg-6">
                <span class="section-label d-block mb-3">
                    <i class="bi bi-cup-hot me-2"></i>Winters Salon
                </span>
                <h1 style="font-size:clamp(2.2rem,5vw,3.5rem);
                           color:var(--cafe-cream); font-weight:300; line-height:1.15;">
                    El café que<br>
                    <strong style="font-weight:600; color:var(--cafe-gold);">te inspira.</strong>
                </h1>
                <div class="divider-cafe mt-3 mb-3"></div>
                <p style="color:rgba(245,237,228,.6); font-size:.95rem; max-width:400px; line-height:1.8;">
                    Granos seleccionados, ambiente acogedor y sabores que enamoran.
                    Visítanos y vive la experiencia.
                </p>
                <div class="d-flex flex-wrap gap-3 mt-4">
                    <a href="{{ route('catalogo') }}" class="btn-cafe">Ver Menú</a>
                    <a href="{{ route('contacto') }}"
                       class="btn-outline-cafe"
                       style="border-color:rgba(245,237,228,.25); color:rgba(245,237,228,.7);">
                        Contáctanos
                    </a>
                </div>
            </div>
            <div class="col-lg-4 offset-lg-2 d-none d-lg-flex justify-content-center">
                <div style="text-align:center; padding:2.5rem;
                            border:1px solid rgba(212,168,83,.15); border-radius:4px;">
                    <i class="bi bi-cup-hot" style="font-size:5rem; color:var(--cafe-gold); opacity:.7;"></i>
                    <div style="color:var(--cafe-gold); font-size:2.5rem; font-weight:300; margin-top:1rem;">
                        Since '24
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CTA --}}
<section style="background: var(--cafe-brown); padding: 4rem 0;">
    <div class="container text-center">
        <h2 style="color:var(--cafe-cream); font-size:1.8rem; font-weight:300; margin-bottom:1rem;">
            Descubre nuestro <strong style="font-weight:600;">menú completo</strong>
        </h2>
        <p style="color:rgba(245,237,228,.6); margin-bottom:2rem; font-size:.9rem;">
            Bebidas y alimentos disponibles en línea.
        </p>
        <a href="{{ route('catalogo') }}" class="btn-cafe"
           style="background:var(--cafe-cream); color:var(--cafe-brown); padding:.85rem 2.5rem;">
            Ver Menú
        </a>
    </div>
</section>

@endsection