<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

// incluimos para poder borrar la fotogra en el storage
use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // consultamos datos registrados, paginacion
        $datos['empleados']=Empleado::paginate(5);

        //añadimos las rutas en los metodos a las vistas
        return view('empleado.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //añadimos las rutas en los metodos a las vistas
        return view('empleado.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // request de todos los datos
        // $datosEmpleado = request()->all();

        // request para todos los datos menos el token
        $datosEmpleado = request()->except('_token');


        // cambiamos fotografía temporal a jpg e insertamos a carpeta /storage/public/uploads
        if($request->hasFile('Foto')){
          $datosEmpleado['Foto']=$request->file('Foto')->store('uploads', 'public');
        }

        // recolectamos los datos para la bbdd
        Empleado::insert($datosEmpleado);

        // devuelve en json los datos registrados
        // return response()->json($datosEmpleado);

        // retornar a la vista index
        return redirect('empleado')->with('mensaje', 'Empleado agregado con éxito');



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //recuperamos los datos de la bbdd
          $empleado=Empleado::findOrFail($id);

        return view('empleado.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // actualizamos los datos de la bbdd
          $datosEmpleado = request()->except('_token', '_method');

        // actualizamos fotogra
        if($request->hasFile('Foto')){
          $empleado=Empleado::findOrFail($id);
          Storage::delete(['public/' . $empleado->Foto]);
          $datosEmpleado['Foto']=$request->file('Foto')->store('uploads', 'public');
        }

          Empleado::where('id', '=' ,$id)->update($datosEmpleado);

          $empleado=Empleado::findOrFail($id);
          return view('empleado.edit', compact('empleado'));



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //borrar imagenes de la carpeta storage
        $empleado=Empleado::findOrFail($id);
        if(Storage::delete('public/' . $empleado->Foto)){
          Empleado::destroy($id);
        };

        return redirect('empleado')->with('mensaje', 'Empleado borrado con éxito');
    }















}
