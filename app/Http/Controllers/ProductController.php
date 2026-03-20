<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    protected string $apiUrl;
    protected string $storageUrl;

    public function __construct()
    {
        $this->apiUrl    = env('API_BASE_URL', 'http://127.0.0.1:8001');
        $this->storageUrl = env('API_STORAGE_URL', 'http://127.0.0.1:8001');
    }

    public function index(Request $request)
    {
        $productos = [];
        $error     = null;

        try {
            $response = Http::timeout(15)->get("{$this->apiUrl}/productos");

            if ($response->successful()) {
                $json = $response->json();
                // La API devuelve los productos dentro de "data"
                $productos = $json['data'] ?? $json;
            } else {
                $error = "Error al conectar con la API (código {$response->status()})";
            }
        } catch (\Exception $e) {
            Log::error('Error consumiendo API: ' . $e->getMessage());
            $error = "No se pudo conectar con la API. Intenta más tarde.";
        }

        return view('products.index', compact('productos', 'error'));
    }

    public function show(int $id)
    {
        $producto = null;
        $error    = null;

        try {
            $response = Http::timeout(15)->get("{$this->apiUrl}/productos/{$id}");

            if ($response->successful()) {
                $json     = $response->json();
                $producto = $json['data'] ?? $json;
            } elseif ($response->status() === 404) {
                abort(404, 'Producto no encontrado');
            } else {
                $error = "Error al obtener el producto (código {$response->status()})";
            }
        } catch (\Exception $e) {
            Log::error("Error obteniendo producto {$id}: " . $e->getMessage());
            $error = "No se pudo obtener la información del producto.";
        }

        return view('products.show', compact('producto', 'error'));
    }

    /**
     * Construye la URL pública de una imagen
     */
    public static function imagenUrl(?string $path, string $base): ?string
    {
        if (!$path) return null;
        if (str_starts_with($path, 'http')) return $path;
        if (str_starts_with($path, '/storage')) return $base . $path;
        if (str_starts_with($path, 'productos/')) return $base . '/storage/' . $path;
        return null;
    }
}