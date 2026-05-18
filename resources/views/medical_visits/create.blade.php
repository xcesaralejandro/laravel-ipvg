@extends('layouts.main')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm p-4" style="border-radius: 20px;">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold" style="color: #333;">Nueva Visita Médica 🩺</h2>
                        <p class="text-muted">Registrar consulta para <strong>{{ $pet->name }}</strong></p>
                    </div>

                    <form action="{{ route('medical-visits.store', ['pet_id' => $pet->id]) }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label fw-semibold">Fecha de la Visita</label>
                                <input type="date" name="visit_date" value="{{ old('visit_date', date('Y-m-d')) }}"
                                    class="form-control bg-light border-0 py-2" />
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">Motivo de la Consulta</label>
                                <input type="text" name="reason" value="{{ old('reason') }}"
                                    class="form-control bg-light border-0 py-2"
                                    placeholder="Ej: Control de vacunas, decaimiento..." />
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">Diagnóstico</label>
                                <textarea name="diagnosis" class="form-control bg-light border-0 py-2" rows="2"
                                    placeholder="Resultado de la evaluación médica (opcional)">{{ old('diagnosis') }}</textarea>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">Tratamiento</label>
                                <textarea name="treatment" class="form-control bg-light border-0 py-2" rows="2"
                                    placeholder="Medicamentos o indicaciones (opcional)">{{ old('treatment') }}</textarea>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">Notas Adicionales</label>
                                <textarea name="notes" class="form-control bg-light border-0 py-2" rows="2"
                                    placeholder="Observaciones extra (opcional)">{{ old('notes') }}</textarea>
                            </div>

                            @if ($errors->any())
                                <div class="col-12 mt-3">
                                    <div class="alert alert-danger pb-0">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif

                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary btn-sm px-3 w-100">
                                    Guardar visita médica
                                </button>
                                <a href="{{ route('medical-visits.index', $pet->id) }}"
                                    class="btn btn-link w-100 text-decoration-none text-muted mt-2">Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .form-control:focus,
        .form-select:focus {
            background-color: #fff !important;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
            border: 1px solid #0d6efd !important;
        }

        body {
            background-color: #f8f9fa;
        }
    </style>
@endsection
