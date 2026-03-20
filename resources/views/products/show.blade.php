@extends('layouts.app')

@php
    $baseUrl     = 'http://127.0.0.1:8001';
    $nombre      = $producto['Nombre']   ?? 'Producto';
    $precio      = $producto['Precio']   ?? 0;
    $stock       = $producto['Stock']    ?? null;
    $categoria   = $producto['Categoria_id'] ?? null;

    // Construir las 3 imágenes
    $img0 = \App\Http\Controllers\ProductController::imagenUrl($producto['Imagen']   ?? null, $baseUrl);
    $img1 = \App\Http\Controllers\ProductController::imagenUrl($producto['Imagen_1'] ?? null, $baseUrl);
    $img2 = \App\Http\Controllers\ProductController::imagenUrl($producto['Imagen_2'] ?? null, $baseUrl);

    $imagenes = array_filter([$img0, $img1, $img2]);
    $imagenes = array_values($imagenes);
    $imagenPrincipal = $imagenes[0] ?? null;
@endphp

@section('title', $nombre)

@section('content')

<section class="page-hero">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('catalogo') }}">Menú</a></li>
                <li class="breadcrumb-item active">{{ Str::limit($nombre, 40) }}</li>
            </ol>
        </nav>
        <h1 style="font-size:clamp(1.5rem,3vw,2.5rem);"><em>{{ $nombre }}</em></h1>
    </div>
</section>

<section class="section-pad">
    <div class="container">

        @if($error)
            <div style="background:#fdf0f0;border:1px solid #f5c0c0;color:#7f1d1d;
                        border-radius:4px;padding:1.25rem 1.5rem;">
                <h5 class="mb-1"><i class="bi bi-exclamation-triangle me-2"></i>Error</h5>
                <p class="mb-0">{{ $error }}</p>
            </div>
        @elseif($producto)

        <div class="row gy-5">

            {{-- IMÁGENES --}}
            <div class="col-lg-6">
                {{-- Imagen principal --}}
                <div style="margin-bottom:1rem;">
                    @if($imagenPrincipal)
                        <img id="imgPrincipal"
                             src="{{ $imagenPrincipal }}"
                             alt="{{ $nombre }}"
                             class="img-detail"
                             style="transition:opacity .3s ease;"
                             onerror="this.onerror=null;this.src='https://placehold.co/500x420/f5ede4/6b3f2a?text=Sin+Imagen';">
                    @else
                        <div class="img-detail d-flex align-items-center justify-content-center"
                             style="min-height:300px;">
                            <i class="bi bi-cup-hot" style="font-size:4rem;color:var(--cafe-warm);"></i>
                        </div>
                    @endif
                </div>

                {{-- 3 miniaturas --}}
                <span class="section-label d-block mb-2">
                    Imágenes del producto ({{ count($imagenes) }})
                </span>
                <div class="row g-2">
                    @foreach([$img0, $img1, $img2] as $i => $img)
                    <div class="col-4">
                        @if($img)
                            <img src="{{ $img }}"
                                 alt="{{ $nombre }} imagen {{ $i + 1 }}"
                                 class="img-thumb"
                                 onclick="cambiarImagen(this)"
                                 style="{{ $i === 0 ? 'border-color:var(--cafe-gold);' : '' }}"
                                 onerror="this.onerror=null;this.src='https://placehold.co/200x110/f5ede4/6b3f2a?text=Img+{{ $i+1 }}';">
                        @else
                            <div class="img-thumb d-flex align-items-center justify-content-center"
                                 style="cursor:default;">
                                <div class="text-center">
                                    <i class="bi bi-image" style="font-size:1.5rem;color:var(--cafe-warm);display:block;"></i>
                                    <span style="font-size:.65rem;color:var(--cafe-gray);">N/D</span>
                                </div>
                            </div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- INFO --}}
            <div class="col-lg-6">
                <h2 style="font-size:clamp(1.8rem,3vw,2.5rem);font-weight:300;
                           line-height:1.2;margin-bottom:.8rem;">
                    {{ $nombre }}
                </h2>
                <div class="divider-cafe mb-4"></div>

                {{-- Precio --}}
                <div class="mb-4">
                    <span class="precio-badge" style="font-size:2rem;">
                        ${{ number_format((float)$precio, 2) }}
                    </span>
                </div>

                {{-- Stock --}}
                <div class="mb-4 p-3" style="background:var(--cafe-cream);border-radius:3px;
                     border-left:2px solid {{ $stock > 0 ? '#2d7a4f' : '#c0392b' }};">
                    <span style="font-size:.7rem;font-weight:500;text-transform:uppercase;
                                 letter-spacing:.1em;color:var(--cafe-gray);">Disponibilidad</span><br>
                    @if($stock === null)
                        <span style="color:var(--cafe-gray);">Consultar disponibilidad</span>
                    @elseif($stock > 0)
                        <span class="stock-in">
                            <i class="bi bi-check-circle me-1"></i>Disponible — {{ $stock }} unidades
                        </span>
                    @else
                        <span class="stock-out">
                            <i class="bi bi-x-circle me-1"></i>Agotado
                        </span>
                    @endif
                </div>

                {{-- Botones --}}
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('catalogo') }}" class="btn-outline-cafe">
                        <i class="bi bi-arrow-left me-2"></i>Volver al menú
                    </a>
                </div>
            </div>

        </div>

        @else
        <div class="text-center py-5">
            <i class="bi bi-cup" style="font-size:3rem;color:var(--cafe-warm);display:block;margin-bottom:1rem;"></i>
            <h4 style="font-weight:300;color:var(--cafe-gray);">Producto no disponible</h4>
            <a href="{{ route('catalogo') }}" class="btn-cafe mt-3">Volver al menú</a>
        </div>
        @endif

    </div>
</section>

@endsection

@push('scripts')
<script>
    function cambiarImagen(thumb) {
        const principal = document.getElementById('imgPrincipal');
        if (principal) {
            principal.style.opacity = '0.4';
            principal.src = thumb.src;
            principal.onload = () => { principal.style.opacity = '1'; };
        }
        document.querySelectorAll('.img-thumb').forEach(t => {
            t.style.borderColor = '';
        });
        thumb.style.borderColor = 'var(--cafe-gold)';
    }
</script>
@endpush