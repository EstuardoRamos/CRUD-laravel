@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <!-- Dinámico: Cambia de color y título según si estamos editando o creando -->
            <div class="card-header {{ isset($producto) ? 'bg-warning text-dark' : 'bg-primary text-white' }}">
                <h4 class="mb-0">{{ isset($producto) ? 'Editar producto' : 'Crear Nuevo producto' }}</h4>
            </div>
            <div class="card-body">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                        <i class="fa fa-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Alerta de Error de Servidor / Base de datos -->
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                        <i class="fa fa-triangle-exclamation me-2"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                <!-- Mostrar errores de validación -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Dinámico: Apunta a 'productos.update' con PUT si existe $producto, o a 'productos.store' con POST si es nueva -->
                <form action="{{ isset($producto) ? route('productos.update', $producto->id) : route('productos.store') }}" method="POST">
                    @csrf
                    @if(isset($producto))
                        @method('PUT')
                    @endif

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre', $producto->nombre ?? '') }}" required>
                        @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $producto->description ?? '') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- CORREGIDO: Cambiado a input type="number" con soporte para decimales (step="0.01") -->
                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="number" step="0.01" class="form-control @error('precio') is-invalid @enderror" id="precio" name="precio" value="{{ old('precio', $producto->precio ?? '') }}" required>
                        @error('precio')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- CORREGIDO: Cambiado a input type="number" para inventario/stock -->
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock', $producto->stock ?? '') }}" required>
                        @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                   
                    <div class="mb-3">
                        <label for="marca_id" class="form-label">Marca</label>
                        <select name="marca_id" id="marca_id" class="form-select @error('marca_id') is-invalid @enderror" required>
                            <option value="" disabled {{ old('marca_id', $producto->marca_id ?? '') == '' ? 'selected' : '' }}>Seleccione una opción</option>
                            
                            @foreach ($marcas as $marca)
                                <option value="{{ $marca->id }}" {{ old('marca_id', $producto->marca_id ?? '') == $marca->id ? 'selected' : '' }}>
                                    {{ $marca->nombre }} <!-- (O $marca->numbree según tu BD) -->
                                </option> 
                            @endforeach
                        </select>
                        
                        <!-- CORREGIDO: Apunta a 'marca_id' -->
                        @error('marca_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="activo" class="form-label">Activo</label>
                        <select name="activo" id="activo" class="form-select @error('activo') is-invalid @enderror" required>
                            <option value="" disabled {{ old('activo', $producto->activo ?? '') === '' ? 'selected' : '' }}>Seleccione una opción</option>
                            <option value="1" {{ old('activo', $producto->activo ?? '') == '1' ? 'selected' : '' }}>Sí</option>
                            <option value="0" {{ old('activo', $producto->activo ?? '') == '0' ? 'selected' : '' }}>No</option>
                        </select>
                        @error('activo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn {{ isset($producto) ? 'btn-primary' : 'btn-success' }}">
                            {{ isset($producto) ? 'Actualizar' : 'Guardar' }}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection