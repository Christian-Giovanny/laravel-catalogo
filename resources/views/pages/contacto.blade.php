@extends('layouts.app')

@section('title', 'Contacto')

@section('content')

<section class="page-hero">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
                <li class="breadcrumb-item active">Contacto</li>
            </ol>
        </nav>
        <h1><em>Contáctanos</em></h1>
        <p class="mt-2">Estamos para servirte. Escríbenos cuando quieras.</p>
    </div>
</section>

<section class="section-pad">
    <div class="container">
        <div class="row gy-5">

            {{-- FORMULARIO --}}
            <div class="col-lg-7">

                @if($enviado)
                    <div style="background:#f0faf4;border:1px solid #a8d5b8;color:#1a5c35;
                                border-radius:4px;padding:1.25rem 1.5rem;margin-bottom:1.5rem;">
                        <h5 class="mb-1"><i class="bi bi-check-circle me-2"></i>¡Mensaje enviado!</h5>
                        <p class="mb-0">Gracias por escribirnos. Te responderemos pronto.</p>
                    </div>
                @endif

                @if($errors->any())
                    <div style="background:#fdf0f0;border:1px solid #f5c0c0;color:#7f1d1d;
                                border-radius:4px;padding:1.25rem 1.5rem;margin-bottom:1.5rem;">
                        <strong><i class="bi bi-exclamation-triangle me-2"></i>Corrige los errores:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <span class="section-label d-block mb-2">Escríbenos</span>
                <h3 style="font-size:1.8rem;font-weight:300;margin-bottom:.5rem;">
                    Envíanos un <strong style="font-weight:600;color:var(--cafe-brown);">mensaje</strong>
                </h3>
                <div class="divider-cafe mb-4"></div>

                <form action="{{ route('contacto') }}" method="POST" novalidate>
                    @csrf
                    <div class="row gy-3">
                        <div class="col-sm-6">
                            <label style="font-size:.75rem;font-weight:500;letter-spacing:.1em;
                                          text-transform:uppercase;color:var(--cafe-gray);display:block;margin-bottom:.4rem;">
                                Nombre *
                            </label>
                            <input type="text" name="nombre" value="{{ old('nombre') }}"
                                   class="form-control @error('nombre') is-invalid @enderror"
                                   placeholder="Tu nombre completo"
                                   style="border-radius:3px;border:1px solid rgba(107,63,42,.2);
                                          padding:.75rem 1rem;font-family:'Poppins',sans-serif;">
                            @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-sm-6">
                            <label style="font-size:.75rem;font-weight:500;letter-spacing:.1em;
                                          text-transform:uppercase;color:var(--cafe-gray);display:block;margin-bottom:.4rem;">
                                Correo *
                            </label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                   class="form-control @error('email') is-invalid @enderror"
                                   placeholder="tu@correo.com"
                                   style="border-radius:3px;border:1px solid rgba(107,63,42,.2);
                                          padding:.75rem 1rem;font-family:'Poppins',sans-serif;">
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <label style="font-size:.75rem;font-weight:500;letter-spacing:.1em;
                                          text-transform:uppercase;color:var(--cafe-gray);display:block;margin-bottom:.4rem;">
                                Asunto *
                            </label>
                            <input type="text" name="asunto" value="{{ old('asunto') }}"
                                   class="form-control @error('asunto') is-invalid @enderror"
                                   placeholder="¿En qué te podemos ayudar?"
                                   style="border-radius:3px;border:1px solid rgba(107,63,42,.2);
                                          padding:.75rem 1rem;font-family:'Poppins',sans-serif;">
                            @error('asunto')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <label style="font-size:.75rem;font-weight:500;letter-spacing:.1em;
                                          text-transform:uppercase;color:var(--cafe-gray);display:block;margin-bottom:.4rem;">
                                Mensaje *
                            </label>
                            <textarea name="mensaje" rows="5"
                                      class="form-control @error('mensaje') is-invalid @enderror"
                                      placeholder="Escribe tu mensaje aquí..."
                                      style="border-radius:3px;border:1px solid rgba(107,63,42,.2);
                                             padding:.75rem 1rem;font-family:'Poppins',sans-serif;resize:vertical;">{{ old('mensaje') }}</textarea>
                            @error('mensaje')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn-cafe" style="padding:.8rem 2.2rem;">
                                <i class="bi bi-send me-2"></i>Enviar mensaje
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            {{-- INFO --}}
            <div class="col-lg-4 offset-lg-1">
                <span class="section-label d-block mb-2">Información</span>
                <h3 style="font-size:1.8rem;font-weight:300;margin-bottom:.5rem;">
                    Visítanos en <strong style="font-weight:600;color:var(--cafe-brown);">Winters Salon</strong>
                </h3>
                <div class="divider-cafe mb-4"></div>

                @php
                    $info = [
                        ['icon'=>'bi-geo-alt','title'=>'Ubicación','value'=>'Jalisco, México'],
                        ['icon'=>'bi-envelope','title'=>'Correo','value'=>'hola@winterssalon.mx'],
                        ['icon'=>'bi-telephone','title'=>'Teléfono','value'=>'+52 33 0000 0000'],
                        ['icon'=>'bi-clock','title'=>'Horario','value'=>'Lun–Dom, 7:00–21:00'],
                    ];
                @endphp

                <div class="d-flex flex-column gap-3">
                    @foreach($info as $i)
                    <div class="d-flex align-items-start gap-3">
                        <div style="width:38px;height:38px;flex-shrink:0;border-radius:3px;
                                    background:var(--cafe-cream);border:1px solid rgba(107,63,42,.15);
                                    display:flex;align-items:center;justify-content:center;">
                            <i class="bi {{ $i['icon'] }}" style="color:var(--cafe-brown);font-size:.95rem;"></i>
                        </div>
                        <div>
                            <div style="font-size:.7rem;font-weight:500;letter-spacing:.1em;
                                        text-transform:uppercase;color:var(--cafe-gray);">
                                {{ $i['title'] }}
                            </div>
                            <div style="font-weight:400;color:var(--cafe-dark);font-size:.9rem;">
                                {{ $i['value'] }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>

@endsection