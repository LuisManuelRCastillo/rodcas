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
    //
    public function createView()
    {
        $clientes = Cliente::all();
        return view('quotes.quotesCreate', compact('clientes'));
    }

    // Búsqueda de productos por nombre (ajax)
    public function buscarProductos(Request $request)
    {
        $query = $request->get('q', '');
        $productos = Producto::where('producto', 'LIKE', "%{$query}%")->get();
        return response()->json($productos);
    }

    // Guardar cotización
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $cotizacion = Cotizacion::create([
                'id_cliente' => $request->id_cliente,
                'subtotal' => 0,
                'iva' => 0,
                'total' => 0,
                'estatus' => 'pendiente'
            ]);

            $subtotal = 0;

            foreach ($request->detalles as $detalle) {
                $producto = Producto::findOrFail($detalle['id_producto']);
                $precio = $detalle['precio_unitario'] ?? $producto->p_venta;
                $linea = $precio * $detalle['cantidad'];

                CotizacionDetalle::create([
                    'id_cotizacion' => $cotizacion->id_cotizacion,
                    'id_producto' => $producto->id_producto,
                    'cantidad' => $detalle['cantidad'],
                    'precio_unitario' => $precio
                ]);

                $subtotal += $linea;
            }

            $iva = $subtotal * 0.16;
            $total = $subtotal;

            $cotizacion->update([
                'subtotal' => $subtotal,
                'iva' => $iva,
                'total' => $total
            ]);

            DB::commit();
            // Cargar cotización completa
$cotizacion = Cotizacion::with('cliente', 'detalles.producto')
                ->find($cotizacion->id_cotizacion);

// Generar PDF
$pdf = Pdf::loadView('quotes.pdf', compact('cotizacion'));

// Descargar PDF automáticamente
return $pdf->download('cotizacion_'.$cotizacion->id_cotizacion.'.pdf');


            return redirect()->route('cotizaciones.show', $cotizacion->id_cotizacion)
                             ->with('success', 'Cotización creada correctamente');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    // Listar cotizaciones
    public function indexView()
    {
        $cotizaciones = Cotizacion::with('cliente')->get();
        return view('quotes.quote', compact('cotizaciones'));
    }

    // Ver cotización
    public function showView($id)
    {
        $cotizacion = Cotizacion::with('cliente', 'detalles.producto')->findOrFail($id);
        return view('quotes.quoteShow', compact('cotizacion'));
    }
}
