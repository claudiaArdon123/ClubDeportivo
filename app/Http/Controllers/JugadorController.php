<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Jugador;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JugadorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jugadores = Jugador::Paginate(10);
        return view('jugadores.index_jugador', compact('jugadores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $equipos = Equipo::all();
        return view('jugadores.formulario_jugador', compact('equipos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string',
            'apellidos' => 'required|string',
            'identidad' => 'required|string|unique:jugadores,identidad',
            'edad' => 'required|integer|min:0',
            'nacionalidad' => 'required|string',
            'posicion_juego' => 'required|string',
            'fecha_nacimiento' => 'required|date',
        ], [
            'nombres.required' => 'El nombre del jugador es obligatorio',
            'apellidos.required' => 'El apellido del jugador es obligatorio',
            'identidad.required' => 'La identidad del jugador es obligatoria',
            'identidad.unique' => 'La identidad ya está registrada para otro jugador',
            'edad.required' => 'La edad es obligatoria',
            'edad.integer' => 'La edad debe ser un número entero',
            'edad.min' => 'La edad no puede ser negativa',
            'nacionalidad.required' => 'La nacionalidad es obligatoria',
            'posicion_juego.required' => 'La posición de juego es obligatoria',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria',
            'fecha_nacimiento.date' => 'La fecha de nacimiento debe ser una fecha válida',
            'equipo_id.required' => 'Debe seleccionar un equipo',
        ]);

        $jugadorNuevo = new Jugador();
        $jugadorNuevo->nombres = $request->input('nombres');
        $jugadorNuevo->apellidos = $request->input('apellidos');
        $jugadorNuevo->identidad = $request->input('identidad');
        $jugadorNuevo->edad = $request->input('edad');
        $jugadorNuevo->nacionalidad = $request->input('nacionalidad');
        $jugadorNuevo->posicion_juego = $request->input('posicion_juego');
        $jugadorNuevo->fecha_nacimiento = $request->input('fecha_nacimiento');
        $jugadorNuevo->equipo_id = $request->input('equipo_id');

        if ($jugadorNuevo->save()) {
            return redirect()->route('jugadores.index')->with('mensaje', 'El jugador se ha guardado exitosamente.');
        } else {
            return redirect()->route('jugadores.index')->with('mensaje', 'Error, el jugador no se ha guardado exitosamente.');
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $jugador = Jugador::findOrfail($id);
        return view('jugadores.show_jugador', compact('jugador'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jugador = Jugador::findOrfail($id);
        $equipos = Equipo::all();
        return view('jugadores.formulario_jugador', compact('jugador', 'equipos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombres' => 'required|string',
            'apellidos' => 'required|string',
            'identidad' => ['required', Rule::unique('jugadores', 'identidad')->ignore($id)],
            'edad' => 'required|integer|min:0',
            'nacionalidad' => 'required|string',
            'posicion_juego' => 'required|string',
            'fecha_nacimiento' => 'required|date',
        ], [
            'nombres.required' => 'El nombre del jugador es obligatorio',
            'apellidos.required' => 'El apellido del jugador es obligatorio',
            'identidad.required' => 'La identidad del jugador es obligatoria',
            'identidad.unique' => 'La identidad ya está registrada para otro jugador',
            'edad.required' => 'La edad es obligatoria',
            'edad.integer' => 'La edad debe ser un número entero',
            'edad.min' => 'La edad no puede ser negativa',
            'nacionalidad.required' => 'La nacionalidad es obligatoria',
            'posicion_juego.required' => 'La posición de juego es obligatoria',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria',
            'fecha_nacimiento.date' => 'La fecha de nacimiento debe ser una fecha válida',
            'equipo_id.required' => 'Debe seleccionar un equipo',
        ]);

        $jugador = Jugador::findOrfail($id);
        $jugador->nombres = $request->input('nombres');
        $jugador->apellidos = $request->input('apellidos');
        $jugador->identidad = $request->input('identidad');
        $jugador->edad = $request->input('edad');
        $jugador->nacionalidad = $request->input('nacionalidad');
        $jugador->posicion_juego = $request->input('posicion_juego');
        $jugador->fecha_nacimiento = $request->input('fecha_nacimiento');
        $jugador->equipo_id = $request->input('equipo_id');

        if ($jugador->save()) {
            return redirect()->route('jugadores.index')->with('mensaje', 'El jugador se ha actualizado exitosamente.');
        } else {
            return redirect()->route('jugadores.index')->with('mensaje', 'Error, el jugador no se ha actualizado exitosamente.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jugador = Jugador::findOrfail($id);
        if($jugador->equipo_id == ''){
            if ($jugador->delete()){
                return redirect()->route('jugadores.index')->with('mensaje', 'El jugador se ha borrado exitosamente.');
            }
            else{
                return redirect()->route('jugadores.index')->with('mensaje', 'Error, El jugador no se ha borrado exitosamente.');
            }
        }
        else{

            return redirect()->route('jugadores.index')->with('error', 'Error, El jugador no se ha sido borrado porque está asociado a un jugador.');
        }
    }
}
