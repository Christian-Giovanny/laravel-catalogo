@extends('layouts.app')

@section('title', 'Mi Perfil')

@section('content')

<section class="page-hero">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
                <li class="breadcrumb-item active">Mi Perfil</li>
            </ol>
        </nav>
        <h1><em>Mi</em> Perfil</h1>
        <p class="mt-2">Gestiona tu información personal.</p>
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

        <div class="row gy-4">

            {{-- DATOS DEL CLIENTE --}}
            <div class="col-lg-4">
                <div class="card p-4 text-center">
                    @php
                        $baseUrl = 'http://127.0.0.1:8001';
                        $imgPerfil = null;
                        if (!empty($cliente['Imagen'])) {
                            $img = $cliente['Imagen'];
                            $imgPerfil = str_starts_with($img, 'http') ? $img : $baseUrl . '/' . ltrim($img, '/');
                        }
                    @endphp

                    @if($imgPerfil)
                        <img src="{{ $imgPerfil }}"
                             alt="Foto de perfil"
                             style="width:100px;height:100px;border-radius:50%;object-fit:cover;
                                    border:3px solid var(--cafe-gold);margin-bottom:1rem;"
                             onerror="this.onerror=null;this.style.display='none';">
                    @else
                        <div style="width:100px;height:100px;border-radius:50%;
                                    background:var(--cafe-cream);border:3px solid var(--cafe-gold);
                                    display:flex;align-items:center;justify-content:center;
                                    margin:0 auto 1rem;">
                            <i class="bi bi-person" style="font-size:2.5rem;color:var(--cafe-brown);"></i>
                        </div>
                    @endif

                    <h5 style="font-weight:600;font-size:1rem;margin-bottom:.2rem;">
                        {{ $cliente['Nombres'] ?? '' }} {{ $cliente['Apellidos'] ?? '' }}
                    </h5>
                    <p style="font-size:.85rem;color:var(--cafe-gray);">{{ $cliente['Correo'] ?? '' }}</p>

                    <div class="divider-cafe mx-auto my-3"></div>

                    @php
                        $info = [
                            ['icon'=>'bi-geo-alt','label'=>'Dirección','value'=>$cliente['Direccion'] ?? 'No especificada'],
                            ['icon'=>'bi-shield-check','label'=>'Estado','value'=>$cliente['Estado'] ?? 'activo'],
                        ];
                    @endphp

                    @foreach($info as $i)
                    <div class="d-flex align-items-center gap-2 mb-2 text-start">
                        <i class="bi {{ $i['icon'] }}" style="color:var(--cafe-gold);font-size:.9rem;"></i>
                        <div>
                            <div style="font-size:.68rem;color:var(--cafe-gray);text-transform:uppercase;letter-spacing:.08em;">
                                {{ $i['label'] }}
                            </div>
                            <div style="font-size:.85rem;font-weight:500;">{{ $i['value'] }}</div>
                        </div>
                    </div>
                    @endforeach

                    <div class="mt-3 d-flex flex-column gap-2">
                        <a href="{{ route('cliente.editar') }}" class="btn-cafe w-100"
                           style="padding:.7rem;text-align:center;">
                            <i class="bi bi-pencil me-2"></i>Editar perfil
                        </a>
                        <form action="{{ route('cliente.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-outline-cafe w-100"
                                    style="padding:.68rem;text-align:center;">
                                <i class="bi bi-box-arrow-right me-2"></i>Cerrar sesión
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- INFO --}}
            <div class="col-lg-8">

                <div class="card p-4 mb-4" style="border-left:2px solid var(--cafe-gold);">
                    <h5 style="font-weight:600;font-size:.95rem;margin-bottom:.5rem;">
                        <i class="bi bi-shield-check me-2" style="color:var(--cafe-gold);"></i>
                        Sesión activa
                    </h5>
                    <p style="font-size:.85rem;color:var(--cafe-gray);margin:0;">
                        Tu sesión está autenticada mediante token de la API.
                        <span style="color:var(--cafe-brown);font-weight:600;">✓ Conectado</span>
                    </p>
                </div>

                <div class="card p-4">
                    <h5 style="font-weight:600;font-size:.95rem;margin-bottom:1rem;">
                        <i class="bi bi-info-circle me-2" style="color:var(--cafe-brown);"></i>
                        Información completa
                    </h5>
                    <table style="width:100%;font-size:.875rem;">
                        <tr style="border-bottom:1px solid rgba(107,63,42,.08);">
                            <td style="padding:.5rem .75rem;color:var(--cafe-gray);font-weight:500;
                                       text-transform:uppercase;font-size:.7rem;letter-spacing:.06em;width:35%;">
                                Nombres
                            </td>
                            <td style="padding:.5rem .75rem;">{{ $cliente['Nombres'] ?? '—' }}</td>
                        </tr>
                        <tr style="border-bottom:1px solid rgba(107,63,42,.08);">
                            <td style="padding:.5rem .75rem;color:var(--cafe-gray);font-weight:500;
                                       text-transform:uppercase;font-size:.7rem;letter-spacing:.06em;">
                                Apellidos
                            </td>
                            <td style="padding:.5rem .75rem;">{{ $cliente['Apellidos'] ?? '—' }}</td>
                        </tr>
                        <tr style="border-bottom:1px solid rgba(107,63,42,.08);">
                            <td style="padding:.5rem .75rem;color:var(--cafe-gray);font-weight:500;
                                       text-transform:uppercase;font-size:.7rem;letter-spacing:.06em;">
                                Correo
                            </td>
                            <td style="padding:.5rem .75rem;">{{ $cliente['Correo'] ?? '—' }}</td>
                        </tr>
                        <tr style="border-bottom:1px solid rgba(107,63,42,.08);">
                            <td style="padding:.5rem .75rem;color:var(--cafe-gray);font-weight:500;
                                       text-transform:uppercase;font-size:.7rem;letter-spacing:.06em;">
                                Dirección
                            </td>
                            <td style="padding:.5rem .75rem;">{{ $cliente['Direccion'] ?? '—' }}</td>
                        </tr>
                        <tr>
                            <td style="padding:.5rem .75rem;color:var(--cafe-gray);font-weight:500;
                                       text-transform:uppercase;font-size:.7rem;letter-spacing:.06em;">
                                Estado
                            </td>
                            <td style="padding:.5rem .75rem;">
                                <span style="background:#f0faf4;color:#1a5c35;font-size:.75rem;
                                             font-weight:600;padding:.2rem .7rem;border-radius:3px;">
                                    {{ $cliente['Estado'] ?? 'activo' }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection