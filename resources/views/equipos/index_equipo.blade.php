@extends('layout.plantilla')

@section('titulo', 'Equipos')
@section('contenido')
    <h3 class="mb-4">Lista de equipos</h3>
    <div class="mb-4 p-2 border rounded shadow-sm bg-light" style="background-color: #F8F1F6;">
        <div class="d-flex justify-content-end">
            <a href="{{ route('equipos.create') }}" class="btn btn-primary">+ Nuevo equipo</a>
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
                <th class="text-start">Nombre</th>
                <th class="text-start">Director técnico</th>
                <th class="text-start">Categoría</th>
                <th class="text-start">Presidente</th>
                <th class="text-start">Fecha de fundación</th>
                <th class="text-start">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($equipos as $equipo)
                <tr class="align-middle" style="background-color: #F9F0F7; border-radius: 5px;">
                    <td class="text-uppercase">{{ $equipo->nombre }}</td>
                    <td class="text-uppercase">{{ $equipo->director_tecnico }}</td>
                    <td class="text-uppercase">{{ $equipo->categoria }}</td>
                    <td class="text-uppercase">{{ $equipo->dueño }}</td>
                    <td>{{ date('d-m-Y', strtotime($equipo->fecha_fundacio)) }}</td>
                    <td>
                        <a href="{{ route('equipos.edit', $equipo->id) }}" class="btn btn-sm btn-secondary">Editar</a>
                        <a href="{{ route('equipos.show', $equipo->id) }}" class="btn btn-sm btn-warning">Mostrar</a>

                        <!-- Botón eliminar con modal -->
                        <button type="submit" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modal{{$equipo->id}}">
                            Eliminar
                        </button>
                        <div class="modal fade" id="modal{{$equipo->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar equipo</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Desea realmente eliminar el equipo {{$equipo->nombre}}?
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('equipos.destroy', $equipo->id) }}" method="post" style="display: inline-block;">
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
                    <td colspan="6" class="text-center text-muted">No hay equipos registrados</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $equipos->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
