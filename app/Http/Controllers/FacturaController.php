<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SolicitudFactura;

class FacturaController extends Controller
{
    public function form()
    {
        return view('factura.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'rfc'            => 'required|min:12|max:13',
            'nombre'         => 'required|max:255',
            'codigo_postal'  => 'required|digits:5',
            'regimen_fiscal' => 'required',
            'uso_cfdi'       => 'required',
            'email'          => 'required|email|max:255',
        ], [
            'rfc.required'            => 'El RFC es obligatorio.',
            'rfc.min'                 => 'El RFC debe tener al menos 12 caracteres.',
            'rfc.max'                 => 'El RFC no puede superar 13 caracteres.',
            'nombre.required'         => 'El nombre o razón social es obligatorio.',
            'codigo_postal.required'  => 'El código postal es obligatorio.',
            'codigo_postal.digits'    => 'El código postal debe ser de 5 dígitos.',
            'regimen_fiscal.required' => 'Selecciona un régimen fiscal.',
            'uso_cfdi.required'       => 'Selecciona el uso de CFDI.',
            'email.required'          => 'El correo electrónico es obligatorio.',
            'email.email'             => 'Ingresa un correo válido.',
        ]);

        SolicitudFactura::create($request->only(
            'rfc', 'nombre', 'codigo_postal', 'regimen_fiscal', 'uso_cfdi', 'email'
        ));

        return back()->with('success', true);
    }

    public function panel()
    {
        $solicitudes = SolicitudFactura::latest()->get();
        return view('factura.panel', compact('solicitudes'));
    }

    public function completar($id)
    {
        SolicitudFactura::findOrFail($id)->update(['estatus' => 'completada']);
        return back();
    }
}
