@extends('layout.plantilla')
@section('titulo', 'Equipo')

@section('contenido')
    <div class="d-flex justify-content-center align-items-center">
        <div class="card shadow-lg p-4" style="width: 42rem;">
            <div class="card-body text-center">
                <h3 class="card-title mb-4">Datos del equipo</h3>

                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Fecha de Fundación</th>
                        <th>Código</th>
                        <th>Director Técnico</th>
                        <th>Categoría</th>
                        <th>Dueño</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ $equipo->id }}</td>
                        <td>{{ $equipo->nombre }}</td>
                        <td>{{ date('d-m-Y', strtotime($equipo->fecha_fundacion)) }}</td>
                        <td>{{ $equipo->codigo }}</td>
                        <td>{{ $equipo->director_tecnico }}</td>
                        <td>{{ $equipo->categoria }}</td>
                        <td>{{ $equipo->dueño }}</td>
                    </tr>
                    </tbody>
                </table>

                <h4 class="mt-5 mb-3">Jugadores del equipo</h4>

                @if($equipo->jugadores->count())
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre completo</th>
                            <th>Identidad</th>
                            <th>Edad</th>
                            <th>Nacionalidad</th>
                            <th>Posición de juego</th>
                            <th>Fecha de nacimiento</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($equipo->jugadores as $jugador)
                            <tr>
                                <td>{{ $jugador->id }}</td>
                                <td>{{ $jugador->nombres }} {{ $jugador->apellidos }}</td>
                                <td>{{ $jugador->identidad }}</td>
                                <td>{{ $jugador->edad }}</td>
                                <td>{{ $jugador->nacionalidad }}</td>
                                <td>{{ $jugador->posicion_juego }}</td>
                                <td>{{ date('d-m-Y', strtotime($jugador->fecha_nacimiento)) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="mt-3">Este equipo no tiene jugadores registrados.</p>
                @endif

                <a href="{{ route('equipos.index') }}" class="btn btn-outline-secondary mt-4">Regresar</a>
            </div>
        </div>
    </div>
@endsection
