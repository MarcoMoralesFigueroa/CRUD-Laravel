<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Nivel;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use PharIo\Manifest\Url;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alumnos = Alumno::where('is_deleted', false)->orderBy('id', 'desc')->paginate(10);
        return view('alumnos.index', ['alumnos' => $alumnos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('alumnos.create', ['niveles' => Nivel::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'matricula' => 'required|unique:alumnos|max:10',
            'nombre' => 'required|max:255',
            'fecha' => 'required|date',
            'telefono' => 'required|max:9',
            'email' => 'nullable|email',
            'nivel' => 'required'
        ]);

        $alumno = new Alumno();
        $alumno->matricula = $request->input('matricula');
        $alumno->nombre = $request->input('nombre');
        $alumno->fecha_nacimiento = $request->input('fecha');
        $alumno->telefono = $request->input('telefono');
        $alumno->email = $request->input('email');
        $alumno->nivel_id = $request->input('nivel');
        $alumno->save();

        toastr()->success('Registro Guardado Correctamente!', 'OK');
        return redirect()->route('alumnos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $alumno = Alumno::findOrFail($id);
            return view('alumnos.show', ['alumno' => $alumno]);
        } catch (ModelNotFoundException $e) {
            return view('404');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $alumno = Alumno::find($id);
        return view('alumnos.edit', ['alumno' => $alumno, 'niveles' => Nivel::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'matricula' => 'required|max:10|unique:alumnos,matricula,' . $id,
            'nombre' => 'required|max:255',
            'fecha' => 'required|date',
            'telefono' => 'required|max:9',
            'email' => 'nullable|email',
            'nivel' => 'required'
        ]);

        $alumno = Alumno::find($id);
        $alumno->matricula = $request->input('matricula');
        $alumno->nombre = $request->input('nombre');
        $alumno->fecha_nacimiento = $request->input('fecha');
        $alumno->telefono = $request->input('telefono');
        $alumno->email = $request->input('email');
        $alumno->nivel_id = $request->input('nivel');
        $alumno->save();

        toastr()->success('Registro Editado Correctamente!', 'OK');
        return redirect()->route('alumnos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $alumno = Alumno::find($id);
        $alumno->is_deleted = true;
        $alumno->fecha_delete = Carbon::now();
        $alumno->save();

        toastr()->warning('Registro Eliminado!', '¡Cuidado!');
        return redirect("alumnos");
    }

    public function __invoke()
    {
        // Recupera los alumnos eliminados
        $alumnosDeleted = Alumno::where('is_deleted', true)->orderBy('fecha_delete', 'desc')->paginate(10);

        // Devuelve la vista con los alumnos eliminados
        return view('alumnos.deleted', ['alumnosDeleted' => $alumnosDeleted]);
    }

    public function restore($id){

        $alumno = Alumno::find($id);
        $alumno->is_deleted = false;
        $alumno->save();

        toastr()->success('¡Registro Restaurado!', '¡OK!');
        return redirect("eliminados");
    }
}
