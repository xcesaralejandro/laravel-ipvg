@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4" style="border-radius: 20px;">
                <div class="text-center mb-4">
                    <h2 class="fw-bold" style="color: #333;">Nueva Mascota 🐾</h2>
                    <p class="text-muted">Ingresa los datos para registrar a tu compañero</p>
                </div>

                <form action="{{route('pets.store')}}" method="POST">
                    @csrf

                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold">Nombre</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control bg-light border-0 py-2" placeholder="Ej: Halsey" />
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Especie</label>
                            <input type="text" name="species" value="{{ old('species') }}" class="form-control bg-light border-0 py-2" placeholder="Canino, felino..." />
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nacimiento</label>
                            <input type="date" name="birth_date" value="{{ old('birth_date') }}" class="form-control bg-light border-0 py-2" />
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Género</label>
                            <select name="gender" class="form-select bg-light border-0 py-2">
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Macho</option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Hembra</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Peso (Kg)</label>
                            <input type="number" name="weight" step="0.1" value="{{ old('weight') }}" class="form-control bg-light border-0 py-2" placeholder="0.0" />
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Color</label>
                            <input type="text" name="color" value="{{ old('color') }}" class="form-control bg-light border-0 py-2" placeholder="Ej: Café" />
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Foto (URL)</label>
                            <input type="text" name="photo" value="{{ old('photo') }}" class="form-control bg-light border-0 py-2" placeholder="http://..." />
                        </div>
                        @if ($errors->any())
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li style="color: red;">{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-success w-100 py-2 fw-bold" style="background-color: #28a745; border-radius: 10px;">
                                Guardar Mascota
                            </button>
                            <a href="{{ url()->previous() }}" class="btn btn-link w-100 text-decoration-none text-muted mt-2">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control:focus, .form-select:focus {
        background-color: #fff !important;
        box-shadow: 0 0 0 0.25rem rgba(40, 167, 69, 0.15);
        border: 1px solid #28a745 !important;
    }
    body {
        background-color: #f0f9f4;
    }
</style>
@endsection
