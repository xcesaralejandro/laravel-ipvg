@extends('layouts.main')

@section('content')
    <div class="container py-5">
        <div class="d-flex justify-content-between mb-5">
            <div class="d-flex align-items-center">
                <div class="bg-white shadow-sm rounded-circle d-flex align-items-center justify-content-center me-3"
                    style="width: 70px; height: 70px; font-size: 2rem;">
                    {{ $pet->photo }}
                </div>
                <div>
                    <h1 class="fw-bold m-0 text-dark">Atenciones de {{ $pet->name }}</h1>
                    <p class="text-muted m-0">Historial clínico de tu mascota</p>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('medical-visits.create', ['pet_id' => $pet->id]) }}" class="btn btn-primary btn-sm px-3">
                    <span class="me-2">+</span> Nueva Visita Médica
                </a>
                <a href="{{ route('pets.index') }}" class="btn-back">
                    <i class="bi bi-arrow-left"></i>
                </a>
            </div>
        </div>

        @if ($pet->medicalVisits->count() == 0)
            <div class="card border-0 shadow-sm rounded-4 p-5 text-center">
                <p class="text-muted fs-5 mb-0">No se han registrado visitas médicas todavía.</p>
            </div>
        @else
            <div class="row">
                @foreach ($pet->medicalVisits as $key => $visit)
                    <div class="col-12 mb-4">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center justify-content-between mb-4 border-bottom pb-3">

                                    <h3 class="fw-bold mb-0 text-primary" style="letter-spacing: -0.5px;">
                                        {{ ucfirst($visit->reason) }}
                                    </h3>
                                    <span class="badge rounded-pill bg-success px-3 py-2 mb-2 shadow-sm"
                                        style="font-size: 0.8rem;">
                                        📅 {{ \Carbon\Carbon::parse($visit->visit_date)->format('d / m / Y') }}
                                    </span>

                                </div>

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="p-4 rounded-4 h-100 border-0" style="background-color: #f1f3f5;">
                                            <div class="d-flex align-items-center mb-2">
                                                <span class="me-2">🩺</span>
                                                <label
                                                    class="fw-bolder small text-uppercase text-secondary">Diagnóstico</label>
                                            </div>
                                            <div class="text-dark lh-base">
                                                {{ $visit->diagnosis }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="p-4 rounded-4 h-100 border-0" style="background-color: #f1f3f5;">
                                            <div class="d-flex align-items-center mb-2">
                                                <span class="me-2">💊</span>
                                                <label
                                                    class="fw-bolder small text-uppercase text-secondary">Tratamiento</label>
                                            </div>
                                            <div class="text-dark lh-base">
                                                {{ $visit->treatment }}
                                            </div>
                                        </div>
                                    </div>

                                    @if ($visit->notes)
                                        <div class="col-12 mt-3">
                                            <div class="p-3 bg-white border-start border-4 border-success rounded-end-3">
                                                <label class="fw-bold small text-uppercase text-success d-block mb-1">Notas
                                                    de la atención</label>
                                                <p class="mb-0 text-muted small fst-italic">{{ $visit->notes }}</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <style>
        body {
            background-color: #f0f4f8;
        }

        .rounded-4 {
            border-radius: 1.5rem !important;
        }

        .text-primary {
            color: #2c3e50 !important;
        }
    </style>
@endsection
