@extends('layouts.auth')

@section('page_title', 'Crear cuenta')
@section('auth_title', 'Crear cuenta')
@section('auth_subtitle', 'Comienza a gestionar la salud de tus mascotas')

@section('auth_form')
    <form action="#" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label small fw-bold text-secondary">Nombre</label>
                <input type="text" name="name" class="form-control bg-light border-0 shadow-none"
                       placeholder="Ej: Juan" style="border-radius: 12px; padding: 10px;" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label small fw-bold text-secondary">Apellido</label>
                <input type="text" name="surname" class="form-control bg-light border-0 shadow-none"
                       placeholder="Ej: Pérez" style="border-radius: 12px; padding: 10px;" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label small fw-bold text-secondary">Correo Electrónico</label>
            <input type="email" name="email" class="form-control bg-light border-0 shadow-none"
                   placeholder="correo@ejemplo.com" style="border-radius: 12px; padding: 10px;" required>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label small fw-bold text-secondary">Género</label>
                <select name="gender" class="form-select bg-light border-0 shadow-none"
                        style="border-radius: 12px; padding: 10px;" required>
                    <option value="" selected disabled>Selecciona...</option>
                    <option value="male">Masculino</option>
                    <option value="female">Femenino</option>
                    <option value="other">Otro</option>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label small fw-bold text-secondary">Fecha de nacimiento</label>
                <input type="date" name="birth_date" class="form-control bg-light border-0 shadow-none"
                       style="border-radius: 12px; padding: 10px;" required>
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label small fw-bold text-secondary">Contraseña</label>
            <input type="password" name="password" class="form-control bg-light border-0 shadow-none"
                   placeholder="Crea una clave segura" style="border-radius: 12px; padding: 10px;" required>
        </div>

        <button type="submit" class="btn btn-primary btn-lg w-100 shadow-sm fw-bold border-0"
                style="border-radius: 12px; padding: 10px; background-color: #00b894;">
            Registrarme
        </button>
    </form>

    <div class="text-center mt-4">
        <p class="text-muted small">¿Ya tienes cuenta?
            <a href="{{ route('auth.login') }}" class="text-primary fw-bold text-decoration-none">Inicia sesión</a>
        </p>
    </div>
@endsection
