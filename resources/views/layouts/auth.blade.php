@extends('layouts.main')
@section('content')
<div class="row justify-content-center align-items-center vh-100 m-0">
    <div class="col-11 col-md-8 col-lg-6 col-xxl-4">
        <div class="card border-0 shadow-lg my-4" style="border-radius: 20px;">
            <div class="card-body p-4 p-md-5">
                <div class="text-center mb-4">
                    <div class="d-flex align-items-center justify-content-center mx-auto mb-3"
                        style="width: 80px; height: 80px; border-radius: 50%; background-color: #f0f0ff;">
                        <span style="font-size: 2.5rem;">🐶</span>
                    </div>
                    <h2 class="fw-bold text-dark">@yield('auth_title')</h2>
                    <p class="text-muted">@yield('auth_subtitle')</p>
                </div>
                @yield('auth_form')
            </div>
        </div>
        <div class="text-center pb-4">
            <small class="text-muted">&copy; {{ date('Y') }} Mascotapp</small>
        </div>
    </div>
</div>
@endsection
