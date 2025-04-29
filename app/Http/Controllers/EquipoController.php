<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class EquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuario = Auth::user();
        $equipos = Equipo::where('user_id', $usuario->id)->paginate(10);
        return view('equipos.index_equipo', compact('equipos', 'usuario'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('equipos.formulario_equipo');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'fecha' => 'required',
            'codigo' => 'required|unique:equipos,codigo',
            'dueño' => 'required',
            'director' => 'required',
            'categoria' => 'required',
        ], [
            'nombre.required' => 'El nombre del equipo es obligatorio',
            'fecha.required' => 'La fecha de fundación es obligatoria',
            'codigo.required' => 'El código es obligatorio',
            'codigo.unique' => 'El código ya está registrado en otro equipo',
            'dueño.required' => 'El nombre del dueño es obligatorio',
            'director.required' => 'El nombre del director técnico es obligatorio',
            'categoria.required' => 'La categoría es obligatoria',
        ]);
        $usuario = Auth::user();

        $equipoNuevo = new Equipo();
        $equipoNuevo->nombre = $request->input('nombre');
        $equipoNuevo->fecha_fundacion = $request->input('fecha');
        $equipoNuevo->codigo = $request->input('codigo');
        $equipoNuevo->categoria = $request->input('categoria');
        $equipoNuevo->director_tecnico = $request->input('director');
        $equipoNuevo->dueño = $request->input('dueño');
        $equipoNuevo->user_id = $usuario->id;

        if($equipoNuevo->save()){
            return redirect()->route('equipos.index')->with('mensaje', 'El equipo se ha guardado exitosamente.');
        }
        else{
            return redirect()->route('equipos.index')->with('mensaje', 'Error, El equipo no se ha guardado exitosamente.');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $equipo = Equipo::findOrfail($id);
        return view('equipos.show_equipo', compact('equipo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $equipo = Equipo::findOrfail($id);
        return view('equipos.formulario_equipo', compact('equipo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required',
            'fecha' => 'required',
            'codigo' => ['required', Rule::unique('equipos', 'codigo')->ignore($id)],
            'dueño' => 'required',
            'director' => 'required',
            'categoria' => 'required',
        ], [
            'nombre.required' => 'El nombre del equipo es obligatorio',
            'fecha.required' => 'La fecha de fundación es obligatoria',
            'codigo.required' => 'El código es obligatorio',
            'codigo.unique' => 'El código ya está registrado en otro equipo',
            'dueño.required' => 'El nombre del dueño es obligatorio',
            'director.required' => 'El nombre del director técnico es obligatorio',
            'categoria.required' => 'La categoría es obligatoria',
        ]);

        $equipo = Equipo::findOrfail($id);
        $equipo->nombre = $request->input('nombre');
        $equipo->fecha_fundacion = $request->input('fecha');
        $equipo->codigo = $request->input('codigo');
        $equipo->categoria = $request->input('categoria');
        $equipo->director_tecnico = $request->input('director');
        $equipo->dueño = $request->input('dueño');

        if($equipo->save()){
            return redirect()->route('equipos.index')->with('mensaje', 'El equipo se ha actualizado exitosamente.');
        }
        else{
            return redirect()->route('equipos.index')->with('mensaje', 'Error, El equipo no se ha actualizado exitosamente.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $equipo = Equipo::findOrfail($id);
        $equipo->jugadores()->update(['equipo_id' => null]);
        if ($equipo->delete()){
            return redirect()->route('equipos.index')->with('mensaje', 'El equipo se ha borrado exitosamente.');
        }
        else{
            return redirect()->route('equipos.index')->with('mensaje', 'Error, El equipo no se ha borrado exitosamente.');
        }

    }
}
