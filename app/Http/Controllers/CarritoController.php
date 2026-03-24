<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarritoController extends Controller
{
    // Ver carrito
    public function index()
    {
        $carrito = session()->get('carrito', []);
        $total   = array_sum(array_map(fn($i) => $i['precio'] * $i['cantidad'], $carrito));
        return view('carrito.index', compact('carrito', 'total'));
    }

    // Agregar producto
    public function agregar(Request $request)
    {
        $id       = $request->id;
        $nombre   = $request->nombre;
        $precio   = (float) $request->precio;
        $imagen   = $request->imagen;
        $stock    = (int) $request->get('stock', 999);
        $cantidad = (int) $request->get('cantidad', 1);

        $carrito = session()->get('carrito', []);

        if (isset($carrito[$id])) {
            $nuevaCantidad = $carrito[$id]['cantidad'] + $cantidad;
            if ($nuevaCantidad > $stock) {
                return redirect()->back()
                    ->with('error', "Solo hay {$stock} unidades disponibles de {$nombre}.");
            }
            $carrito[$id]['cantidad'] = $nuevaCantidad;
        } else {
            if ($cantidad > $stock) {
                return redirect()->back()
                    ->with('error', "Solo hay {$stock} unidades disponibles de {$nombre}.");
            }
            $carrito[$id] = [
                'id'       => $id,
                'nombre'   => $nombre,
                'precio'   => $precio,
                'imagen'   => $imagen,
                'cantidad' => $cantidad,
                'stock'    => $stock,
            ];
        }

        session()->put('carrito', $carrito);

        // Guardar carrito por usuario si está logueado
        $clienteId = session('cliente_id');
        if ($clienteId) {
            session()->put('carrito_' . $clienteId, $carrito);
        }

        return redirect()->route('carrito.index')->with('success', 'Producto agregado al carrito.');
    }

    // Actualizar cantidad
    public function actualizar(Request $request, $id)
    {
        $carrito = session()->get('carrito', []);

        if (isset($carrito[$id])) {
            $stock        = $carrito[$id]['stock'] ?? 999;
            $nuevaCantidad = max(1, (int) $request->cantidad);

            if ($nuevaCantidad > $stock) {
                return redirect()->route('carrito.index')
                    ->with('error', "Solo hay {$stock} unidades disponibles.");
            }

            $carrito[$id]['cantidad'] = $nuevaCantidad;
            session()->put('carrito', $carrito);

            // Actualizar carrito del usuario
            $clienteId = session('cliente_id');
            if ($clienteId) {
                session()->put('carrito_' . $clienteId, $carrito);
            }
        }

        return redirect()->route('carrito.index')->with('success', 'Cantidad actualizada.');
    }

    // Eliminar producto
    public function eliminar($id)
    {
        $carrito = session()->get('carrito', []);
        unset($carrito[$id]);
        session()->put('carrito', $carrito);

        $clienteId = session('cliente_id');
        if ($clienteId) {
            session()->put('carrito_' . $clienteId, $carrito);
        }

        return redirect()->route('carrito.index')->with('success', 'Producto eliminado.');
    }

    // Vaciar carrito
    public function vaciar()
    {
        $clienteId = session('cliente_id');
        if ($clienteId) {
            session()->forget('carrito_' . $clienteId);
        }

        session()->forget('carrito');
        return redirect()->route('carrito.index')->with('success', 'Carrito vaciado.');
    }
}