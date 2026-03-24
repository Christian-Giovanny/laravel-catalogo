<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ClienteController extends Controller
{
    protected string $apiUrl;

    public function __construct()
    {
        $this->apiUrl = env('API_BASE_URL', 'http://127.0.0.1:8001');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'Nombres'    => 'required|string|min:2',
            'Apellidos'  => 'required|string|min:2',
            'Correo'     => 'required|email',
            'Contrasena' => 'required|min:6|same:Contrasena_confirmation',
            'Direccion'  => 'nullable|string',
        ]);

        try {
            $response = Http::timeout(15)
                ->post("{$this->apiUrl}/api/cliente/register", [
                    'Nombres'    => $request->Nombres,
                    'Apellidos'  => $request->Apellidos,
                    'Correo'     => $request->Correo,
                    'Contrasena' => $request->Contrasena,
                    'Direccion'  => $request->Direccion,
                ]);

            $data = $response->json();

            if ($response->successful() && ($data['status'] ?? false)) {
                return redirect()->route('cliente.login')
                    ->with('success', '¡Registro exitoso! Inicia sesión.');
            }

            $mensaje = $data['error_validacion'] ?? $data['message'] ?? 'Error al registrar.';
            if (is_array($mensaje)) {
                $mensaje = implode(' ', array_merge(...array_values($mensaje)));
            }
            return back()->withErrors(['general' => $mensaje])->withInput();

        } catch (\Exception $e) {
            Log::error('Error registro: ' . $e->getMessage());
            return back()->withErrors(['general' => 'No se pudo conectar: ' . $e->getMessage()])->withInput();
        }
    }

    public function showLogin()
    {
        if (session('cliente_token')) {
            return redirect()->route('cliente.perfil');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'Correo'     => 'required|email',
            'Contrasena' => 'required',
        ]);

        try {
            $response = Http::timeout(15)
                ->post("{$this->apiUrl}/api/cliente/login", [
                    'Correo'     => $request->Correo,
                    'Contrasena' => $request->Contrasena,
                ]);

            $data = $response->json();

            if ($response->successful() && isset($data['token'])) {
                $clienteId = $data['cliente']['ID'] ?? null;

                session([
                    'cliente_token'  => $data['token'],
                    'cliente_nombre' => $data['cliente']['Nombres'] ?? 'Cliente',
                    'cliente_id'     => $clienteId,
                ]);

                // Cargar carrito del usuario si existe
                $carritoKey = 'carrito_' . ($clienteId ?? 'guest');
                session(['carrito' => session($carritoKey, [])]);

                return redirect()->route('cliente.perfil')
                    ->with('success', '¡Bienvenido, ' . ($data['cliente']['Nombres'] ?? '') . '!');
            }

            return back()->withErrors(['Correo' => $data['message'] ?? 'Credenciales incorrectas.'])->withInput();

        } catch (\Exception $e) {
            Log::error('Error login: ' . $e->getMessage());
            return back()->withErrors(['Correo' => 'No se pudo conectar: ' . $e->getMessage()])->withInput();
        }
    }

    public function perfil()
    {
        $token = session('cliente_token');
        if (!$token) return redirect()->route('cliente.login');

        try {
            $response = Http::timeout(15)
                ->withToken($token)
                ->get("{$this->apiUrl}/api/cliente/perfil");

            if ($response->successful()) {
                $cliente = $response->json();
                return view('auth.perfil', compact('cliente'));
            }

            return redirect()->route('cliente.login')
                ->withErrors(['general' => 'Sesión expirada.']);

        } catch (\Exception $e) {
            return redirect()->route('cliente.login')
                ->withErrors(['general' => 'No se pudo obtener el perfil.']);
        }
    }

    public function showEditar()
    {
        $token = session('cliente_token');
        if (!$token) return redirect()->route('cliente.login');

        try {
            $response = Http::timeout(15)
                ->withToken($token)
                ->get("{$this->apiUrl}/api/cliente/perfil");

            $cliente = $response->json();
            return view('auth.editar', compact('cliente'));

        } catch (\Exception $e) {
            return redirect()->route('cliente.perfil');
        }
    }

    public function actualizar(Request $request)
    {
        $token = session('cliente_token');
        if (!$token) return redirect()->route('cliente.login');

        $request->validate([
            'Nombres'   => 'required|string|min:2',
            'Apellidos' => 'required|string|min:2',
            'Correo'    => 'required|email',
            'Direccion' => 'nullable|string',
        ]);

        try {
            $response = Http::timeout(15)
                ->withToken($token)
                ->put("{$this->apiUrl}/api/cliente/update", [
                    'Nombres'   => $request->Nombres,
                    'Apellidos' => $request->Apellidos,
                    'Correo'    => $request->Correo,
                    'Direccion' => $request->Direccion,
                ]);

            $data = $response->json();

            if ($response->successful()) {
                session(['cliente_nombre' => $request->Nombres]);
                return redirect()->route('cliente.perfil')
                    ->with('success', 'Perfil actualizado correctamente.');
            }

            return back()->withErrors(['general' => $data['error'] ?? 'Error al actualizar.']);

        } catch (\Exception $e) {
            return back()->withErrors(['general' => 'No se pudo conectar con la API.']);
        }
    }

    public function cambiarPassword(Request $request)
    {
        $token = session('cliente_token');
        if (!$token) return redirect()->route('cliente.login');

        $request->validate([
            'Contrasena_Actual' => 'required',
            'Nueva_Contrasena'  => 'required|min:6|confirmed',
        ]);

        try {
            $response = Http::timeout(15)
                ->withToken($token)
                ->post("{$this->apiUrl}/api/cliente/change-password", [
                    'Contrasena_Actual'             => $request->Contrasena_Actual,
                    'Nueva_Contrasena'              => $request->Nueva_Contrasena,
                    'Nueva_Contrasena_confirmation' => $request->Nueva_Contrasena_confirmation,
                ]);

            $data = $response->json();

            if ($response->successful() && ($data['status'] ?? false)) {
                return redirect()->route('cliente.perfil')
                    ->with('success', 'Contraseña actualizada correctamente.');
            }

            return back()->withErrors(['general' => $data['message'] ?? 'Error al cambiar contraseña.']);

        } catch (\Exception $e) {
            return back()->withErrors(['general' => 'No se pudo conectar con la API.']);
        }
    }

    public function logout(Request $request)
    {
        $token    = session('cliente_token');
        $clienteId = session('cliente_id');

        if ($token) {
            try {
                Http::timeout(10)
                    ->withToken($token)
                    ->post("{$this->apiUrl}/api/cliente/logout");
            } catch (\Exception $e) {
                Log::error('Error logout: ' . $e->getMessage());
            }
        }

        // Guardar carrito del usuario antes de cerrar sesión
        if ($clienteId) {
            session()->put('carrito_' . $clienteId, session('carrito', []));
        }

        session()->forget(['cliente_token', 'cliente_nombre', 'cliente_id', 'carrito']);
        return redirect()->route('inicio')->with('success', 'Sesión cerrada correctamente.');
    }
}