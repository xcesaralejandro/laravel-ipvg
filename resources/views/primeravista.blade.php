@extends('layouts.main')

@section('content')
    <form action="{{ route('primera_pagina') }}" method="get">
        <input type="text" placeholder="buscar" name="search" />
        <input type="submit" />
    </form>

    <h1>Soy el contenido</h1>
    @if ($isAdmin)
        <h2>Bienvenido, administrador!</h2>
    @endif

    {{ $title }}

    <ul>
        @foreach ($fruits as $fruit)
            <li> {{ $fruit }} </li>
        @endforeach
    </ul>
@endsection
