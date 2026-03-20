<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function inicio()
    {
        return view('pages.inicio');
    }

    public function nosotros()
    {
        return view('pages.nosotros');
    }

    public function contacto(Request $request)
    {
        $enviado = false;
        $error = null;

        if ($request->isMethod('post')) {
            $request->validate([
                'nombre'  => 'required|min:3|max:100',
                'email'   => 'required|email',
                'asunto'  => 'required|min:5|max:150',
                'mensaje' => 'required|min:10|max:1000',
            ]);

            $enviado = true;
        }

        return view('pages.contacto', compact('enviado', 'error'));
    }
}