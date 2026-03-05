<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cotizacion;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\CotizacionDetalle;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;


class CotizacionController extends Controller
{
    public function createView()
    {
        $clientes = Cliente::orderBy('name')->get();
        return view('quotes.quotesCreate', compact('clientes'));
    }

    // Búsqueda de productos por nombre (ajax)
    public function buscarProductos(Request $request)
    {
        $query = $request->get('q', '');
        $productos = Producto::where('producto', 'LIKE', "%{$query}%")
            ->orWhere('codigo', 'LIKE', "%{$query}%")
            ->limit(15)
            ->get();
        return response()->json($productos);
    }

    // Guardar cotización
    public function store(Request $request)
    {
        $request->validate([
            'id_cliente' => 'required|exists:customers,id',
            'detalles'   => 'required|array|min:1',
        ]);

        DB::beginTransaction();
        try {
            $cotizacion = Cotizacion::create([
                'id_cliente' => $request->id_cliente,
                'subtotal'   => 0,
                'iva'        => 0,
                'total'      => 0,
                'estatus'    => 'pendiente'
            ]);

            $subtotal = 0;

            foreach ($request->detalles as $detalle) {
                $idProducto  = !empty($detalle['id_producto']) ? $detalle['id_producto'] : null;
                $descripcion = $detalle['descripcion'] ?? null;
                $precio      = floatval($detalle['precio_unitario'] ?? 0);
                $cantidad    = intval($detalle['cantidad'] ?? 1);

                // Si viene de la BD, usar el nombre del producto como descripción
                if ($idProducto) {
                    $producto    = Producto::findOrFail($idProducto);
                    $descripcion = $descripcion ?: $producto->producto;
                    $precio      = $precio ?: $producto->p_venta;
                }

                $linea = $precio * $cantidad;

                CotizacionDetalle::create([
                    'id_cotizacion'   => $cotizacion->id_cotizacion,
                    'descripcion'     => $descripcion,
                    'id_producto'     => $idProducto,
                    'cantidad'        => $cantidad,
                    'precio_unitario' => $precio,
                ]);

                $subtotal += $linea;
            }

            $cotizacion->update([
                'subtotal' => $subtotal,
                'iva'      => 0,
                'total'    => $subtotal
            ]);

            DB::commit();

            $cotizacion = Cotizacion::with('cliente', 'detalles.producto')
                ->find($cotizacion->id_cotizacion);

            $pdf = Pdf::loadView('quotes.pdf', compact('cotizacion'))
                ->setPaper('letter', 'portrait');

            return $pdf->download('cotizacion_' . $cotizacion->id_cotizacion . '.pdf');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    // Listar cotizaciones
    public function indexView()
    {
        $cotizaciones = Cotizacion::with('cliente')->latest('id_cotizacion')->get();
        return view('quotes.quote', compact('cotizaciones'));
    }

    // Ver cotización
    public function showView($id)
    {
        $cotizacion = Cotizacion::with('cliente', 'detalles.producto')->findOrFail($id);
        return view('quotes.quoteShow', compact('cotizacion'));
    }
}
