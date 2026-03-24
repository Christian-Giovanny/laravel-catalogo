@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('content')

<section class="page-hero">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
                <li class="breadcrumb-item active">Iniciar Sesión</li>
            </ol>
        </nav>
        <h1><em>Iniciar</em> Sesión</h1>
        <p class="mt-2">Accede a tu cuenta para gestionar tu perfil.</p>
    </div>
</section>

<section class="section-pad">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">

                @if(session('success'))
                    <div style="background:#f0faf4;border:1px solid #a8d5b8;color:#1a5c35;
                                border-radius:4px;padding:1rem 1.5rem;margin-bottom:1.5rem;">
                        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div style="background:#fdf0f0;border:1px solid #f5c0c0;color:#7f1d1d;
                                border-radius:4px;padding:1rem 1.5rem;margin-bottom:1.5rem;">
                        @foreach($errors->all() as $e)
                            <div><i class="bi bi-exclamation-triangle me-2"></i>{{ $e }}</div>
                        @endforeach
                    </div>
                @endif

                <div class="card p-4 p-lg-5">
                    <h3 style="font-size:1.5rem;font-weight:300;margin-bottom:.5rem;">
                        Bienvenido a <strong style="font-weight:600;color:var(--cafe-brown);">Winters Salon</strong>
                    </h3>
                    <div class="divider-cafe mb-4"></div>

                    <form action="{{ route('cliente.login.post') }}" method="POST" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label style="font-size:.75rem;font-weight:500;letter-spacing:.1em;
                                          text-transform:uppercase;color:var(--cafe-gray);display:block;margin-bottom:.4rem;">
                                Correo electrónico *
                            </label>
                            <input type="email" name="Correo" value="{{ old('Correo') }}"
                                   class="form-control @error('Correo') is-invalid @enderror"
                                   placeholder="tu@correo.com"
                                   style="border-radius:3px;border:1px solid rgba(107,63,42,.2);
                                          padding:.75rem 1rem;font-family:'Poppins',sans-serif;">
                            @error('Correo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-4">
                            <label style="font-size:.75rem;font-weight:500;letter-spacing:.1em;
                                          text-transform:uppercase;color:var(--cafe-gray);display:block;margin-bottom:.4rem;">
                                Contraseña *
                            </label>
                            <input type="password" name="Contrasena"
                                   class="form-control @error('Contrasena') is-invalid @enderror"
                                   placeholder="Tu contraseña"
                                   style="border-radius:3px;border:1px solid rgba(107,63,42,.2);
                                          padding:.75rem 1rem;font-family:'Poppins',sans-serif;">
                            @error('Contrasena')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <button type="submit" class="btn-cafe w-100" style="padding:.85rem;">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Iniciar Sesión
                        </button>
                    </form>

                    <p class="text-center mt-4" style="font-size:.875rem;color:var(--cafe-gray);">
                        ¿No tienes cuenta?
                        <a href="{{ route('cliente.register') }}" style="color:var(--cafe-brown);font-weight:600;">
                            Regístrate aquí
                        </a>
                    </p>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection