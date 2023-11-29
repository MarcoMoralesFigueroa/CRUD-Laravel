@extends('layout/template')

@section('title', 'Alumnos | Escuela')

@section('content')
    <main>
        <div class="container py-4">
            <div class="p-3 mb-4 bg-secondary bg-opacity-25 rounded shadow">
                <h2>Listado de Alumnos</h2>

            </div>

            <div class="p-3 bg-secondary bg-opacity-25 rounded shadow">
                <div class="mb-3">
                    <a href="{{ url('alumnos/create') }}" class="btn btn-primary btn-sm">Nuevo Registro</a>
                </div>

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
                                {{-- <th scope="col">Is Deleted</th> --}}
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($alumnos as $alumno)
                                <tr>
                                    <td>{{ $alumno->id }}</td>
                                    <td>{{ $alumno->matricula }}</td>
                                    <td>{{ $alumno->nombre }}</td>
                                    <td>{{ \Carbon\Carbon::parse($alumno->fecha_nacimiento)->format('d-m-Y') }}</td>
                                    <td>{{ $alumno->telefono }}</td>
                                    <td>{{ $alumno->email }}</td>
                                    <td>{{ $alumno->nivel->nombre ?? 'N/A' }}</td>
                                    {{-- <td>{{ $alumno->is_deleted }}</td> --}}
                                    <td><a href="{{ url('alumnos/' . $alumno->id . '/edit') }}"
                                            class="btn btn-warning btn-sm">Editar</a></td>
                                    <td>


                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal">
                                            Eliminar
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar
                                                            Registro</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>¿Estas seguro que desea eliminar este registro?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cerrar</button>
                                                        <form action="{{ url('alumnos/' . $alumno->id) }}" method="post">
                                                            @method('DELETE')
                                                            @csrf

                                                            <button type="submit"
                                                                class="btn btn-danger btn">Eliminar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end">
                    {!! $alumnos->links() !!}
                </div>
            </div>

        </div>
    </main>
@endsection
