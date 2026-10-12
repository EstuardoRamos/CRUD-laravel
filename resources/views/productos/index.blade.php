@extends('layouts.app')

@section('content')
<div class="row mb-3">
    <div class="col-md-6">
        <h2>Lista de Registros</h2>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('productos.create') }}" class="btn btn-primary">
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
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Activo</th>
                        <th>Marca</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($productos as $producto)
                        <tr>
                            <td>{{ $producto->id }}</td>
                            <td>{{ $producto->nombre }}</td>
                            <td>{{ $producto->description }}</td>
                            <!-- Formato de precio con 2 decimales y signo de moneda opcional -->
                            <td>Q. {{ number_format($producto->precio, 2) }}</td>
                            <td>{{ $producto->stock }}</td>
                            <td>
                                <!-- Uso de badges para mayor impacto visual -->
                                @if($producto->activo)
                                    <span class="badge bg-success">Sí</span>
                                @else
                                    <span class="badge bg-secondary">No</span>
                                @endif
                            </td>
                            <!-- Operador nullsafe (?->) para evitar errores si no hay marca -->
                            <td>{{ $producto->marca?->nombre ?? 'Sin marca' }}</td>
                            <td class="text-center">
                                <!-- Botón Editar -->
                                <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-sm btn-warning" title="Editar">
                                    <i class="fa fa-pen"></i>
                                </a>
                                <!-- Botón Eliminar -->
                                <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este registro?');">
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
                            <!-- CORREGIDO: Colspan en 8 para abarcar toda la tabla -->
                            <td colspan="8" class="text-center text-muted py-4">No hay registros encontrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este producto?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                
            </button>
        </form>
        <!-- Paginación conectada a la variable correcta -->
        <div class="mt-3">
            {{ $productos->links() }}
        </div>
    </div>
</div>
@endsection