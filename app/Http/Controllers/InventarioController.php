<?php

namespace App\Http\Controllers;
use App\Models\Producto;

use Illuminate\Http\Request;

class InventarioController extends Controller
{
    //
    public function index()
    {
        $productos = Producto::all(); 
    return view('stock.stockView', compact('productos'));
    }
}
