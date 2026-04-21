@extends('layouts.auth')

@section('page_title', 'Accede a tu cuenta')
@section('auth_title', 'Accede a tu cuenta')
@section('auth_subtitle', 'Toda la información médica de tus mascotas en un solo lugar')

@section('auth_form')
    <form action="#" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label small fw-bold text-secondary">Correo Electrónico</label>
            <input type="email" name="email" class="form-control form-control-lg bg-light border-0 shadow-none"
                   placeholder="tu@ejemplo.com" style="border-radius: 12px; font-size: 1rem;" required>
        </div>
        <div class="mb-3">
            <div class="d-flex justify-content-between">
                <label class="form-label small fw-bold text-secondary">Contraseña</label>
                <a href="#" class="text-decoration-none small fw-semibold">¿Olvidaste tu clave?</a>
            </div>
            <input type="password" name="password" class="form-control form-control-lg bg-light border-0 shadow-none"
                   placeholder="••••••••" style="border-radius: 12px; font-size: 1rem;" required>
        </div>
        <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" id="remember">
            <label class="form-check-label small text-muted" for="remember">
                Mantener sesión iniciada
            </label>
        </div>
        <button type="submit" class="btn btn-primary btn-lg w-100 shadow-sm fw-bold border-0"
                style="border-radius: 12px; padding: 10px; background-color: #00b894;">
            Iniciar Sesión
        </button>
    </form>
    <div class="text-center mt-5">
        <p class="text-muted small">¿Nuevo en Mascotapp?
            <a href="{{ route('auth.register') }}" class="text-primary fw-bold text-decoration-none">Crea una cuenta</a>
        </p>
    </div>
@endsection
