<?php

namespace App\Http\Controllers;

use App\Models\Emergencia;
use App\Models\Estructura;
use App\Models\FrenteTrabajo;
use App\Models\Municipio;
use App\Models\ImagenesEmergencia;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EmergenciasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Emergencia::with('municipio', 'parroquia', 'estructura', 'frente_trabajo', 'frente_trabajo.organismo', 'imagenes_emergencias')->get();

        return response()->json([
            'status' => 'ok',
            'data' => $data
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = Emergencia::create([
            'sector' => $request->sector,
            'coordenadas' => $request->coordenadas,
            'parroquia_id' => $request->parroquia_id,
            'municipio_id' => $request->municipio_id,
            'estructura_id' => $request->estructura_id,
            'frente_id' => $request->frente_id,
            'situacion' => $request->situacion,
            'causas' => $request->causas,
            'personas_afectadas' => $request->personas_afectadas,
            'heridos' => $request->heridos,
            'fallecidos' => $request->fallecidos,
            'desaparecidos' => $request->desaparecidos,
            'descripcion' => $request->descripcion,
            'familias_afectadas' => $request->familias_afectadas,
            'estructura_afectcantidad' => $request->estructura_afectcantidad,
            'status' => $request->status,
            'fecha_evento' => $request->fecha_evento

        ]);
        if ($request->hasFile("img")) {
            $imagenes = $request->file("img");
            foreach ($imagenes as $imagen) {
                $nombreimagen = carbon::now()->format('YmdHis') . "." . $imagen->getClientOriginalName();
                $ruta = public_path("imagenes_emergencias/");
                $imagen->move($ruta, $nombreimagen);

                ImagenesEmergencia::create([
                    'emergencia_id' => $data->id,
                    'ruta' => $nombreimagen
                ]);
            }
        } else {
            // return "no hay imagen";
        }
        return response()->json([
            'status' => 'ok',
            'data' => $data
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Emergencia::with('municipio', 'parroquia', 'estructura', 'frente_trabajo', 'frente_trabajo.organismo', 'imagenes_emergencias')->where('id', $id)->get();
        if ($data) {
            return response()->json([
                'status' => 'ok',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Registro no encontrado'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = Emergencia::find($id)->fill($request->all())->save();

        if ($request->hasFile("img")) {
            ImagenesEmergencia::where('emergencia_id', $id)->delete();
            $imagenes = $request->file("img");
            foreach ($imagenes as $imagen) {
                $nombreimagen = carbon::now()->format('YmdHis') . "." . $imagen->getClientOriginalName();
                $ruta = public_path("imagenes_emergencias/");
                $imagen->move($ruta, $nombreimagen);

                ImagenesEmergencia::create([
                    'emergencia_id' => $id,
                    'ruta' => $nombreimagen
                ]);
            }
        } else {
            // return "no hay imagen";
        }
        return response()->json([
            'status' => 'ok',
            'data' => $data
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Emergencia::find($id)->delete();
        return response()->json([
            'status' => 'ok',
            'message' => "data eliminada con éxito"
        ], 200);
    }

    public function list()
    {
        $data = Emergencia::all();
        $municipios = Municipio::where('estado_id', 19)->get();
        $frentes = FrenteTrabajo::all();
        $estructuras = Estructura::all();
        return view('admin.emergencias.index', compact('data', 'municipios', 'frentes', 'estructuras'));
    }
}
