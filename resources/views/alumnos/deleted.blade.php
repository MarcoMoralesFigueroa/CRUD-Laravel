@extends('layout/template')

@section('title', 'Alumnos | Borrados')

@section('content')
    <main>
        <div class="container py-4">
            <div class="p-3 mb-4 bg-secondary bg-opacity-25 rounded shadow">
                <h2>Listado de Alumnos</h2>

            </div>

            <div class="p-3 bg-secondary bg-opacity-25 rounded shadow">
                {{-- <div class="mb-3">
                    <a href="{{ url('alumnos/create') }}" class="btn btn-primary btn-sm">Nuevo Registro</a>
                </div> --}}

                <div class="rounded border">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Matricula</th>
                                <th scope="col">Nombre Completo</th>
                                <th scope="col">Fecha de Nacimiento</th>
                                <th scope="col">Telefono</th>
                                <th scope="col">Email</th>
                                <th scope="col">Nivel</th>
                                <th scope="col">Fecha de Eliminacion</th>
                                {{-- <th scope="col">Is Deleted</th> --}}
                                {{-- <th></th> --}}
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($alumnosDeleted as $alumno)
                                <tr>
                                    <td>{{ $alumno->id }}</td>
                                    <td>{{ $alumno->matricula }}</td>
                                    <td>{{ $alumno->nombre }}</td>
                                    <td>{{ \Carbon\Carbon::parse($alumno->fecha_nacimiento)->format('d-m-Y') }}</td>
                                    <td>{{ $alumno->telefono }}</td>
                                    <td>{{ $alumno->email }}</td>
                                    <td>{{ $alumno->nivel->nombre ?? 'N/A' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($alumno->fecha_delete)->format('d-m-Y H:i:s') }}</td>
                                    {{-- <td>{{ $alumno->is_deleted }}</td> --}}
                                    {{-- <td><a href="{{ url('alumnos/' . $alumno->id . '/edit') }}"
                                            class="btn btn-warning btn-sm">Editar</a></td> --}}
                                    <td>
                                        <form action="{{ route('alumnos.restore', $alumno->id) }}" method="post">
                                            @csrf
                                            @method('patch')
                                            <button type="submit" class="btn btn-success btn-sm">Restaurar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end">
                    {!! $alumnosDeleted->links() !!}
                </div>
            </div>

        </div>
    </main>
@endsection
