@extends('layout.plantilla')
@section('titulo', 'Jugador')

@section('contenido')
    <div class="d-flex justify-content-center align-items-center">
        <div class="card shadow-lg p-4" style="width: 60rem;">
            <div class="card-body text-center">
                <h3 class="card-title mb-4">Datos del jugador</h3>

                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Identidad</th>
                        <th>Edad</th>
                        <th>Nacionalidad</th>
                        <th>Posición de juego</th>
                        <th>Fecha de nacimiento</th>
                        <th>Equipo</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ $jugador->id }}</td>
                        <td>{{ $jugador->nombres }}</td>
                        <td>{{ $jugador->apellidos }}</td>
                        <td>{{ $jugador->identidad }}</td>
                        <td>{{ $jugador->edad }}</td>
                        <td>{{ $jugador->nacionalidad }}</td>
                        <td>{{ $jugador->posicion_juego }}</td>
                        <td>{{ date('d-m-Y', strtotime($jugador->fecha_nacimiento)) }}</td>
                        <td>{{ $jugador->equipo ? $jugador->equipo->nombre : 'No hay equipo asociado' }}</td>
                    </tr>
                    </tbody>
                </table>

                <a href="{{ route('jugadores.index') }}" class="btn btn-outline-secondary mt-4">Regresar</a>
            </div>
        </div>
    </div>
@endsection
