@extends('layouts.app')

@section('title', 'Carrito de Compras')

@section('content')

<section class="page-hero">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
                <li class="breadcrumb-item active">Carrito</li>
            </ol>
        </nav>
        <h1><em>Mi</em> Carrito</h1>
        <p class="mt-2">Productos seleccionados para tu pedido.</p>
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

        @if(session('error'))
            <div style="background:#fdf0f0;border:1px solid #f5c0c0;color:#7f1d1d;
                        border-radius:4px;padding:1rem 1.5rem;margin-bottom:1.5rem;">
                <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
            </div>
        @endif

        @if(empty($carrito))
            <div class="text-center py-5">
                <i class="bi bi-cart-x" style="font-size:4rem;color:var(--cafe-warm);display:block;margin-bottom:1rem;"></i>
                <h4 style="font-weight:300;color:var(--cafe-gray);">Tu carrito está vacío</h4>
                <a href="{{ route('catalogo') }}" class="btn-cafe mt-3">Ver Menú</a>
            </div>
        @else

            <div class="row gy-4">
                {{-- TABLA DE PRODUCTOS --}}
                <div class="col-lg-8">
                    @foreach($carrito as $item)
                    <div class="card p-3 mb-3">
                        <div class="row align-items-center gy-3">
                            {{-- Imagen --}}
                            <div class="col-3 col-md-2">
                                @if($item['imagen'])
                                    <img src="{{ $item['imagen'] }}"
                                         alt="{{ $item['nombre'] }}"
                                         style="width:100%;height:70px;object-fit:contain;
                                                background:var(--cafe-cream);border-radius:3px;padding:.3rem;"
                                         onerror="this.onerror=null;this.src='https://placehold.co/80x70/f5ede4/6b3f2a?text=IMG';">
                                @else
                                    <div style="width:100%;height:70px;background:var(--cafe-cream);
                                                border-radius:3px;display:flex;align-items:center;justify-content:center;">
                                        <i class="bi bi-cup-hot" style="color:var(--cafe-warm);font-size:1.5rem;"></i>
                                    </div>
                                @endif
                            </div>

                            {{-- Nombre y precio --}}
                            <div class="col-9 col-md-4">
                                <div style="font-weight:600;font-size:.9rem;">{{ $item['nombre'] }}</div>
                                <div style="color:var(--cafe-brown);font-weight:600;font-size:.95rem;">
                                    ${{ number_format($item['precio'], 2) }}
                                </div>
                                @if(isset($item['stock']))
                                    <div style="font-size:.72rem;color:var(--cafe-gray);">
                                        Stock: {{ $item['stock'] }} unidades
                                    </div>
                                @endif
                            </div>

                            {{-- Cantidad --}}
                            <div class="col-md-3">
                                <form action="{{ route('carrito.actualizar', $item['id']) }}" method="POST"
                                      class="d-flex align-items-center gap-2">
                                    @csrf
                                    <input type="number" name="cantidad" value="{{ $item['cantidad'] }}"
                                           min="1" max="{{ $item['stock'] ?? 99 }}"
                                           style="width:65px;border:1px solid rgba(107,63,42,.2);
                                                  border-radius:3px;padding:.4rem .5rem;
                                                  font-family:'Poppins',sans-serif;text-align:center;">
                                    <button type="submit" class="btn-cafe"
                                            style="padding:.4rem .8rem;font-size:.7rem;">
                                        <i class="bi bi-arrow-clockwise"></i>
                                    </button>
                                </form>
                            </div>

                            {{-- Subtotal --}}
                            <div class="col-md-2 text-md-center">
                                <div style="font-size:.7rem;color:var(--cafe-gray);text-transform:uppercase;
                                            letter-spacing:.08em;">Subtotal</div>
                                <div style="font-weight:700;color:var(--cafe-brown);font-size:1rem;">
                                    ${{ number_format($item['precio'] * $item['cantidad'], 2) }}
                                </div>
                            </div>

                            {{-- Eliminar --}}
                            <div class="col-md-1 text-md-center">
                                <form action="{{ route('carrito.eliminar', $item['id']) }}" method="POST">
                                    @csrf
                                    <button type="submit" style="background:none;border:none;
                                            color:#c0392b;cursor:pointer;font-size:1.1rem;"
                                            title="Eliminar">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    {{-- Vaciar carrito --}}
                    <form action="{{ route('carrito.vaciar') }}" method="POST" class="mt-2">
                        @csrf
                        <button type="submit" class="btn-outline-cafe"
                                onclick="return confirm('¿Vaciar el carrito?')"
                                style="font-size:.75rem;padding:.5rem 1.2rem;">
                            <i class="bi bi-cart-x me-2"></i>Vaciar carrito
                        </button>
                    </form>
                </div>

                {{-- RESUMEN --}}
                <div class="col-lg-4">
                    <div class="card p-4" style="border-left:2px solid var(--cafe-gold);">
                        <h5 style="font-weight:600;font-size:1rem;margin-bottom:1.2rem;">
                            Resumen del pedido
                        </h5>

                        <div class="d-flex justify-content-between mb-2" style="font-size:.9rem;">
                            <span style="color:var(--cafe-gray);">Productos</span>
                            <span>{{ count($carrito) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3" style="font-size:.9rem;">
                            <span style="color:var(--cafe-gray);">Total de artículos</span>
                            <span>{{ array_sum(array_column($carrito, 'cantidad')) }}</span>
                        </div>

                        <hr style="border-color:rgba(107,63,42,.1);">

                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span style="font-weight:600;">Total</span>
                            <span style="font-size:1.5rem;font-weight:700;color:var(--cafe-brown);">
                                ${{ number_format($total, 2) }}
                            </span>
                        </div>

                        {{-- ✅ BOTÓN CORREGIDO --}}
                        @if(session('cliente_token'))
                            <a href="{{ route('checkout.index') }}"
                               class="btn-cafe w-100 mt-4"
                               style="padding:.85rem;text-align:center;display:block;">
                                <i class="bi bi-bag-check me-2"></i>Proceder al checkout
                            </a>
                        @else
                            <a href="{{ route('cliente.login') }}"
                               class="btn-cafe w-100 mt-4"
                               style="padding:.85rem;text-align:center;display:block;">
                                <i class="bi bi-lock me-2"></i>Inicia sesión para comprar
                            </a>
                        @endif

                        <a href="{{ route('catalogo') }}" class="btn-outline-cafe w-100 mt-2"
                           style="padding:.83rem;text-align:center;display:block;">
                            Seguir comprando
                        </a>
                    </div>
                </div>
            </div>

        @endif
    </div>
</section>

@endsection