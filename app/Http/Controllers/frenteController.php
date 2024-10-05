<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FrenteTrabajo;
use App\Models\Municipio;
use App\Models\Organismo;

class frenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = FrenteTrabajo::with('organismo', 'emergencias')->get();
        
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
        $data = FrenteTrabajo::create([
            'descripcion' => $request->descripcion,
            'area_abarca' => $request->area_abarca,
            'coordenadas' => $request->coordenadas,
            'organismo_id' => $request->organismo_id,
            'municipio_id' => $request->municipio_id
            
        ]);
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
        $data = FrenteTrabajo::where('id', $id)->get();
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
        $data = FrenteTrabajo::find($id)->fill($request->all())->save();
        return response()->json([
           'status' => 'ok',
            'data' => 'Data',
            
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = FrenteTrabajo::find($id)->delete();
        return response()->json([
            'status' => 'ok',
            'message' => "data eliminada con éxito"
        ], 200);
    }

    public function list()
    {
        $data = FrenteTrabajo::with('organismo', 'emergencias')->get();
        $municipios = Municipio::where('estado_id',19)->get();
        $organismos = Organismo::all();
        return view('admin.frentes.index', compact('data','municipios','organismos'));
    }
}
