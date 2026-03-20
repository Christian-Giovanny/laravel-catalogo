@extends('layouts.app')

@section('title', 'Menú')

@section('content')

<section class="page-hero">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
                <li class="breadcrumb-item active">Menú</li>
            </ol>
        </nav>
        <h1><em>Nuestro</em> Menú</h1>
        <p class="mt-2">
            @if(!empty($productos))
                <strong style="color:var(--cafe-gold);">{{ count($productos) }} productos</strong> disponibles hoy.
            @else
                Explora nuestra selección de bebidas y alimentos.
            @endif
        </p>
    </div>
</section>

<section class="section-pad">
    <div class="container">

        @if($error)
            <div style="background:#fdf0f0;border:1px solid #f5c0c0;color:#7f1d1d;
                        border-radius:4px;padding:1.25rem 1.5rem;margin-bottom:2rem;">
                <h5 class="mb-1"><i class="bi bi-exclamation-triangle me-2"></i>Error de conexión</h5>
                <p class="mb-0">{{ $error }}</p>
            </div>
        @endif

        @if(!$error && empty($productos))
            <div class="text-center py-5">
                <i class="bi bi-cup" style="font-size:3rem;color:var(--cafe-warm);display:block;margin-bottom:1rem;"></i>
                <h4 style="font-weight:300;color:var(--cafe-gray);">No hay productos disponibles por el momento.</h4>
            </div>
        @endif

        @if(!empty($productos))
            <div class="row gy-4 row-cols-1 row-cols-sm-2 row-cols-lg-3">
                @foreach($productos as $producto)
                @php
                    $id          = $producto['ID'] ?? null;
                    $nombre      = $producto['Nombre'] ?? 'Sin nombre';
                    $precio      = $producto['Precio'] ?? 0;
                    $stock       = $producto['Stock'] ?? null;
                    $imagenRaw   = $producto['Imagen'] ?? null;
                    $baseUrl     = 'http://127.0.0.1:8001';
                    $imagen      = \App\Http\Controllers\ProductController::imagenUrl($imagenRaw, $baseUrl);
                @endphp
                <div class="col">
                    <div class="card h-100" style="overflow:hidden;">
                        <div style="overflow:hidden;position:relative;">
                            @if($imagen)
                                <img src="{{ $imagen }}"
                                     alt="{{ $nombre }}"
                                     class="product-img"
                                     loading="lazy"
                                     onerror="this.onerror=null;this.src='https://placehold.co/400x220/f5ede4/6b3f2a?text=Sin+Imagen';">
                            @else
                                <div class="product-img d-flex align-items-center justify-content-center">
                                    <i class="bi bi-cup-hot" style="font-size:3rem;color:var(--cafe-warm);"></i>
                                </div>
                            @endif
                        </div>
                        <div class="card-body d-flex flex-column p-3">
                            <h6 style="font-weight:600;font-size:.95rem;line-height:1.3;margin-bottom:.4rem;">
                                {{ $nombre }}
                            </h6>
                            @if($stock !== null)
                                <p style="font-size:.78rem;color:var(--cafe-gray);margin-bottom:.5rem;">
                                    <i class="bi bi-box-seam me-1"></i>{{ $stock }} disponibles
                                </p>
                            @endif
                            <div class="d-flex justify-content-between align-items-center mt-auto pt-3"
                                 style="border-top:1px solid rgba(107,63,42,.1);">
                                <span class="precio-badge">${{ number_format((float)$precio, 2) }}</span>
                                @if($id)
                                    <a href="{{ route('producto.detalle', $id) }}" class="btn-cafe"
                                       style="padding:.4rem 1rem;font-size:.72rem;">
                                        Ver más
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif

    </div>
</section>

@endsection