@extends('layout.plantilla')

@section('titulo', 'Jugadores')
@section('contenido')
    <div class="container" style="margin-top: 50px">
        <h1>{{ isset($jugador) ? 'Editar jugador: ' : 'Crear nuevo jugador' }}</h1>
        <hr>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ isset($jugador) ? route('jugadores.update', $jugador->id) : route('jugadores.store') }}" method="POST">
            @csrf
            @if(isset($jugador))
                @method('PUT')
            @endif

            <div class="row">
                <div class="col-6 mb-3">
                    <label for="nombres" class="form-label">Nombres:</label>
                    <input type="text" class="form-control" id="nombres" name="nombres"
                           value="{{ isset($jugador) ? $jugador->nombres : old('nombres') }}"
                           maxlength="50" placeholder="Escriba los nombres">
                </div>
                <div class="col-6 mb-3">
                    <label for="apellidos" class="form-label">Apellidos:</label>
                    <input type="text" class="form-control" id="apellidos" name="apellidos"
                           value="{{ isset($jugador) ? $jugador->apellidos : old('apellidos') }}"
                           maxlength="50" placeholder="Escriba los apellidos">
                </div>
            </div>

            <div class="row">
                <div class="col-4 mb-3">
                    <label for="identidad" class="form-label">Identidad:</label>
                    <input type="text" class="form-control" id="identidad" name="identidad"
                           value="{{ isset($jugador) ? $jugador->identidad : old('identidad') }}"
                           maxlength="20" placeholder="Número de identidad">
                </div>
                <div class="col-4 mb-3">
                    <label for="edad" class="form-label">Edad:</label>
                    <input type="number" class="form-control" id="edad" name="edad"
                           value="{{ isset($jugador) ? $jugador->edad : old('edad') }}"
                           min="1" max="100" placeholder="Edad del jugador">
                </div>
                <div class="col-4 mb-3">
                    <label for="nacionalidad" class="form-label">Nacionalidad:</label>
                    <input type="text" class="form-control" id="nacionalidad" name="nacionalidad"
                           value="{{ isset($jugador) ? $jugador->nacionalidad : old('nacionalidad') }}"
                           maxlength="30" placeholder="País de origen">
                </div>
            </div>

            <div class="row">
                <div class="col-4 mb-3">
                    <label for="posicion_juego" class="form-label">Posición de juego:</label>
                    <input type="text" class="form-control" id="posicion_juego" name="posicion_juego"
                           value="{{ isset($jugador) ? $jugador->posicion_juego : old('posicion_juego') }}"
                           maxlength="30" placeholder="Posición (ej: Delantero, Defensa)">
                </div>
                <div class="col-4 mb-3">
                    <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento:</label>
                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento"
                           value="{{ isset($jugador) ? $jugador->fecha_nacimiento : old('fecha_nacimiento') }}">
                </div>
                <div class="col-4 mb-3">
                    <label for="equipo_id" class="form-label">Equipo:</label>
                    <select name="equipo_id" id="equipo_id" class="form-control">
                        <option value="">Seleccione el equipo</option>
                        @foreach($equipos as $equipo)
                            <option value="{{ $equipo->id }}"
                                {{ (isset($jugador) && $jugador->equipo_id == $equipo->id) || old('equipo_id') == $equipo->id ? 'selected' : '' }}>
                                {{ $equipo->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <hr>
            <button type="submit" class="btn btn-success">{{ isset($jugador) ? 'Actualizar jugador' : 'Guardar jugador' }}</button>
            <a href="{{ route('jugadores.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
