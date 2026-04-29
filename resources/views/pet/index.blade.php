@extends('layouts.main')

@section('content')
<div class="container py-5">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-5 gap-3">
        <div>
            <h1 class="fw-bold text-dark mb-0">Mis Mascotas 🐾</h1>
            <p class="text-muted mb-0">Administra de forma simple y segura los datos de tus mascotas</p>
        </div>
        <a href="{{route('pets.create')}}" class="btn btn-primary shadow-sm fw-bold btn-subtle-hover btn-add-hover"
        style="border-radius: 12px; background-color: #1e7e34; padding: 12px 24px; min-width: 160px; color: white;">
            <span class="me-2">+</span> Agregar Mascota
        </a>
    </div>

    <div class="row g-4">
        @foreach($pets as $pet)
        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 20px; background: #ffffff;">
                <div class="p-3">
                    <div class="d-flex align-items-center justify-content-center"
                         style="height: 150px; background-color: #f0f7f4; border-radius: 15px; position: relative;">
                        <span style="font-size: 3.5rem;">🐶</span>

                        <span class="badge position-absolute top-0 start-0 m-2 border-0"
                              style="background-color: #1e7e34; font-size: 0.7rem; border-radius: 8px;">
                            {{ $pet->gender }}
                        </span>
                    </div>
                </div>

                <div class="card-body pt-0 px-4 pb-4">
                    <div class="mb-3">
                        <h4 class="fw-bold mb-1">{{ $pet->name }}</h4>
                        <p class="text-muted small mb-0">{{ $pet->species}} • {{$pet->birth_date}} </p>
                    </div>

                    <div class="d-flex gap-3 mb-4">
                        <div class="small text-secondary">
                            <strong class="text-dark">Peso:</strong> {{$pet->weight}} Kg
                        </div>
                        <div class="small text-secondary">
                            <strong class="text-dark">Color:</strong> {{$pet->color}}
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-2">
                        <a href="#" class="btn btn-light flex-grow-1 fw-bold btn-subtle-hover btn-ficha-hover"
                           style="background-color: #f8f9fa; color: #1e7e34; border-radius: 10px; font-size: 0.9rem; padding: 10px;">
                            Ver Ficha
                        </a>

                        <a href="{{ route('pets.edit', $pet->id) }}" class="btn btn-light d-flex align-items-center justify-content-center btn-subtle-hover btn-edit-hover"
                           title="Editar" style="width: 40px; height: 40px; border-radius: 10px; background-color: #e9ecef; color: #495057;">
                           <small>✏️</small>
                        </a>
                        <form action="{{ route('pets.destroy', $pet->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este registro?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="btn btn-light d-flex align-items-center justify-content-center btn-subtle-hover btn-delete-hover"
                                title="Eliminar"
                                style="width: 40px; height: 40px; border-radius: 10px; background-color: #fee2e2; color: #dc3545; border: none;">
                            <span style="font-size: 1.2rem;">🗑️</span>
                        </button>
                    </form>

                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
