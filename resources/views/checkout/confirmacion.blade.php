@extends('layouts.app')

@section('title', 'Pedido Confirmado')

@section('content')

<section class="page-hero">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
                <li class="breadcrumb-item active">Pedido confirmado</li>
            </ol>
        </nav>
        <h1><em>Pedido</em> Confirmado</h1>
        <p class="mt-2">Gracias por tu compra en Winters Salon</p>
    </div>
</section>

<section class="section-pad">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 col-lg-5">

                {{-- Número de orden --}}
                <div class="text-center mb-4">
                    <div style="font-size:.72rem;font-weight:600;letter-spacing:.12em;
                                text-transform:uppercase;color:var(--cafe-gray);">
                        Número de orden
                    </div>
                    <div style="font-size:2rem;font-weight:700;color:var(--cafe-brown);
                                letter-spacing:.04em;">
                        {{ $pedido['numero_orden'] }}
                    </div>
                    <div style="font-size:.78rem;color:var(--cafe-gray);">
                        {{ $pedido['fecha'] }}
                    </div>
                </div>

                <hr style="border-color:rgba(107,63,42,.12);">

                {{-- Productos --}}
                <div class="mb-3">
                    @foreach ($pedido['productos'] as $item)
                    <div class="d-flex justify-content-between py-2"
                         style="font-size:.88rem;border-bottom:1px solid rgba(107,63,42,.08);">
                        <span>
                            {{ $item['nombre'] }}
                            <span style="color:var(--cafe-gray);"> × {{ $item['cantidad'] }}</span>
                        </span>
                        <span style="font-weight:600;color:var(--cafe-brown);">
                            ${{ number_format($item['precio'] * $item['cantidad'], 2) }}
                        </span>
                    </div>
                    @endforeach

                    <div class="d-flex justify-content-between pt-3"
                         style="font-weight:600;font-size:.95rem;">
                        <span>Total</span>
                        <span style="color:var(--cafe-brown);">
                            ${{ number_format($pedido['total'], 2) }}
                        </span>
                    </div>
                </div>

                <hr style="border-color:rgba(107,63,42,.12);">

                {{-- Dirección --}}
                <div class="mb-3" style="font-size:.85rem;">
                    <span style="font-size:.7rem;font-weight:600;letter-spacing:.1em;
                                 text-transform:uppercase;color:var(--cafe-gray);">
                        <i class="bi bi-geo-alt me-1"></i>Entrega
                    </span>
                    <div style="color:var(--cafe-dark);margin-top:.3rem;">
                        {{ $pedido['direccion'] }}
                    </div>
                </div>

                {{-- Notas --}}
                @if (!empty($pedido['notas']))
                <div class="mb-3" style="font-size:.85rem;">
                    <span style="font-size:.7rem;font-weight:600;letter-spacing:.1em;
                                 text-transform:uppercase;color:var(--cafe-gray);">
                        <i class="bi bi-chat-left-text me-1"></i>Notas
                    </span>
                    <div style="color:var(--cafe-dark);margin-top:.3rem;">
                        {{ $pedido['notas'] }}
                    </div>
                </div>
                @endif

                {{-- Aviso API --}}
                @if (!$pedido['api_guardado'])
                <div style="font-size:.78rem;color:var(--cafe-gray);margin-bottom:1.2rem;">
                    <i class="bi bi-info-circle me-1"></i>
                    Pedido registrado localmente. Nos pondremos en contacto contigo pronto.
                </div>
                @endif

                {{-- Acciones --}}
                <div class="d-grid gap-2 mt-4">
                    <a href="{{ route('catalogo') }}" class="btn-cafe"
                       style="padding:.83rem;text-align:center;">
                        Seguir comprando
                    </a>
                    <a href="{{ route('inicio') }}" class="btn-outline-cafe"
                       style="padding:.83rem;text-align:center;">
                        Ir al inicio
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection