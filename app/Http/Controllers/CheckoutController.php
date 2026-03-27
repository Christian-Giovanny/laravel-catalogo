<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CheckoutController extends Controller
{
    protected string $apiUrl;

    public function __construct()
    {
        $this->apiUrl = env('API_BASE_URL', 'http://127.0.0.1:8001');
    }

    public function index()
    {
        if (!session('cliente_token')) {
            return redirect()->route('cliente.login')
                ->with('error', 'Debes iniciar sesión para continuar con el checkout.');
        }

        $carrito = session()->get('carrito', []);

        if (empty($carrito)) {
            return redirect()->route('catalogo')
                ->with('error', 'Tu carrito está vacío.');
        }

        $total = array_sum(array_map(
            fn($i) => $i['precio'] * $i['cantidad'],
            $carrito
        ));

        // Pre-llenar dirección desde la API
        $direccion = '';
        try {
            $response = Http::withToken(session('cliente_token'))
                ->timeout(5)
                ->get("{$this->apiUrl}/api/cliente/perfil");

            if ($response->successful()) {
                $direccion = $response->json()['Direccion'] ?? '';
            }
        } catch (\Exception $e) {
            // Si falla, el campo queda vacío
        }

        return view('checkout.index', compact('carrito', 'total', 'direccion'));
    }

    public function procesar(Request $request)
    {
        if (!session('cliente_token')) {
            return redirect()->route('cliente.login')
                ->with('error', 'Sesión expirada. Inicia sesión nuevamente.');
        }

        $request->validate([
            'direccion' => 'required|string|min:10|max:255',
            'notas'     => 'nullable|string|max:500',
        ], [
            'direccion.required' => 'La dirección de entrega es obligatoria.',
            'direccion.min'      => 'La dirección debe tener al menos 10 caracteres.',
        ]);

        $carrito = session()->get('carrito', []);

        if (empty($carrito)) {
            return redirect()->route('catalogo')
                ->with('error', 'Tu carrito está vacío.');
        }

        $total = array_sum(array_map(
            fn($i) => $i['precio'] * $i['cantidad'],
            $carrito
        ));

        $pedidoData = [
            'cliente_id' => session('cliente_id'),
            'direccion'  => $request->direccion,
            'notas'      => $request->notas,
            'total'      => $total,
            'productos'  => array_values(array_map(fn($item) => [
                'id'       => $item['id'],
                'nombre'   => $item['nombre'],
                'cantidad' => $item['cantidad'],
                'precio'   => $item['precio'],
            ], $carrito)),
        ];

        // Intentar enviar a la API
        $pedidoConfirmado = null;
        $apiDisponible    = false;

        try {
            $response = Http::withToken(session('cliente_token'))
                ->timeout(5)
                ->post("{$this->apiUrl}/api/pedidos", $pedidoData);

            if ($response->successful()) {
                $apiDisponible    = true;
                $pedidoConfirmado = $response->json();
            }
        } catch (\Exception $e) {
            $apiDisponible = false;
        }

        // Número de orden desde API o generado localmente
        $numeroOrden = $pedidoConfirmado['id']
            ?? $pedidoConfirmado['data']['id']
            ?? 'WS-' . strtoupper(substr(uniqid(), -6));

        session()->put('pedido_confirmado', [
            'numero_orden' => $numeroOrden,
            'direccion'    => $request->direccion,
            'notas'        => $request->notas ?? '',
            'total'        => $total,
            'productos'    => $carrito,
            'fecha'        => now()->setTimezone('America/Mexico_City')->format('d/m/Y H:i'),
            'api_guardado' => $apiDisponible,
        ]);

        // Limpiar carrito
        $clienteId = session('cliente_id');
        if ($clienteId) {
            session()->forget('carrito_' . $clienteId);
        }
        session()->forget('carrito');

        return redirect()->route('checkout.confirmacion');
    }

    public function confirmacion()
    {
        $pedido = session()->get('pedido_confirmado');

        if (!$pedido) {
            return redirect()->route('inicio')
                ->with('error', 'No hay un pedido reciente para mostrar.');
        }

        return view('checkout.confirmacion', compact('pedido'));
    }
}