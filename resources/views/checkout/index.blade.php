@extends('layouts.app')

@section('title', 'Checkout')

@section('content')

<section class="page-hero">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('carrito.index') }}">Carrito</a></li>
                <li class="breadcrumb-item active">Checkout</li>
            </ol>
        </nav>
        <h1><em>Confirmar</em> Pedido</h1>
        <p class="mt-2">Revisa tu pedido e indica la dirección de entrega.</p>
    </div>
</section>

<section class="section-pad">
    <div class="container">

        @if ($errors->any())
            <div style="background:#fdf0f0;border:1px solid #f5c0c0;color:#7f1d1d;
                        border-radius:4px;padding:1rem 1.5rem;margin-bottom:1.5rem;">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row gy-4">

            {{-- Resumen del carrito --}}
            <div class="col-lg-7">
                <div class="card p-0">
                    <div class="px-4 py-3"
                         style="background:var(--cafe-dark);color:var(--cafe-cream);border-radius:4px 4px 0 0;">
                        <h5 class="mb-0" style="font-weight:600;font-size:.95rem;letter-spacing:.04em;">
                            <i class="bi bi-cart3 me-2" style="color:var(--cafe-gold);"></i>Resumen del pedido
                        </h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach ($carrito as $item)
                        <li class="list-group-item px-4 py-3" style="border-color:rgba(107,63,42,.1);">
                            <div class="d-flex align-items-center gap-3">
                                <img src="{{ $item['imagen'] ?? 'https://placehold.co/60x60/f5ede4/6b3f2a?text=☕' }}"
                                     alt="{{ $item['nombre'] }}"
                                     style="width:56px;height:56px;object-fit:contain;
                                            background:var(--cafe-cream);border-radius:3px;padding:.3rem;"
                                     onerror="this.onerror=null;this.src='https://placehold.co/60x60/f5ede4/6b3f2a?text=IMG';">
                                <div class="flex-grow-1">
                                    <div style="font-weight:600;font-size:.88rem;color:var(--cafe-dark);">
                                        {{ $item['nombre'] }}
                                    </div>
                                    <small style="color:var(--cafe-gray);">
                                        {{ $item['cantidad'] }} × ${{ number_format($item['precio'], 2) }}
                                    </small>
                                </div>
                                <div style="font-weight:700;color:var(--cafe-brown);">
                                    ${{ number_format($item['precio'] * $item['cantidad'], 2) }}
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    <div class="d-flex justify-content-between align-items-center px-4 py-3"
                         style="border-top:2px solid var(--cafe-gold);background:#fdf8f2;">
                        <span style="font-weight:600;color:var(--cafe-dark);">Total</span>
                        <span style="font-size:1.5rem;font-weight:700;color:var(--cafe-brown);">
                            ${{ number_format($total, 2) }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Datos de entrega --}}
            <div class="col-lg-5">
                <div class="card p-0">
                    <div class="px-4 py-3"
                         style="background:var(--cafe-brown);color:var(--cafe-cream);border-radius:4px 4px 0 0;">
                        <h5 class="mb-0" style="font-weight:600;font-size:.95rem;letter-spacing:.04em;">
                            <i class="bi bi-geo-alt me-2" style="color:var(--cafe-gold);"></i>Datos de entrega
                        </h5>
                    </div>
                    <div class="p-4">
                        <form action="{{ route('checkout.procesar') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label style="font-size:.82rem;font-weight:600;color:var(--cafe-dark);
                                              letter-spacing:.04em;text-transform:uppercase;">
                                    Dirección de entrega <span style="color:#c0392b;">*</span>
                                </label>
                                <textarea name="direccion" rows="3"
                                          class="form-control mt-1 @error('direccion') is-invalid @enderror"
                                          placeholder="Calle, número, colonia, ciudad..."
                                          style="border-color:rgba(107,63,42,.25);border-radius:3px;
                                                 font-family:'Poppins',sans-serif;font-size:.85rem;resize:none;">{{ old('direccion', $direccion) }}</textarea>
                                @error('direccion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label style="font-size:.82rem;font-weight:600;color:var(--cafe-dark);
                                              letter-spacing:.04em;text-transform:uppercase;">
                                    Notas <span style="color:var(--cafe-gray);font-weight:400;">(opcional)</span>
                                </label>
                                <textarea name="notas" rows="2"
                                          class="form-control mt-1"
                                          placeholder="Instrucciones especiales, referencias..."
                                          style="border-color:rgba(107,63,42,.15);border-radius:3px;
                                                 font-family:'Poppins',sans-serif;font-size:.85rem;resize:none;">{{ old('notas') }}</textarea>
                            </div>

                            <button type="submit" class="btn-cafe w-100"
                                    style="padding:.85rem;text-align:center;">
                                <i class="bi bi-check-circle me-2"></i>Confirmar pedido
                            </button>

                            <a href="{{ route('carrito.index') }}" class="btn-outline-cafe w-100 mt-2"
                               style="padding:.83rem;text-align:center;display:block;">
                                <i class="bi bi-arrow-left me-2"></i>Volver al carrito
                            </a>

                            <p class="text-center mt-3 mb-0"
                               style="font-size:.72rem;color:var(--cafe-gray);">
                                <i class="bi bi-shield-check me-1"></i>Tu información está protegida
                            </p>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection