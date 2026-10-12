<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductoRequest;
use App\Models\Marca;
use App\Models\Producto;
//use App\Models\Productos;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $productos = Producto::latest()->paginate(10);
        return view('productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $marcas = Marca::orderBy('nombre', 'asc')->get();
        return view('productos.create', compact('marcas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductoRequest $request)
    {
        //
        Producto::create($request->validated());

        return redirect()->route('productos.index')->with('success', 'Producto Creado');

    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $productos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        //
        $marcas= Marca::orderBy('nombre', 'asc')->get();
        return view('productos.create', compact('producto', 'marcas'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductoRequest $request, Producto $producto)
    {
        //
        $producto->update($request->validated());
        return redirect()->route('productos.index')->with('success', 'Producto editado con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        //
        $producto = Producto::findOrFail($id);
        $producto ->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente');

    }
}
