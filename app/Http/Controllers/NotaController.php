<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
class NotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $notas = Nota::latest()->get();
        return view('notas.index', compact('notas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('notas.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'titulo'    => 'required|string|max:100',
            'contenido' => 'nullable|string',
            'fijada'    => 'required|in:0,1',
        ], [
            'titulo.required' => 'El título de la nota es obligatorio.',
            'titulo.max'      => 'El título no puede superar los 100 caracteres.',
            'fijada.required' => 'Debe indicar si la nota está fijada o no.',
        ]);


        try {
            //code...
            $nota = new Nota();
            $nota->titulo = $request->input('titulo');
            $nota->contenido = $request->input('contenido');
            $nota->fijada = $request->input('fijada');
            $nota ->save();

            return redirect()->route('notas.index')->with('succes', 'Nota creada con exito');
        } catch (\Exception $e) {
            //throw $th;
            return back()->withInput()
                         ->with('error', 'Ocurrió un error inesperado. Inténtalo de nuevo.');
        }

        
        $nota = new Nota();
        $nota->titulo = $request->input('titulo');
        $nota->contenido = $request->input('contenido');
        $nota->fijada = $request->input('fijada');
        $nota ->save();

        return redirect()->route('notas.index')->with('succes', 'Nota creada con exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Nota $nota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        //
        $nota= Nota::findOrFail($id);
        return view('notas.create', compact('nota'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Nota $nota)
    {
        //
        $request->validate([
            'titulo'=> "required|max:255",
            //'contenido'=> '',
            'fijada'=>'required:boolean'

        ]);
        $nota -> update([
            'titulo'=>$request->titulo,
            'contenido'=>$request->contenido,
            'fijada'=>$request->fijada,
        ]);
        
        return redirect()->route('notas.index')->with('success', 'Nota se actualizo');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        //
        $nota = Nota::findOrFail($id);
        $nota->delete();
         return redirect('index')->with('success', 'Nota eliminada con exito');
    }
}
