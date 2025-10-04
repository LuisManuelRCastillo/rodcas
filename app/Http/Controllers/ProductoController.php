<?php

namespace App\Http\Controllers;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $productos = Producto::paginate(50); 
    return view('catalog.catalog', compact('productos'));
    }

  
}
