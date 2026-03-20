@extends('layouts.app')

@section('title', 'Nosotros')

@section('content')

<section class="page-hero">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
                <li class="breadcrumb-item active">Nosotros</li>
            </ol>
        </nav>
        <h1><em>Nuestra</em> Historia</h1>
        <p class="mt-2">El equipo y la pasión detrás de Winters Salon.</p>
    </div>
</section>

<section class="section-pad">
    <div class="container">
        <div class="row gy-5 align-items-center">
            <div class="col-lg-6">
                <span class="section-label d-block mb-3">Quiénes somos</span>
                <h2 style="font-size:2.2rem; font-weight:300; line-height:1.3;">
                    Estilo, cuidado<br>
                    <strong style="font-weight:600; color:var(--cafe-brown);">y dedicación.</strong>
                </h2>
                <div class="divider-cafe"></div>
                <p style="color:var(--cafe-gray); line-height:1.9; margin-top:1rem;">
                    En <strong style="color:var(--cafe-dark);">Winters Salon</strong> nos dedicamos
                    a ofrecerte una experiencia única de belleza y cuidado personal.
                    Contamos con un equipo de profesionales apasionados que se mantienen
                    al día con las últimas tendencias del sector.
                </p>
                <p style="color:var(--cafe-gray); line-height:1.9;">
                    Nuestro compromiso es brindarte un servicio de calidad en un ambiente
                    cálido y acogedor, donde cada visita sea una experiencia memorable.
                    Desde cortes y coloración hasta tratamientos especializados, tenemos
                    todo lo que necesitas.
                </p>
                <a href="{{ route('catalogo') }}" class="btn-cafe mt-3">
                    Ver nuestros servicios
                </a>
            </div>
            <div class="col-lg-5 offset-lg-1">
                <div class="row gy-3">
                    @php
                        $valores = [
                            ['icon'=>'bi-award','title'=>'Calidad','desc'=>'Usamos solo productos de primera calidad para garantizar los mejores resultados.'],
                            ['icon'=>'bi-people','title'=>'Equipo profesional','desc'=>'Estilistas certificados con años de experiencia y formación continua.'],
                            ['icon'=>'bi-heart','title'=>'Atención personalizada','desc'=>'Cada cliente es único. Adaptamos cada servicio a tus necesidades.'],
                            ['icon'=>'bi-star','title'=>'Experiencia','desc'=>'Más de 10 años creando looks increíbles para nuestros clientes.'],
                        ];
                    @endphp
                    @foreach($valores as $v)
                    <div class="col-6">
                        <div class="card p-3 h-100">
                            <i class="bi {{ $v['icon'] }}" style="font-size:1.4rem; color:var(--cafe-gold); margin-bottom:.5rem;"></i>
                            <div style="font-size:.85rem; font-weight:600; margin-bottom:.3rem;">{{ $v['title'] }}</div>
                            <p style="font-size:.78rem; color:var(--cafe-gray); margin:0; line-height:1.6;">{{ $v['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-pad" style="background: var(--cafe-cream);">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-5 text-center">
                <span class="section-label d-block mb-3">Nuestro equipo</span>
                <h2 style="font-size:2rem; font-weight:300; line-height:1.3;">
                    Profesionales <strong style="font-weight:600; color:var(--cafe-brown);">apasionados.</strong>
                </h2>
            </div>
        </div>
        <div class="row gy-4 justify-content-center">
            @php
                $equipo = [
                    ['nombre'=>'Ana Winters','rol'=>'Fundadora & Estilista Senior','icono'=>'bi-person-circle'],
                    ['nombre'=>'Carlos Méndez','rol'=>'Colorista Especialista','icono'=>'bi-person-circle'],
                    ['nombre'=>'Sofía Reyes','rol'=>'Estilista & Tratamientos','icono'=>'bi-person-circle'],
                ];
            @endphp
            @foreach($equipo as $e)
            <div class="col-sm-6 col-md-4">
                <div class="card p-4 text-center h-100">
                    <i class="bi {{ $e['icono'] }}" style="font-size:3.5rem; color:var(--cafe-warm); margin-bottom:1rem;"></i>
                    <h5 style="font-weight:600; font-size:1rem; margin-bottom:.3rem;">{{ $e['nombre'] }}</h5>
                    <p style="font-size:.8rem; color:var(--cafe-gray); margin:0;">{{ $e['rol'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="section-pad">
    <div class="container">
        <div class="row gy-4">
            <div class="col-md-6">
                <div class="card p-4 p-lg-5 h-100" style="border-left: 2px solid var(--cafe-gold);">
                    <i class="bi bi-gem" style="font-size:1.6rem; color:var(--cafe-gold); margin-bottom:1rem;"></i>
                    <h4 style="font-weight:600; font-size:1.1rem;">Misión</h4>
                    <div class="divider-cafe"></div>
                    <p style="color:var(--cafe-gray); line-height:1.9; margin-bottom:0; font-size:.9rem;">
                        Brindar servicios de belleza y cuidado personal de la más alta calidad,
                        en un ambiente cómodo y profesional, haciendo que cada cliente
                        se sienta especial y satisfecho con los resultados.
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card p-4 p-lg-5 h-100" style="border-left: 2px solid var(--cafe-brown);">
                    <i class="bi bi-eye" style="font-size:1.6rem; color:var(--cafe-brown); margin-bottom:1rem;"></i>
                    <h4 style="font-weight:600; font-size:1.1rem;">Visión</h4>
                    <div class="divider-cafe"></div>
                    <p style="color:var(--cafe-gray); line-height:1.9; margin-bottom:0; font-size:.9rem;">
                        Ser el salón de referencia en Jalisco, reconocido por nuestra
                        excelencia en servicio, innovación en técnicas y el trato
                        cálido y personalizado que ofrecemos a cada uno de nuestros clientes.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection