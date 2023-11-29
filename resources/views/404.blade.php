@extends('layout/template')

@section('title', 'Página no encontrada')

@section('content')
    <main>
        <div class="container py-4">
            <div class="p-3 mb-4 bg-secondary bg-opacity-25 rounded">
                <h2>Página no encontrada</h2>
                <p>La ruta solicitada no existe.</p>
                {{-- Otras informaciones de la solicitud si es necesario --}}
            </div>
        </div>
    </main>
@endsection
