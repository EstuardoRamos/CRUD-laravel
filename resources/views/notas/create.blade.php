@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <!-- Dinámico: Cambia de color y título según si estamos editando o creando -->
            <div class="card-header {{ isset($nota) ? 'bg-warning text-dark' : 'bg-primary text-white' }}">
                <h4 class="mb-0">{{ isset($nota) ? 'Editar Nota' : 'Crear Nueva Nota' }}</h4>
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

                <!-- Dinámico: Apunta a 'notas.update' con PUT si existe $nota, o a 'notas.store' con POST si es nueva -->
                <form action="{{ isset($nota) ? route('notas.update', $nota->id) : route('notas.store') }}" method="POST">
                    @csrf
                    @if(isset($nota))
                        @method('PUT')
                    @endif

                    <div class="mb-3">
                        <label for="titulo" class="form-label">Titulo</label>
                        <input type="text" class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo" value="{{ old('titulo', $nota->titulo ?? '') }}" required>
                        @error('titulo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="contenido" class="form-label">Contenido</label>
                        <textarea class="form-control @error('contenido') is-invalid @enderror" id="contenido" name="contenido" rows="3">{{ old('contenido', $nota->contenido ?? '') }}</textarea>
                        @error('contenido')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="fijada" class="form-label">Fijada</label>
                        <select name="fijada" id="fijada" class="form-select @error('fijada') is-invalid @enderror" required>
                            <option value="" disabled {{ old('fijada', $nota->fijada ?? '') === '' ? 'selected' : '' }}>Seleccione una opción</option>
                            <option value="1" {{ old('fijada', $nota->fijada ?? '') == '1' ? 'selected' : '' }}>Sí</option>
                            <option value="0" {{ old('fijada', $nota->fijada ?? '') == '0' ? 'selected' : '' }}>No</option>
                        </select>
                        @error('fijada')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('notas.index') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn {{ isset($nota) ? 'btn-primary' : 'btn-success' }}">
                            {{ isset($nota) ? 'Actualizar' : 'Guardar' }}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection