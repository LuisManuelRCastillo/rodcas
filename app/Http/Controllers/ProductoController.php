<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        $query = Producto::query();

        // Búsqueda por nombre o código
        if ($buscar = $request->get('buscar')) {
            $query->where(function ($q) use ($buscar) {
                $q->where('producto', 'like', "%{$buscar}%")
                  ->orWhere('codigo',   'like', "%{$buscar}%");
            });
        }

        // Filtro por departamento
        if ($dpto = $request->get('dpto')) {
            $query->where('dpto', $dpto);
        }

        // Filtro por disponibilidad
        if ($request->get('disponible') == '1') {
            $query->where('existencia', '>', 0);
        }

        // Ordenamiento
        $orden = $request->get('orden', 'nombre');
        if ($orden === 'precio_asc') {
            $query->orderBy('p_venta', 'asc');
        } elseif ($orden === 'precio_desc') {
            $query->orderBy('p_venta', 'desc');
        } else {
            $query->orderBy('producto', 'asc');
        }

        // Departamentos únicos para el sidebar
        $departamentos = Producto::select('dpto')
            ->whereNotNull('dpto')
            ->where('dpto', '!=', '')
            ->distinct()
            ->orderBy('dpto')
            ->pluck('dpto');

        $productos = $query->paginate(24)->withQueryString();

        return view('catalog.catalog', compact('productos', 'departamentos'));
    }
}
