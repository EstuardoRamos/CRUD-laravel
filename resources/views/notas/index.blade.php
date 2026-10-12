@extends('layouts.app')

@section('content')
<div class="row mb-3">
    <div class="col-md-6">
        <h2>Lista de Registros</h2>
    </div>
    <div class="col-md-6 text-end">
        <!-- Reemplaza 'items.create' por la ruta de tu controlador -->
        <a href="{{ route('notas.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"></i> Nuevo Registro
        </a>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Titulo</th>
                        <th>Contenido</th>
                        <th>Fijado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($notas as $nota)
                        <tr>
                            <td>{{ $nota->id }}</td>
                            <td>{{ $nota->titulo }}</td>
                            <td>{{ $nota->contenido }}</td>
                            <td>{{ $nota->fijada ? 'Si' : 'No'  }}</td>
                            <td class="text-center">
                                <!-- Botón Ver / Detalle -->
                                {{-- <a href="{{ route('notas.show', $notas->id) }}" class="btn btn-sm btn-info text-white" title="Ver">
                                    <i class="fa fa-eye"></i>
                                </a> --}}
                                <!-- Botón Editar -->
                                <a href="{{ route('notas.edit', $nota->id) }}" class="btn btn-sm btn-warning" title="Editar">
                                    <i class="fa fa-pen"></i>
                                </a>
                                <!-- Botón Eliminar (Requiere formulario por seguridad en Laravel) -->
                                <form action="{{ route('notas.destroy', $nota->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este registro?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">No hay registros encontrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Paginación (si usas ->paginate() en el controlador) -->
        <div class="mt-3">
            {{-- {{ $items->links() }} --}}
        </div>
    </div>
</div>
@endsection