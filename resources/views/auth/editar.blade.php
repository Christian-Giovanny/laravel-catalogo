@extends('layouts.app')

@section('title', 'Editar Perfil')

@section('content')

<section class="page-hero">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('cliente.perfil') }}">Mi Perfil</a></li>
                <li class="breadcrumb-item active">Editar</li>
            </ol>
        </nav>
        <h1><em>Editar</em> Perfil</h1>
        <p class="mt-2">Actualiza tu información personal.</p>
    </div>
</section>

<section class="section-pad">
    <div class="container">

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

        <div class="row gy-4">

            {{-- DATOS GENERALES --}}
            <div class="col-lg-6">
                <div class="card p-4">
                    <h5 style="font-weight:600;font-size:.95rem;margin-bottom:1rem;">
                        <i class="bi bi-person me-2" style="color:var(--cafe-gold);"></i>
                        Datos generales
                    </h5>
                    <div class="divider-cafe mb-4"></div>

                    <form action="{{ route('cliente.actualizar') }}" method="POST" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="row gy-3">
                            <div class="col-sm-6">
                                <label style="font-size:.75rem;font-weight:500;letter-spacing:.1em;
                                              text-transform:uppercase;color:var(--cafe-gray);display:block;margin-bottom:.4rem;">
                                    Nombres *
                                </label>
                                <input type="text" name="Nombres"
                                       value="{{ old('Nombres', $cliente['Nombres'] ?? '') }}"
                                       class="form-control @error('Nombres') is-invalid @enderror"
                                       style="border-radius:3px;border:1px solid rgba(107,63,42,.2);
                                              padding:.75rem 1rem;font-family:'Poppins',sans-serif;">
                                @error('Nombres')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-sm-6">
                                <label style="font-size:.75rem;font-weight:500;letter-spacing:.1em;
                                              text-transform:uppercase;color:var(--cafe-gray);display:block;margin-bottom:.4rem;">
                                    Apellidos *
                                </label>
                                <input type="text" name="Apellidos"
                                       value="{{ old('Apellidos', $cliente['Apellidos'] ?? '') }}"
                                       class="form-control @error('Apellidos') is-invalid @enderror"
                                       style="border-radius:3px;border:1px solid rgba(107,63,42,.2);
                                              padding:.75rem 1rem;font-family:'Poppins',sans-serif;">
                                @error('Apellidos')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label style="font-size:.75rem;font-weight:500;letter-spacing:.1em;
                                              text-transform:uppercase;color:var(--cafe-gray);display:block;margin-bottom:.4rem;">
                                    Correo *
                                </label>
                                <input type="email" name="Correo"
                                       value="{{ old('Correo', $cliente['Correo'] ?? '') }}"
                                       class="form-control @error('Correo') is-invalid @enderror"
                                       style="border-radius:3px;border:1px solid rgba(107,63,42,.2);
                                              padding:.75rem 1rem;font-family:'Poppins',sans-serif;">
                                @error('Correo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label style="font-size:.75rem;font-weight:500;letter-spacing:.1em;
                                              text-transform:uppercase;color:var(--cafe-gray);display:block;margin-bottom:.4rem;">
                                    Dirección
                                </label>
                                <input type="text" name="Direccion"
                                       value="{{ old('Direccion', $cliente['Direccion'] ?? '') }}"
                                       class="form-control"
                                       style="border-radius:3px;border:1px solid rgba(107,63,42,.2);
                                              padding:.75rem 1rem;font-family:'Poppins',sans-serif;">
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn-cafe w-100" style="padding:.8rem;">
                                    <i class="bi bi-save me-2"></i>Guardar cambios
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- CAMBIAR CONTRASEÑA --}}
            <div class="col-lg-6">
                <div class="card p-4 mb-4">
                    <h5 style="font-weight:600;font-size:.95rem;margin-bottom:1rem;">
                        <i class="bi bi-lock me-2" style="color:var(--cafe-brown);"></i>
                        Cambiar contraseña
                    </h5>
                    <div class="divider-cafe mb-4"></div>

                    <form action="{{ route('cliente.password') }}" method="POST" novalidate>
                        @csrf
                        <div class="row gy-3">
                            <div class="col-12">
                                <label style="font-size:.75rem;font-weight:500;letter-spacing:.1em;
                                              text-transform:uppercase;color:var(--cafe-gray);display:block;margin-bottom:.4rem;">
                                    Contraseña actual *
                                </label>
                                <input type="password" name="Contrasena_Actual"
                                       class="form-control"
                                       style="border-radius:3px;border:1px solid rgba(107,63,42,.2);
                                              padding:.75rem 1rem;font-family:'Poppins',sans-serif;">
                            </div>
                            <div class="col-12">
                                <label style="font-size:.75rem;font-weight:500;letter-spacing:.1em;
                                              text-transform:uppercase;color:var(--cafe-gray);display:block;margin-bottom:.4rem;">
                                    Nueva contraseña *
                                </label>
                                <input type="password" name="Nueva_Contrasena"
                                       class="form-control"
                                       placeholder="Mínimo 6 caracteres"
                                       style="border-radius:3px;border:1px solid rgba(107,63,42,.2);
                                              padding:.75rem 1rem;font-family:'Poppins',sans-serif;">
                            </div>
                            <div class="col-12">
                                <label style="font-size:.75rem;font-weight:500;letter-spacing:.1em;
                                              text-transform:uppercase;color:var(--cafe-gray);display:block;margin-bottom:.4rem;">
                                    Confirmar nueva contraseña *
                                </label>
                                <input type="password" name="Nueva_Contrasena_confirmation"
                                       class="form-control"
                                       style="border-radius:3px;border:1px solid rgba(107,63,42,.2);
                                              padding:.75rem 1rem;font-family:'Poppins',sans-serif;">
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn-cafe w-100" style="padding:.8rem;">
                                    <i class="bi bi-key me-2"></i>Cambiar contraseña
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card p-3 text-center">
                    <a href="{{ route('cliente.perfil') }}" class="btn-outline-cafe"
                       style="padding:.7rem 1.5rem;">
                        <i class="bi bi-arrow-left me-2"></i>Volver al perfil
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection