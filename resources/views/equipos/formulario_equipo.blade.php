@extends('layout.plantilla')

@section('titulo', 'Equipos')
@section('contenido')
    <div class="container" style="margin-top: 50px">
        <h1>{{ isset($equipo) ? 'Editar equipo: ' : 'Crear nuevo equipo' }}</h1>
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

        <form action="{{ isset($equipo) ? route('equipos.update', $equipo->id) : route('equipos.store') }}" method="POST">
            @csrf
            @if(isset($equipo))
                @method('PUT')
            @endif
            <div class="row">
                <div class="col-4 mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ isset($equipo) ? $equipo->nombre : old('nombre') }}" maxlength="50" placeholder="Escriba el nombre del equipo">
                </div>
                <div class="col-4 mb-3">
                    <label for="fecha" class="form-label">Fecha de fundación:</label>
                    <input type="date" class="form-control" id="fecha" name="fecha" value="{{ isset($equipo) ? $equipo->fecha_fundacion : old('fecha') }}">
                </div>
                <div class="col-4 mb-3">
                    <label for="codigo" class="form-label">Código:</label>
                    <input type="text" class="form-control" id="codigo" name="codigo" value="{{ isset($equipo) ? $equipo->codigo : old('codigo') }}" maxlength="10" placeholder="Escriba el código del equipo">
                </div>
            </div>
            <div class="row">
                <div class="col-4 mb-3">
                    <label for="dueño" class="form-label">Nombre del dueño:</label>
                    <input type="text" class="form-control" id="dueño" name="dueño" value="{{ isset($equipo) ? $equipo->dueño : old('dueño') }}" maxlength="50" placeholder="Escriba el nombre del dueño">
                </div>
                <div class="col-4 mb-3">
                    <label for="director" class="form-label">Nombre del director técnico:</label>
                    <input type="text" class="form-control" id="director" name="director" value="{{ isset($equipo) ? $equipo->director_tecnico : old('director') }}" maxlength="50" placeholder="Escriba el nombre del director técnico">
                </div>
                <div class="col-4 mb-3">
                    <label for="categoria" class="form-label">Categoría:</label>
                    <select name="categoria" id="categoria" class="form-control">
                        <option value="">Seleccione la categoría</option>
                        <option value="Primera división" {{ (isset($equipo) && ($equipo->categoria == 'Primera división')) || old('categoria') == 'Primera división' ? 'selected' : '' }}>Primera división</option>
                        <option value="Segunda división" {{ (isset($equipo) && ($equipo->categoria == 'Segunda división')) || old('categoria') == 'Segunda división' ? 'selected' : '' }}>Segunda división</option>
                        <option value="Juvenil" {{ (isset($equipo) && ($equipo->categoria == 'Juvenil')) || old('categoria') == 'Juvenil' ? 'selected' : '' }}>Juvenil</option>
                    </select>
                </div>
            </div>

            <hr>
            <button type="submit" class="btn btn-success">{{ isset($equipo) ? 'Actualizar equipo' : 'Guardar equipo' }}</button>
            <a href="{{ route('equipos.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
