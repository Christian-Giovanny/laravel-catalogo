@extends('layouts.app')

@section('title', 'Registro')

@section('content')

<section class="page-hero">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
                <li class="breadcrumb-item active">Registro</li>
            </ol>
        </nav>
        <h1><em>Crear</em> Cuenta</h1>
        <p class="mt-2">Regístrate para acceder a tu perfil.</p>
    </div>
</section>

<section class="section-pad">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">

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
                        Crear <strong style="font-weight:600;color:var(--cafe-brown);">nueva cuenta</strong>
                    </h3>
                    <div class="divider-cafe mb-4"></div>

                    <form action="{{ route('cliente.register.post') }}" method="POST" novalidate>
                        @csrf
                        <div class="row gy-3">
                            <div class="col-sm-6">
                                <label style="font-size:.75rem;font-weight:500;letter-spacing:.1em;
                                              text-transform:uppercase;color:var(--cafe-gray);display:block;margin-bottom:.4rem;">
                                    Nombres *
                                </label>
                                <input type="text" name="Nombres" value="{{ old('Nombres') }}"
                                       class="form-control @error('Nombres') is-invalid @enderror"
                                       placeholder="Tu nombre"
                                       style="border-radius:3px;border:1px solid rgba(107,63,42,.2);
                                              padding:.75rem 1rem;font-family:'Poppins',sans-serif;">
                                @error('Nombres')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-sm-6">
                                <label style="font-size:.75rem;font-weight:500;letter-spacing:.1em;
                                              text-transform:uppercase;color:var(--cafe-gray);display:block;margin-bottom:.4rem;">
                                    Apellidos *
                                </label>
                                <input type="text" name="Apellidos" value="{{ old('Apellidos') }}"
                                       class="form-control @error('Apellidos') is-invalid @enderror"
                                       placeholder="Tus apellidos"
                                       style="border-radius:3px;border:1px solid rgba(107,63,42,.2);
                                              padding:.75rem 1rem;font-family:'Poppins',sans-serif;">
                                @error('Apellidos')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-12">
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

                            <div class="col-12">
                                <label style="font-size:.75rem;font-weight:500;letter-spacing:.1em;
                                              text-transform:uppercase;color:var(--cafe-gray);display:block;margin-bottom:.4rem;">
                                    Dirección
                                </label>
                                <input type="text" name="Direccion" value="{{ old('Direccion') }}"
                                       class="form-control"
                                       placeholder="Tu dirección (opcional)"
                                       style="border-radius:3px;border:1px solid rgba(107,63,42,.2);
                                              padding:.75rem 1rem;font-family:'Poppins',sans-serif;">
                            </div>

                            <div class="col-sm-6">
                                <label style="font-size:.75rem;font-weight:500;letter-spacing:.1em;
                                              text-transform:uppercase;color:var(--cafe-gray);display:block;margin-bottom:.4rem;">
                                    Contraseña *
                                </label>
                                <input type="password" name="Contrasena"
                                       class="form-control @error('Contrasena') is-invalid @enderror"
                                       placeholder="Mínimo 6 caracteres"
                                       style="border-radius:3px;border:1px solid rgba(107,63,42,.2);
                                              padding:.75rem 1rem;font-family:'Poppins',sans-serif;">
                                @error('Contrasena')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-sm-6">
                                <label style="font-size:.75rem;font-weight:500;letter-spacing:.1em;
                                              text-transform:uppercase;color:var(--cafe-gray);display:block;margin-bottom:.4rem;">
                                    Confirmar contraseña *
                                </label>
                                <input type="password" name="Contrasena_confirmation"
                                       class="form-control"
                                       placeholder="Repite la contraseña"
                                       style="border-radius:3px;border:1px solid rgba(107,63,42,.2);
                                              padding:.75rem 1rem;font-family:'Poppins',sans-serif;">
                            </div>

                            <div class="col-12 mt-2">
                                <button type="submit" class="btn-cafe w-100" style="padding:.85rem;">
                                    <i class="bi bi-person-plus me-2"></i>Crear cuenta
                                </button>
                            </div>
                        </div>
                    </form>

                    <p class="text-center mt-4" style="font-size:.875rem;color:var(--cafe-gray);">
                        ¿Ya tienes cuenta?
                        <a href="{{ route('cliente.login') }}" style="color:var(--cafe-brown);font-weight:600;">
                            Inicia sesión
                        </a>
                    </p>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection