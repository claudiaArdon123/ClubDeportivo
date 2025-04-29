@extends('layout.plantilla')

@section('titulo', 'Jugadores')

@section('contenido')
    <h3 class="mb-4">Lista de jugadores</h3>
    <div class="mb-4 p-2 border rounded shadow-sm bg-light" style="background-color: #F8F1F6;">
        <div class="d-flex justify-content-end">
            <a href="{{ route('jugadores.create') }}" class="btn btn-primary">+ Nuevo jugador</a>
        </div>
    </div>

    @if(session('mensaje'))
        <div class="alert alert-success" role="alert">
            {{ session('mensaje') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <hr>
    <div class="table-responsive">
        <table class="table table-bordered table-striped shadow-sm" style="border-radius: 8px;">
            <thead class="text-center" style="background-color: #E0BBE4;">
            <tr>
                <th class="text-start">Nombres</th>
                <th class="text-start">Apellidos</th>
                <th class="text-start">Identidad</th>
                <th class="text-start">Edad</th>
                <th class="text-start">Nacionalidad</th>
                <th class="text-start">Posición</th>
                <th class="text-start">Fecha de nacimiento</th>
                <th class="text-start">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($jugadores as $jugador)
                <tr class="align-middle" style="background-color: #F9F0F7; border-radius: 5px;">
                    <td class="text-uppercase">{{ $jugador->nombres }}</td>
                    <td class="text-uppercase">{{ $jugador->apellidos }}</td>
                    <td>{{ $jugador->identidad }}</td>
                    <td>{{ $jugador->edad }}</td>
                    <td class="text-uppercase">{{ $jugador->nacionalidad }}</td>
                    <td class="text-uppercase">{{ $jugador->posicion_juego }}</td>
                    <td>{{ date('d-m-Y', strtotime($jugador->fecha_nacimiento)) }}</td>
                    <td>
                        <a href="{{ route('jugadores.edit', $jugador->id) }}" class="btn btn-sm btn-secondary">Editar</a>
                        <a href="{{ route('jugadores.show', $jugador->id) }}" class="btn btn-sm btn-warning">Mostrar</a>

                        <!-- Botón eliminar con modal -->
                        <button type="submit" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modal{{$jugador->id}}">
                            Eliminar
                        </button>

                        <div class="modal fade" id="modal{{$jugador->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar jugador</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Desea realmente eliminar al jugador {{ $jugador->nombres }} {{ $jugador->apellidos }}?
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('jugadores.destroy', $jugador->id) }}" method="post" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" value="Eliminar" class="btn btn-success">
                                        </form>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- fin Botón eliminar con modal -->
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">No hay jugadores registrados</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $jugadores->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
